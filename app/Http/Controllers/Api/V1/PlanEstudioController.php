<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\PlanEstudio\StorePlanEstudioRequest;
use App\Http\Requests\V1\PlanEstudio\UpdatePlanEstudioRequest;
use App\Http\Resources\V1\PlanEstudioResource;
use App\Models\PlanEstudio;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PlanEstudioController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return PlanEstudioResource::collection(PlanEstudio::paginate(15));
    }

    public function store(StorePlanEstudioRequest $request): JsonResponse
    {
        return (new PlanEstudioResource(PlanEstudio::create($request->validated())))
            ->response()
            ->setStatusCode(201);
    }

    public function show(PlanEstudio $plan_estudio): PlanEstudioResource
    {
        return new PlanEstudioResource($plan_estudio);
    }

    public function update(UpdatePlanEstudioRequest $request, PlanEstudio $plan_estudio): PlanEstudioResource
    {
        $plan_estudio->update($request->validated());
        return new PlanEstudioResource($plan_estudio);
    }

    public function destroy(PlanEstudio $plan_estudio): Response
    {
        $plan_estudio->delete();
        return response()->noContent();
    }

    public function restore(int $id): PlanEstudioResource
    {
        $plan = PlanEstudio::onlyTrashed()->findOrFail($id);
        $plan->restore();
        return new PlanEstudioResource($plan);
    }
}
