<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanEstudioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'periodo_inicial' => $this->periodo_inicial,
            'periodo_final' => $this->periodo_final,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
