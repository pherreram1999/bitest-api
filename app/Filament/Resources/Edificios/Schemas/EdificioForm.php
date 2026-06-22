<?php

namespace App\Filament\Resources\Edificios\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EdificioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('numero')
                    ->label('Número')
                    ->required()
                    ->integer()
                    ->minValue(1)
                    ->unique(ignoreRecord: true),
                TextInput::make('nombre')
                    ->required(),
            ]);
    }
}
