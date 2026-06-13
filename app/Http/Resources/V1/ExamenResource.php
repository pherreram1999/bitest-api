<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'descripcion' => $this->descripcion,
            'horario' => $this->horario,
            'activo' => $this->activo,
            'user_id' => $this->user_id,
            'unidad_aprendizaje_id' => $this->unidad_aprendizaje_id,
            'profesor_id' => $this->profesor_id,
            'salon_id' => $this->salon_id,
            'usuario' => UserResource::make($this->whenLoaded('usuario')),
            'unidad_aprendizaje' => UnidadAprendizajeResource::make($this->whenLoaded('unidadAprendizaje')),
            'profesor' => ProfesorResource::make($this->whenLoaded('profesor')),
            'salon' => SalonResource::make($this->whenLoaded('salon')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
