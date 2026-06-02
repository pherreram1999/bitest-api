<?php

namespace App\Filament\Resources\UnidadAprendizajes;

use App\Filament\Resources\UnidadAprendizajes\Pages\ListUnidadAprendizajes;
use App\Filament\Resources\UnidadAprendizajes\Pages\ViewUnidadAprendizaje;
use App\Filament\Resources\UnidadAprendizajes\Schemas\UnidadAprendizajeForm;
use App\Filament\Resources\UnidadAprendizajes\Schemas\UnidadAprendizajeInfolist;
use App\Filament\Resources\UnidadAprendizajes\Tables\UnidadAprendizajesTable;
use App\Models\UnidadAprendizaje;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnidadAprendizajeResource extends Resource
{
    protected static ?string $model = UnidadAprendizaje::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $modelLabel = 'Unidad de Aprendizaje';

    protected static ?string $pluralModelLabel = 'Unidades de Aprendizaje';

    protected static \UnitEnum|string|null $navigationGroup = 'Académico';

    public static function canCreate(): bool { return false; }

    public static function canEdit(mixed $record): bool { return false; }

    public static function canDelete(mixed $record): bool { return false; }

    public static function form(Schema $schema): Schema
    {
        return UnidadAprendizajeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UnidadAprendizajeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UnidadAprendizajesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUnidadAprendizajes::route('/'),
            'view'  => ViewUnidadAprendizaje::route('/{record}'),
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
