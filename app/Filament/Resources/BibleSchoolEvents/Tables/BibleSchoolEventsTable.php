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
                    ->size(48)
                    ->defaultImageUrl(asset('images/slide-1.png')),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(45),

                TextColumn::make('speakers.name')
                    ->label('Speakers')
                    ->badge()
                    ->color('primary')
                    ->limitList(3)
                    ->separator(','),

                TextColumn::make('start_date')
                    ->label('Start')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('End')
                    ->date('d M Y')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('year')
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                TextColumn::make('location')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'upcoming' => 'info',
                        'ongoing'  => 'success',
                        'past'     => 'gray',
                        default    => 'gray',
                    })
                    ->formatStateUsing(fn (string $state) => ucfirst($state)),
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
