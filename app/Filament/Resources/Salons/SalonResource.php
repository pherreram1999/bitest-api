<?php

namespace App\Filament\Resources\Salons;

use App\Filament\Resources\Salons\Pages\ListSalons;
use App\Filament\Resources\Salons\Pages\ViewSalon;
use App\Filament\Resources\Salons\Schemas\SalonForm;
use App\Filament\Resources\Salons\Schemas\SalonInfolist;
use App\Filament\Resources\Salons\Tables\SalonsTable;
use App\Models\Salon;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SalonResource extends Resource
{
    protected static ?string $model = Salon::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static ?string $modelLabel = 'Salón';

    protected static ?string $pluralModelLabel = 'Salones';

    protected static \UnitEnum|string|null $navigationGroup = 'Infraestructura';

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
        return SalonForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SalonInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SalonsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSalons::route('/'),
            'view' => ViewSalon::route('/{record}'),
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
