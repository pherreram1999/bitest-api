<?php

namespace App\Filament\Resources\UnidadAprendizajes\Schemas;

use App\Models\UnidadAprendizaje;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UnidadAprendizajeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre'),
                TextEntry::make('carrera.id')
                    ->label('Carrera'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (UnidadAprendizaje $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
