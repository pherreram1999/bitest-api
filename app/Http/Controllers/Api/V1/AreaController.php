<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Area\StoreAreaRequest;
use App\Http\Requests\V1\Area\UpdateAreaRequest;
use App\Http\Resources\V1\AreaResource;
use App\Models\Area;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AreaController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AreaResource::collection(Area::paginate(15));
    }

    public function store(StoreAreaRequest $request): JsonResponse
    {
        return (new AreaResource(Area::create($request->validated())))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Area $area): AreaResource
    {
        return new AreaResource($area);
    }

    public function update(UpdateAreaRequest $request, Area $area): AreaResource
    {
        $area->update($request->validated());
        return new AreaResource($area);
    }

    public function destroy(Area $area): Response
    {
        $area->delete();
        return response()->noContent();
    }

    public function restore(int $id): AreaResource
    {
        $area = Area::onlyTrashed()->findOrFail($id);
        $area->restore();
        return new AreaResource($area);
    }
}
