<?php

namespace App\Http\Controllers;

use App\Models\MissionsSection;
use Illuminate\View\View;

class MissionsController extends Controller
{
    public function index(): View
    {
        $missionsSection = MissionsSection::instance();

        return view('pages.missions', compact('missionsSection'));
    }
}
