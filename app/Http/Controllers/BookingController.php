<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DoctorProfile;
use App\Models\Bill;
use App\Models\Service;
use Carbon\Carbon;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

use App\Http\Services\AppointmentService;
use App\Http\Services\WorkScheduleService;
use App\Helper\CacheKey;

class BookingController extends Controller
{
    private $appointmentService;
    private $workScheduleService;
    private $cacheKey;

    public function __construct()
    {
        $this->appointmentService = app(AppointmentService::class);
        $this->workScheduleService = app(WorkScheduleService::class);
        $this->cacheKey = new CacheKey();
    }

    /**
     * Get doctor profile with all necessary relationships and aggregations
     */
    private function getDoctorProfileWithStats($doctorProfileId, array $extraRelations = [])
    {
        $baseRelations = ['user', 'medicalCategory', 'services'];
        $relations = array_merge($baseRelations, $extraRelations);

        return DoctorProfile::with($relations)
            ->withCount('reviews')
            ->withAvg('reviews', 'rate')
            ->find($doctorProfileId);
    }

    /**
     * Format price with Vietnamese currency format
     */
    private function formatPrice($price)
    {
        return number_format($price, 0, ',', '.') . ' đ';
    }

    /**
     * Calculate bill details
     */
    private function calculateBill($servicePrice)
    {
        $vat = $servicePrice * 0.1;
        $total = $servicePrice + $vat;

        return [
            'service_price' => $servicePrice,
            'vat' => $vat,
            'total' => $total,
            'formatted' => [
                'service_price' => $this->formatPrice($servicePrice),
                'vat' => $this->formatPrice($vat),
                'total' => $this->formatPrice($total)
            ]
        ];
    }

    public function showDoctorBookingList(Request $request)
    {
        $cacheKey = $this->cacheKey::DOCTOR_LIST_SEARCH_PAGE;
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 12);
        $searchQuery = $request->input('q', '');
        $identity = $request->input('identity', 'doctor');

        // Create unique cache key based on search parameters
        $uniqueCacheKey = $cacheKey . md5($page . $perPage . $searchQuery . $identity);

