<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Salon\StoreSalonRequest;
use App\Http\Requests\V1\Salon\UpdateSalonRequest;
use App\Http\Resources\V1\SalonResource;
use App\Models\Salon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SalonController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return SalonResource::collection(Salon::paginate(15));
    }

    public function store(StoreSalonRequest $request): JsonResponse
    {
        return (new SalonResource(Salon::create($request->validated())))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Salon $salon): SalonResource
    {
        return new SalonResource($salon);
    }

    public function update(UpdateSalonRequest $request, Salon $salon): SalonResource
    {
        $salon->update($request->validated());
        return new SalonResource($salon);
    }

    public function destroy(Salon $salon): Response
    {
        $salon->delete();
        return response()->noContent();
    }

    public function restore(int $id): SalonResource
    {
        $salon = Salon::onlyTrashed()->findOrFail($id);
        $salon->restore();
        return new SalonResource($salon);
    }
}
