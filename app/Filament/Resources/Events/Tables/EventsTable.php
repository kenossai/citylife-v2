<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('#')->sortable()->width('60px'),
                ImageColumn::make('image_path')->label('Image')->disk('public')->height(50)->width(80)->defaultImageUrl(asset('images/slide-1.png')),
                TextColumn::make('title')->searchable()->sortable()->limit(50),
                TextColumn::make('event_at')->label('Date')->dateTime('M j, Y g:i A')->sortable(),
                TextColumn::make('location')->limit(30)->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('category')->badge()->sortable(),
                TextColumn::make('badge')->label('Badge')->limit(25)->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_featured')->label('Featured')->boolean(),
                IconColumn::make('requires_registration')->label('Reg.')->boolean(),
                IconColumn::make('is_active')->label('Active')->boolean(),
            ])
            ->filters([])
            ->defaultSort('event_at')
            ->reorderable('sort_order')
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
