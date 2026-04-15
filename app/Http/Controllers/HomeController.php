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
        $ministries    = Ministry::active()->take(6)->get();
        $threshold = now()->setTime(10, 30);
        $pastOrLive = fn ($q) => $q->where('is_live', true)->orWhere('preached_at', '<=', $threshold);
        $featuredSermon = Sermon::where('is_featured', true)->where('is_active', true)
            ->where(fn ($q) => $pastOrLive($q))
            ->latest('preached_at')->first()
            ?? Sermon::active()->whereNotNull('slug')
            ->where(fn ($q) => $pastOrLive($q))
            ->latest('preached_at')->first();
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

