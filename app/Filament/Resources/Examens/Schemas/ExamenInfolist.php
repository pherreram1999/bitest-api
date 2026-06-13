<?php

namespace App\Filament\Resources\Examens\Schemas;

use App\Models\Examen;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ExamenInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('descripcion'),
                TextEntry::make('horario')
                    ->dateTime(),
                TextEntry::make('unidadAprendizaje.semestre')
                    ->label('Semestre')
                    ->numeric(),
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('unidadAprendizaje.id')
                    ->label('Unidad aprendizaje'),
                TextEntry::make('profesor.id')
                    ->label('Profesor'),
                TextEntry::make('salon.id')
                    ->label('Salon'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Examen $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
