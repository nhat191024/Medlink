<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        $rules = [
            'phone' => 'required|string',
            'countryCode' => 'required|string',
            'userType' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-zA-Z]{6,})(?=.*\d)(?=.*[&$#%]).+$/',
            'avatar' => 'nullable|image|mimes:png,jpg|max:5120',
        ];

        if ($this->userType == 1) {
            $rules['identity'] = 'required|int';
            $rules['medicalDegree'] = 'required|image|mimes:png,jpg';

            if ($this->identity == 1 || $this->identity == 2) {
                $rules['idCard'] = 'required|image|mimes:png,jpg';
            }
            if ($this->identity == 1) {
                $rules['professionalNumber'] = 'required|string';
            }
        } elseif ($this->userType == 2) {
            $rules['fullName'] = 'required|string';
            $rules['age'] = 'required|int';
            $rules['gender'] = 'required|string';
            $rules['height'] = 'required|int';
            $rules['weight'] = 'required|int';
            $rules['bloodGroup'] = 'required|string|in:A+,A-,B+,B-,O+,O-,AB+,AB-';
            $rules['medicalHistory'] = 'required|string';
            $rules['insuranceType'] = 'required|int';
            $rules['insuranceNumber'] = 'required|string';
            $rules['assuranceType'] = 'required|string';
            $rules['address'] = 'required|string';
        }

        if ($this->insuranceType == 2) {
            $rules['main_insured'] = 'required|string';
            $rules['entitled_insured'] = 'required|string';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            //common
            'phone.required' => "Phone number is required",
            'phone.string' => "Phone number must be string",
            'countryCode.required' => "Country code is required",
            'countryCode.string' => "Country code must be string",
            'userType.required' => "User Type is required",
            'userType.string' => "User Type must be string",
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'password.required' => "Password is required",
            'password.string' => "Password must be string",
            'password.min' => "Password must be at least 8 characters",
            'password.regex' => "Password must contain at least 6 characters, 1 letter, 1 number, and 1 special character",
            'avatar.image' => "Avatar must be an image",
            'avatar.mimes' => "Avatar must be a file of type: png, jpg",
            'avatar.max' => "Avatar may not be greater than 5 mb",
            //healthcare
            'identity.required' => "Identity is required",
            'identity.int' => "Identity must be integer",
            'idCard.required' => "ID Card Path is required",
            'idCard.image' => "ID Card Path must be an image",
            'idCard.mimes' => "ID Card Path must be a file of type: png, jpg",
            'medicalDegree.required' => "Medical Degree Path is required",
            'medicalDegree.image' => "Medical Degree Path must be an image",
            'medicalDegree.mimes' => "Medical Degree Path must be a file of type: png, jpg",
            'professionalNumber.required' => "Professional Number is required",
            'professionalNumber.string' => "Professional Number must be string",
            //patient
            'fullName.required' => "Full Name is required",
            'fullName.string' => "Full Name must be string",
            'age.required' => "Age is required",
            'age.int' => "Age must be integer",
            'gender.required' => "Gender is required",
            'gender.string' => "Gender must be string",
            'height.required' => "Height is required",
            'height.int' => "Height must be integer",
            'weight.required' => "Weight is required",
            'weight.int' => "Weight must be integer",
            'bloodGroup.required' => "Blood Group is required",
            'bloodGroup.string' => "Blood Group must be string",
            'bloodGroup.in' => "Blood Group must be A+, A-, B+, B-, O+, O-, AB+, AB-",
            'medicalHistory.required' => "Medical History is required",
            'medicalHistory.string' => "Medical History must be string",
            'insuranceType.required' => "Insurance Type is required",
            'insuranceType.string' => "Insurance Type must be string",
            'insuranceNumber.required' => "Insurance Number is required",
            'insuranceNumber.string' => "Insurance Number must be string",
            'main_insured.required' => "Main Insured is required",
            'main_insured.string' => "Main Insured must be string",
            'entitled_insured.required' => "Entitled Insured is required",
            'entitled_insured.string' => "Entitled Insured must be string",
            'assuranceType.required' => "Assurance Type is required",
            'assuranceType.string' => "Assurance Type must be string",
            'address.required' => "Address is required",
            'address.string' => "Address must be string",
        ];
    }
}
