<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    /**
     * Número de exámenes activos agrupados por carrera.
     *
     * @return JsonResponse { labels: string[], values: int[] }
     */
    public function examenesPorCarrera(): JsonResponse
    {
        $rows = DB::table('examenes')
            ->join('unidades_aprendizaje', 'examenes.unidad_aprendizaje_id', '=', 'unidades_aprendizaje.id')
            ->join('carreras', 'unidades_aprendizaje.carrera_id', '=', 'carreras.id')
            ->where('examenes.activo', 1)
            ->whereNull('examenes.deleted_at')
            ->whereNull('carreras.deleted_at')
            ->groupBy('carreras.id', 'carreras.nombre')
            ->orderByDesc('total')
            ->select('carreras.nombre as label', DB::raw('COUNT(examenes.id) as total'))
            ->get();

        return response()->json([
            'labels' => $rows->pluck('label')->values(),
            'values' => $rows->pluck('total')->map(fn ($v) => (int) $v)->values(),
        ]);
    }

    /**
     * Número de alumnos inscritos agrupados por unidad de aprendizaje (materia).
     * Cuenta filas del pivot alumno_examen para exámenes activos.
     *
     * @return JsonResponse { labels: string[], values: int[] }
     */
    public function inscritosPorMateria(): JsonResponse
    {
        $rows = DB::table('alumno_examen')
            ->join('examenes', 'alumno_examen.examen_id', '=', 'examenes.id')
            ->join('unidades_aprendizaje', 'examenes.unidad_aprendizaje_id', '=', 'unidades_aprendizaje.id')
            ->where('examenes.activo', 1)
            ->whereNull('examenes.deleted_at')
            ->whereNull('unidades_aprendizaje.deleted_at')
            ->groupBy('unidades_aprendizaje.id', 'unidades_aprendizaje.nombre')
            ->orderByDesc('total')
            ->select('unidades_aprendizaje.nombre as label', DB::raw('COUNT(alumno_examen.user_id) as total'))
            ->get();

        return response()->json([
            'labels' => $rows->pluck('label')->values(),
            'values' => $rows->pluck('total')->map(fn ($v) => (int) $v)->values(),
        ]);
    }
}
