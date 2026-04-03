<?php

namespace App\Http\Controllers;

use App\Models\Sermon;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function index(): View
    {
        $sermons = Sermon::active()
            ->orderByDesc('preached_at')
            ->get();

        $featuredSermon = Sermon::featured() ?? $sermons->first();

        $liveSermon = Sermon::where('is_live', true)->where('is_active', true)->first();

        return view('pages.media', compact('sermons', 'featuredSermon', 'liveSermon'));
    }

    public function show(string $slug): View
    {
        return view('pages.sermon-play', ['slug' => $slug]);
    }
}
