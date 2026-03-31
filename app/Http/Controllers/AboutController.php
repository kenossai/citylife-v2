<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use App\Models\CoreValue;
use App\Models\WorshipCentre;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $aboutSection   = AboutSection::instance();
        $coreValues     = CoreValue::active()->ordered()->get();
        $worshipCentres = WorshipCentre::active()->ordered()->get();

        return view('pages.about', compact('aboutSection', 'coreValues', 'worshipCentres'));
    }
}
