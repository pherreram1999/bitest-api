<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AreaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'nombre'     => $this->nombre,
            'email'      => $this->email,
            'profesores' => ProfesorResource::collection($this->whenLoaded('profesores')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
