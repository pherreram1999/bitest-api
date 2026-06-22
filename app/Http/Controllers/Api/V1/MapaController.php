<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MapaCanvasResource;
use App\Models\Edificio;
use Illuminate\Support\Collection;

class MapaController extends Controller
{
    /**
     * Spec de dibujo del plano ESCOM para Flutter CustomPainter.
     *
     * Devuelve el canvas lógico (1024×560 px) con todos los elementos del plano:
     * edificios reales (tappable, con edificio_numero) y zonas decorativas (tappable=false).
     *
     * Flujo Flutter:
     *   1. GET /api/v1/mapa/canvas → obtener canvas + elements
     *   2. CustomPainter: scale = min(size.width / canvas.width, size.height / canvas.height)
     *   3. onTapDown → hit-test sobre elements donde tappable=true
     *   4. Al tap → GET /api/v1/edificios/{edificio_numero} para listar salones
     */
    public function canvas(): MapaCanvasResource
    {
        $layout = config('mapa_canvas');

        // Resolver edificio_numero por nombre en un solo query
        /** @var Collection<string,int> $numeros */
        $numeros = Edificio::pluck('numero', 'nombre');

        $layout['elements'] = array_map(function (array $element) use ($numeros): array {
            if ($element['type'] === 'building') {
                $nombre = $element['edificio'];
                $element['label'] = $nombre;
                $element['edificio_numero'] = $numeros[$nombre] ?? null;
                $element['tappable'] = $element['edificio_numero'] !== null;
                unset($element['edificio']); // el consumer usa edificio_numero + label
            } else {
                $element['edificio_numero'] = null;
                $element['tappable'] = false;
            }

            return $element;
        }, $layout['elements']);

        return new MapaCanvasResource($layout);
    }
}
