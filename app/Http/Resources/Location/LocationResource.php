<?php

namespace App\Http\Resources\Location;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type' => $this->type,
            'coordinates' => [
                'longitude' => $this->longitude,
                'latitude' => $this->latitude
            ],
        ];
    }
}
