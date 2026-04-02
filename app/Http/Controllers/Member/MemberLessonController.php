<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseLesson;
use App\Models\LessonProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberLessonController extends Controller
{
    /**
     * Load all data shared by lesson, notes, and quiz pages.
     */
    private function lessonContext(string $courseSlug, string $lessonSlug): array
    {
        $member = Auth::guard('member')->user();

        $course = Course::where('slug', $courseSlug)
            ->where('is_active', true)
            ->firstOrFail();

        $enrollment = $member->enrollments()
            ->where('course_id', $course->id)
            ->whereIn('status', ['active', 'completed'])
            ->with(['progress:id,enrollment_id,lesson_id,completed_at,quiz_score,notes'])
            ->firstOrFail();

        $lesson = $course->lessons()
            ->where('slug', $lessonSlug)
            ->where('is_published', true)
            ->firstOrFail();

        $allLessons = $course->lessons()
            ->where('is_published', true)
            ->orderBy('lesson_number')
            ->get();

        $grouped     = $allLessons->groupBy(fn($l) => $l->week_group ?: 'Lessons');
        $progressMap = $enrollment->progress->keyBy('lesson_id');
        $progress    = $progressMap->get($lesson->id);

        $lessonIndex    = $allLessons->search(fn($l) => $l->id === $lesson->id);
        $lessonPosition = $lessonIndex !== false ? $lessonIndex + 1 : null;
        $totalLessons   = $allLessons->count();
        $prevLesson     = $lessonIndex > 0 ? $allLessons->get($lessonIndex - 1) : null;
        $nextLesson     = $lessonIndex < $totalLessons - 1 ? $allLessons->get($lessonIndex + 1) : null;

        $completedCount  = $progressMap->whereNotNull('completed_at')->count();
        $progressPercent = $totalLessons > 0 ? round(($completedCount / $totalLessons) * 100) : 0;
        $quizScore       = $progress?->quiz_score;

        return compact(
            'member', 'course', 'enrollment', 'lesson',
            'grouped', 'progressMap', 'progress',
            'lessonPosition', 'totalLessons',
            'prevLesson', 'nextLesson',
            'completedCount', 'progressPercent', 'quizScore',
        );
    }

    /**
     * Display the lesson viewer.
     */
    public function show(string $courseSlug, string $lessonSlug)
    {
        return view('member.lesson', $this->lessonContext($courseSlug, $lessonSlug));
    }

    /**
     * Display the notes page for a lesson.
     */
    public function notesPage(string $courseSlug, string $lessonSlug)
    {
        return view('member.notes', $this->lessonContext($courseSlug, $lessonSlug));
    }

    /**
     * Mark the lesson as read (completed).
     */
    public function markRead(Request $request, string $courseSlug, string $lessonSlug)
    {
        $member = Auth::guard('member')->user();

        $course = Course::where('slug', $courseSlug)->where('is_active', true)->firstOrFail();

        $enrollment = $member->enrollments()
            ->where('course_id', $course->id)
            ->whereIn('status', ['active', 'completed'])
            ->firstOrFail();

        $lesson = $course->lessons()
            ->where('slug', $lessonSlug)
            ->where('is_published', true)
            ->firstOrFail();

        LessonProgress::updateOrCreate(
            ['enrollment_id' => $enrollment->id, 'lesson_id' => $lesson->id],
            ['completed_at'  => now()]
        );

        // Redirect to next lesson if one exists, otherwise back to dashboard
        if ($request->has('next') && $request->input('next')) {
            $nextLesson = $course->lessons()
                ->where('slug', $request->input('next'))
                ->where('is_published', true)
                ->first();

            if ($nextLesson) {
                return redirect()->route('member.lesson.show', [
                    'courseSlug' => $courseSlug,
                    'lessonSlug' => $nextLesson->slug,
                ]);
            }
        }

        return redirect()->route('member.lesson.show', [
            'courseSlug' => $courseSlug,
            'lessonSlug' => $lessonSlug,
        ])->with('status', 'Lesson marked as read!');
    }

    /**
     * Save the member's notes for this lesson.
     */
    public function saveNotes(Request $request, string $courseSlug, string $lessonSlug)
    {
        $validated = $request->validate([
            'notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $member = Auth::guard('member')->user();

        $course = Course::where('slug', $courseSlug)->where('is_active', true)->firstOrFail();

        $enrollment = $member->enrollments()
            ->where('course_id', $course->id)
            ->whereIn('status', ['active', 'completed'])
            ->firstOrFail();

        $lesson = $course->lessons()
            ->where('slug', $lessonSlug)
            ->where('is_published', true)
            ->firstOrFail();

        LessonProgress::updateOrCreate(
            ['enrollment_id' => $enrollment->id, 'lesson_id' => $lesson->id],
            ['notes' => $validated['notes']]
        );

        return back()->with('status', 'Notes saved!');
    }

    /**
     * Display the dedicated full-page quiz for a lesson.
     */
    public function quizPage(string $courseSlug, string $lessonSlug)
    {
        $member = Auth::guard('member')->user();

        $course = Course::where('slug', $courseSlug)
            ->where('is_active', true)
            ->firstOrFail();

        $enrollment = $member->enrollments()
            ->where('course_id', $course->id)
            ->whereIn('status', ['active', 'completed'])
            ->firstOrFail();

        $lesson = $course->lessons()
            ->where('slug', $lessonSlug)
            ->where('is_published', true)
            ->firstOrFail();

        abort_if(empty($lesson->quiz_questions), 404);

        $progress = LessonProgress::where('enrollment_id', $enrollment->id)
            ->where('lesson_id', $lesson->id)
            ->first();

        $quizScore = $progress?->quiz_score;

        return view('member.quiz', compact('course', 'lesson', 'quizScore'));
    }

    /**
     * Submit quiz answers and record the score.
     */
    public function submitQuiz(Request $request, string $courseSlug, string $lessonSlug)
    {
        $member = Auth::guard('member')->user();

        $course = Course::where('slug', $courseSlug)->where('is_active', true)->firstOrFail();

        $enrollment = $member->enrollments()
            ->where('course_id', $course->id)
            ->whereIn('status', ['active', 'completed'])
            ->firstOrFail();

        $lesson = $course->lessons()
            ->where('slug', $lessonSlug)
            ->where('is_published', true)
            ->firstOrFail();

        $questions = $lesson->quiz_questions ?? [];

        if (empty($questions)) {
            return back()->with('status', 'No quiz available for this lesson.');
        }

        $answers  = $request->input('answers', []);
        $correct  = 0;

        foreach ($questions as $index => $question) {
            $submitted = isset($answers[$index]) ? (int) $answers[$index] : -1;
            if ($submitted === (int) ($question['answer'] ?? -99)) {
                $correct++;
            }
        }

        $score = (int) round(($correct / count($questions)) * 100);

        LessonProgress::updateOrCreate(
            ['enrollment_id' => $enrollment->id, 'lesson_id' => $lesson->id],
            ['quiz_score' => $score]
        );

        return redirect()->route('member.lesson.show', [
            'courseSlug' => $courseSlug,
            'lessonSlug' => $lessonSlug,
        ])->with('quiz_score', $score)->with('quiz_correct', $correct)->with('quiz_total', count($questions));
    }
}
