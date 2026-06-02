<?php

namespace App\Filament\Resources\Examens\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExamenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('descripcion')
                    ->required(),
                DateTimePicker::make('horario')
                    ->required(),
                TextInput::make('semestre')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Select::make('unidad_aprendizaje_id')
                    ->relationship('unidadAprendizaje', 'id')
                    ->required(),
                Select::make('profesor_id')
                    ->relationship('profesor', 'id')
                    ->required(),
                Select::make('salon_id')
                    ->relationship('salon', 'id')
                    ->required(),
            ]);
    }
}
