<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfesorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'email' => $this->email,
            'area_id' => $this->area_id,
            'area' => AreaResource::make($this->whenLoaded('area')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
