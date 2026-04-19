<?php

namespace App\Filament\Pages\Instructor;

use App\Models\Course;
use App\Models\CourseLesson;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;
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
