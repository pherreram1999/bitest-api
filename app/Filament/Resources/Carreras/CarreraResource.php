<?php

namespace App\Filament\Resources\Carreras;

use App\Filament\Resources\Carreras\Pages\ListCarreras;
use App\Filament\Resources\Carreras\Pages\ViewCarrera;
use App\Filament\Resources\Carreras\Schemas\CarreraForm;
use App\Filament\Resources\Carreras\Schemas\CarreraInfolist;
use App\Filament\Resources\Carreras\Tables\CarrerasTable;
use App\Models\Carrera;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarreraResource extends Resource
{
    protected static ?string $model = Carrera::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $modelLabel = 'Carrera';

    protected static ?string $pluralModelLabel = 'Carreras';

    protected static \UnitEnum|string|null $navigationGroup = 'Académico';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(mixed $record): bool
    {
        return false;
    }

    public static function canDelete(mixed $record): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return CarreraForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CarreraInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CarrerasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCarreras::route('/'),
            'view' => ViewCarrera::route('/{record}'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
