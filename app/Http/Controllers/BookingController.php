<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DoctorProfile;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Services\AppointmentService;
use App\Http\Services\WorkScheduleService;
use App\Models\Bill;
use App\Models\Service;

class BookingController extends Controller
{
    private $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function showDoctorBookingList(Request $request)
    {
        // dd(User::all());
        // Logic to retrieve and display the list of doctor bookings
        // dd ($request->all());
        // "q" => "thinh"
        // "identity" => "pharmacies"
        $searchQuery = $request->input('q', '');
        $identity = $request->input('identity', 'doctor');
        $userProfiles = User::where('user_type', 'healthcare')
            ->when($searchQuery, function ($query, $searchQuery) {
                return $query->where(function ($q) use ($searchQuery) {
                    $q->where('name', 'like', '%' . $searchQuery . '%')
                        ->orWhere('email', 'like', '%' . $searchQuery . '%');
                });
            })
            ->when($identity !== 'doctor', function ($query) use ($identity) {
                return $query->where('identity', $identity);
            })
            ->with(['doctorProfile', 'doctorProfile.medicalCategory', 'doctorProfile.services', 'doctorProfile.reviews',  'doctorProfile.user'])
            ->paginate(10);
        $request->session()->put('identity', $identity);
        return view('appointment.search', [
            'userProfiles' => $userProfiles,
        ]);
    }

    public function showDoctorInfo($doctorProfileId)
    {
        $doctorProfile = DoctorProfile::where('id',$doctorProfileId)->with(['medicalCategory', 'services', 'reviews',  'user'])->first();
        $workSchedules = new WorkScheduleService()->getAvailableWorkSchedule($doctorProfile->workSchedules, $doctorProfile->id);
        // dd($doctorProfile->user->languages[0]->language);
        return view('appointment.doctor-detail', [
            'doctorProfile' => $doctorProfile,
            'workSchedules' => $workSchedules,
        ]);
    }

    public function showStepOne(Request $request, $doctorProfileId)
    {
        $doctorProfile = DoctorProfile::findOrFail($doctorProfileId);
        $request->session()->put('appointment.doctor_profile_id', $doctorProfile->id);
        $workSchedules = new WorkScheduleService()->getAvailableWorkSchedule($doctorProfile->workSchedules, $doctorProfile->id);
        // dd('time of the doctor', $workSchedules);
        return view('appointment.step-1', [
            'doctorProfile' => $doctorProfile,
            'workSchedules' => $workSchedules,
        ]);
    }

    public function storeStepOne(Request $request)
    {
        // $doctorProfileId = $request->session()->get('appointment.doctor_profile_id');
        // $doctorProfile = DoctorProfile::findOrFail($doctorProfileId);

        // validate
        $request->validate([
            'service' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required|string',
        ]);

        // todo: check if that service belongs to that doctor
        // TODO: check if time is correct

        // "service" => "5"
        // "date" => "2025-07-09"
        // "time" => "17:30"

        $serviceId = $request->input('service');
        $request->session()->put('appointment.service_id', $serviceId);

        $date = $request->input('date');
        $request->session()->put('appointment.date', $date);

        $selectedService = Service::findOrFail($serviceId);
        $duration = $selectedService->duration;
        // $bufferTime = $selectedService->buffer_time;
        $endTime = $duration; // in x minutes
        // dd($duration);
        $time = $request->input('time');
        $startDateTime = \Carbon\Carbon::createFromFormat('H:i', $time);
        $endDateTime = (clone $startDateTime)->addMinutes($endTime);
        $formattedTime = $startDateTime->format('H:i A') . ' - ' . $endDateTime->format('H:i A');
        $request->session()->put('appointment.time', $formattedTime);

        // Get day of week from selected date as string (Monday, Tuesday, etc.)
        $dayOfWeek = \Carbon\Carbon::parse($date)->format('l');
        $request->session()->put('appointment.day_of_week', $dayOfWeek);
        // dd($dayOfWeek, $date, $doctorProfile, $duration, $bufferTime, $formattedTime);

        return redirect(route('appointment.step.two'));
    }

    public function showStepTwo(Request $request)
    {
        $doctorProfileId = $request->session()->get('appointment.doctor_profile_id');
        $doctorProfile = DoctorProfile::findOrFail($doctorProfileId);
        // dd($doctorProfile);
        return view('appointment.step-2', [
            'doctorProfile' => $doctorProfile,
        ]);
    }

    public function storeStepTwo(Request $request)
    {
        $request->validate([
            'medical_problem' => 'required|string',
            'medical_files' => 'nullable|array',
            'medical_files.*' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx',
                'max:5480',
            ],
            'note' => 'nullable|string',
        ]);

        try {
            if ($request->hasFile('medical_files')) {
                $file = $request->file('medical_files');
                $uploadedFile = $file[0];
                $filename = Str::uuid() . '.' . $uploadedFile->getClientOriginalExtension();
                $path = $uploadedFile->storeAs('', $filename, 'tmp_uploads');
                $request->session()->put('appointment.temporary_file_name', $uploadedFile->getClientOriginalName());
                $request->session()->put('appointment.temporary_file_path', $path);
            }

            $note = $request->input('note') ?? '';
            $request->session()->put('appointment.note', $note);

            $medicalProblem = $request->input('medical_problem');
            $request->session()->put('appointment.medical_problem', $medicalProblem);

            return redirect(route('appointment.step.three'));
        } catch (\Throwable $th) {
            return redirect(route('appointment.step.two'))->with('error', 'Đã xảy ra lỗi, vui lòng thử lại.' . $th->getMessage());
        }

