<?php

namespace App\Filament\Resources\Carreras\Schemas;

use App\Models\Carrera;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CarreraInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Carrera $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
