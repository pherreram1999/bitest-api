<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Profesor\StoreProfesorRequest;
use App\Http\Requests\V1\Profesor\UpdateProfesorRequest;
use App\Http\Resources\V1\ProfesorResource;
use App\Models\Profesor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProfesorController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return ProfesorResource::collection(Profesor::paginate(15));
    }

    public function store(StoreProfesorRequest $request): JsonResponse
    {
        return (new ProfesorResource(Profesor::create($request->validated())))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Profesor $profesor): ProfesorResource
    {
        return new ProfesorResource($profesor);
    }

    public function update(UpdateProfesorRequest $request, Profesor $profesor): ProfesorResource
    {
        $profesor->update($request->validated());
        return new ProfesorResource($profesor);
    }

    public function destroy(Profesor $profesor): Response
    {
        $profesor->delete();
        return response()->noContent();
    }

    public function restore(int $id): ProfesorResource
    {
        $profesor = Profesor::onlyTrashed()->findOrFail($id);
        $profesor->restore();
        return new ProfesorResource($profesor);
    }
}
