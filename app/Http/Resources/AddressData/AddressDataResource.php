<?php

namespace App\Http\Resources\AddressData;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cep' => $this->cep,
            'state' => $this->state,
            'city' => $this->city,
            'neighborhood' => $this->neighborhood ?? 'N/A',
            'street' => $this->street ?? 'N/A',
            'created_at' => $this->created_at
        ];
    }
}
