<?php

namespace App\Filament\Resources\BibleSchoolAudios;

use App\Filament\Resources\BibleSchoolAudios\Pages\ListBibleSchoolAudios;
use App\Filament\Resources\BibleSchoolSessions\Pages\CreateBibleSchoolSession;
use App\Filament\Resources\BibleSchoolSessions\Pages\EditBibleSchoolSession;
use App\Filament\Resources\BibleSchoolSessions\Schemas\BibleSchoolSessionForm;
use App\Filament\Resources\BibleSchoolSessions\Tables\BibleSchoolSessionsTable;
use App\Models\BibleSchoolSession;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BibleSchoolAudioResource extends Resource
{
    protected static ?string $model = BibleSchoolSession::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMusicalNote;

    public static function getNavigationGroup(): ?string { return 'Bible School'; }
    public static function getNavigationLabel(): string  { return 'Audios'; }
    public static function getNavigationSort(): ?int     { return 2; }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getEloquentQuery()->count() ?: null;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'audio');
    }

    public static function form(Schema $schema): Schema
    {
        return BibleSchoolSessionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BibleSchoolSessionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListBibleSchoolAudios::route('/'),
            'create' => CreateBibleSchoolSession::route('/create'),
            'edit'   => EditBibleSchoolSession::route('/{record}/edit'),
        ];
    }
}
