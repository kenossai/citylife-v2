<?php

namespace App\Filament\Resources\SessionAccessCodes;

use App\Filament\Resources\SessionAccessCodes\Pages\ListSessionAccessCodes;
use App\Models\SessionAccessCode;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SessionAccessCodeResource extends Resource
{
    protected static ?string $model = SessionAccessCode::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedKey;

    public static function getNavigationGroup(): ?string { return 'Bible School'; }
    public static function getNavigationLabel(): string  { return 'Access Requests'; }
    public static function getNavigationSort(): ?int     { return 4; }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')->searchable()->copyable()->limit(40),
                TextColumn::make('speaker_slug')->label('Speaker')->searchable()->limit(35),
                TextColumn::make('year')->label('Year')->sortable()->placeholder('—'),
                TextColumn::make('code')->label('Code')->fontFamily('mono'),
                IconColumn::make('verified')->boolean()->trueColor('success')->falseColor('gray'),
                TextColumn::make('expires_at')->label('Expires')->dateTime()->sortable(),
                TextColumn::make('last_used_at')->label('Last Used')->since()->placeholder('Never')->sortable(),
                TextColumn::make('created_at')->label('Requested')->since()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('verified')
                    ->options(['1' => 'Verified', '0' => 'Pending']),
                SelectFilter::make('year')
                    ->options(fn () => SessionAccessCode::query()->distinct()->orderByDesc('year')->pluck('year', 'year')->filter()->toArray()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSessionAccessCodes::route('/'),
        ];
    }
}
