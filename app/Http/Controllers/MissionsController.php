<?php

namespace App\Http\Controllers;

use App\Models\MissionCountry;
use App\Models\MissionPillar;
use App\Models\MissionsSection;
use Illuminate\View\View;

class MissionsController extends Controller
{
    public function index(): View
    {
        $missionsSection = MissionsSection::instance();

        $pillars = MissionPillar::active()->with('leaders')->orderBy('sort_order')->get();

        $countries = MissionCountry::active()->orderBy('sort_order')->get();

        return view('pages.missions', compact('missionsSection', 'pillars', 'countries'));
    }

    public function show(string $slug): View
    {
        $pillar = MissionPillar::with('leaders')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $otherPillars = MissionPillar::active()
            ->with('leaders')
            ->where('id', '!=', $pillar->id)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('pages.mission-pillar', compact('pillar', 'otherPillars'));
    }
}
