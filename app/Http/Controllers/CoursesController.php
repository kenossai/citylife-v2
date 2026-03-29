<?php

namespace App\Http\Controllers;

class CoursesController extends Controller
{
    public function index()
    {
        return view('pages.courses');
    }

    public function show(string $slug)
    {
        return view('pages.course-detail', ['slug' => $slug]);
    }
}
