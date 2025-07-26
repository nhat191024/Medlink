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
            "avatar" => $this->user->avatar ?
                asset($this->user->avatar) : '',
            "full_name" => $this->user->name,
            "medical_category_name" => $this->medicalCategory->name,
            "phone" => "{$this->user->country_code} {$this->user->phone}",
            "email" => $this->user->email,
            "gender" => $this->user->gender,
            "office_address" => $this->office_address
        ];
    }
}
