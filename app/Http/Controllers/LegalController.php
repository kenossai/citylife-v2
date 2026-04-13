<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LegalController extends Controller
{
    public function privacy(): View
    {
        return view('pages.privacy-policy');
    }

    public function cookies(): View
    {
        return view('pages.cookie-policy');
    }
}
