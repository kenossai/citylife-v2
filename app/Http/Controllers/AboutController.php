<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $aboutSection = AboutSection::instance();

        return view('pages.about', compact('aboutSection'));
    }
}
