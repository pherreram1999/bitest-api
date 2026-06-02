<?php

namespace App\Filament\Resources\UnidadAprendizajes\Pages;

use App\Filament\Resources\UnidadAprendizajes\UnidadAprendizajeResource;
use Filament\Resources\Pages\ViewRecord;

class ViewUnidadAprendizaje extends ViewRecord
{
    protected static string $resource = UnidadAprendizajeResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
