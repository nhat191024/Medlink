<?php

namespace App\Http\Controllers;

use App\Models\DoctorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function showDoctorBookingList(Request $request)
    {
        // dd(User::all());
        // Logic to retrieve and display the list of doctor bookings
        // dd ($request->all());
        // "q" => "thinh"
        // "identity" => "pharmacies"
        $searchQuery = $request->input('q', '');
        $identity = $request->input('identity', 'doctor');
        $doctorProfiles = User::where('user_type', 'healthcare')
            ->when($searchQuery, function ($query, $searchQuery) {
                return $query->where(function ($q) use ($searchQuery) {
                    $q->where('name', 'like', '%' . $searchQuery . '%')
                        ->orWhere('email', 'like', '%' . $searchQuery . '%');
                });
            })
            ->when($identity !== 'doctor', function ($query) use ($identity) {
                return $query->where('identity', $identity);
            })
            ->with(['doctorProfile', 'doctorProfile.medicalCategory', 'doctorProfile.services', 'doctorProfile.reviews'])
            ->paginate(10);
        // dd($doctorProfiles);
        return view('appointment.search', [
            'doctorProfiles' => $doctorProfiles,
        ]);
    }

    public function showAppointment(Request $request, $doctorProfileId)
    {

        $doctorProfile = DoctorProfile::findOrFail($doctorProfileId);
        $request->session()->put('appointment.doctor_profile_id', $doctorProfile->id);
        return view('appointment.step-1', [
            'doctorProfile' => $doctorProfile,
        ]);
    }

    public function storeAppointment(Request $request)
    {
        // validate
        $request->validate([
            'service' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required|string',
        ]);

        // todo: check if that service belongs to that doctor

        $doctorProfileId = $request->session()->get('appointment.doctor_profile_id');
        $doctorProfile = DoctorProfile::findOrFail($doctorProfileId);

        // TODO: check if time is correct
        // "service" => "5"
        // "date" => "2025-07-09"
        // "time" => "15:00"

        $service = $request->input('service');
        $request->session()->put('appointment.service', $service);

        $date = $request->input('date');
        $request->session()->put('appointment.date', $date);

        $time = $request->input('time');
        $request->session()->put('appointment.time', $time);


        return view('appointment.step-2', [
            'doctorProfile' => $doctorProfile,
        ]);
        // return redirect()->route('appointment.step.2');
        // return redirect()->route('appointment.index')->with('success', 'Appointment booked successfully.');
    }

    // public function showDetailAppointmentForm(Request $request)
    // {
    //     // Retrieve the appointment details from the session
    //     $appointment = $request->session()->get('appointment', []);

    //     return view('appointment.detail-appointment', [
    //         'appointment' => $appointment,
    //     ]);
    // }

    public function storeDetailAppointment(Request $request)
    {
        // dd($request->all());
        // // Validate the detail appointment form
        $request->validate([
            'medical_problem' => 'required|string',
            'medical_files' => 'required|file',
            'note' => 'required|string',
        ]);

        $doctorProfileId = $request->session()->get('appointment.doctor_profile_id');
        $doctorProfile = DoctorProfile::findOrFail($doctorProfileId);

        $file = $request->file('medical_files');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('', $filename, 'tmp_uploads');

        // Store the path or a unique identifier in the session
        $request->session()->put('appointment.temporary_file_path', $path);

        // // Store the detail appointment information in the session
        // $request->session()->put('appointment.details', $request->only([

        // ]));

        $temporaryFilePath = session('temporary_file_path');


        return view('appointment.step-3', [
            'doctorProfile' => $doctorProfile,
        ]);
    }

    // public function showConfirmPaymentAppointment(Request $request)
    // {
    //     // Retrieve the appointment details from the session
    //     $appointment = $request->session()->get('appointment', []);

    //     return view('appointment.confirm-payment', [
    //         'appointment' => $appointment,
    //     ]);
    // }

    public function storePaymentAppointment(Request $request)
    {
        // Validate the payment information
        $request->validate([
            'payment_method' => 'required|string',
            'card_number' => 'required|string',
            'expiry_date' => 'required|string',
            'cvv' => 'required|string',
        ]);

        // Store the payment information in the session
        $request->session()->put('appointment.payment', $request->only([
            'payment_method',
            'card_number',
            'expiry_date',
            'cvv',
        ]));

        return redirect()->route('appointment.index')->with('success', 'Appointment booked successfully.');
    }
}
