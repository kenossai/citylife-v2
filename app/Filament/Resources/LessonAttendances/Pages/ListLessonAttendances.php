<?php

namespace App\Filament\Resources\LessonAttendances\Pages;

use App\Filament\Resources\LessonAttendances\LessonAttendanceResource;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\CourseLesson;
use App\Models\LessonAttendance;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListLessonAttendances extends ListRecords
{
    protected static string $resource = LessonAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Mark Attendance'),

            Action::make('bulk_attendance')
                ->label('Bulk Attendance by Lesson')
                ->icon('heroicon-o-user-group')
                ->color('info')
                ->form([
                    Select::make('course_id')
                        ->label('Course')
                        ->options(Course::active()->pluck('title', 'id'))
                        ->searchable()
                        ->required()
                        ->live()
                        ->afterStateUpdated(fn (callable $set) => $set('lesson_id', null)),

                    Select::make('lesson_id')
                        ->label('Lesson')
                        ->options(fn ($get) => $get('course_id')
                            ? CourseLesson::where('course_id', $get('course_id'))
                                ->orderBy('lesson_number')
                                ->get()
                                ->mapWithKeys(fn ($l) => [$l->id => "#{$l->lesson_number} — {$l->title}"])
                            : [])
                        ->searchable()
                        ->required(),

                    DateTimePicker::make('attended_at')
                        ->label('Session Date & Time')
                        ->default(now())
                        ->required(),
                ])
                ->action(function (array $data): void {
                    $enrollments = CourseEnrollment::with('member')
                        ->where('course_id', $data['course_id'])
                        ->whereIn('status', ['active', 'completed'])
                        ->get();

                    foreach ($enrollments as $enrollment) {
                        // Skip if already marked for this lesson + date
                        $alreadyMarked = LessonAttendance::where('enrollment_id', $enrollment->id)
                            ->where('lesson_id', $data['lesson_id'])
                            ->whereDate('attended_at', now()->parse($data['attended_at'])->toDateString())
                            ->exists();

                        if (! $alreadyMarked) {
                            LessonAttendance::create([
                                'enrollment_id' => $enrollment->id,
                                'lesson_id'     => $data['lesson_id'],
                                'attended_at'   => $data['attended_at'],
                                'present'       => true,
                            ]);
                        }
                    }
                })
                ->successNotificationTitle('Attendance marked for all enrolled students'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Attendance')
                ->badge(LessonAttendance::count()),

            'present' => Tab::make('Present')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('present', true))
                ->badge(LessonAttendance::where('present', true)->count())
                ->badgeColor('success'),

            'absent' => Tab::make('Absent')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('present', false))
                ->badge(LessonAttendance::where('present', false)->count())
                ->badgeColor('danger'),

            'today' => Tab::make('Today')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereDate('attended_at', today()))
                ->badge(LessonAttendance::whereDate('attended_at', today())->count())
                ->badgeColor('info'),
        ];
    }
}
