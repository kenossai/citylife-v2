<?php

namespace App\Filament\Resources\CourseEnrollments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CourseEnrollmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('member.first_name')
                    ->label('Member')
                    ->formatStateUsing(fn ($state, $record) => "{$record->member->first_name} {$record->member->last_name}")
                    ->searchable(['members.first_name', 'members.last_name'])
                    ->sortable(),

                TextColumn::make('course.title')
                    ->label('Course')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active'    => 'success',
                        'completed' => 'info',
                        'cancelled' => 'danger',
                        'suspended' => 'warning',
                        default     => 'gray',
                    }),

                TextColumn::make('attendance_count')
                    ->label('Attendance')
                    ->sortable(),

                IconColumn::make('certificate_issued')
                    ->label('Certificate')
                    ->boolean(),

                TextColumn::make('enrolled_at')
                    ->label('Enrolled')
                    ->dateTime('M j, Y')
                    ->sortable(),
            ])
            ->filters([])
            ->defaultSort('enrolled_at', 'desc')
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
