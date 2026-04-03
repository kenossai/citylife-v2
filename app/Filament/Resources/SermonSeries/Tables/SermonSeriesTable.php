<?php

namespace App\Filament\Resources\SermonSeries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SermonSeriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('#')->sortable()->width('60px'),
                ColorColumn::make('color')->label('Colour')->width('60px'),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('sermons_count')
                    ->label('Sermons')
                    ->counts('sermons')
                    ->sortable(),
                IconColumn::make('is_active')->label('Active')->boolean(),
            ])
            ->filters([])
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
