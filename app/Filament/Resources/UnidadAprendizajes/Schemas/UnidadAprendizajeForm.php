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
                TextInput::make('semestre')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(12),
                Select::make('carrera_id')
                    ->relationship('carrera', 'nombre')
                    ->required(),
                Select::make('plan_estudio_id')
                    ->relationship('planEstudio', 'nombre')
                    ->required(),
            ]);
    }
}
