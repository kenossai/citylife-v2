<?php

namespace App\Filament\Resources\Speakers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SpeakersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('#')->sortable()->width('50px'),
                ImageColumn::make('image')
                    ->disk('public')
                    ->height(50)
                    ->width(40)
                    ->defaultImageUrl(asset('images/slide-1.png'))
                    ->circular(),
                TextColumn::make('name')->searchable()->sortable()->limit(40),
                TextColumn::make('role')->searchable()->limit(40)->toggleable(),
                TextColumn::make('church')->limit(35)->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sessions_count')
                    ->label('Sessions')
                    ->counts('sessions')
                    ->badge()
                    ->color('primary'),
                IconColumn::make('is_active')->label('Active')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
