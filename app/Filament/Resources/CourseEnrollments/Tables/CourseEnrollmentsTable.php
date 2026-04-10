<?php

namespace App\Filament\Resources\CourseEnrollments\Tables;

use App\Models\CourseLesson;
use App\Models\LessonAttendance;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
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
                    ->formatStateUsing(fn ($state, $record) => $record->member
                        ? "{$record->member->first_name} {$record->member->last_name}"
                        : '—')
                    ->searchable(['members.first_name', 'members.last_name'])
                    ->sortable(),

                TextColumn::make('course.title')
                    ->label('Course')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending'   => 'warning',
                        'active'    => 'success',
                        'completed' => 'info',
                        'cancelled' => 'danger',
                        'suspended' => 'gray',
                        default     => 'gray',
                    }),

                TextColumn::make('progress_percentage')
                    ->label('Progress')
                    ->getStateUsing(fn ($record) => $record->progress_percentage)
                    ->suffix('%')
                    ->sortable(query: fn ($query, string $direction) => $query->orderBy('attendance_count', $direction)),

                TextColumn::make('lessons_done_count')
                    ->label('Lessons Done')
                    ->getStateUsing(fn ($record) => $record->lessons_done_count),

                TextColumn::make('average_grade')
                    ->label('Grade')
                    ->getStateUsing(fn ($record) => $record->average_grade ?? '—'),

                TextColumn::make('completed_at')
                    ->label('Completed')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->placeholder('—'),

                IconColumn::make('certificate_issued')
                    ->label('Certificate')
                    ->boolean(),

                TextColumn::make('attendance_ratio')
                    ->label('Attendance')
                    ->getStateUsing(fn ($record) => $record->attendance_count . '/' . $record->total_lessons)
                    ->badge()
                    ->color(fn ($record) => $record->total_lessons > 0 && $record->attendance_count >= $record->total_lessons
                        ? 'success'
                        : 'warning'),
            ])
            ->filters([])
            ->defaultSort('enrolled_at', 'desc')
            ->recordActions([
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Approve Enrollment')
                    ->modalDescription(fn ($record) => "Approve {$record->member?->first_name} {$record->member?->last_name} for {$record->course?->title}?")
                    ->action(fn ($record) => $record->update(['status' => 'active'])),

                Action::make('mark_attendance')
                    ->label('Mark Attendance')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->color('success')
                    ->visible(fn ($record) => in_array($record->status, ['active', 'completed'])
                        && ! ($record->total_lessons > 0 && $record->attendance_count >= $record->total_lessons)
                    )
                    ->form(fn ($record) => [
                        Select::make('lesson_id')
                            ->label('Lesson')
                            ->options(
                                CourseLesson::where('course_id', $record->course_id)
                                    ->orderBy('lesson_number')
                                    ->get()
                                    ->mapWithKeys(fn ($l) => [$l->id => "#{$l->lesson_number} — {$l->title}"])
                            )
                            ->searchable()
                            ->required(),

                        DateTimePicker::make('attended_at')
                            ->label('Session Date')
                            ->default(now())
                            ->required(),
                    ])
                    ->action(function (array $data, $record): void {
                        $alreadyMarked = LessonAttendance::where('enrollment_id', $record->id)
                            ->where('lesson_id', $data['lesson_id'])
                            ->whereDate('attended_at', now()->parse($data['attended_at'])->toDateString())
                            ->exists();

                        if (! $alreadyMarked) {
                            LessonAttendance::create([
                                'enrollment_id' => $record->id,
                                'lesson_id'     => $data['lesson_id'],
                                'attended_at'   => $data['attended_at'],
                                'present'       => true,
                            ]);
                        }
                    })
                    ->successNotificationTitle('Attendance marked'),

                Action::make('recalc_progress')
                    ->label('Recalc Progress')
                    ->icon('heroicon-o-arrow-path')
                    ->color('info')
                    ->action(function ($record): void {
                        $count = LessonAttendance::where('enrollment_id', $record->id)
                            ->where('present', true)
                            ->count();
                        $record->update(['attendance_count' => $count]);
                    })
                    ->successNotificationTitle('Progress recalculated'),

                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
