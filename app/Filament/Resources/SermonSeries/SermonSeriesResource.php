<?php

namespace App\Filament\Resources\SermonSeries;

use App\Filament\Resources\SermonSeries\Pages\CreateSermonSeries;
use App\Filament\Resources\SermonSeries\Pages\EditSermonSeries;
use App\Filament\Resources\SermonSeries\Pages\ListSermonSeries;
use App\Filament\Resources\SermonSeries\RelationManagers\SermonsRelationManager;
use App\Filament\Resources\SermonSeries\Schemas\SermonSeriesForm;
use App\Filament\Resources\SermonSeries\Tables\SermonSeriesTable;
use App\Models\SermonSeries as SermonSeriesModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SermonSeriesResource extends Resource
{
    protected static ?string $model = SermonSeriesModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQueueList;

    public static function getNavigationGroup(): ?string { return 'Content'; }
    public static function getNavigationLabel(): string  { return 'Sermon Series'; }
    public static function getNavigationSort(): ?int     { return 2; }

    public static function form(Schema $schema): Schema
    {
        return SermonSeriesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SermonSeriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            SermonsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListSermonSeries::route('/'),
            'create' => CreateSermonSeries::route('/create'),
            'edit'   => EditSermonSeries::route('/{record}/edit'),
        ];
    }
}
