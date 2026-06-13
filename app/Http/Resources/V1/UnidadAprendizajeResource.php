<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnidadAprendizajeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'semestre' => $this->semestre,
            'carrera_id' => $this->carrera_id,
            'plan_estudio_id' => $this->plan_estudio_id,
            'carrera' => CarreraResource::make($this->whenLoaded('carrera')),
            'planEstudio' => PlanEstudioResource::make($this->whenLoaded('planEstudio')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
