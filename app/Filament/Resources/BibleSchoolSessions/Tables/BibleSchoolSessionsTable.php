<?php

namespace App\Filament\Resources\BibleSchoolSessions\Tables;

use App\Models\BibleSchoolEvent;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
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
                TextColumn::make('event.title')
                    ->label('Event')
                    ->searchable()
                    ->sortable()
                    ->limit(35),

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
                    ->trueIcon(Heroicon::OutlinedLockClosed)
                    ->falseIcon(Heroicon::OutlinedLockOpen)
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
                SelectFilter::make('bible_school_event_id')
                    ->label('Event')
                    ->options(fn () => BibleSchoolEvent::orderByDesc('year')->pluck('title', 'id')),
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
