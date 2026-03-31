<?php

namespace App\Filament\Resources\WorshipCentres\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WorshipCentresTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('#')->sortable()->width('50px'),
                TextColumn::make('label')->sortable(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('address')->searchable()->limit(40),
                TextColumn::make('times')->limit(30),
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
