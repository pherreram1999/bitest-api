<?php

namespace App\Filament\Resources\Edificios\Pages;

use App\Filament\Resources\Edificios\EdificioResource;
use Filament\Resources\Pages\ListRecords;

class ListEdificios extends ListRecords
{
    protected static string $resource = EdificioResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
