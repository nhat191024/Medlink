<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this->resource->user;
        $patientProfile = $user->patientProfile;

        return [
            //basic user information
            'id' => $user->id,
            'phone' => "{$user->country_code} {$user->phone}",
            'userType' => $user->user_type,
            'email' => $user->email,
            'identity' => $user->identity,
            'latitude' => $user->latitude,
            'longitude' => $user->longitude,
            'name' => $user->name,
            'gender' => $user->gender,
            'avatar' => $user->avatar ? asset($user->avatar) : null,
            'address' => $user->address,
            'country' => $user->country,
            'city' => $user->city,
            'state' => $user->state,
            'zipCode' => $user->zip_code,
            'status' => $user->status,

            //patient profile information
            'patientProfileId' => $patientProfile?->id,
            'birthDate' => $patientProfile?->birth_date,
            'age' => $patientProfile?->age,
            'height' => $patientProfile?->height,
            'weight' => $patientProfile?->weight,
            'bloodGroup' => $patientProfile?->blood_group,
            'medicalHistory' => $patientProfile?->medical_history,

            //calculated fields
            'profileCompleteness' => $this->calculateProfileCompleteness($user, $patientProfile),
        ];
    }

    /**
     * Calculate profile completeness percentage.
     */

    protected function calculateProfileCompleteness($user, $patientProfile)
    {
        $fields = [
            'user_name' => !empty($user->name),
            'user_phone' => !empty($user->phone),
            'user_email' => !empty($user->email),
            'user_address' => !empty($user->address),
            'user_avatar' => !empty($user->avatar),
            'patient_birth_date' => !empty($patientProfile->birth_date),
            'patient_age' => !empty($patientProfile->age),
            'patient_height' => !empty($patientProfile->height),
            'patient_weight' => !empty($patientProfile->weight),
            'patient_blood_group' => !empty($patientProfile->blood_group),
            'patient_medical_history' => !empty($patientProfile->medical_history),
        ];

        $completedFields = array_filter($fields);
        $totalFields = count($fields);

        return $totalFields > 0 ? (count($completedFields) / $totalFields) * 100 : 0;
    }
}
