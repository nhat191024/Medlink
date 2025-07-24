<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorAppointmentResource extends JsonResource
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
            "status" => $this->status,
            "medical_problem" => $this->medical_problem,
            "medical_problem_file" => $this->medical_problem_file,
            "duration" => $this->duration,
            "date" => $this->date,
            "day_of_week" => $this->day_of_week,
            "time" => $this->time,
            "reason" => $this->reason,
            "link" => $this->link,
            "address" => $this->address,
            "created_at" => $this->created_at,
            "office_address" => $this->doctor->office_address,
            "pay_type" => $this->bill->payment_method == 'qr_transfer' ? 'QR Code' : $this->bill->payment_method,
            "provider" => $this->bill->payment_method == 'qr_transfer' ? 'Pay OS' : "Ping Bank",
            "medical_category" => new MedicalCategoryResource($this->whenLoaded('medical_category')),
            "patient" => new PatientResource($this->whenLoaded('patient')),
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
            "service" => new ServiceResource($this->whenLoaded('service')),
            "bill" => new BillResource($this->whenLoaded('bill')),
        ];
    }
}
