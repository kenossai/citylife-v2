<?php

namespace App\Filament\Resources\Books\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class BooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Cover')
                    ->disk('public')
                    ->square()
                    ->size(48),
                TextColumn::make('title')->searchable()->sortable()->limit(50),
                TextColumn::make('author')->searchable()->sortable(),
                TextColumn::make('slug')->limit(40)->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_published')->label('Published')->boolean(),
                TextColumn::make('created_at')->label('Added')->date('M j, Y')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_published')->label('Published'),
            ])
            ->defaultSort('title')
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
