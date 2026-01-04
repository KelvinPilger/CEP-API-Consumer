<?php

namespace App\Http\Resources\AddressData;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AddressDataCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'addresses' => AddressDataResource::collection($this->collection),
        ];
    }
}
