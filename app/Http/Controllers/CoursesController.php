<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Member;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = Course::active()
            ->with('leader')
            ->withCount('lessons')
            ->orderBy('created_at')
            ->get();

        $categories = $courses->pluck('category')->filter()->unique()->sort()->values()->prepend('All');

        return view('pages.courses', compact('courses', 'categories'));
    }

    public function show(string $slug)
    {
        $course = Course::where('slug', $slug)
            ->active()
            ->with(['leader', 'lessons' => fn ($q) => $q->active()->ordered()])
            ->firstOrFail();

        return view('pages.course-detail', compact('course'));
    }

    public function enrol(Request $request, string $slug)
    {
        $course = Course::where('slug', $slug)->active()->firstOrFail();

        if (! $course->is_registration_open) {
            return back()->with('enrol_error', 'Registration for this course is not currently open.');
        }

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
        ]);

        $nameParts  = explode(' ', trim($validated['name']), 2);
        $firstName  = $nameParts[0];
        $lastName   = $nameParts[1] ?? '';

        $member = Member::firstOrCreate(
            ['email' => strtolower($validated['email'])],
            [
                'first_name'       => $firstName,
                'last_name'        => $lastName,
                'membership_status' => 'visitor',
            ]
        );

        $alreadyEnrolled = CourseEnrollment::where('course_id', $course->id)
            ->where('member_id', $member->id)
            ->whereIn('status', ['active', 'completed'])
            ->exists();

        if ($alreadyEnrolled) {
            return back()->with('enrol_error', 'You are already enrolled in this course.');
        }

        CourseEnrollment::create([
            'course_id'   => $course->id,
            'member_id'   => $member->id,
            'status'      => 'active',
            'enrolled_at' => now(),
        ]);

        return back()->with('enrol_success', 'You have been successfully enrolled! We will be in touch with further details.');
    }
}

