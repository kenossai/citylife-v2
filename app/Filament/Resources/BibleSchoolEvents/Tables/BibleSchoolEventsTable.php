<?php

namespace App\Filament\Resources\BibleSchoolEvents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BibleSchoolEventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('')
                    ->square()
                    ->disk('public'),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(45),

                TextColumn::make('year')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                TextColumn::make('start_date')
                    ->label('Start')
                    ->date('d M Y')
                    ->sortable()
                    ->placeholder('—'),

                TextColumn::make('speakers_count')
                    ->label('Speakers')
                    ->badge()
                    ->color('primary')
                    ->counts('speakers'),

                TextColumn::make('videos_count')
                    ->label('Videos')
                    ->badge()
                    ->color('warning')
                    ->counts('videos'),

                TextColumn::make('audios_count')
                    ->label('Audios')
                    ->badge()
                    ->color('warning')
                    ->counts('audios'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'upcoming' => 'info',
                        'ongoing'  => 'success',
                        'past'     => 'gray',
                        default    => 'gray',
                    })
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('end_date')
                    ->label('End')
                    ->date('d M Y')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('location')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('start_date', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'upcoming' => 'Upcoming',
                        'ongoing'  => 'Ongoing',
                        'past'     => 'Past',
                    ]),
                SelectFilter::make('year')
                    ->options(fn () => \App\Models\BibleSchoolEvent::query()
                        ->selectRaw('year')
                        ->distinct()
                        ->orderByDesc('year')
                        ->pluck('year', 'year')
                        ->toArray()),
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
