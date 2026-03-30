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

    public function show(string $slug)
    {
        $ministry = Ministry::where('slug', $slug)->where('is_active', true)->first();
        $otherMinistries = $ministry
            ? Ministry::active()->where('id', '!=', $ministry->id)->take(3)->get()
            : collect();

        return view('pages.ministry-detail', compact('ministry', 'otherMinistries', 'slug'));
    }
}
