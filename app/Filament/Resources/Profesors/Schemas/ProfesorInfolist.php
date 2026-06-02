<?php

namespace App\Filament\Resources\Profesors\Schemas;

use App\Models\Profesor;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProfesorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('area.id')
                    ->label('Area'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Profesor $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
