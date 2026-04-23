<?php

namespace App\Filament\Resources\CourseLessons\Tables;

use App\Mail\CourseLessonRescheduledMail;
use App\Models\CourseLesson;
use App\Models\CourseEnrollment;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class CourseLessonsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lesson_number')->label('#')->sortable()->width('60px'),
                TextColumn::make('title')->searchable()->sortable()->limit(50),
                TextColumn::make('course.title')->label('Course')->searchable()->sortable()->limit(40),
                TextColumn::make('available_date')
                    ->label('Scheduled')
                    ->date('M j, Y')
                    ->sortable()
                    ->description(fn (CourseLesson $record) => $record->reschedule_reason
                        ? 'Rescheduled: ' . mb_strimwidth($record->reschedule_reason, 0, 60, '…')
                        : null
                    ),
                IconColumn::make('is_rescheduled')
                    ->label('')
                    ->getStateUsing(fn (CourseLesson $record) => (bool) $record->reschedule_reason)
                    ->boolean()
                    ->trueIcon('heroicon-m-arrow-path')
                    ->falseIcon(null)
                    ->trueColor('warning')
                    ->tooltip('This lesson has been rescheduled')
                    ->width('40px'),
                IconColumn::make('is_published')->label('Published')->boolean(),
            ])
            ->filters([])
            ->defaultSort('course_id')
            ->recordActions([
                Action::make('reschedule')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->iconButton()
                    ->tooltip('Reschedule class')
                    ->modalHeading('Reschedule Class')
                    ->modalDescription('Update the date for this lesson and optionally notify enrolled students.')
                    ->modalSubmitActionLabel('Save & Notify Students')
                    ->form([
                        DatePicker::make('available_date')
                            ->label('New Date')
                            ->required()
                            ->native(false)
                            ->default(fn (CourseLesson $record) => $record->available_date),
                        Textarea::make('reschedule_reason')
                            ->label('Reason (shown to students)')
                            ->placeholder('e.g. The instructor is unavailable this week.')
                            ->rows(3)
                            ->default(fn (CourseLesson $record) => $record->reschedule_reason),
                    ])
                    ->action(function (CourseLesson $record, array $data): void {
                        $record->update([
                            'available_date'    => $data['available_date'],
                            'reschedule_reason' => $data['reschedule_reason'] ?? null,
                        ]);

                        // Notify all active enrolled members
                        $record->loadMissing('course');
                        $enrollments = CourseEnrollment::where('course_id', $record->course_id)
                            ->whereIn('status', ['active', 'completed'])
                            ->with('member')
                            ->get();

                        $notified = 0;
                        foreach ($enrollments as $enrollment) {
                            $email = $enrollment->member?->email ?? $enrollment->guest_email;
                            $name  = $enrollment->member?->first_name ?? $enrollment->guest_name ?? 'Student';

                            if ($email) {
                                Mail::to($email)->queue(new CourseLessonRescheduledMail($record, $name));
                                $notified++;
                            }
                        }

                        Notification::make()
                            ->title('Class rescheduled')
                            ->body($notified > 0 ? "{$notified} student(s) notified by email." : 'No enrolled students to notify.')
                            ->success()
                            ->send();
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

