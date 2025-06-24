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
            'patient_profile_id' => 'required|exists:patient_profiles,id',
            'doctor_profile_id' => 'required|exists:doctor_profiles,id',
            'service_id' => 'required|exists:services,id',
            'medical_problem' => 'required|string|max:1024',
            'medical_problem_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'date' => 'required|date',
            'day_of_week' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'time' => 'required|string',
            'payment_method' => 'required|in:wallet,credit_card,qr_transfer',
        ];
    }
}
