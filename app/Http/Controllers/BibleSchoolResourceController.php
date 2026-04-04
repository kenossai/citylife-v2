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
            ->with(['events.sessions' => fn ($q) => $q->active()])
            ->get()
            ->map(function (Speaker $speaker) {
                $sessions = $speaker->events->flatMap(fn ($e) => $e->sessions);
                return [
                    'slug'   => $speaker->slug,
                    'name'   => $speaker->name,
                    'role'   => $speaker->role ?? '',
                    'church' => $speaker->church ?? '',
                    'image'  => $speaker->image ? asset('storage/' . $speaker->image) : asset('images/slide-1.png'),
                    'years'  => $sessions->pluck('year')->unique()->sortDesc()->values()->all(),
                    'videos' => $sessions->where('type', 'video')->count(),
                    'audios' => $sessions->where('type', 'audio')->count(),
                    'locked' => $sessions->where('is_locked', true)->count() > 0,
                ];
            });

        $years = BibleSchoolSession::active()
            ->selectRaw('year, count(*) as session_count')
            ->groupBy('year')
            ->orderByDesc('year')
            ->pluck('session_count', 'year')
            ->map(fn ($count, $year) => ['value' => (int) $year, 'sessions' => (int) $count])
            ->values()
            ->all();

        return view('pages.bible-school-resources', compact('speakers', 'years'));
    }

    public function show(string $slug)
    {
        $speaker = Speaker::active()->where('slug', $slug)->firstOrFail();

        $eventIds = $speaker->events()->pluck('bible_school_events.id');

        $speaker->videos_count = BibleSchoolSession::whereIn('bible_school_event_id', $eventIds)
            ->where('type', 'video')->where('is_active', true)->count();
        $speaker->audios_count = BibleSchoolSession::whereIn('bible_school_event_id', $eventIds)
            ->where('type', 'audio')->where('is_active', true)->count();

        $sessions = BibleSchoolSession::whereIn('bible_school_event_id', $eventIds)
            ->active()
            ->orderBy('year', 'desc')
            ->orderBy('sort_order')
            ->get();

        $unlocked = in_array($slug, array_keys(session('unlocked_speakers', [])));

        $otherSpeakers = Speaker::active()
            ->ordered()
            ->where('slug', '!=', $slug)
            ->take(3)
            ->get()
            ->each(function (Speaker $s) {
                $eIds = $s->events()->pluck('bible_school_events.id');
                $s->sessions_count = BibleSchoolSession::whereIn('bible_school_event_id', $eIds)
                    ->where('is_active', true)->count();
            });

        return view('pages.speaker-session', compact('speaker', 'sessions', 'unlocked', 'otherSpeakers'));
    }

    public function play(string $speakerSlug, string $sessionSlug)
    {
        $speaker = Speaker::active()->where('slug', $speakerSlug)->firstOrFail();

        $eventIds = $speaker->events()->pluck('bible_school_events.id');

        $session = BibleSchoolSession::active()
            ->whereIn('bible_school_event_id', $eventIds)
            ->where('slug', $sessionSlug)
            ->firstOrFail();

        $allSessions = BibleSchoolSession::whereIn('bible_school_event_id', $eventIds)
            ->active()
            ->orderBy('year', 'desc')
            ->orderBy('sort_order')
            ->get();

        return view('pages.session-play', compact('speaker', 'session', 'allSessions'));
    }
}
