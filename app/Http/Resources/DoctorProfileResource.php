<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Determine which model we're working with
        $user = $this->resource->user;
        $doctorProfile = $user->doctorProfile;

        return [
            // User information
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

            // Doctor profile information
            'doctorProfileId' => $doctorProfile?->id,
            'professionalNumber' => $doctorProfile?->professional_number,
            'introduce' => $doctorProfile?->introduce,
            'medicalCategory' => $doctorProfile && $doctorProfile->medicalCategory ?
                new MedicalCategoryResource($doctorProfile->medicalCategory) : null,
            'officeAddress' => $doctorProfile?->office_address,
            'companyName' => $doctorProfile?->company_name,

            // Calculated fields
            'profileCompleteness' => $this->calculateProfileCompleteness($user, $doctorProfile),

            // Additional statistics (if relationships are loaded)
            'totalServices' => $this->when(
                $doctorProfile && $doctorProfile->relationLoaded('services'),
                fn() => $doctorProfile->services->count()
            ),
            'activeServices' => $this->when(
                $doctorProfile && $doctorProfile->relationLoaded('services'),
                fn() => $doctorProfile->services->where('is_active', 1)->count()
            ),
            'totalAppointments' => $this->when(
                $doctorProfile && $doctorProfile->relationLoaded('appointments'),
                fn() => $doctorProfile->appointments->count()
            ),
            'totalReviews' => $this->when(
                $doctorProfile && $doctorProfile->relationLoaded('reviews'),
                fn() => $doctorProfile->reviews->count()
            ),
            'averageRating' => $this->when(
                $doctorProfile && $doctorProfile->relationLoaded('reviews'),
                fn() => $doctorProfile->reviews->count() > 0 ?
                    round($doctorProfile->reviews->avg('rate'), 1) : 0
            ),
        ];
    }

    /**
     * Calculate profile completeness percentage
     */
    private function calculateProfileCompleteness($user, $doctorProfile)
    {
        $fields = [
            'user_name' => !empty($user->name),
            'user_phone' => !empty($user->phone),
            'user_email' => !empty($user->email),
            'user_address' => !empty($user->address),
            'user_avatar' => !empty($user->avatar),
        ];

        if ($doctorProfile) {
            $fields = [];
            // $fields = array_merge($fields, [
            //     'professional_number' => !empty($doctorProfile->professional_number),
            //     'introduce' => !empty($doctorProfile->introduce),
            //     'medical_category' => !empty($doctorProfile->medical_category_id),
            //     'office_address' => !empty($doctorProfile->office_address),
            // ]);

            // Add identity-specific fields
            if ($user->identity === 'doctor') {
                $fields['id_card_path'] = !empty($doctorProfile->id_card_path);
                $fields['medical_degree_path'] = !empty($doctorProfile->medical_degree_path);
            } elseif (in_array($user->identity, ['pharmacies', 'hospital'])) {
                $fields['exploitation_license_path'] = !empty($doctorProfile->exploitation_license_path);
            }
        }

        $completedFields = array_filter($fields);
        $totalFields = count($fields);

        return $totalFields > 0 ? round((count($completedFields) / $totalFields) * 100, 1) : 0;
    }
}
