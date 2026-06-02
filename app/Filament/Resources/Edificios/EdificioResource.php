<?php

namespace App\Filament\Resources\Edificios;

use App\Filament\Resources\Edificios\Pages\ListEdificios;
use App\Filament\Resources\Edificios\Pages\ViewEdificio;
use App\Filament\Resources\Edificios\Schemas\EdificioForm;
use App\Filament\Resources\Edificios\Schemas\EdificioInfolist;
use App\Filament\Resources\Edificios\Tables\EdificiosTable;
use App\Models\Edificio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EdificioResource extends Resource
{
    protected static ?string $model = Edificio::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice;

    protected static ?string $modelLabel = 'Edificio';

    protected static ?string $pluralModelLabel = 'Edificios';

    protected static \UnitEnum|string|null $navigationGroup = 'Infraestructura';

    public static function canCreate(): bool { return false; }

    public static function canEdit(mixed $record): bool { return false; }

    public static function canDelete(mixed $record): bool { return false; }

    public static function form(Schema $schema): Schema
    {
        return EdificioForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EdificioInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EdificiosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEdificios::route('/'),
            'view'  => ViewEdificio::route('/{record}'),
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
