<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Carrera\IndexCarreraRequest;
use App\Http\Requests\V1\Carrera\StoreCarreraRequest;
use App\Http\Requests\V1\Carrera\UpdateCarreraRequest;
use App\Http\Resources\V1\CarreraResource;
use App\Models\Carrera;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CarreraController extends Controller
{
    public function index(IndexCarreraRequest $request): AnonymousResourceCollection
    {
        return CarreraResource::collection(
            Carrera::with('unidades')->applyFilters($request->validated())->paginate(15)
        );
    }

    public function store(StoreCarreraRequest $request): JsonResponse
    {
        return (new CarreraResource(Carrera::create($request->validated())->load('unidades')))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Carrera $carrera): CarreraResource
    {
        return new CarreraResource($carrera->load('unidades'));
    }

    public function update(UpdateCarreraRequest $request, Carrera $carrera): CarreraResource
    {
        $carrera->update($request->validated());

        return new CarreraResource($carrera->load('unidades'));
    }

    public function destroy(Carrera $carrera): Response
    {
        $carrera->delete();

        return response()->noContent();
    }

    public function restore(int $id): CarreraResource
    {
        $carrera = Carrera::onlyTrashed()->findOrFail($id);
        $carrera->restore();

        return new CarreraResource($carrera->load('unidades'));
    }
}
