<?php

namespace App\Filament\Pages\Instructor;

use App\Mail\CourseLessonRescheduledMail;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\CourseLesson;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;

class TeachLessonPage extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'instructor/teach';

    protected string $view = 'filament.pages.instructor.teach-lesson';

    public ?Course $course = null;

    public ?CourseLesson $lesson = null;

    /** @var Collection<int, CourseLesson> */
    public Collection $lessons;

    public ?CourseLesson $prevLesson = null;

    public ?CourseLesson $nextLesson = null;

    public int $lessonPosition = 1;

    public int $totalLessons = 0;

    public int $minRead = 1;

    public function mount(): void
    {
        $courseId = (int) request()->query('course', 0);
        $lessonId = (int) request()->query('lesson', 0);

        abort_if(! $courseId, 404);

        $this->course = Course::findOrFail($courseId);

        $this->lessons = $this->course->lessons()
            ->where('is_published', true)
            ->orderBy('lesson_number')
            ->get();

        $this->totalLessons = $this->lessons->count();

        $this->lesson = $lessonId
            ? ($this->lessons->firstWhere('id', $lessonId) ?? $this->lessons->first())
            : $this->lessons->first();

        if ($this->lesson) {
            $index = $this->lessons->search(fn ($l) => $l->id === $this->lesson->id);
            $this->lessonPosition = $index !== false ? $index + 1 : 1;
            $this->prevLesson     = $index > 0 ? $this->lessons->get($index - 1) : null;
            $this->nextLesson     = $index < $this->totalLessons - 1 ? $this->lessons->get($index + 1) : null;
            $this->minRead        = max(1, (int) ceil(Str::wordCount(strip_tags($this->lesson->content ?? '')) / 200));
        }
    }

    public function getTitle(): string | \Illuminate\Contracts\Support\Htmlable
    {
        return $this->lesson?->title ?? 'Lesson Viewer';
    }

    protected function getHeaderActions(): array
    {
        if (! $this->lesson) {
            return [];
        }

        return [
            Action::make('reschedule')
                ->label('Reschedule Class')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->modalHeading('Reschedule Class')
                ->modalDescription('Update the scheduled date for this lesson. Enrolled students will be notified by email.')
                ->modalSubmitActionLabel('Save & Notify Students')
                ->form([
                    DatePicker::make('available_date')
                        ->label('New Date')
                        ->required()
                        ->native(false)
                        ->default(fn () => $this->lesson?->available_date),
                    Textarea::make('reschedule_reason')
                        ->label('Reason (shown to students)')
                        ->placeholder('e.g. The instructor is unavailable this week.')
                        ->rows(3)
                        ->default(fn () => $this->lesson?->reschedule_reason),
                ])
                ->action(function (array $data): void {
                    $this->lesson->update([
                        'available_date'    => $data['available_date'],
                        'reschedule_reason' => $data['reschedule_reason'] ?? null,
                    ]);

                    $this->lesson->refresh();

                    $enrollments = CourseEnrollment::where('course_id', $this->lesson->course_id)
                        ->whereIn('status', ['active', 'completed'])
                        ->with('member')
                        ->get();

                    $notified = 0;
                    foreach ($enrollments as $enrollment) {
                        $email = $enrollment->member?->email ?? $enrollment->guest_email;
                        $name  = $enrollment->member?->first_name ?? $enrollment->guest_name ?? 'Student';

                        if ($email) {
                            Mail::to($email)->queue(new CourseLessonRescheduledMail($this->lesson, $name));
                            $notified++;
                        }
                    }

                    Notification::make()
                        ->title('Class rescheduled')
                        ->body($notified > 0 ? "{$notified} student(s) notified by email." : 'No enrolled students to notify.')
                        ->success()
                        ->send();
                }),
        ];
    }

    /** @return Collection<string, Collection<int, CourseLesson>> */
    #[Computed]
    public function grouped(): Collection
    {
        return $this->lessons->groupBy(fn (CourseLesson $l) => $l->week_group ?: 'Lessons');
    }

    public function getBreadcrumbs(): array
    {
        $breadcrumbs = [];

        if ($this->course) {
            $breadcrumbs[\App\Filament\Resources\Instructor\InstructorCourseResource::getUrl()] = 'Teach a Course';
            $breadcrumbs['#'] = $this->course->title;
        }

        return $breadcrumbs;
    }
}
