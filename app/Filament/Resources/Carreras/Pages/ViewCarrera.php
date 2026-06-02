<?php

namespace App\Filament\Resources\Carreras\Pages;

use App\Filament\Resources\Carreras\CarreraResource;
use Filament\Resources\Pages\ViewRecord;

class ViewCarrera extends ViewRecord
{
    protected static string $resource = CarreraResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
