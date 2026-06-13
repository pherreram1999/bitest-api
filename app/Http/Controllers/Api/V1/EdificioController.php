<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Edificio\IndexEdificioRequest;
use App\Http\Requests\V1\Edificio\StoreEdificioRequest;
use App\Http\Requests\V1\Edificio\UpdateEdificioRequest;
use App\Http\Resources\V1\EdificioResource;
use App\Models\Edificio;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class EdificioController extends Controller
{
    public function index(IndexEdificioRequest $request): AnonymousResourceCollection
    {
        return EdificioResource::collection(
            Edificio::with('salones')->applyFilters($request->validated())->paginate(15)
        );
    }

    public function store(StoreEdificioRequest $request): JsonResponse
    {
        return (new EdificioResource(Edificio::create($request->validated())->load('salones')))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Edificio $edificio): EdificioResource
    {
        return new EdificioResource($edificio->load('salones'));
    }

    public function update(UpdateEdificioRequest $request, Edificio $edificio): EdificioResource
    {
        $edificio->update($request->validated());

        return new EdificioResource($edificio->load('salones'));
    }

    public function destroy(Edificio $edificio): Response
    {
        $edificio->delete();

        return response()->noContent();
    }

    public function restore(int $id): EdificioResource
    {
        $edificio = Edificio::onlyTrashed()->findOrFail($id);
        $edificio->restore();

        return new EdificioResource($edificio->load('salones'));
    }
}
