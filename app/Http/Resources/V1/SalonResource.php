<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalonResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'edificio_id' => $this->edificio_id,
            'edificio' => EdificioResource::make($this->whenLoaded('edificio')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
