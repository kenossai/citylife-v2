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
        $sermon = Sermon::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $related = Sermon::active()
            ->where('id', '!=', $sermon->id)
            ->orderByDesc('preached_at')
            ->take(6)
            ->get();

        return view('pages.sermon-play', compact('sermon', 'related'));
    }
}
