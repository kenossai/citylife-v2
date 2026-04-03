<?php

namespace App\Http\Controllers;

use App\Models\BibleSchoolSession;
use App\Models\Speaker;

class BibleSchoolResourceController extends Controller
{
    public function index()
    {
        $speakers = Speaker::active()
            ->ordered()
            ->withCount(['sessions as videos_count' => fn ($q) => $q->where('type', 'video')->where('is_active', true)])
            ->withCount(['sessions as audios_count' => fn ($q) => $q->where('type', 'audio')->where('is_active', true)])
            ->with(['sessions' => fn ($q) => $q->where('is_active', true)->select('speaker_id', 'year')])
            ->get()
            ->map(function (Speaker $speaker) {
                $years = $speaker->sessions->pluck('year')->unique()->sortDesc()->values()->all();
                return [
                    'slug'    => $speaker->slug,
                    'name'    => $speaker->name,
                    'role'    => $speaker->role ?? '',
                    'church'  => $speaker->church ?? '',
                    'image'   => $speaker->image ? asset('storage/' . $speaker->image) : asset('images/slide-1.png'),
                    'years'   => $years,
                    'videos'  => $speaker->videos_count,
                    'audios'  => $speaker->audios_count,
                    'locked'  => $speaker->sessions->where('is_locked', true)->count() > 0,
                ];
            });

        $years = BibleSchoolSession::active()
            ->selectRaw('year, count(*) as session_count')
            ->groupBy('year')
            ->orderByDesc('year')
            ->pluck('session_count', 'year')
            ->map(fn ($count, $year) => ['value' => $year, 'sessions' => $count])
            ->values()
            ->all();

        return view('pages.bible-school-resources', compact('speakers', 'years'));
    }

    public function show(string $slug)
    {
        $speaker = Speaker::active()
            ->where('slug', $slug)
            ->withCount(['sessions as videos_count' => fn ($q) => $q->where('type', 'video')->where('is_active', true)])
            ->withCount(['sessions as audios_count' => fn ($q) => $q->where('type', 'audio')->where('is_active', true)])
            ->firstOrFail();
        $sessions = $speaker->sessions()
            ->active()
            ->orderBy('year', 'desc')
            ->orderBy('sort_order')
            ->get();

        $unlocked = in_array($slug, array_keys(session('unlocked_speakers', [])));

        $otherSpeakers = Speaker::active()
            ->ordered()
            ->where('slug', '!=', $slug)
            ->take(3)
            ->get();

        return view('pages.speaker-session', compact('speaker', 'sessions', 'unlocked', 'otherSpeakers'));
    }

    public function play(string $speakerSlug, string $sessionSlug)
    {
        $speaker = Speaker::active()->where('slug', $speakerSlug)->firstOrFail();
        $session = BibleSchoolSession::active()
            ->where('speaker_id', $speaker->id)
            ->where('slug', $sessionSlug)
            ->firstOrFail();

        $allSessions = $speaker->sessions()->active()->orderBy('year', 'desc')->orderBy('sort_order')->get();

        return view('pages.session-play', compact('speaker', 'session', 'allSessions'));
    }
}

