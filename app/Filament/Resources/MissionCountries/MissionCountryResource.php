<?php

namespace App\Filament\Resources\MissionCountries;

use App\Filament\Resources\MissionCountries\Pages\CreateMissionCountry;
use App\Filament\Resources\MissionCountries\Pages\EditMissionCountry;
use App\Filament\Resources\MissionCountries\Pages\ListMissionCountries;
use App\Filament\Resources\MissionCountries\Schemas\MissionCountryForm;
use App\Filament\Resources\MissionCountries\Tables\MissionCountriesTable;
use App\Models\MissionCountry;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MissionCountryResource extends Resource
{
    protected static ?string $model = MissionCountry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFlag;

    public static function getNavigationGroup(): ?string { return 'Missions Page'; }
    public static function getNavigationLabel(): string  { return 'Mission Countries'; }
    public static function getNavigationSort(): ?int     { return 2; }

    public static function form(Schema $schema): Schema
    {
        return MissionCountryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MissionCountriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListMissionCountries::route('/'),
            'create' => CreateMissionCountry::route('/create'),
            'edit'   => EditMissionCountry::route('/{record}/edit'),
        ];
    }
}