        $userProfiles = Cache::remember($uniqueCacheKey, 300, function () use ($searchQuery, $identity) {
            return User::where('user_type', 'healthcare')
                ->when($searchQuery, fn($query, $searchQuery) => $query->where(fn($q) => $q->where('name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('email', 'like', '%' . $searchQuery . '%')))
                ->when($identity !== 'doctor', fn($query) => $query->where('identity', $identity))
                ->with([
                    'doctorProfile' => function ($query) {
                        $query->withCount('reviews')
                            ->withAvg('reviews', 'rate')
                            ->with([
                                'medicalCategory',
                                'services' => function ($serviceQuery) {
                                    $serviceQuery->orderBy('price', 'asc');
                                }
                            ]);
                    }
                ])
                ->paginate(9);
        });

        // Transform data to include computed attributes
        $userProfiles->getCollection()->transform(function ($user) {
            if ($user->doctorProfile) {
                // Calculate average rating (rounded to 1 decimal)
                $user->average_rating = $user->doctorProfile->reviews_avg_rate ? round($user->doctorProfile->reviews_avg_rate, 1) : 0;

                // Total reviews count
                $user->total_reviews = $user->doctorProfile->reviews_count ?? 0;
                $user->service_price = $user->doctorProfile->services->isNotEmpty() ? $user->doctorProfile->services->min('price') : 0;

                // Doctor profile ID for easier access
                $user->doctor_profile_id = $user->doctorProfile->id;

                // Set legacy array access for backward compatibility
                $user['id'] = $user->doctorProfile->id;
                $user['average_rating'] = $user->average_rating;
                $user['total_reviews'] = $user->total_reviews;
                $user['service_price'] = $user->service_price;
            }
            return $user;
        });

        $request->session()->put('identity', $identity);

        return view('appointment.search', [
            'userProfiles' => $userProfiles,
        ]);
    }

    public function showDoctorInfo($doctorProfileId)
    {
        $cacheKey = "doctor_profile_{$doctorProfileId}";

        $doctorProfile = Cache::remember($cacheKey, 300, function () use ($doctorProfileId) {
            return $this->getDoctorProfileWithStats($doctorProfileId, ['reviews']);
        });

        if (!$doctorProfile) {
            return redirect()->back()->with('error', 'Doctor profile not found');
        }

        $workSchedules = null;
        if ($doctorProfile->workSchedules) {
            $workSchedules = $this->workScheduleService->getAvailableWorkSchedule(
                $doctorProfile->workSchedules,
                $doctorProfile->id
            );
        }

        return view('appointment.doctor-detail', [
            'doctorProfile' => $doctorProfile,
            'workSchedules' => $workSchedules,
        ]);
    }

    public function showStepOne(Request $request, $doctorProfileId)
    {
        $doctorProfile = $this->getDoctorProfileWithStats($doctorProfileId, ['workSchedules']);

        if (!$doctorProfile) {
            return redirect()->route('appointment.failed')->with('error', 'Doctor profile not found');
        }

        $request->session()->put('appointment.doctor_profile_id', $doctorProfile->id);

        $workSchedules = null;
        try {
            if ($doctorProfile->workSchedules) {
                $workSchedules = $this->workScheduleService->getAvailableWorkSchedule(
                    $doctorProfile->workSchedules,
                    $doctorProfile->id
                );
            }
        } catch (\Throwable $th) {
            Log::error('Error retrieving doctor schedule', [
                'doctor_profile_id' => $doctorProfileId,
                'error' => $th->getMessage()
            ]);
            return redirect()->back()->with('error', 'Error retrieving doctor schedule');
        }

        return view('appointment.step-1', [
            'doctorProfile' => $doctorProfile,
            'workSchedules' => $workSchedules,
        ]);
    }

    public function storeStepOne(Request $request)
    {
        $validated = $request->validate([
            'service' => 'required|integer|exists:services,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
        ]);

        try {
            // Validate service belongs to doctor
            $doctorProfileId = $request->session()->get('appointment.doctor_profile_id');
            $serviceBelongsToDoctor = Service::where('id', $validated['service'])
                ->where('doctor_profile_id', $doctorProfileId)
                ->exists();

            if (!$serviceBelongsToDoctor) {
                return redirect()->back()->with('error', 'Invalid service selection for this doctor.');
            }

            $selectedService = Service::findOrFail($validated['service']);

            // Store service info
            $request->session()->put('appointment.service_id', $validated['service']);
            $request->session()->put('appointment.date', $validated['date']);

            // Calculate time slots
            $duration = $selectedService->duration;
            $startDateTime = Carbon::createFromFormat('H:i', $validated['time']);
            $endDateTime = (clone $startDateTime)->addMinutes($duration);
            $formattedTime = $startDateTime->format('H:i A') . ' - ' . $endDateTime->format('H:i A');

            $request->session()->put('appointment.time', $formattedTime);
            $request->session()->put('appointment.start_time', $startDateTime->format('h:i A'));

            $dayOfWeek = Carbon::parse($validated['date'])->format('l');
            $request->session()->put('appointment.day_of_week', $dayOfWeek);

            return redirect()->route('appointment.step.two');
        } catch (\Throwable $th) {
            Log::error('Error storing step one data', [
                'data' => $validated,
                'error' => $th->getMessage()
            ]);
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
    }

    public function showStepTwo(Request $request)
    {
        $doctorProfileId = $request->session()->get('appointment.doctor_profile_id');

        if (!$doctorProfileId) {
            return redirect()->route('appointment.step.one')->with('error', 'Session expired. Please start again.');
        }

        $doctorProfile = $this->getDoctorProfileWithStats($doctorProfileId);

        if (!$doctorProfile) {
            return redirect()->route('appointment.failed')->with('error', 'Doctor profile not found');
        }

        return view('appointment.step-2', [
            'doctorProfile' => $doctorProfile,
        ]);
    }

    public function storeStepTwo(Request $request)
    {
        $validated = $request->validate([
            'medical_problem' => 'required|string|min:10|max:1000',
            'medical_files' => 'nullable|array|max:10',
            'medical_files.*' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,jpg,jpeg,png',
                'max:5480',
            ],
            'note' => 'nullable|string|max:500',
        ]);

        try {
            $stored = [];

            if ($request->hasFile('medical_files')) {
                foreach ($request->file('medical_files') as $uploadedFile) {
                    if (!$uploadedFile) continue;

                    $filename = Str::uuid() . '.' . $uploadedFile->getClientOriginalExtension();
                    $path = $uploadedFile->storeAs('', $filename, 'tmp_uploads');

                    $stored[] = [
                        'original_name' => $uploadedFile->getClientOriginalName(),
                        'stored_path'   => $path,
                        'mime'          => $uploadedFile->getClientMimeType(),
                        'size'          => $uploadedFile->getSize(),
                    ];
                }

                $request->session()->put('appointment.temporary_files', $stored);
            }

            $request->session()->put('appointment.note', $validated['note'] ?? '');
            $request->session()->put('appointment.medical_problem', $validated['medical_problem']);

            return redirect()->route('appointment.step.three');
        } catch (\Throwable $th) {
            Log::error('Error storing step two data', [
                'data' => $validated,
                'error' => $th->getMessage()
            ]);
            return redirect()
                ->route('appointment.step.two')
                ->with('error', 'An error occurred while processing your files. Please try again.');
        }
    }

    public function showStepThree(Request $request)
    {
        $doctorProfileId = $request->session()->get('appointment.doctor_profile_id');
        $serviceId = $request->session()->get('appointment.service_id');

        if (!$doctorProfileId || !$serviceId) {
            return redirect()->route('appointment.step.one')->with('error', 'Session expired. Please start again.');
        }

        $doctorProfile = $this->getDoctorProfileWithStats($doctorProfileId);

        if (!$doctorProfile) {
            return redirect()->route('appointment.failed')->with('error', 'Doctor profile not found');
        }

        $service = Service::find($serviceId);
        if (!$service) {
            return redirect()->route('appointment.step.one')->with('error', 'Service not found. Please select again.');
        }

        // Get session data
        $sessionData = [
            'date' => $request->session()->get('appointment.date'),
            'time' => $request->session()->get('appointment.time'),
            'note' => $request->session()->get('appointment.note', ''),
            'medicalProblem' => $request->session()->get('appointment.medical_problem', ''),
        ];

        // Calculate bill
        $billDetails = $this->calculateBill($service->price);

        // Get temporary files
        $tempFiles = $request->session()->get('appointment.temporary_files', []);

        return view('appointment.step-3', [
            'doctorProfile' => $doctorProfile,
            'schedule' => [
                'date' => $sessionData['date'],
                'time' => $sessionData['time']
            ],
            'address' => $doctorProfile->office_address ?? '',
            'note' => $sessionData['note'],
            'summarize' => $sessionData['medicalProblem'],
            'bill' => [
                'service' => [
                    'name' => $service->name,
                    'price' => $billDetails['formatted']['service_price']
                ],
                'vat' => $billDetails['formatted']['vat'],
                'total' => $billDetails['formatted']['total']
            ]
        ]);
    }

    public function storeStepThree(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => 'required|string|in:qr_transfer,credit_card',
        ]);

        try {
            // Validate session data
            $sessionData = $this->validateSessionData($request);
            if (!$sessionData) {
                return redirect()->route('appointment.step.one')->with('error', 'Session expired. Please start again.');
            }

            // Validate service belongs to doctor
            $serviceBelongsToDoctor = Service::where('doctor_profile_id', $sessionData['doctor_profile_id'])
                ->where('id', $sessionData['service_id'])
                ->exists();

            if (!$serviceBelongsToDoctor) {
                return redirect()->route('appointment.step.one')->with('error', 'Invalid service selection.');
            }

            // Prepare files
            $recreatedFiles = $this->prepareUploadedFiles($request);

            // Merge all data for appointment creation
            $appointmentData = array_merge($sessionData, [
                'payment_method' => $validated['payment_method'],
                'medical_problem_files' => $recreatedFiles,
            ]);

            $request->merge($appointmentData);

            // Create appointment
            $response = $this->appointmentService->createAppointment($request, Auth::user());

            if (!$response) {
                return redirect()->back()->with('error', 'Failed to create appointment. Please try again.');
            }

            // Store appointment info in session for success page
            $service = Service::find($sessionData['service_id']);
            if ($service) {
                session()->flash('serviceName', $service->name);
            }
            session()->flash('date', Carbon::parse($sessionData['date'])->format('d/m/Y'));
            session()->flash('time', $sessionData['time']);

            // If payment is required, redirect to payment URL
            if (isset($response['checkoutUrl'])) {
                return redirect($response['checkoutUrl']);
            }

            // Clear appointment session data after success
            $this->clearAppointmentSession($request);

            return redirect()->route('appointment.success')
                ->with('success', 'Appointment booked successfully!')
                ->with('appointment_id', $response['appointment']->id);
        } catch (\Throwable $th) {
            Log::error('Error creating appointment', [
                'user_id' => Auth::id(),
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'An error occurred while booking your appointment. Please try again.');
        }
    }

    /**
     * Validate session data for appointment creation
     */
    private function validateSessionData(Request $request): ?array
    {
        $requiredKeys = [
            'doctor_profile_id',
            'service_id',
            'date',
            'time',
            'day_of_week',
            'medical_problem'
        ];

        $sessionData = [];
        foreach ($requiredKeys as $key) {
            $value = $request->session()->get("appointment.{$key}");
            if (empty($value)) {
                return null;
            }
            $sessionData[$key] = $value;
        }

        // Optional fields
        $sessionData['note'] = $request->session()->get('appointment.note', '');

        return $sessionData;
    }

    /**
     * Prepare uploaded files from session
     */
    private function prepareUploadedFiles(Request $request): array
    {
        $tempFiles = $request->session()->get('appointment.temporary_files', []);
        $recreatedFiles = [];

        foreach ($tempFiles as $tf) {
            if (!isset($tf['stored_path'], $tf['original_name'])) {
                continue;
            }

            $absolutePath = Storage::disk('tmp_uploads')->path($tf['stored_path']);
            if (!is_file($absolutePath)) {
                continue;
            }

            $recreatedFiles[] = new UploadedFile(
                $absolutePath,
                $tf['original_name'],
                $tf['mime'] ?? 'application/octet-stream',
                0,
                true
            );
        }

        return $recreatedFiles;
    }

    /**
     * Clear appointment session data
     */
    private function clearAppointmentSession(Request $request): void
    {
        $keys = [
            'appointment.doctor_profile_id',
            'appointment.service_id',
            'appointment.date',
            'appointment.time',
            'appointment.day_of_week',
            'appointment.medical_problem',
            'appointment.note',
            'appointment.temporary_files'
        ];

        foreach ($keys as $key) {
            $request->session()->forget($key);
        }
    }

    public function paymentResultCallback(Request $request)
    {
        //"/appointment/payment-result?code=00&id=354b52d8ef1f4f65bb0a2968b94be841&cancel=true&status=CANCELLED&orderCode=1753562968185179"
        // todo: important: needs to check if the callback data is correct and not edited by the user
        $request->validate([
            'code' => 'required|string',
            'id' => 'required|string',
            'status' => 'required|string',
            'orderCode' => 'required|string'
        ]);
        $status = $request->input('status');
        $orderCode = $request->input('orderCode');
        $failedStatuses = ['CANCELLED', 'UNDERPAID', 'EXPIRED', 'FAILED'];
        $successStatuses = ['PAID'];
        $pendingStatuses = ['PENDING', 'PROCESSING'];

        // todo: translate to multilang
        $errorMessage = match ($status) {
            'CANCELLED' => 'Payment was cancelled',
            'UNDERPAID' => 'The payment amount was insufficient',
            'EXPIRED' => 'The payment session has expired',
            'FAILED' => 'Payment failed to process',
            default => 'An unknown error occurred'
        };

        try {
            $bill = Bill::findOrFail($orderCode);
        } catch (\Throwable $th) {
            return redirect()->route('appointment.failed')->with('error', 'We could not find your order, please try again later');
        }

        if (in_array($status, $failedStatuses)) {
            $this->updateBillStatus($bill, 'cancelled');
            $request->session()->forget('appointment');
            return redirect()->route('appointment.failed')->with([
                'error' => $errorMessage,
                'billId' => $bill->id
            ]);
        }

        if (in_array($status, $successStatuses)) {
            $this->updateBillStatus($bill, 'paid');
            $serviceId = $request->session()->get('appointment.service_id');
            $service = Service::find($serviceId);
            if (!$service) {
                Log::error('Service not found for appointment', [
                    'service_id' => $serviceId,
                    'bill_id' => $bill->id,
                    'order_code' => $orderCode
                ]);
                return redirect('/');
            }
            $date = $request->session()->get('appointment.date');
            $time = $request->session()->get('appointment.time');
            $humanReadableDate = Carbon::parse($date)->format('l, d F Y');

            $request->session()->forget('appointment');
            return redirect()->route('appointment.success')->with([
                'serviceName' => $service->name,
                'time' => $time,
                'date' => $humanReadableDate,
            ]);;
        }

        $request->session()->forget('appointment');

        if (in_array($status, $pendingStatuses)) {
            return redirect()->route('appointment.failed')->with([
                'error' => 'Payment is still processing',
                'billId' => $bill->id
            ]);
        }

        return redirect()->route('appointment.failed')->with([
            'error' => 'Invalid payment status',
            'billId' => $bill->id
        ]);
    }

    private function updateBillStatus(Bill $bill, string $status)
    {
        $bill->status = strtolower($status);
        $bill->save();
    }

    public function showSuccess(Request $request)
    {
        return view('appointment.success');
    }

    public function showFailed()
    {
        return view('appointment.failed')->with('error', 'Not Found');
    }
}
