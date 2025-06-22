<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Check if this is a User model or DoctorProfile model
        $isUser = $this->resource instanceof \App\Models\User;
        $isDoctorProfile = $this->resource instanceof \App\Models\DoctorProfile;

        if ($isUser) {
            // Handle User model with doctorProfile relationship
            $user = $this->resource;
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
                'fullName' => $user->name,
                'avatar' => $user->avatar ? asset($user->avatar) : '',
                'address' => $user->address,
                'country' => $user->country,
                'city' => $user->city,
                'state' => $user->state,
                'zipCode' => $user->zip_code,
                'status' => $user->status,

                // Doctor profile information (if exists)
                'doctorProfileId' => $doctorProfile?->id,
                'professionalNumber' => $doctorProfile?->professional_number,
                'introduce' => $doctorProfile?->introduce,
                'medicalCategory' => $doctorProfile && $doctorProfile->medicalCategory ?
                    new MedicalCategoryResource($doctorProfile->medicalCategory) : null,
                'officeAddress' => $doctorProfile?->office_address,
                'companyName' => $doctorProfile?->company_name,

                // Document paths
                'idCardPath' => $doctorProfile?->id_card_path,
                'medicalDegreePath' => $doctorProfile?->medical_degree_path,
                'professionalCardPath' => $doctorProfile?->professional_card_path,
                'exploitationLicensePath' => $doctorProfile?->exploitation_license_path,

                // Calculated fields
                'hasCompleteProfile' => $doctorProfile !== null,
                'profileCompleteness' => $this->calculateProfileCompleteness($user, $doctorProfile),
            ];
        } elseif ($isDoctorProfile) {
            // Handle DoctorProfile model with user relationship
            $doctorProfile = $this->resource;
            $user = $doctorProfile->user;

            return [
                // User information
                'id' => $user->id,
                'phone' => "{$user->country_code} {$user->phone}",
                'userType' => $user->user_type,
                'email' => $user->email,
                'identity' => $user->identity,
                'latitude' => $user->latitude,
                'longitude' => $user->longitude,
                'fullName' => $user->name,
                'avatar' => $user->avatar ? asset($user->avatar) : null,
                'address' => $user->address,
                'country' => $user->country,
                'city' => $user->city,
                'state' => $user->state,
                'zipCode' => $user->zip_code,
                'status' => $user->status,

                // Doctor profile information
                'doctorProfileId' => $doctorProfile->id,
                'professionalNumber' => $doctorProfile->professional_number,
                'introduce' => $doctorProfile->introduce,
                'medicalCategory' => $doctorProfile->medicalCategory ? $doctorProfile->medicalCategory->name : null,
                'officeAddress' => $doctorProfile->office_address,
                'companyName' => $doctorProfile->company_name,

                // Calculated fields
                // 'hasCompleteProfile' => true,
                'profileCompleteness' => $this->calculateProfileCompleteness($user, $doctorProfile),

                // Additional statistics (if relationships are loaded)
                'totalServices' => $this->when(
                    $doctorProfile->relationLoaded('services'),
                    fn() => $doctorProfile->services->count()
                ),
                'activeServices' => $this->when(
                    $doctorProfile->relationLoaded('services'),
                    fn() => $doctorProfile->services->where('is_active', 1)->count()
                ),
                'totalAppointments' => $this->when(
                    $doctorProfile->relationLoaded('appointments'),
                    fn() => $doctorProfile->appointments->count()
                ),
                'totalReviews' => $this->when(
                    $doctorProfile->relationLoaded('reviews'),
                    fn() => $doctorProfile->reviews->count()
                ),
                'averageRating' => $this->when(
                    $doctorProfile->relationLoaded('reviews'),
                    fn() => $doctorProfile->reviews->count() > 0 ?
                        round($doctorProfile->reviews->avg('rate'), 1) : 0
                ),
            ];
        }

        // Fallback for unknown model types
        return [
            'error' => 'Unsupported model type for ProfileResource'
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
            $fields = array_merge($fields, [
                'professional_number' => !empty($doctorProfile->professional_number),
                'introduce' => !empty($doctorProfile->introduce),
                'medical_category' => !empty($doctorProfile->medical_category_id),
                'office_address' => !empty($doctorProfile->office_address),
            ]);

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
