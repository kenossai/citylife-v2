<?php

namespace App\Filament\Resources\BibleSchoolVideos;

use App\Filament\Resources\BibleSchoolSessions\Pages\CreateBibleSchoolSession;
use App\Filament\Resources\BibleSchoolSessions\Pages\EditBibleSchoolSession;
use App\Filament\Resources\BibleSchoolSessions\Schemas\BibleSchoolSessionForm;
use App\Filament\Resources\BibleSchoolVideos\Pages\ListBibleSchoolVideos;
use App\Models\BibleSchoolSession;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
        return $table
            ->columns([
                TextColumn::make('speaker.name')->label('Speaker')->searchable()->sortable()->limit(30),
                TextColumn::make('title')->searchable()->limit(55),
                TextColumn::make('year')->sortable()->badge()->color('gray'),
                TextColumn::make('duration')->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_locked')->label('Locked')->boolean()->trueColor('warning')->falseColor('success'),
                IconColumn::make('is_active')->label('Active')->boolean(),
            ])
            ->defaultSort('year', 'desc')
            ->filters([
                SelectFilter::make('speaker_id')
                    ->label('Speaker')
                    ->relationship('speaker', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListBibleSchoolVideos::route('/'),
            'create' => CreateBibleSchoolSession::route('/create'),
            'edit'   => EditBibleSchoolSession::route('/{record}/edit'),
        ];
    }
}
