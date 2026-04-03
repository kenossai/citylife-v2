<?php

namespace App\Filament\Resources\BibleSchoolEvents;

use App\Filament\Resources\BibleSchoolEvents\Pages\CreateBibleSchoolEvent;
use App\Filament\Resources\BibleSchoolEvents\Pages\EditBibleSchoolEvent;
use App\Filament\Resources\BibleSchoolEvents\Pages\ListBibleSchoolEvents;
use App\Filament\Resources\BibleSchoolEvents\Schemas\BibleSchoolEventForm;
use App\Filament\Resources\BibleSchoolEvents\Tables\BibleSchoolEventsTable;
use App\Models\BibleSchoolEvent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BibleSchoolEventResource extends Resource
{
    protected static ?string $model = BibleSchoolEvent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    public static function getNavigationGroup(): ?string { return 'Bible School'; }
    public static function getNavigationLabel(): string  { return 'Events'; }
    public static function getNavigationSort(): ?int     { return 6; }

    public static function getNavigationBadge(): ?string
    {
        return (string) BibleSchoolEvent::whereIn('status', ['upcoming', 'ongoing'])->count() ?: null;
    }

    public static function form(Schema $schema): Schema
    {
        return BibleSchoolEventForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BibleSchoolEventsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListBibleSchoolEvents::route('/'),
            'create' => CreateBibleSchoolEvent::route('/create'),
            'edit'   => EditBibleSchoolEvent::route('/{record}/edit'),
        ];
    }
}
