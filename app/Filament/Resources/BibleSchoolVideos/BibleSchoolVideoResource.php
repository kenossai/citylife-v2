<?php

namespace App\Filament\Resources\BibleSchoolVideos;

use App\Filament\Resources\BibleSchoolSessions\Schemas\BibleSchoolSessionForm;
use App\Filament\Resources\BibleSchoolSessions\Tables\BibleSchoolSessionsTable;
use App\Filament\Resources\BibleSchoolVideos\Pages\CreateBibleSchoolVideo;
use App\Filament\Resources\BibleSchoolVideos\Pages\EditBibleSchoolVideo;
use App\Filament\Resources\BibleSchoolVideos\Pages\ListBibleSchoolVideos;
use App\Models\BibleSchoolSession;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BibleSchoolVideoResource extends Resource
{
    protected static ?string $model = BibleSchoolSession::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedVideoCamera;

    public static function getNavigationGroup(): ?string { return 'Bible School'; }
    public static function getNavigationLabel(): string  { return 'Videos'; }
    public static function getNavigationSort(): ?int     { return 1; }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getEloquentQuery()->count() ?: null;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'video');
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
            'index'  => ListBibleSchoolVideos::route('/'),
            'create' => CreateBibleSchoolVideo::route('/create'),
            'edit'   => EditBibleSchoolVideo::route('/{record}/edit'),
        ];
    }
}
