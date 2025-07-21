<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->payable_id,
            'wallet_id' => $this->wallet_id,
            'amount' => $this->amount,
            'description' => $this->meta['description'] ?? null,
            'confirmed' => $this->confirmed,
            'uuid' => $this->uuid,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'deleted_at' => $this->deleted_at ? $this->deleted_at->diffForHumans() : null,
        ];
    }
}
