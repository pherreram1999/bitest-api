<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MapaCanvasResource;
use App\Models\Edificio;

class MapaController extends Controller
{
    /**
     * Spec de dibujo del plano ESCOM para Flutter CustomPainter.
     *
     * Devuelve el canvas lógico (1024×560 px) con todos los elementos del plano:
     * edificios reales (tappable, con edificio_id) y zonas decorativas (tappable=false).
     *
     * Flujo Flutter:
     *   1. GET /api/v1/mapa/canvas → obtener canvas + elements
     *   2. CustomPainter: scale = min(size.width / canvas.width, size.height / canvas.height)
     *   3. onTapDown → hit-test sobre elements donde tappable=true
     *   4. Al tap → GET /api/v1/edificios/{edificio_id} para listar salones
     *
     * @return MapaCanvasResource
     */
    public function canvas(): MapaCanvasResource
    {
        $layout = config('mapa_canvas');

        // Resolver edificio_id por nombre en un solo query
        /** @var \Illuminate\Support\Collection<string,int> $ids */
        $ids = Edificio::pluck('id', 'nombre');

        $layout['elements'] = array_map(function (array $element) use ($ids): array {
            if ($element['type'] === 'building') {
                $nombre = $element['edificio'];
                $element['label']       = $nombre;
                $element['edificio_id'] = $ids[$nombre] ?? null;
                $element['tappable']    = $element['edificio_id'] !== null;
                unset($element['edificio']); // el consumer usa edificio_id + label
            } else {
                $element['edificio_id'] = null;
                $element['tappable']    = false;
            }

            return $element;
        }, $layout['elements']);

        return new MapaCanvasResource($layout);
    }
}
