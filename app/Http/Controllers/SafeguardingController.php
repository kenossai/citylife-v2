<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SafeguardingController extends Controller
{
    public function index(): View
    {
        return view('pages.safeguarding');
    }
}
