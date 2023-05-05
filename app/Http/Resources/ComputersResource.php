<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComputersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "model" => $this->resource->get('model'),
            "ram" => $this->resource->get('ram'),
            "hdd" => $this->resource->get('hdd'),
            "location" => $this->resource->get('location'),
            "price" => $this->resource->get('price'),
        ];
    }
}
