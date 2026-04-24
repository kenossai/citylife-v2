<?php

namespace App\Filament\Resources\LessonAttendances\Schemas;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\CourseLesson;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LessonAttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()->schema([
                Grid::make(2)->schema([
                    Select::make('course_id')
                        ->label('Course')
                        ->options(Course::active()->pluck('title', 'id'))
                        ->searchable()
                        ->required()
                        ->live()
                        ->afterStateUpdated(fn (callable $set) => $set('enrollment_id', null) + $set('lesson_id', null))
                        ->dehydrated(false),

                    Select::make('lesson_id')
                        ->label('Lesson')
                        ->options(fn ($get) => $get('course_id')
                            ? CourseLesson::where('course_id', $get('course_id'))
                                ->orderBy('lesson_number')
                                ->pluck('title', 'id')
                            : [])
                        ->searchable()
                        ->required(),
                ]),

                Select::make('enrollment_ids')
                    ->label('Students')
                    ->options(fn ($get) => $get('course_id')
                        ? CourseEnrollment::with('member')
                            ->where('course_id', $get('course_id'))
                            ->whereIn('status', ['active', 'completed'])
                            ->get()
                            ->mapWithKeys(fn ($e) => [
                                $e->id => $e->member
                                    ? "{$e->member->first_name} {$e->member->last_name} ({$e->member->membership_number})"
                                    : "Enrollment #{$e->id}",
                            ])
                        : [])
                    ->searchable()
                    ->multiple()
                    ->required()
                    ->dehydrated(false),

                Grid::make(2)->schema([
                    DateTimePicker::make('attended_at')
                        ->label('Attended At')
                        ->default(now())
                        ->required(),

                    Toggle::make('present')
                        ->label('Present')
                        ->default(true),
                ]),
            ]),
        ]);
    }
}
