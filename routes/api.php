<?php

use App\Http\Controllers\Api\V1\AreaController;
use App\Http\Controllers\Api\V1\ChartController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CarreraController;
use App\Http\Controllers\Api\V1\EdificioController;
use App\Http\Controllers\Api\V1\ExamenController;
use App\Http\Controllers\Api\V1\MisExamenesController;
use App\Http\Controllers\Api\V1\PlanEstudioController;
use App\Http\Controllers\Api\V1\ProfesorController;
use App\Http\Controllers\Api\V1\SalonController;
use App\Http\Controllers\Api\V1\UnidadAprendizajeController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // ── Auth (públicos) ───────────────────────────────────────────────────────
    Route::post('auth/register', [AuthController::class, 'register']);
    Route::post('auth/login', [AuthController::class, 'login']);

    // ── Rutas protegidas por personal access token ────────────────────────────
    Route::middleware('auth:sanctum')->group(function () {

        Route::post('auth/logout', [AuthController::class, 'logout']);
        Route::get('auth/me', [AuthController::class, 'me']);

        // Restore (antes de apiResource para no colisionar con {id})
        Route::post('carreras/{id}/restore', [CarreraController::class,           'restore']);
        Route::post('planes-estudio/{id}/restore', [PlanEstudioController::class,       'restore']);
        Route::post('unidades-aprendizaje/{id}/restore', [UnidadAprendizajeController::class, 'restore']);
        Route::post('edificios/{id}/restore', [EdificioController::class,          'restore']);
        Route::post('salones/{id}/restore', [SalonController::class,             'restore']);
        Route::post('areas/{id}/restore', [AreaController::class,              'restore']);
        Route::post('profesores/{id}/restore', [ProfesorController::class,          'restore']);
        Route::post('examenes/{id}/restore', [ExamenController::class,            'restore']);

        // CRUD
        Route::apiResource('carreras', CarreraController::class);
        Route::apiResource('planes-estudio', PlanEstudioController::class)
            ->parameters(['planes-estudio' => 'plan_estudio']);
        Route::apiResource('unidades-aprendizaje', UnidadAprendizajeController::class)
            ->parameters(['unidades-aprendizaje' => 'unidad_aprendizaje']);
        Route::apiResource('edificios', EdificioController::class);
        Route::apiResource('salones', SalonController::class)
            ->parameters(['salones' => 'salon']);
        Route::apiResource('areas', AreaController::class);
        Route::apiResource('profesores', ProfesorController::class)
            ->parameters(['profesores' => 'profesor']);
        Route::apiResource('examenes', ExamenController::class)
            ->parameters(['examenes' => 'examen']);

        // Mis exámenes (alumno)
        Route::get('mis-examenes', [MisExamenesController::class, 'index']);
        Route::get('mis-examenes/pdf', [MisExamenesController::class, 'pdf']);
        Route::get('mis-examenes/ical', [MisExamenesController::class, 'ical']);
        Route::post('mis-examenes/{examen}', [MisExamenesController::class, 'store']);
        Route::get('mis-examenes/{examen}/ical', [MisExamenesController::class, 'icalExamen']);
        Route::delete('mis-examenes/{examen}', [MisExamenesController::class, 'destroy']);

        // Charts (agregaciones para Flutter/fl_chart)
        Route::get('charts/examenes-por-carrera', [ChartController::class, 'examenesPorCarrera']);
        Route::get('charts/inscritos-por-materia', [ChartController::class, 'inscritosPorMateria']);
    });
});
