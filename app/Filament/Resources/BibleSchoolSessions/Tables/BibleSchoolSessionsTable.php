<?php

namespace App\Filament\Resources\BibleSchoolSessions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BibleSchoolSessionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('speaker.name')
                    ->label('Speaker')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                TextColumn::make('title')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'video' => 'primary',
                        'audio' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('year')
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('duration')
                    ->label('Duration')
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_locked')
                    ->label('Locked')
                    ->boolean()
                    ->trueColor('warning')
                    ->falseColor('success'),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->defaultSort('year', 'desc')
            ->filters([
                SelectFilter::make('type')
                    ->options(['video' => 'Video', 'audio' => 'Audio']),

                SelectFilter::make('speaker_id')
                    ->label('Speaker')
                    ->relationship('speaker', 'name')
                    ->searchable()
                    ->preload(),
            ])
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
