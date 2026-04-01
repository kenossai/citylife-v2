<?php

namespace App\Filament\Resources\CourseLessons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CourseLessonsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lesson_number')->label('#')->sortable()->width('60px'),
                TextColumn::make('title')->searchable()->sortable()->limit(50),
                TextColumn::make('course.title')->label('Course')->searchable()->sortable()->limit(40),
                TextColumn::make('available_date')->label('Available')->date('M j, Y')->sortable(),
                IconColumn::make('is_published')->label('Published')->boolean(),
            ])
            ->filters([])
            ->defaultSort('course_id')
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
