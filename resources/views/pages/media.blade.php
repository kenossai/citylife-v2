@extends('layouts.app')

@section('title', 'Media & Resources — City Life International')
@section('meta_description', 'Explore sermons, messages, and church media from City Life International.')

@php
    $thumbnailFallbacks = [
        asset('images/slide-1.png'),
        asset('images/slide-2.png'),
        'https://images.unsplash.com/photo-1511379938547-c1f69419868d?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1516280030429-27679b3dc9cf?auto=format&fit=crop&w=1200&q=80',
        asset('images/slide-1.png'),
        asset('images/slide-1.png'),
        asset('images/slide-2.png'),
    ];

    $tagFallbacks = [
        'Worship & Life',
        'Empowered',
        'Foundations',
        'Unshakeable',
        'Grace & Truth',
        'Spirit & Truth',
    ];

    $durationFallbacks = ['41:45', '39:30', '36:09', '52:08', '31:24', '48:18', '43:12', '29:56'];

    $assetFromPath = function (?string $path, int $index = 0) use ($thumbnailFallbacks): string {
        if (! filled($path)) {
            return $thumbnailFallbacks[$index % count($thumbnailFallbacks)];
        }

        if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (\Illuminate\Support\Str::startsWith($path, ['images/', 'storage/'])) {
            return asset($path);
        }

        return asset('storage/' . ltrim($path, '/'));
    };

    $mapSermon = function ($sermon, int $index) use ($assetFromPath, $durationFallbacks, $tagFallbacks) {
        $text = strtolower(trim(($sermon->title ?? '') . ' ' . ($sermon->service_label ?? '')));
        $type = 'sermons';

        if (str_contains($text, 'podcast')) {
            $type = 'podcasts';
        } elseif (str_contains($text, 'music') || str_contains($text, 'worship') || str_contains($text, 'praise')) {
            $type = 'music';
        } elseif (str_contains($text, 'live')) {
            $type = 'live-streams';
        }

        return [
            'id' => 'sermon-' . ($sermon->id ?? $index),
            'slug' => \Illuminate\Support\Str::slug($sermon->title ?? 'walking-in-the-spirit'),
            'title' => $sermon->title ?? 'Walking In The Spirit',
            'speaker' => $sermon->speaker ?? 'Pastor James Maxwell',
            'date' => optional($sermon->preached_at)->format('F d, Y') ?: 'March 23, 2026',
            'meta' => trim(($sermon->speaker ?? 'Pastor James Maxwell') . ' • ' . (optional($sermon->preached_at)->format('M d, Y') ?: 'Mar 23, 2026')),
            'tag' => \Illuminate\Support\Str::upper(\Illuminate\Support\Str::limit($sermon->service_label ?: $tagFallbacks[$index % count($tagFallbacks)], 18, '')),
            'type' => $type,
            'duration' => $durationFallbacks[$index % count($durationFallbacks)],
            'thumbnail' => $assetFromPath($sermon->thumbnail_path ?? null, $index),
            'watch_url' => route('media.show', \Illuminate\Support\Str::slug($sermon->title ?? 'walking-in-the-spirit')),
            'listen_url' => route('media.show', \Illuminate\Support\Str::slug($sermon->title ?? 'walking-in-the-spirit')),
            'description' => $sermon->description ?: 'An encouraging message to help you live with faith, clarity, and spiritual boldness in everyday life.',
            'is_upcoming' => (bool) ($sermon->is_upcoming ?? false),
            'upcoming_date' => optional($sermon->preached_at)->isFuture() ? optional($sermon->preached_at)->format('D, M j · g:i A') : null,
        ];
    };

    $fallbackMedia = collect([
        [
            'id' => 'fallback-1',
            'slug' => 'walking-in-the-spirit',
            'title' => 'Walking In The Spirit',
            'speaker' => 'Pastor James Maxwell',
            'date' => 'March 23, 2026',
            'meta' => 'Pastor James Maxwell • Mar 23, 2026',
            'tag' => 'WORSHIP & LIFE',
            'type' => 'sermons',
            'duration' => '41:45',
            'thumbnail' => $thumbnailFallbacks[0],
            'watch_url' => route('media.show', 'walking-in-the-spirit'),
            'listen_url' => route('media.show', 'walking-in-the-spirit'),
            'description' => 'A practical message about learning to walk with the Holy Spirit in daily life and growing in maturity, courage, and obedience.',
        ],
        [
            'id' => 'fallback-2',
            'slug' => 'the-power-of-prayer',
            'title' => 'The Power Of Prayer',
            'speaker' => 'Pastor Daniel Carter',
            'date' => 'March 19, 2026',
            'meta' => 'Pastor Daniel Carter • Mar 19, 2026',
            'tag' => 'EMPOWERED',
            'type' => 'sermons',
            'duration' => '39:30',
            'thumbnail' => $thumbnailFallbacks[1],
            'watch_url' => route('media.show', 'the-power-of-prayer'),
            'listen_url' => route('media.show', 'the-power-of-prayer'),
            'description' => 'A message on bold faith, persistent prayer, and the confidence that grows when we seek God wholeheartedly.',
        ],
        [
            'id' => 'fallback-3',
            'slug' => 'faith-that-moves-mountains',
            'title' => 'Faith That Moves Mountains',
            'speaker' => 'Pastor Michael Brown',
            'date' => 'March 18, 2026',
            'meta' => 'Pastor Michael Brown • Mar 18, 2026',
            'tag' => 'UNSHAKEABLE',
            'type' => 'sermons',
            'duration' => '36:09',
            'thumbnail' => $thumbnailFallbacks[2],
            'watch_url' => route('media.show', 'faith-that-moves-mountains'),
            'listen_url' => route('media.show', 'faith-that-moves-mountains'),
            'description' => 'An uplifting sermon on trusting God in difficult seasons and building a faith that remains steady under pressure.',
        ],
        [
            'id' => 'fallback-4',
            'slug' => 'grace-and-truth',
            'title' => 'Grace And Truth',
            'speaker' => 'Pastor Anna Lewis',
            'date' => 'March 11, 2026',
            'meta' => 'Pastor Anna Lewis • Mar 11, 2026',
            'tag' => 'SPIRIT & LIFE',
            'type' => 'sermons',
            'duration' => '52:08',
            'thumbnail' => $thumbnailFallbacks[3],
            'watch_url' => route('media.show', 'grace-and-truth'),
            'listen_url' => route('media.show', 'grace-and-truth'),
            'description' => 'A teaching on the balance of conviction and compassion as we follow Jesus with humility and courage.',
        ],
        [
            'id' => 'fallback-5',
            'slug' => 'the-heart-of-worship',
            'title' => 'You Are Not Alone',
            'speaker' => 'Pastor James Maxwell',
            'date' => 'March 10, 2026',
            'meta' => 'Pastor James Maxwell • Mar 10, 2026',
            'tag' => 'FOUNDATIONS',
            'type' => 'sermons',
            'duration' => '31:24',
            'thumbnail' => $thumbnailFallbacks[4],
            'watch_url' => route('media.show', 'the-heart-of-worship'),
            'listen_url' => route('media.show', 'the-heart-of-worship'),
            'description' => 'A pastoral reminder that God is near in every season and the church family is meant to walk together.',
        ],
        [
            'id' => 'fallback-6',
            'slug' => 'identity-in-christ',
            'title' => 'Living With Purpose',
            'speaker' => 'Pastor Michael Brown',
            'date' => 'March 08, 2026',
            'meta' => 'Pastor Michael Brown • Mar 08, 2026',
            'tag' => 'UNSHAKEABLE',
            'type' => 'sermons',
            'duration' => '48:18',
            'thumbnail' => $thumbnailFallbacks[5],
            'watch_url' => route('media.show', 'identity-in-christ'),
            'listen_url' => route('media.show', 'identity-in-christ'),
            'description' => 'A message about clarity, calling, and living as people who are shaped by the mission of Jesus.',
        ],
    ]);

    $mediaItems = $sermons->isNotEmpty()
        ? $sermons->values()->map(fn ($sermon, $index) => $mapSermon($sermon, $index))
        : $fallbackMedia;

    $featuredItem = $featuredSermon
        ? $mapSermon($featuredSermon, 0)
        : $mediaItems->first();

    $heroImage = asset('images/slide-1.png');

    $socialLinks = [
        [
            'label' => 'YouTube',
            'handle' => 'CityLifeChurch',
            'href' => '#',
            'classes' => 'bg-[#ff5a4e] text-white shadow-[0_14px_28px_rgba(255,90,78,0.28)]',
            'icon' => 'youtube',
        ],
        [
            'label' => 'Facebook',
            'handle' => 'City Life International',
            'href' => '#',
            'classes' => 'bg-[#2f5bff] text-white shadow-[0_14px_28px_rgba(47,91,255,0.22)]',
            'icon' => 'facebook',
        ],
        [
            'label' => 'Instagram',
            'handle' => '@citylifechurch',
            'href' => '#',
            'classes' => 'bg-gradient-to-r from-[#ff7d45] via-[#f45ca6] to-[#7a5cff] text-white shadow-[0_14px_28px_rgba(244,92,166,0.26)]',
            'icon' => 'instagram',
        ],
        [
            'label' => 'X',
            'handle' => '@CityLifeChurch',
            'href' => '#',
            'classes' => 'bg-[#1f2330] text-white shadow-[0_14px_28px_rgba(31,35,48,0.22)]',
            'icon' => 'x',
        ],
    ];
