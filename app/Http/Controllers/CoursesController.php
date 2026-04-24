<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Member;
use App\Mail\CourseEnrollmentRequestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        // Church WiFi gate — enrolment only allowed from church premises
        $allowedIps = array_filter(array_map('trim', explode(',', config('services.church_wifi_ip', ''))));
        if (! empty($allowedIps) && ! in_array($request->ip(), $allowedIps)) {
            return back()->with('enrol_error', 'Enrolment is only available from within the church premises.');
        }

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
            'status'      => 'pending',
            'enrolled_at' => now(),
        ]);

        // Notify instructor / courses admin
        $adminEmail = env('COURSES_ADMIN_EMAIL', config('mail.from.address'));
        $enrollment = CourseEnrollment::with(['course', 'member'])
            ->where('course_id', $course->id)
            ->where('member_id', $member->id)
            ->latest()
            ->first();

        Mail::to($adminEmail)->send(new CourseEnrollmentRequestMail($enrollment));

        return back()->with('enrol_success', 'Your enrollment request has been submitted! We will review it and be in touch shortly.');
    }
}

