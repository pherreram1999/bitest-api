<?php

namespace App\Filament\Resources\PlanEstudios\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PlanEstudioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                DatePicker::make('periodo_inicial')
                    ->required(),
                DatePicker::make('periodo_final')
                    ->required(),
                Select::make('carrera_id')
                    ->relationship('carrera', 'id')
                    ->required(),
            ]);
    }
}
