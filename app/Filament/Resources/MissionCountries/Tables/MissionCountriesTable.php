<?php

namespace App\Filament\Resources\MissionCountries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MissionCountriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('#')->sortable()->width('60px'),
                TextColumn::make('flag')->label('Flag'),
                TextColumn::make('name')->label('Country')->searchable(),
                TextColumn::make('region')->label('Region')->limit(50),
                TextColumn::make('type')->label('Type')->badge()
                    ->color(fn (string $state) => match ($state) {
                        'home'   => 'success',
                        'abroad' => 'info',
                        default  => 'gray',
                    }),
                IconColumn::make('is_active')->label('Active')->boolean(),
            ])
            ->filters([])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
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
