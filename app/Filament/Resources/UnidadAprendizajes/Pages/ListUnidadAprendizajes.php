<?php

namespace App\Filament\Resources\UnidadAprendizajes\Pages;

use App\Filament\Resources\UnidadAprendizajes\UnidadAprendizajeResource;
use Filament\Resources\Pages\ListRecords;

class ListUnidadAprendizajes extends ListRecords
{
    protected static string $resource = UnidadAprendizajeResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
