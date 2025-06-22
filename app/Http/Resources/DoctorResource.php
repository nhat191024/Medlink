<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            "phone" => $this->country_code . " " . $this->phone,
            "email" => $this->email,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "full_name" => $this->full_name,
            "avatar" => $this->avatar ? asset($this->avatar) : '',
            "age" => $this->age,
            "gender" => $this->gender,
            "height" => $this->height,
            "weight" => $this->weight,
            "blood_group" => $this->blood_group,
            "medical_history" => $this->medical_history,
            "insurance_type" => $this->insurance_type,
            "insurance_number" => $this->insurance_number,
            "main_insured" => $this->main_insured,
            "entitled_insured" => $this->entitled_insured,
            "assurance_type" => $this->assurance_type,
            "office_address" => $this->office_address
        ];
    }
}
