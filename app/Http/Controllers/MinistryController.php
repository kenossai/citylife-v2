<?php

namespace App\Http\Controllers;

use App\Models\Ministry;

class MinistryController extends Controller
{
    public function index()
    {
        $ministries = Ministry::active()->get();

        return view('pages.ministries', compact('ministries'));
    }
}