@endphp

@push('head')
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
@endpush

@section('content')
<div class="bg-[#f6f4ef]">
    <section class="relative overflow-hidden bg-[#131118] pt-16">
        <div class="absolute inset-0">
            <img
                src="{{ $heroImage }}"
                alt="Media and resources"
                class="h-full w-full object-cover object-center opacity-24"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-[#131118]/76 via-[#131118]/74 to-[#131118]"></div>
        </div>

        <div class="relative mx-auto flex min-h-[250px] max-w-6xl flex-col items-center justify-center px-4 py-16 text-center sm:min-h-[280px] sm:px-6 lg:px-8">
            <span class="inline-flex items-center gap-2 rounded-full border border-[#e85d26]/25 bg-[#e85d26]/12 px-4 py-1.5 text-[10px] font-bold uppercase tracking-[0.3em] text-[#ff9b74]">
                Media Centre
            </span>
            <h1 class="mt-5 text-[36px] font-extrabold tracking-tight text-white sm:text-[48px]">Media &amp; Resources</h1>
            <nav class="mt-4 flex items-center gap-2 text-[11px] uppercase tracking-[0.24em] text-white/62">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white">Media</span>
            </nav>
        </div>
    </section>

    {{-- ============================================================
         LIVE BANNER — shown only when a sermon has is_live = true
    ============================================================ --}}
    @if (!empty($liveSermon))
    @php
        $liveChannelId = $liveSermon->youtube_channel_id;
        $liveEmbedUrl  = $liveChannelId
            ? 'https://www.youtube.com/embed/live_stream?channel=' . $liveChannelId . '&autoplay=1'
            : null;
    @endphp
    <section class="bg-[#0f0c14] py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-5 flex items-center gap-3">
                <span class="relative flex h-3 w-3">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-500 opacity-75"></span>
                    <span class="relative inline-flex h-3 w-3 rounded-full bg-red-600"></span>
                </span>
                <span class="text-[11px] font-bold uppercase tracking-[0.28em] text-red-400">We Are Live Now</span>
                <span class="ml-auto text-[12px] text-white/40">{{ $liveSermon->title }}</span>
            </div>
            @if ($liveEmbedUrl)
                <div class="aspect-video w-full overflow-hidden rounded-2xl shadow-[0_24px_60px_rgba(0,0,0,0.5)]">
                    <iframe
                        src="{{ $liveEmbedUrl }}"
                        class="h-full w-full"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                    ></iframe>
                </div>
            @else
                <div class="flex items-center justify-center rounded-2xl border border-red-500/20 bg-red-500/5 py-14 text-center">
                    <div>
                        <p class="text-[16px] font-bold text-white">{{ $liveSermon->title }}</p>
                        <p class="mt-1 text-[13px] text-white/50">{{ $liveSermon->speakerName ?? '' }}</p>
                        @if ($liveSermon->video_url)
                            <a href="{{ $liveSermon->video_url }}" target="_blank" rel="noopener"
                               class="mt-5 inline-flex items-center gap-2 rounded-full bg-red-600 px-6 py-2.5 text-[13px] font-semibold text-white hover:bg-red-700">
                                Watch on YouTube
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </section>
    @endif

    <section class="bg-[#161822] py-9 sm:py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-4 flex items-center gap-2">
                <span class="h-px w-7 bg-[#e85d26]"></span>
                <p class="text-[11px] font-bold uppercase tracking-[0.28em] text-[#e85d26]">Featured This Week</p>
            </div>

            <div class="grid gap-8 lg:grid-cols-[1.02fr_0.98fr] lg:items-center">
                <a
                    href="{{ $featuredItem['watch_url'] }}"
                    class="group relative block overflow-hidden rounded-[14px] bg-[#0f1016] shadow-[0_18px_40px_rgba(0,0,0,0.28)]"
                >
                    <img
                        src="{{ $featuredItem['thumbnail'] }}"
                        alt="{{ $featuredItem['title'] }}"
                        class="h-[238px] w-full object-cover transition-transform duration-700 group-hover:scale-105 sm:h-[290px] lg:h-[262px]"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-black/42 via-black/10 to-transparent"></div>
                    <span class="absolute bottom-4 left-4 rounded-full bg-black/70 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.22em] text-white">
                        {{ $featuredItem['duration'] }}
                    </span>
                    <span class="absolute left-1/2 top-1/2 inline-flex h-14 w-14 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-full bg-[#ff6b3b] text-white shadow-[0_14px_28px_rgba(255,107,59,0.35)] transition-transform duration-300 group-hover:scale-105">
                        <svg class="ml-1 h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </span>
                </a>

                <div class="text-white">
                    <span class="inline-flex rounded-full bg-[#e85d26]/16 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.24em] text-[#ff9d7a]">
                        Latest Sermon
                    </span>
                    <h2 class="mt-4 text-[31px] font-extrabold leading-tight text-white sm:text-[37px]">
                        {{ $featuredItem['title'] }}
                    </h2>
                    <p class="mt-3 text-[12px] font-semibold uppercase tracking-[0.22em] text-white/45">
                        {{ $featuredItem['speaker'] }} · {{ $featuredItem['date'] }}
                    </p>
                    <p class="mt-5 max-w-xl text-sm leading-7 text-white/68 sm:text-[15px]">
                        {{ $featuredItem['description'] }}
                    </p>

                    <div class="mt-7 flex flex-wrap gap-3">
                        <a
                            href="{{ $featuredItem['watch_url'] }}"
                            class="inline-flex items-center gap-2 rounded-full bg-[#ff6b3b] px-5 py-2.5 text-[13px] font-semibold text-white transition-colors hover:bg-[#e85d26]"
                        >
                            Watch Now
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </a>
                        <a
                            href="{{ $featuredItem['listen_url'] }}"
                            class="inline-flex items-center gap-2 rounded-full border border-white/12 bg-white/4 px-5 py-2.5 text-[13px] font-semibold text-white transition-colors hover:border-white/22 hover:bg-white/8"
                        >
                            Listen
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-12 sm:py-14 lg:py-16">
        <div
            x-data="mediaLibrary(@js($mediaItems->values()->all()))"
            class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8"
        >
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex flex-wrap items-center gap-2">
                    <template x-for="tab in tabs" :key="tab.key">
                        <button
                            type="button"
                            @click="setTab(tab.key)"
                            :class="activeTab === tab.key ? 'bg-[#17141a] text-white shadow-[0_10px_22px_rgba(23,20,26,0.14)]' : 'bg-[#f4f0e9] text-[#6f675e] hover:bg-[#ede6dc]'"
                            class="rounded-full px-4 py-2 text-[12px] font-semibold transition-colors"
                        >
                            <span x-text="tab.label"></span>
                        </button>
                    </template>
                </div>

                <div class="relative w-full lg:max-w-[240px]">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#b2a89b]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z"/>
                        </svg>
                    </span>
                    <input
                        x-model.debounce.250ms="search"
                        @input="visibleCount = 6"
                        type="text"
                        placeholder="Search sermons..."
                        class="w-full rounded-full border border-[#efe7dc] bg-[#faf7f2] py-2.5 pl-10 pr-4 text-sm text-[#433d36] outline-none transition-colors focus:border-[#e85d26]"
                    >
                </div>
            </div>

            <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                <template x-for="item in visibleItems" :key="item.id">
                    <article class="overflow-hidden rounded-[14px] border border-[#efe7dc] bg-white shadow-[0_8px_20px_rgba(18,12,15,0.04)]">
                        <a :href="item.watch_url" class="group relative block overflow-hidden">
                            <img
                                :src="item.thumbnail"
                                :alt="item.title"
                                class="h-[172px] w-full object-cover transition-transform duration-700 group-hover:scale-105"
                            >
                            <span class="absolute bottom-4 right-4 rounded-full bg-black/72 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.22em] text-white" x-text="item.duration"></span>
                            <template x-if="item.is_upcoming">
                                <span class="absolute left-3 top-3 inline-flex items-center gap-1.5 rounded-full bg-[#e85d26] px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.18em] text-white shadow">
                                    <svg class="h-2.5 w-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                                    Upcoming
                                </span>
                            </template>
                        </a>

                        <div class="px-4 py-4 sm:px-5">
                            <p class="text-[10px] font-bold uppercase tracking-[0.24em] text-[#e85d26]" x-text="item.tag"></p>
                            <h3 class="mt-2 text-[18px] font-extrabold leading-tight text-[#1f1b22]" x-text="item.title"></h3>
                            <p class="mt-3 text-[12px] text-[#8a8177]" x-text="item.meta"></p>
                            <template x-if="item.is_upcoming && item.upcoming_date">
                                <p class="mt-1 inline-flex items-center gap-1 text-[11px] font-semibold text-[#e85d26]">
                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span x-text="item.upcoming_date"></span>
                                </p>
                            </template>
                        </div>
                    </article>
                </template>
            </div>

            <div x-cloak x-show="filteredItems.length === 0" class="mt-8 rounded-[18px] border border-dashed border-[#e7ddd1] bg-[#fbf8f4] px-6 py-10 text-center">
                <p class="text-lg font-bold text-[#262129]">No media found</p>
                <p class="mt-2 text-sm text-[#7c746a]">Try a different search term or switch back to `All Sermons`.</p>
            </div>

            <div x-cloak x-show="hasMore" class="mt-10 flex justify-center">
                <button
                    type="button"
                    @click="loadMore()"
                    class="inline-flex items-center gap-2 rounded-full border border-[#1d1820]/12 bg-[#faf7f2] px-5 py-2.5 text-[13px] font-semibold text-[#2d262f] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]"
                >
                    Load More Sermons
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <section class="bg-[#f1eee8] py-16 sm:py-18 lg:py-20">
        <div class="mx-auto max-w-5xl px-4 text-center sm:px-6 lg:px-8">
            <div class="mb-3 flex items-center justify-center gap-3">
                <span class="h-px w-10 bg-[#e85d26]"></span>
                <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#e85d26]">Follow Us</p>
                <span class="h-px w-10 bg-[#e85d26]"></span>
            </div>
            <h2 class="text-[34px] font-extrabold leading-tight text-[#25212a] sm:text-[40px]">Connect With Us Online</h2>
            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-[#6b655f] sm:text-[15px]">
                Stay connected with all the latest sermon clips, worship moments, and live updates across our social media platforms.
            </p>

            <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($socialLinks as $social)
                    <a
                        href="{{ $social['href'] }}"
                        class="flex items-center gap-3 rounded-[16px] px-4 py-4 text-left {{ $social['classes'] }}"
                    >
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/16">
                            @if ($social['icon'] === 'youtube')
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M21.8 8.001a2.75 2.75 0 00-1.93-1.945C18.17 5.6 12 5.6 12 5.6s-6.17 0-7.87.456A2.75 2.75 0 002.2 8.001C1.75 9.71 1.75 12 1.75 12s0 2.29.45 3.999a2.75 2.75 0 001.93 1.945C5.83 18.4 12 18.4 12 18.4s6.17 0 7.87-.456a2.75 2.75 0 001.93-1.945c.45-1.709.45-3.999.45-3.999s0-2.29-.45-3.999zM10 14.75v-5.5L15 12l-5 2.75z"/>
                                </svg>
                            @elseif ($social['icon'] === 'facebook')
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13.5 21v-7h2.35l.35-2.75H13.5V9.5c0-.8.22-1.35 1.37-1.35h1.46V5.69A19.1 19.1 0 0014.2 5.5c-2.11 0-3.55 1.29-3.55 3.67v2.08H8.25V14h2.4v7h2.85z"/>
                                </svg>
                            @elseif ($social['icon'] === 'instagram')
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <rect x="3.5" y="3.5" width="17" height="17" rx="5" stroke-width="2"/>
                                    <circle cx="12" cy="12" r="3.75" stroke-width="2"/>
                                    <circle cx="17.3" cy="6.7" r="1.1" fill="currentColor" stroke="none"/>
                                </svg>
                            @else
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.9 3H22l-6.77 7.74L23.2 21h-6.28l-4.92-6.44L6.38 21H3.26l7.24-8.28L.8 3h6.44l4.45 5.88L18.9 3zm-1.1 16.1h1.73L6.3 4.82H4.45L17.8 19.1z"/>
                                </svg>
                            @endif
                        </span>
                        <span>
                            <span class="block text-sm font-bold">{{ $social['label'] }}</span>
                            <span class="mt-1 block text-[12px] opacity-85">{{ $social['handle'] }}</span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('mediaLibrary', (items) => ({
            items,
            activeTab: 'all',
            search: '',
            visibleCount: 6,
            tabs: [
                { key: 'all', label: 'All Sermons' },
                { key: 'podcasts', label: 'Podcasts' },
                { key: 'music', label: 'Music' },
                { key: 'live-streams', label: 'Live Streams' },
            ],

            get filteredItems() {
                const query = this.search.trim().toLowerCase();

                return this.items.filter((item) => {
                    const matchesTab = this.activeTab === 'all' || item.type === this.activeTab;
                    const haystack = [item.title, item.speaker, item.tag, item.meta].join(' ').toLowerCase();
                    const matchesSearch = !query || haystack.includes(query);

                    return matchesTab && matchesSearch;
                });
            },

            get visibleItems() {
                return this.filteredItems.slice(0, this.visibleCount);
            },

            get hasMore() {
                return this.visibleCount < this.filteredItems.length;
            },

            setTab(tab) {
                this.activeTab = tab;
                this.visibleCount = 6;
            },

            loadMore() {
                this.visibleCount += 6;
            },
        }));
    });
</script>
@endpush
