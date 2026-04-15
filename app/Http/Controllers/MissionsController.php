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

        $pillars = MissionPillar::active()->orderBy('sort_order')->get();

        $countries = MissionCountry::active()->orderBy('sort_order')->get();

        return view('pages.missions', compact('missionsSection', 'pillars', 'countries'));
    }
}
