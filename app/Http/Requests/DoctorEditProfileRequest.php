<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorEditProfileRequest extends FormRequest
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
            'useDefaultAvatar' => 'required|boolean',
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

            // Doctor profile information
            'professional_number' => 'required|string|max:100',
            'introduce' => 'required|string|max:1000',
            'medical_category_id' => 'required|integer|exists:medical_categories,id',
            'office_address' => 'required|string|max:500',
            'company_name' => 'required|string|max:255',
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
            'professional_number.required' => 'The professional number is required.',
            'professional_number.max' => 'The professional number may not be greater than 100 characters.',
            'introduce.required' => 'The introduction is required.',
            'introduce.max' => 'The introduction may not be greater than 1000 characters.',
            'medical_category_id.required' => 'The medical category is required.',
            'medical_category_id.exists' => 'The selected medical category is invalid.',
            'office_address.required' => 'The office address is required.',
            'office_address.max' => 'The office address may not be greater than 500 characters.',
            'company_name.required' => 'The company name is required.',
            'company_name.max' => 'The company name may not be greater than 255 characters.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'useDefaultAvatar' => 'use default avatar',
            'medical_category_id' => 'medical category',
            'professional_number' => 'professional number',
            'office_address' => 'office address',
            'company_name' => 'company name',
            'id_card' => 'ID card',
        ];
    }
}
