<?php

namespace App\Http\Controllers;

use App\Models\Leader;

class LeadershipController extends Controller
{
    public function index()
    {
        $leadPastors  = Leader::active()->featured()->ordered()->get();
        $otherLeaders = Leader::active()->where('is_featured', false)->ordered()->get();

        return view('pages.leadership', compact('leadPastors', 'otherLeaders'));
    }
}
