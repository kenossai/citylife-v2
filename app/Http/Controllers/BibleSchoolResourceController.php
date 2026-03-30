<?php

namespace App\Http\Controllers;

class BibleSchoolResourceController extends Controller
{
    public function index()
    {
        return view('pages.bible-school-resources');
    }

    public function show(string $slug)
    {
        return view('pages.speaker-session', ['slug' => $slug]);
    }
}
