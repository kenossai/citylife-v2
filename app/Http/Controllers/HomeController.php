<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use App\Models\CtaSection;
use App\Models\Event;
use App\Models\HeroSlide;
use App\Models\Ministry;
use App\Models\MissionsSection;
use App\Models\Sermon;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $heroSlides    = HeroSlide::active()->get();
        $ministries    = Ministry::active()->get();
        $featuredSermon = Sermon::featured()
            ?? Sermon::active()->whereNotNull('slug')->latest('preached_at')->first();
        $upcomingEvents = Event::active()->upcoming()->take(2)->get();
        $aboutSection  = AboutSection::instance();
        $missionsSection = MissionsSection::instance();
        $ctaSection    = CtaSection::instance();

        return view('pages.home', compact(
            'heroSlides',
            'ministries',
            'featuredSermon',
            'upcomingEvents',
            'aboutSection',
            'missionsSection',
            'ctaSection',
        ));
    }
}

