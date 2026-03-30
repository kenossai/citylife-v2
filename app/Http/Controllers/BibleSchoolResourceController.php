<?php

namespace App\Http\Controllers;

class BibleSchoolResourceController extends Controller
{
    public function index()
    {
        return view('pages.bible-school-resources');
    }

    public function show(string $slug)
    {
        $unlocked = in_array($slug, array_keys(session('unlocked_speakers', [])));

        return view('pages.speaker-session', [
            'slug' => $slug,
            'unlocked' => $unlocked,
        ]);
    }

    public function play(string $speakerSlug, string $sessionSlug)
    {
        return view('pages.session-play', [
            'speakerSlug' => $speakerSlug,
            'sessionSlug' => $sessionSlug,
        ]);
    }
}
