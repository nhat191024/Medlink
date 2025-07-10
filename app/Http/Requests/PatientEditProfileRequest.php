<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientEditProfileRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            // Basic user information
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'useDefaultAvatar' => 'required|string|in:0,1',
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female,other',
            'languages' => 'required|string',
            'country_code' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user()->id,
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',

            // Patient profile information
            'birth_date' => 'nullable|date|before:today',
            'age' => 'nullable|integer|min:1|max:150',
            'height' => 'nullable|integer|min:50|max:300', // in cm
            'weight' => 'nullable|numeric|min:1|max:500', // in kg
            'blood_group' => 'nullable|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'medical_history' => 'nullable|string|max:2000',

            // Insurance information
            'insurance_type' => 'nullable|string|max:100',
            'insurance_number' => 'nullable|string|max:100',
            'main_insured' => 'nullable|string|max:255',
            'entitled_insured' => 'nullable|string|max:255',
            'assurance_type' => 'nullable|string|max:100',
            'insurance_expiry_date' => 'nullable|date|after:today',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'avatar.image' => 'The avatar must be an image.',
            'avatar.mimes' => 'The avatar must be a file of type: png, jpg, jpeg.',
            'avatar.max' => 'The avatar may not be greater than 2MB.',
            'useDefaultAvatar.required' => 'The use default avatar field is required.',
            'useDefaultAvatar.in' => 'The use default avatar must be 0 or 1.',
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'languages.required' => 'The languages field is required.',
            'languages.string' => 'The languages must be a string.',
            'country_code.required' => 'The country code is required.',
            'country_code.max' => 'The country code may not be greater than 10 characters.',
            'phone.required' => 'The phone is required.',
            'phone.max' => 'The phone may not be greater than 20 characters.',
            'email.required' => 'The email is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'birth_date.date' => 'The birth date must be a valid date.',
            'birth_date.before' => 'The birth date must be before today.',
            'age.integer' => 'The age must be an integer.',
            'age.min' => 'The age must be at least 1.',
            'age.max' => 'The age may not be greater than 150.',
            'gender.in' => 'The gender must be male, female, or other.',
            'height.integer' => 'The height must be an integer.',
            'height.min' => 'The height must be at least 50cm.',
            'height.max' => 'The height may not be greater than 300cm.',
            'weight.numeric' => 'The weight must be a number.',
            'weight.min' => 'The weight must be at least 1kg.',
            'weight.max' => 'The weight may not be greater than 500kg.',
            'blood_group.in' => 'The blood group must be one of: A+, A-, B+, B-, AB+, AB-, O+, O-.',
            'medical_history.max' => 'The medical history may not be greater than 2000 characters.',
            'insurance_type.max' => 'The insurance type may not be greater than 100 characters.',
            'insurance_number.max' => 'The insurance number may not be greater than 100 characters.',
            'main_insured.max' => 'The main insured may not be greater than 255 characters.',
            'entitled_insured.max' => 'The entitled insured may not be greater than 255 characters.',
            'assurance_type.max' => 'The assurance type may not be greater than 100 characters.',
            'insurance_expiry_date.date' => 'The insurance expiry date must be a valid date.',
            'insurance_expiry_date.after' => 'The insurance expiry date must be after today.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'useDefaultAvatar' => 'use default avatar',
            'birth_date' => 'birth date',
            'blood_group' => 'blood group',
            'medical_history' => 'medical history',
            'insurance_type' => 'insurance type',
            'insurance_number' => 'insurance number',
            'main_insured' => 'main insured',
            'entitled_insured' => 'entitled insured',
            'assurance_type' => 'assurance type',
            'insurance_expiry_date' => 'insurance expiry date',
        ];
    }
}
