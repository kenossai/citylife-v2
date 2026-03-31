<?php

namespace App\Filament\Resources\CoreValues\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CoreValuesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('#')->sortable()->width('50px'),
                TextColumn::make('tag')->searchable()->sortable(),
                TextColumn::make('heading')->searchable()->sortable()->limit(50),
                TextColumn::make('scripture')->limit(30),
                IconColumn::make('is_active')->label('Active')->boolean(),
            ])
            ->filters([])
            ->defaultSort('sort_order', 'asc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
