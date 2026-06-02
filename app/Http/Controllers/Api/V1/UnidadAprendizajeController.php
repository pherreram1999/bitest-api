<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UnidadAprendizaje\StoreUnidadAprendizajeRequest;
use App\Http\Requests\V1\UnidadAprendizaje\UpdateUnidadAprendizajeRequest;
use App\Http\Resources\V1\UnidadAprendizajeResource;
use App\Models\UnidadAprendizaje;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UnidadAprendizajeController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return UnidadAprendizajeResource::collection(UnidadAprendizaje::paginate(15));
    }

    public function store(StoreUnidadAprendizajeRequest $request): JsonResponse
    {
        return (new UnidadAprendizajeResource(UnidadAprendizaje::create($request->validated())))
            ->response()
            ->setStatusCode(201);
    }

    public function show(UnidadAprendizaje $unidad_aprendizaje): UnidadAprendizajeResource
    {
        return new UnidadAprendizajeResource($unidad_aprendizaje);
    }

    public function update(UpdateUnidadAprendizajeRequest $request, UnidadAprendizaje $unidad_aprendizaje): UnidadAprendizajeResource
    {
        $unidad_aprendizaje->update($request->validated());
        return new UnidadAprendizajeResource($unidad_aprendizaje);
    }

    public function destroy(UnidadAprendizaje $unidad_aprendizaje): Response
    {
        $unidad_aprendizaje->delete();
        return response()->noContent();
    }

    public function restore(int $id): UnidadAprendizajeResource
    {
        $unidad = UnidadAprendizaje::onlyTrashed()->findOrFail($id);
        $unidad->restore();
        return new UnidadAprendizajeResource($unidad);
    }
}
