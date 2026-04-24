<?php

namespace App\Http\Controllers;

use App\Models\Ministry;
use App\Models\MinistryEnquiry;
use Illuminate\Http\Request;

class MinistryController extends Controller
{
    public function index()
    {
        $ministries = Ministry::active()->get();

        return view('pages.ministries', compact('ministries'));
    }

    public function show(string $slug)
    {
        $ministry = Ministry::with('leaders')->where('slug', $slug)->where('is_active', true)->first();
        $otherMinistries = $ministry
            ? Ministry::active()->where('id', '!=', $ministry->id)->take(3)->get()
            : collect();

        return view('pages.ministry-detail', compact('ministry', 'otherMinistries', 'slug'));
    }

    public function joinForm(string $slug)
    {
        $ministry = Ministry::with('leaders')->where('slug', $slug)->where('is_active', true)->firstOrFail();

        return view('pages.ministry-join', compact('ministry'));
    }

    public function connect(Request $request, string $slug)
    {
        $ministry = Ministry::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'email'     => ['required', 'email', 'max:150'],
            'phone'     => ['nullable', 'string', 'max:30'],
            'message'   => ['nullable', 'string', 'max:2000'],
        ]);

        MinistryEnquiry::create([
            'ministry_id' => $ministry->id,
            'full_name'   => $validated['full_name'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'] ?? null,
            'message'     => $validated['message'] ?? null,
        ]);

        return redirect()
            ->route('ministries.join', $slug)
            ->with('connect_success', "Thanks, {$validated['full_name']}! We'll be in touch soon.");
    }
}

