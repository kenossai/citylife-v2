<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\LessonProgress;
use Illuminate\Support\Facades\Auth;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $member = Auth::guard('member')->user();

        $enrollments = $member->enrollments()
            ->with([
                'course:id,title,slug,category,image_path,leader_id',
                'course.leader:id,name',
                'course.lessons:id,course_id,slug,title,lesson_number,is_published',
                'progress:id,enrollment_id,lesson_id,completed_at,quiz_score',
            ])
            ->whereIn('status', ['active', 'completed'])
            ->get();

        // ── Stats ────────────────────────────────────────────────────────────
        $enrolledCount = $enrollments->count();

        $totalLessonsRead  = $enrollments->sum('lessons_done_count');
        $totalLessons      = $enrollments->sum('total_lessons');

        $enrollmentIds = $enrollments->pluck('id');
        $avgQuizScore  = LessonProgress::whereIn('enrollment_id', $enrollmentIds)
            ->whereNotNull('quiz_score')
            ->avg('quiz_score');

        $certificatesEarned = $enrollments->where('certificate_issued', true)->count();

        // ── Continue Learning (active, < 100%) ───────────────────────────────
        $activeCourses = $enrollments
            ->where('status', 'active')
            ->map(function ($enrollment) {
                $completedLessonIds = $enrollment->progress
                    ->whereNotNull('completed_at')
                    ->pluck('lesson_id')
                    ->toArray();

                $nextLesson = $enrollment->course->lessons
                    ->where('is_published', true)
                    ->sortBy('lesson_number')
                    ->first(fn($lesson) => ! in_array($lesson->id, $completedLessonIds));

                $enrollment->next_lesson       = $nextLesson;
                $enrollment->quiz_completed    = $enrollment->progress->whereNotNull('quiz_score')->count();

                return $enrollment;
            });

        // ── Explore courses not yet enrolled ─────────────────────────────────
        $enrolledCourseIds = $enrollments->pluck('course_id');
        $exploreCourses = Course::where('is_active', true)
            ->where('is_registration_open', true)
            ->whereNotIn('id', $enrolledCourseIds)
            ->with('leader:id,name')
            ->latest()
            ->take(6)
            ->get();

        // ── Quiz history ──────────────────────────────────────────────────────
        $quizHistory = LessonProgress::with([
                'enrollment.course:id,title,slug',
                'lesson:id,title',
            ])
            ->whereIn('enrollment_id', $enrollmentIds)
            ->whereNotNull('quiz_score')
            ->latest()
            ->take(20)
            ->get();

        return view('member.dashboard', compact(
            'member',
            'enrolledCount',
            'totalLessonsRead',
            'totalLessons',
            'avgQuizScore',
            'certificatesEarned',
            'activeCourses',
            'exploreCourses',
            'quizHistory',
        ));
    }

    public function courses()
    {
        $member = Auth::guard('member')->user();

        $enrollments = $member->enrollments()
            ->with([
                'course:id,title,slug,category,image_path,leader_id',
                'course.leader:id,name',
                'course.lessons:id,course_id,slug,is_published,lesson_number',
                'progress:id,enrollment_id,lesson_id,completed_at,quiz_score',
            ])
            ->orderByDesc('enrolled_at')
            ->get();

        return view('member.courses', compact('member', 'enrollments'));
    }
}
