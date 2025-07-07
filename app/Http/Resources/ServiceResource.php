<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            "icon" => $this->icon,
            "name" => $this->name,
            "description" => $this->description,
            "price" => $this->price,
            "duration" => $this->duration,
            "buffer_time" => $this->buffer_time,
            "seat" => $this->seat,
            "is_active" => $this->is_active == 1 ? true : false,
            // "doctor" => new UserResource($this->doctor),
        ];
    }
}
