<?php

namespace App\Http\Controllers;

class CoursesController extends Controller
{
    public function index()
    {
        return view('pages.courses');
    }
}
