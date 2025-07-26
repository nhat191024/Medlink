<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "phone" => "{$this->user->country_code} {$this->user->phone}",
            "email" => $this->user->email,
            "latitude" => $this->user->latitude,
            "longitude" => $this->user->longitude,
            "full_name" => $this->user->name,
            "avatar" => $this->user->avatar ? asset($this->user->avatar) : '',
            "age" => $this->age,
            "gender" => $this->user->gender,
            "height" => $this->height,
            "weight" => $this->weight,
            "blood_group" => $this->blood_group,
            "medical_history" => $this->medical_history,
            // "insurance_type" => $this->insurance_type,
            // "insurance_number" => $this->insurance_number,
            // "main_insured" => $this->main_insured,
            // "entitled_insured" => $this->entitled_insured,
            // "assurance_type" => $this->assurance_type,
            "address" => $this->user->address,
        ];
    }
}
