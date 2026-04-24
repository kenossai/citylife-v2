<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberCourseReviewController extends Controller
{
    public function create(string $courseSlug)
    {
        $member = Auth::guard('member')->user();

        $course = Course::where('slug', $courseSlug)
            ->where('is_active', true)
            ->firstOrFail();

        $enrollment = $member->enrollments()
            ->where('course_id', $course->id)
            ->where('status', 'completed')
            ->firstOrFail();

        // Already reviewed — go back to courses
        if ($enrollment->review()->exists()) {
            return redirect()->route('member.courses')
                ->with('status', 'You have already reviewed this course.');
        }

        return view('member.course-review', compact('course', 'enrollment'));
    }

    public function store(Request $request, string $courseSlug)
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'body'   => ['nullable', 'string', 'max:2000'],
        ]);

        $member = Auth::guard('member')->user();

        $course = Course::where('slug', $courseSlug)
            ->where('is_active', true)
            ->firstOrFail();

        $enrollment = $member->enrollments()
            ->where('course_id', $course->id)
            ->where('status', 'completed')
            ->firstOrFail();

        // Idempotent — only create if no review yet
        if (! $enrollment->review()->exists()) {
            CourseReview::create([
                'course_id'     => $course->id,
                'enrollment_id' => $enrollment->id,
                'member_id'     => $member->id,
                'rating'        => $validated['rating'],
                'body'          => $validated['body'] ?? null,
                'is_approved'   => false,
            ]);
        }

        return redirect()->route('member.courses')
            ->with('status', 'Thank you for your review!')
            ->with('suggest_life_group', true);
    }
}
