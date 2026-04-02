<?php

namespace App\Filament\Resources\LessonAttendances\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LessonAttendancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('enrollment.member.first_name')
                    ->label('Student')
                    ->formatStateUsing(fn ($state, $record) => $record->enrollment?->member
                        ? "{$record->enrollment->member->first_name} {$record->enrollment->member->last_name}"
                        : '—')
                    ->searchable(query: fn ($query, string $search) => $query->whereHas(
                        'enrollment.member',
                        fn ($q) => $q->where('first_name', 'like', "%{$search}%")
                                     ->orWhere('last_name', 'like', "%{$search}%")
                    ))
                    ->sortable(),

                TextColumn::make('enrollment.course.title')
                    ->label('Course')
                    ->searchable()
                    ->sortable()
                    ->limit(35),

                TextColumn::make('lesson.title')
                    ->label('Lesson')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                IconColumn::make('present')
                    ->label('Present')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('attended_at')
                    ->label('Date')
                    ->dateTime('M j, Y')
                    ->sortable(),
            ])
            ->filters([])
            ->defaultSort('attended_at', 'desc')
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
