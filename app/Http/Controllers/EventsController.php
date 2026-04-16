<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EventsController extends Controller
{
    public function index(): View
    {
        $events = $this->buildEventsCollection();

        $featuredEvents = $events->filter(fn (array $e) => $e['is_featured'])->take(2)->values();

        if ($featuredEvents->isEmpty()) {
            $featuredEvents = $events->take(2)->values();
        }

        return view('pages.events', [
            'events'         => $events,
            'featuredEvents' => $featuredEvents,
            'nextEvent'      => $events->first(),
        ]);
    }

    public function show(string $slug): View
    {
        $events = $this->buildEventsCollection();
        $event = $events->firstWhere('slug', $slug);

        abort_unless($event, 404);

        return view('pages.event-show', [
            'event' => $event,
            'relatedEvents' => $events
                ->reject(fn (array $item) => $item['slug'] === $slug)
                ->take(3)
                ->values(),
        ]);
    }

    private function buildEventsCollection(): Collection
    {
        $storedEvents = Event::active()
            ->upcoming()
            ->get()
            ->values()
            ->map(fn (Event $event, int $index) => $this->mapEvent([
                'id'                    => 'event-' . $event->id,
                'title'                 => $event->title,
                'slug'                  => $event->slug,
                'description'           => $event->description,
                'image'                 => $this->assetFromPath($event->image_path, $index),
                'event_at'              => $event->event_at ?: now()->addDays($index + 1),
                'location'              => $event->location ?: 'City Life International, Sheffield',
                'category'              => $event->category ?: $this->inferCategory($event->title, $event->description),
                'badge'                 => $event->badge ?: 'Open To All',
                'is_featured'           => (bool) $event->is_featured,
                'requires_registration' => (bool) $event->requires_registration,
                'requires_payment'      => (bool) $event->requires_payment,
            ], $index));

        if ($storedEvents->isNotEmpty()) {
            return $storedEvents->sortBy('timestamp')->values();
        }

        // Only use hardcoded fallbacks when there are no DB events (local/staging only)
        return $this->fallbackEvents()->sortBy('timestamp')->values();
    }

    private function mapEvent(array $event, int $index): array
    {
        $date = $event['event_at'] instanceof Carbon
            ? $event['event_at']->copy()
            : Carbon::parse($event['event_at']);

        return [
            'id'                    => $event['id'] ?? 'fallback-' . $index,
            'title'                 => $event['title'],
            'slug'                  => $event['slug'],
            'description'           => $event['description'] ?: 'Join us for a life-giving gathering filled with worship, community, and space to encounter God together.',
            'image'                 => $event['image'] ?? $this->fallbackImages()[$index % count($this->fallbackImages())],
            'location'              => $event['location'] ?? 'City Life International, Sheffield',
            'category'              => $event['category'] ?? 'Special',
            'badge'                 => $event['badge'] ?? 'Open To All',
            'is_featured'           => $event['is_featured'] ?? false,
            'requires_registration' => $event['requires_registration'] ?? true,
            'requires_payment'      => $event['requires_payment'] ?? false,
            'row_height'            => 185.5,
            'month'                 => strtoupper($date->format('M')),
            'day'                   => $date->format('d'),
            'weekday'               => $date->format('l'),
            'year'                  => $date->format('Y'),
            'date_label'            => $date->format('F j, Y'),
            'short_date'            => $date->format('D, j M'),
            'time_label'            => $date->format('g:i A'),
            'timestamp'             => $date->timestamp,
            'route'                 => route('events.show', $event['slug']),
        ];
    }

    private function fallbackEvents(): Collection
    {
        return collect([
            [
                'title'                 => 'Good Friday Evening Service',
                'slug'                  => 'good-friday-evening-service',
                'description'           => 'Join us for a moving Good Friday evening service of reflection, communion, and worship as we remember the sacrifice of Jesus.',
                'event_at'              => Carbon::parse('2026-03-28 19:00:00'),
                'image'                 => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?auto=format&fit=crop&w=1200&q=80',
                'location'              => 'Main Sanctuary, Sheffield',
                'category'              => 'Worship',
                'badge'                 => 'Open To All',
                'is_featured'           => true,
                'requires_registration' => false,
            ],
            [
                'title'                 => 'Easter Sunday Celebration',
                'slug'                  => 'easter-sunday-celebration',
                'description'           => 'Celebrate the resurrection of Jesus. Bring your family and invite your friends to this powerful Easter Sunday celebration.',
                'event_at'              => Carbon::parse('2026-04-05 09:00:00'),
                'image'                 => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=1200&q=80',
                'location'              => 'Main Sanctuary, Sheffield',
                'category'              => 'Special',
                'badge'                 => 'All Ages',
                'is_featured'           => true,
                'requires_registration' => false,
            ],
            [
                'title'                 => 'Youth & Kids Easter Bash',
                'slug'                  => 'youth-and-kids-easter-bash',
                'description'           => 'A fun-packed afternoon for children and young people with games, worship, food, and an Easter message they will remember.',
                'event_at'              => Carbon::parse('2026-04-05 13:00:00'),
                'image'                 => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1200&q=80',
                'location'              => 'Youth Hall, Sheffield',
                'category'              => 'Youth',
                'badge'                 => 'Family Friendly',
                'is_featured'           => false,
                'requires_registration' => false,
            ],
            [
                'title'                 => 'Community Outreach Day',
                'slug'                  => 'community-outreach-day',
                'description'           => 'Join our city outreach team as we serve the homeless, distribute food, and share the love of Jesus across Sheffield.',
                'event_at'              => Carbon::parse('2026-04-12 10:00:00'),
                'image'                 => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=1200&q=80',
                'location'              => 'City Park, Sheffield',
                'category'              => 'Outreach',
                'badge'                 => 'Serve Together',
                'is_featured'           => false,
                'requires_registration' => true,
            ],
            [
                'title'                 => 'Bible School: Module 3 Launch',
                'slug'                  => 'bible-school-module-3-launch',
                'description'           => 'Our spring intensive programme returns with Module 3, equipping believers in doctrine, practice, and Spirit-led ministry.',
                'event_at'              => Carbon::parse('2026-04-19 19:00:00'),
                'image'                 => 'https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?auto=format&fit=crop&w=1200&q=80',
                'location'              => 'Bible School Hall, Sheffield',
                'category'              => 'Training',
                'badge'                 => 'Enrolment Open',
                'is_featured'           => false,
                'requires_registration' => true,
            ],
            [
                'title'                 => 'Men of Valour Breakfast Meeting',
                'slug'                  => 'men-of-valour-breakfast-meeting',
                'description'           => 'Men, come out for breakfast, fellowship, and practical encouragement as we build one another up in faith and purpose.',
                'event_at'              => Carbon::parse('2026-04-26 08:30:00'),
                'image'                 => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=1200&q=80',
                'location'              => 'Atrium Cafe, Sheffield',
                'category'              => 'Men',
                'badge'                 => 'Men Only',
                'is_featured'           => false,
                'requires_registration' => true,
            ],
            [
                'title'                 => 'Days of Fire Conference 2026',
                'slug'                  => 'days-of-fire-conference-2026',
                'description'           => 'Four spirit-filled days of powerful worship, prophetic ministry, and teaching to ignite fresh hunger for God.',
                'event_at'              => Carbon::parse('2026-05-10 18:00:00'),
                'image'                 => 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=1200&q=80',
                'location'              => 'Main Sanctuary, Sheffield',
                'category'              => 'Conference',
                'badge'                 => 'Featured',
                'is_featured'           => true,
                'requires_registration' => true,
            ],
            [
                'title'                 => 'Night of Worship',
                'slug'                  => 'night-of-worship',
                'description'           => 'A special evening dedicated entirely to worship, prayer, and encountering God in a fresh way as a church family.',
                'event_at'              => Carbon::parse('2026-05-17 18:00:00'),
                'image'                 => asset('images/slide-3.jpg'),
                'location'              => 'Main Sanctuary, Sheffield',
                'category'              => 'Worship',
                'badge'                 => 'Open To All',
                'is_featured'           => false,
                'requires_registration' => false,
            ],
        ])->values()->map(fn (array $event, int $index) => $this->mapEvent($event, $index));
    }

    private function fallbackImages(): array
    {
        return [
            asset('images/slide-1.png'),
            asset('images/slide-2.png'),
            asset('images/slide-3.jpg'),
            'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?auto=format&fit=crop&w=1200&q=80',
        ];
    }

    private function assetFromPath(?string $path, int $index = 0): string
    {
        if (! filled($path)) {
            return $this->fallbackImages()[$index % count($this->fallbackImages())];
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Str::startsWith($path, ['images/', 'storage/'])) {
            return asset($path);
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    private function inferCategory(?string $title, ?string $description): string
    {
        $haystack = Str::lower(trim(($title ?? '') . ' ' . ($description ?? '')));

        return match (true) {
            Str::contains($haystack, ['conference']) => 'Conference',
            Str::contains($haystack, ['men', 'brotherhood', 'valour']) => 'Men',
            Str::contains($haystack, ['bible school', 'training', 'module', 'class']) => 'Training',
            Str::contains($haystack, ['youth', 'students', 'teen', 'kids']) => 'Youth',
            Str::contains($haystack, ['worship', 'prayer', 'praise', 'good friday']) => 'Worship',
            Str::contains($haystack, ['easter', 'celebration', 'special']) => 'Special',
            Str::contains($haystack, ['outreach', 'community', 'family']) => 'Outreach',
            default => 'Special',
        };
    }
}
