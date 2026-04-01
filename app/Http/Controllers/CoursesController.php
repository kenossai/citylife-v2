<?php

namespace App\Http\Controllers;

use App\Models\Course;

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
}
