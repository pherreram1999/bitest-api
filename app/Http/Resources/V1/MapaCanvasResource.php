<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property array $canvas
 * @property array $elements
 * @property array $style
 */
class MapaCanvasResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'canvas'   => $this->resource['canvas'],
            'elements' => $this->resource['elements'],
            'style'    => $this->resource['style'],
        ];
    }
}
