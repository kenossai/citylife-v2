<?php

namespace App\Filament\Resources\MissionPillars\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MissionPillarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('#')->sortable()->width('60px'),
                TextColumn::make('title')->label('Title')->limit(50)->searchable(),
                TextColumn::make('type')->label('Type')->badge()
                    ->color(fn (string $state) => match ($state) {
                        'home'   => 'success',
                        'abroad' => 'info',
                        default  => 'gray',
                    }),
                TextColumn::make('description')->label('Description')->limit(60),
                ImageColumn::make('image_path')->label('Image')->disk('public')->height(60),
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
