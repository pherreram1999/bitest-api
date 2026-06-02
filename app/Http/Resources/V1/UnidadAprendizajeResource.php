<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnidadAprendizajeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'nombre'     => $this->nombre,
            'carrera_id' => $this->carrera_id,
            'carrera'    => CarreraResource::make($this->whenLoaded('carrera')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
