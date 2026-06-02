<?php

namespace App\Filament\Resources\PlanEstudios;

use App\Filament\Resources\PlanEstudios\Pages\ListPlanEstudios;
use App\Filament\Resources\PlanEstudios\Pages\ViewPlanEstudio;
use App\Filament\Resources\PlanEstudios\Schemas\PlanEstudioForm;
use App\Filament\Resources\PlanEstudios\Schemas\PlanEstudioInfolist;
use App\Filament\Resources\PlanEstudios\Tables\PlanEstudiosTable;
use App\Models\PlanEstudio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlanEstudioResource extends Resource
{
    protected static ?string $model = PlanEstudio::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $modelLabel = 'Plan de Estudio';

    protected static ?string $pluralModelLabel = 'Planes de Estudio';

    protected static \UnitEnum|string|null $navigationGroup = 'Académico';

    public static function canCreate(): bool { return false; }

    public static function canEdit(mixed $record): bool { return false; }

    public static function canDelete(mixed $record): bool { return false; }

    public static function form(Schema $schema): Schema
    {
        return PlanEstudioForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PlanEstudioInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PlanEstudiosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPlanEstudios::route('/'),
            'view'  => ViewPlanEstudio::route('/{record}'),
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
