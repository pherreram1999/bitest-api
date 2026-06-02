<?php

namespace App\Filament\Resources\Profesors\Pages;

use App\Filament\Resources\Profesors\ProfesorResource;
use Filament\Resources\Pages\ListRecords;

class ListProfesors extends ListRecords
{
    protected static string $resource = ProfesorResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
