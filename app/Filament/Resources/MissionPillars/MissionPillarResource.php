<?php

namespace App\Filament\Resources\MissionPillars;

use App\Filament\Resources\MissionPillars\Pages\CreateMissionPillar;
use App\Filament\Resources\MissionPillars\Pages\EditMissionPillar;
use App\Filament\Resources\MissionPillars\Pages\ListMissionPillars;
use App\Filament\Resources\MissionPillars\Schemas\MissionPillarForm;
use App\Filament\Resources\MissionPillars\Tables\MissionPillarsTable;
use App\Models\MissionPillar;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MissionPillarResource extends Resource
{
    protected static ?string $model = MissionPillar::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeAlt;

    public static function getNavigationGroup(): ?string { return 'Missions Page'; }
    public static function getNavigationLabel(): string  { return 'Mission Pillars'; }
    public static function getNavigationSort(): ?int     { return 1; }

    public static function form(Schema $schema): Schema
    {
        return MissionPillarForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MissionPillarsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListMissionPillars::route('/'),
            'create' => CreateMissionPillar::route('/create'),
            'edit'   => EditMissionPillar::route('/{record}/edit'),
        ];
    }
}
