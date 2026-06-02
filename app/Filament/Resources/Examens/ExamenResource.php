<?php

namespace App\Filament\Resources\Examens;

use App\Filament\Resources\Examens\Pages\ListExamens;
use App\Filament\Resources\Examens\Pages\ViewExamen;
use App\Filament\Resources\Examens\Schemas\ExamenForm;
use App\Filament\Resources\Examens\Schemas\ExamenInfolist;
use App\Filament\Resources\Examens\Tables\ExamensTable;
use App\Models\Examen;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamenResource extends Resource
{
    protected static ?string $model = Examen::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $modelLabel = 'Examen';

    protected static ?string $pluralModelLabel = 'Exámenes';

    protected static \UnitEnum|string|null $navigationGroup = 'Evaluación';

    public static function canCreate(): bool { return false; }

    public static function canEdit(mixed $record): bool { return false; }

    public static function canDelete(mixed $record): bool { return false; }

    public static function form(Schema $schema): Schema
    {
        return ExamenForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ExamenInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExamensTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExamens::route('/'),
            'view'  => ViewExamen::route('/{record}'),
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
