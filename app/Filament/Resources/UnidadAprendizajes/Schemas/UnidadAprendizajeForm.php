<?php

namespace App\Filament\Resources\UnidadAprendizajes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UnidadAprendizajeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                Select::make('carrera_id')
                    ->relationship('carrera', 'id')
                    ->required(),
            ]);
    }
}
