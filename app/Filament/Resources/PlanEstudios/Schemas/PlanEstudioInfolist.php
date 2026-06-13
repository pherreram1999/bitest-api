<?php

namespace App\Filament\Resources\PlanEstudios\Schemas;

use App\Models\PlanEstudio;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PlanEstudioInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre'),
                TextEntry::make('periodo_inicial')
                    ->date(),
                TextEntry::make('periodo_final')
                    ->date(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (PlanEstudio $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
