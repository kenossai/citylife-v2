<?php

namespace App\Filament\Resources\WorshipCentres;

use App\Filament\Resources\WorshipCentres\Pages\CreateWorshipCentre;
use App\Filament\Resources\WorshipCentres\Pages\EditWorshipCentre;
use App\Filament\Resources\WorshipCentres\Pages\ListWorshipCentres;
use App\Filament\Resources\WorshipCentres\Schemas\WorshipCentreForm;
use App\Filament\Resources\WorshipCentres\Tables\WorshipCentresTable;
use App\Models\WorshipCentre;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WorshipCentreResource extends Resource
{
    protected static ?string $model = WorshipCentre::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    public static function getNavigationGroup(): ?string { return 'About Page'; }
    public static function getNavigationLabel(): string  { return 'Worship Centres'; }
    public static function getNavigationSort(): ?int     { return 2; }

    public static function form(Schema $schema): Schema
    {
        return WorshipCentreForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorshipCentresTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWorshipCentres::route('/'),
            'create' => CreateWorshipCentre::route('/create'),
            'edit' => EditWorshipCentre::route('/{record}/edit'),
        ];
    }
}
