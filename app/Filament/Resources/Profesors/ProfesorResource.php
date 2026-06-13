<?php

namespace App\Filament\Resources\Profesors;

use App\Filament\Resources\Profesors\Pages\ListProfesors;
use App\Filament\Resources\Profesors\Pages\ViewProfesor;
use App\Filament\Resources\Profesors\Schemas\ProfesorForm;
use App\Filament\Resources\Profesors\Schemas\ProfesorInfolist;
use App\Filament\Resources\Profesors\Tables\ProfesorsTable;
use App\Models\Profesor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfesorResource extends Resource
{
    protected static ?string $model = Profesor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $modelLabel = 'Profesor';

    protected static ?string $pluralModelLabel = 'Profesores';

    protected static \UnitEnum|string|null $navigationGroup = 'Personal';

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
        return ProfesorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProfesorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfesorsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProfesors::route('/'),
            'view' => ViewProfesor::route('/{record}'),
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
