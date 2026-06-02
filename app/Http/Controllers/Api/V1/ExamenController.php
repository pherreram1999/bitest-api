<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Examen\StoreExamenRequest;
use App\Http\Requests\V1\Examen\UpdateExamenRequest;
use App\Http\Resources\V1\ExamenResource;
use App\Models\Examen;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ExamenController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return ExamenResource::collection(Examen::paginate(15));
    }

    public function store(StoreExamenRequest $request): JsonResponse
    {
        return (new ExamenResource(Examen::create($request->validated())))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Examen $examen): ExamenResource
    {
        return new ExamenResource($examen);
    }

    public function update(UpdateExamenRequest $request, Examen $examen): ExamenResource
    {
        $examen->update($request->validated());
        return new ExamenResource($examen);
    }

    public function destroy(Examen $examen): Response
    {
        $examen->delete();
        return response()->noContent();
    }

    public function restore(int $id): ExamenResource
    {
        $examen = Examen::onlyTrashed()->findOrFail($id);
        $examen->restore();
        return new ExamenResource($examen);
    }
}
