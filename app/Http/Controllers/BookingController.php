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
{{  }}
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
        // dd($doctorProfile->user->languages[0]->language);
        return view('appointment.doctor-detail', [
            'doctorProfile' => $doctorProfile,
        ]);
    }

    public function showStepOne(Request $request, $doctorProfileId)
    {
        $doctorProfile = DoctorProfile::findOrFail($doctorProfileId);
        $request->session()->put('appointment.doctor_profile_id', $doctorProfile->id);
        return view('appointment.step-1', [
            'doctorProfile' => $doctorProfile,
        ]);
    }

    public function storeStepOne(Request $request)
    {
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
        // "time" => "15:00"

        $serviceId = $request->input('service');
        $request->session()->put('appointment.service_id', $serviceId);

        $date = $request->input('date');
        $request->session()->put('appointment.date', $date);

        $time = $request->input('time');
        $request->session()->put('appointment.time', $time);

        // Get day of week from selected date (1 = Monday, 7 = Sunday)
        $dayOfWeek = \Carbon\Carbon::parse($date)->dayOfWeekIso;
        $request->session()->put('appointment.day_of_week', $dayOfWeek);


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

        return view('appointment.step-3', [
            'doctorProfile' => $doctorProfile,
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

        $response = $this->appointmentService->createAppointment($request, $user);
        dd($response);
        return view('appointment.success', [
            'response' => $response,
        ]);
        // } catch (\Exception $e) {
        //     dd($e,$e->getMessage());
        //     return back()->withErrors(['error' => $e->getMessage()]);
        // }
    }
}
