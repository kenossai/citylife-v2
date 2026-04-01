<?php

namespace App\Filament\Resources\Courses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CoursesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable()->limit(50),
                TextColumn::make('category')->searchable()->sortable(),
                TextColumn::make('instructor_name')
                    ->label('Instructor')
                    ->getStateUsing(fn ($record) => $record->instructor_name)
                    ->searchable(query: function ($query, string $search): void {
                        $query->where(function ($q) use ($search) {
                            $q->where('guest_instructor_name', 'like', "%{$search}%")
                              ->orWhereHas('leader', fn ($q) => $q->where('name', 'like', "%{$search}%"));
                        });
                    }),
                TextColumn::make('start_date')->label('Starts')->date('M j, Y')->sortable(),
                TextColumn::make('end_date')->label('Ends')->date('M j, Y')->sortable(),
                IconColumn::make('is_registration_open')->label('Registration')->boolean(),
                IconColumn::make('is_active')->label('Active')->boolean(),
            ])
            ->filters([])
            ->defaultSort('start_date', 'desc')
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
