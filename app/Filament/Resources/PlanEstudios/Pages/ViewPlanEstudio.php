<?php

namespace App\Filament\Resources\PlanEstudios\Pages;

use App\Filament\Resources\PlanEstudios\PlanEstudioResource;
use Filament\Resources\Pages\ViewRecord;

class ViewPlanEstudio extends ViewRecord
{
    protected static string $resource = PlanEstudioResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
