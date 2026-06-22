<?php

namespace App\Filament\Resources\Edificios\Schemas;

use App\Models\Edificio;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EdificioInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('numero')
                    ->label('Número'),
                TextEntry::make('nombre'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Edificio $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
