<?php

namespace App\Filament\Resources\Salons\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SalonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                Select::make('edificio_id')
                    ->relationship('edificio', 'id')
                    ->required(),
            ]);
    }
}
