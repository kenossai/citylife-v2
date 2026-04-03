<?php

namespace App\Filament\Resources\BibleSchoolSessions;

use App\Filament\Resources\BibleSchoolSessions\Pages\CreateBibleSchoolSession;
use App\Filament\Resources\BibleSchoolSessions\Pages\EditBibleSchoolSession;
use App\Filament\Resources\BibleSchoolSessions\Pages\ListBibleSchoolSessions;
use App\Filament\Resources\BibleSchoolSessions\Schemas\BibleSchoolSessionForm;
use App\Filament\Resources\BibleSchoolSessions\Tables\BibleSchoolSessionsTable;
use App\Models\BibleSchoolSession;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BibleSchoolSessionResource extends Resource
{
    protected static ?string $model = BibleSchoolSession::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    public static function getNavigationGroup(): ?string { return 'Bible School'; }
    public static function getNavigationLabel(): string  { return 'Sessions'; }
    public static function getNavigationSort(): ?int     { return 3; }

    public static function form(Schema $schema): Schema
    {
        return BibleSchoolSessionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BibleSchoolSessionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListBibleSchoolSessions::route('/'),
            'create' => CreateBibleSchoolSession::route('/create'),
            'edit'   => EditBibleSchoolSession::route('/{record}/edit'),
        ];
    }
}