        // dd('failed');
        // return view('appointment.step-3', [
        //     'doctorProfile' => $doctorProfile,
        // ]);
    }

    public function showStepThree(Request $request)
    {
        $doctorProfileId = $request->session()->get('appointment.doctor_profile_id');
        $doctorProfile = DoctorProfile::findOrFail($doctorProfileId);

        // todo: build data here
            // array:9 [
            // "doctor_profile_id" => 2
            // "service_id" => "5"
            // "date" => "2025-07-27"
            // "time" => "07:00 AM - 07:40 AM"
            // "day_of_week" => "Sunday"
            // "temporary_file_name" => "file-sample_150kB.pdf"
            // "temporary_file_path" => "fd333e07-38ad-49dd-8338-36631fea927c.pdf"
            // "note" => "I feel sick thats allI feel sick thats allI feel sick thats allI feel sick thats all"
            // "medical_problem" => "I feel sick thats allI feel sick thats allI feel sick thats allI feel sick thats allI feel sick thats all"
            // ]
            $serviceId = $request->session()->get('appointment.service_id');
            $service = Service::findOrFail($serviceId);

            $date = $request->session()->get('appointment.date');
            $time = $request->session()->get('appointment.time');
            $note = $request->session()->get('appointment.note', '');
            $medicalProblem = $request->session()->get('appointment.medical_problem', '');
            // Calculate total with VAT
            $servicePrice = $service->price;
            $vat = $servicePrice * 0.1; // 10% VAT
            $total = $servicePrice + $vat;

            // Format prices to VND
            $formattedServicePrice = number_format($servicePrice, 0, ',', '.') . ' đ';
            $formattedVat = number_format($vat, 0, ',', '.') . ' đ';
            $formattedTotal = number_format($total, 0, ',', '.') . ' đ';

            $fileName = $request->session()->get('appointment.temporary_file_name', 'No file uploaded');

            return view('appointment.step-3', [
                'doctorProfile' => $doctorProfile,
                'schedule' => [
                    'date' => $date,
                    'time' => $time
                ],
                'address' => $doctorProfile->address ?? '',
                'note' => $note,
                'summarize' => $medicalProblem,
                'fileName' => $fileName,
                'bill' => [
                    'service' => [
                        'name' => $service->name,
                        'price' => $formattedServicePrice
                    ],
                    'vat' => $formattedVat,
                    'total' => $formattedTotal
                ]
            ]);
    }

    public function storeStepThree(Request $request)
    {

        // array:5 [
        //   "doctor_profile_id" => 2
        //   "service" => "6"
        //   "date" => "2025-07-12"
        //   "time" => "07:00"
        //   "temporary_file_path" => "2f5199bd-0eba-4907-9c6e-831d1b998dee.docx"
        // ]
        // dd ($request->all());
        // Validate the payment information

        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $paymentMethod = $request->input('payment_method');
        $doctorProfileId = $request->session()->get('appointment.doctor_profile_id');
        $serviceId = $request->session()->get('appointment.service_id');
        $date = $request->session()->get('appointment.date');
        $time = $request->session()->get('appointment.time');
        $dayOfWeek = $request->session()->get('appointment.day_of_week');
        $medicalProblem = $request->session()->get('appointment.medical_problem');

        $temporaryFilePath = $request->session()->get('appointment.temporary_file_path');
        $temporaryFileName = $request->session()->get('appointment.temporary_file_name');
        $recreatedFile = null;
        if ($temporaryFileName && $temporaryFilePath) {
            $absolutePath = Storage::disk('tmp_uploads')->path($temporaryFilePath);

            $recreatedFile = new UploadedFile(
                $absolutePath,
                $temporaryFileName,
                Storage::mimeType($absolutePath),
                0,
                true
            );
        }

        $user = Auth::user();

        // try {
        $request->merge([
            'doctor_profile_id' => $doctorProfileId,
            'service_id' => $serviceId,
            'date' => $date,
            'day_of_week' => $dayOfWeek,
            'time' => $time,
            'medical_problem' => $medicalProblem,
            'payment_method' => $paymentMethod,
            'medical_problem_file' => $recreatedFile,
        ]);

        // $request->files->set('medical_problem_file', $recreatedFile);

        // dd($request->all(), $user);
        try {
            $response = $this->appointmentService->createAppointment($request, $user);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('appointment.failed')->with([
                'error' => 'This account is not a patient, please re-login using patient account'
            ]);
        }
        if ($response && isset($response['checkoutUrl'])) {
            return redirect($response['checkoutUrl']);
        }

        // return view('appointment.success', [
        //     'response' => $response,
        // ]);
        return redirect()->route('appointment.failed')->with('error', 'Please try again with correct information');
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
        $errorMessage = match($status) {
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
            $service = Service::findOrFail($serviceId);
            $date = $request->session()->get('appointment.date');
            $time = $request->session()->get('appointment.time');
            $humanReadableDate = \Carbon\Carbon::parse($date)->format('l, d F Y');

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

    public function showFailed(Request $request)
    {
        return view('appointment.failed')->with('error', 'Not Found');
    }
}
