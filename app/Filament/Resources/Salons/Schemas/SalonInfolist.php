<?php

namespace App\Filament\Resources\Salons\Schemas;

use App\Models\Salon;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SalonInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre'),
                TextEntry::make('edificio.id')
                    ->label('Edificio'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Salon $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
