<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\LessonProgress;
use App\Models\Ministry;
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
                'course.lessons:id,course_id,slug,title,lesson_number,is_published,available_date',
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

                $enrolledAt = $enrollment->enrolled_at ?? $enrollment->created_at;

                $nextLesson = $enrollment->course->lessons
                    ->where('is_published', true)
                    ->sortBy('lesson_number')
                    ->first(fn($lesson) =>
                        ! in_array($lesson->id, $completedLessonIds) &&
                        now()->gte($lesson->available_date ?? $enrolledAt->copy()->addWeeks($lesson->lesson_number - 1))
                    );

                // First unread locked lesson (for "available in X days" fallback)
                $nextLockedLesson = $nextLesson ? null : $enrollment->course->lessons
                    ->where('is_published', true)
                    ->sortBy('lesson_number')
                    ->first(fn($lesson) => ! in_array($lesson->id, $completedLessonIds));

                $enrollment->next_lesson        = $nextLesson;
                $enrollment->next_locked_lesson = $nextLockedLesson;
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
                'course.lessons:id,course_id,slug,title,is_published,lesson_number,available_date',
                'progress:id,enrollment_id,lesson_id,completed_at,quiz_score',
            ])
            ->orderByDesc('enrolled_at')
            ->get();

        $lifeGroups = Ministry::active()->select('id', 'name', 'slug', 'subtitle', 'category_label', 'image_path', 'meeting_schedule', 'location')->get();

        return view('member.courses', compact('member', 'enrollments', 'lifeGroups'));
    }

    public function progress()
    {
        $member = Auth::guard('member')->user();

        $enrollments = $member->enrollments()
            ->with([
                'course:id,title,slug,category,guest_instructor_name,image_path,leader_id',
                'course.leader:id,name',
                'course.lessons:id,course_id,title,slug,lesson_number,is_published,week_group,available_date,content,quiz_questions',
                'progress:id,enrollment_id,lesson_id,completed_at,quiz_score',
            ])
            ->whereIn('status', ['active', 'completed'])
            ->orderByDesc('enrolled_at')
            ->get();

        $enrollmentIds = $enrollments->pluck('id');

        // ── Study activity heatmap (last 5 weeks, Mon→Sun) ────────────────────
        $heatmapStart = now()->startOfWeek(\Carbon\Carbon::MONDAY)->subWeeks(4);
        $heatmapEnd   = now()->endOfWeek(\Carbon\Carbon::SUNDAY);

        $activityMap = \App\Models\LessonProgress::whereIn('enrollment_id', $enrollmentIds)
            ->whereNotNull('completed_at')
            ->whereBetween('completed_at', [$heatmapStart, $heatmapEnd])
            ->get()
            ->groupBy(fn($p) => $p->completed_at->format('Y-m-d'))
            ->map->count();

        $heatmap = [];
        for ($week = 0; $week < 5; $week++) {
            $row = [];
            for ($day = 0; $day < 7; $day++) {
                $date  = $heatmapStart->copy()->addDays($week * 7 + $day);
                $key   = $date->format('Y-m-d');
                $row[] = [
                    'date'    => $key,
                    'count'   => $activityMap[$key] ?? 0,
                    'isFuture' => $date->isFuture(),
                ];
            }
            $heatmap[] = $row;
        }

        // ── Course breakdown ──────────────────────────────────────────────────
        $courseBreakdowns = $enrollments->map(function ($enrollment) {
            $progressMap  = $enrollment->progress->keyBy('lesson_id');
            $lessons      = $enrollment->course->lessons
                ->where('is_published', true)
                ->sortBy('lesson_number');

            $totalLessons     = $lessons->count();
            $completedLessons = $progressMap->whereNotNull('completed_at')->count();
            $progressPercent  = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;

            $minutesStudied = $lessons
                ->filter(fn($l) => $progressMap->get($l->id)?->completed_at !== null)
                ->sum(fn($l) => max(1, (int) ceil(str_word_count(strip_tags($l->content ?? '')) / 200)));

            $totalQuizzes = $lessons->filter(fn($l) => !empty($l->quiz_questions))->count();
            $quizzesDone  = $progressMap->whereNotNull('quiz_score')->count();

            $modules = $lessons
                ->groupBy(fn($l) => $l->week_group ?: 'Lessons')
                ->map(function ($groupLessons, $groupName) use ($progressMap) {
                    $total     = $groupLessons->count();
                    $completed = $groupLessons->filter(fn($l) => $progressMap->get($l->id)?->completed_at !== null)->count();
                    $quizLesson = $groupLessons->first(fn($l) => !empty($l->quiz_questions));
                    $quizScore  = $quizLesson ? $progressMap->get($quizLesson->id)?->quiz_score : null;

                    return [
                        'name'       => $groupName,
                        'total'      => $total,
                        'completed'  => $completed,
                        'percent'    => $total > 0 ? round(($completed / $total) * 100) : 0,
                        'quiz_score' => $quizScore,
                    ];
                })
                ->values();

            return [
                'enrollment'       => $enrollment,
                'course'           => $enrollment->course,
                'totalLessons'     => $totalLessons,
                'completedLessons' => $completedLessons,
                'progressPercent'  => $progressPercent,
                'minutesStudied'   => $minutesStudied,
                'quizzesDone'      => $quizzesDone,
                'totalQuizzes'     => $totalQuizzes,
                'modules'          => $modules,
            ];
        });

        return view('member.progress', compact('member', 'heatmap', 'courseBreakdowns'));
    }

    public function certificates()
    {
        $member = Auth::guard('member')->user();

        $certificates = $member->enrollments()
            ->with([
                'course:id,title,slug,category,guest_instructor_name,leader_id,has_certificate',
                'course.leader:id,name',
                'progress:id,enrollment_id,lesson_id,completed_at,quiz_score',
            ])
            ->where('certificate_issued', true)
            ->orderByDesc('completed_at')
            ->get()
            ->map(function ($enrollment) {
                $avgGrade = $enrollment->average_grade;

                if ($avgGrade === null) {
                    $grade = null;
                } elseif ($avgGrade >= 85) {
                    $grade = 'Distinction';
                } elseif ($avgGrade >= 70) {
                    $grade = 'Merit';
                } else {
                    $grade = 'Pass';
                }

                $enrolledAt   = $enrollment->enrolled_at ?? $enrollment->created_at;
                $completedAt  = $enrollment->completed_at;
                $durationWeeks = $enrolledAt && $completedAt
                    ? max(1, (int) ceil($enrolledAt->diffInWeeks($completedAt)))
                    : null;

                return [
                    'enrollment'    => $enrollment,
                    'course'        => $enrollment->course,
                    'grade'         => $grade,
                    'avg_score'     => $avgGrade,
                    'issued_at'     => $completedAt ?? $enrollment->updated_at,
                    'duration_weeks' => $durationWeeks,
                ];
            });

        return view('member.certificates', compact('member', 'certificates'));
    }

    public function certificateDetail(int $enrollmentId)
    {
        $member = Auth::guard('member')->user();

        $enrollment = $member->enrollments()
            ->with([
                'course:id,title,slug,category,guest_instructor_name,leader_id',
                'course.leader:id,name',
                'progress:id,enrollment_id,lesson_id,completed_at,quiz_score',
            ])
            ->where('certificate_issued', true)
            ->findOrFail($enrollmentId);

        $avgGrade = $enrollment->average_grade;
        $grade    = $avgGrade === null ? null
            : ($avgGrade >= 85 ? 'Distinction' : ($avgGrade >= 70 ? 'Merit' : 'Pass'));

        $enrolledAt    = $enrollment->enrolled_at ?? $enrollment->created_at;
        $completedAt   = $enrollment->completed_at;
        $durationWeeks = $enrolledAt && $completedAt
            ? max(1, (int) ceil($enrolledAt->diffInWeeks($completedAt)))
            : null;

        return view('member.certificate-detail', compact(
            'member', 'enrollment', 'grade', 'avgGrade', 'completedAt', 'durationWeeks'
        ));
    }
}
