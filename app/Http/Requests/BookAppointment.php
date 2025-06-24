<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookAppointment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'doctor_profile_id' => 'required|exists:doctor_profiles,id',
            'service_id' => 'required|exists:services,id',
            'medical_problem' => 'required|string|max:1024',
            'medical_problem_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'date' => 'required|date|after_or_equal:today',
            'day_of_week' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'time' => 'required|string|regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/',
            'payment_method' => 'required|in:wallet,credit_card,qr_transfer',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'doctor_profile_id.required' => 'Doctor selection is required.',
            'doctor_profile_id.exists' => 'Selected doctor does not exist.',
            'service_id.required' => 'Service selection is required.',
            'service_id.exists' => 'Selected service does not exist.',
            'medical_problem.required' => 'Medical problem description is required.',
            'medical_problem.max' => 'Medical problem description cannot exceed 1024 characters.',
            'medical_problem_file.file' => 'Medical problem file must be a valid file.',
            'medical_problem_file.mimes' => 'Medical problem file must be a file of type: jpg, jpeg, png, pdf.',
            'medical_problem_file.max' => 'Medical problem file size cannot exceed 2MB.',
            'date.required' => 'Appointment date is required.',
            'date.date' => 'Appointment date must be a valid date.',
            'date.after_or_equal' => 'Appointment date cannot be in the past.',
            'day_of_week.required' => 'Day of week is required.',
            'day_of_week.in' => 'Day of week must be a valid day.',
            'time.required' => 'Appointment time is required.',
            'time.regex' => 'Appointment time must be in HH:MM format.',
            'payment_method.required' => 'Payment method is required.',
            'payment_method.in' => 'Payment method must be one of: wallet, credit card, or QR transfer.',
        ];
    }
}
