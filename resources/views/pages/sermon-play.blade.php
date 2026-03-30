@extends('layouts.app')

@php
    // ──────────────────────────────────────────────────────────────
    //  All sermons data
    // ──────────────────────────────────────────────────────────────
    $allSermons = [
        'walking-in-the-spirit' => [
            'title'       => 'Walking In The Spirit',
            'series'      => 'Spirit-Led Life',
            'seriesSlug'  => 'spirit-led-life',
            'seriesColor' => '#e85d26',
            'seriesCount' => 7,
            'speaker'     => 'Pastor James Okafor',
            'speakerRole' => 'City Life International Church',
            'speakerImg'  => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=200&h=200&q=80',
            'date'        => 'Mar 2, 2026',
            'duration'    => '42 min',
            'youtube'     => 'dQw4w9WgXcQ',
            'image'       => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1200&q=80',
            'about'       => 'In this powerful message, Pastor James unpacks what it truly means to be led by the Holy Spirit in every area of your life — from relationships to calling, and everything in between. Drawing from Galatians 5, he shows how the fruit of the Spirit is not a product of effort but a result of surrender.',
            'scripture'   => 'Galatians 5:16-25',
            'topics'      => ['Holy Spirit', 'Christian Living', 'Discipleship'],
            'hasOutline'  => true,
        ],
        'grace-and-truth' => [
            'title'       => 'Grace And Truth',
            'series'      => 'Spirit-Led Life',
            'seriesSlug'  => 'spirit-led-life',
            'seriesColor' => '#e85d26',
            'seriesCount' => 7,
            'speaker'     => 'Pastor James Okafor',
            'speakerRole' => 'City Life International Church',
            'speakerImg'  => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=200&h=200&q=80',
            'date'        => 'Mar 2, 2026',
            'duration'    => '50 min',
            'youtube'     => 'dQw4w9WgXcQ',
            'image'       => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?auto=format&fit=crop&w=1200&q=80',
            'about'       => 'Pastor James explores the beautiful tension between grace and truth as revealed in Jesus Christ. This message challenges the church to hold firmly to both — extending grace to the broken while standing in truth without compromise.',
            'scripture'   => 'John 1:14-17',
            'topics'      => ['Grace', 'Truth', 'Gospel'],
            'hasOutline'  => true,
        ],
        'the-power-of-prayer' => [
            'title'       => 'The Power of Prayer',
            'series'      => 'Foundations',
            'seriesSlug'  => 'foundations',
            'seriesColor' => '#2563eb',
            'seriesCount' => 5,
            'speaker'     => 'Bishop Robert Clarke',
            'speakerRole' => 'City Life International Church',
            'speakerImg'  => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=200&h=200&q=80',
            'date'        => 'Mar 16, 2026',
            'duration'    => '38 min',
            'youtube'     => 'dQw4w9WgXcQ',
            'image'       => 'https://images.unsplash.com/photo-1438232992991-995b7058bbb3?auto=format&fit=crop&w=1200&q=80',
            'about'       => 'Bishop Clarke delivers a stirring call to the prayer life God intended for every believer. He examines the prayer habits of Jesus, the early church and great men and women of faith, showing how prayer is not a religious duty but a powerful weapon and intimate conversation with our Heavenly Father.',
            'scripture'   => 'Matthew 6:5-15',
            'topics'      => ['Prayer', 'Spiritual Disciplines', 'Faith'],
            'hasOutline'  => false,
        ],
        'faith-that-moves-mountains' => [
            'title'       => 'Faith That Moves Mountains',
            'series'      => 'Unshakeable',
            'seriesSlug'  => 'unshakeable',
            'seriesColor' => '#16a34a',
            'seriesCount' => 4,
            'speaker'     => 'Pastor Michael Adisa',
            'speakerRole' => 'City Life International Church',
            'speakerImg'  => 'https://images.unsplash.com/photo-1506277886164-e25aa3f4ef7f?auto=format&fit=crop&w=200&h=200&q=80',
            'date'        => 'Mar 9, 2026',
            'duration'    => '45 min',
            'youtube'     => 'dQw4w9WgXcQ',
            'image'       => 'https://images.unsplash.com/photo-1461378810796-1bd3f1ce3c73?auto=format&fit=crop&w=1200&q=80',
            'about'       => 'What does it take to have faith that literally moves mountains? Pastor Michael explores the nature of bold, audacious faith — the kind that refuses to give up, that stands in the face of impossible circumstances and speaks life. This is a message that will ignite your faith and change how you approach every challenge.',
            'scripture'   => 'Mark 11:22-24',
            'topics'      => ['Faith', 'Miracles', 'Bold Living'],
            'hasOutline'  => true,
        ],
        'the-heart-of-worship' => [
            'title'       => 'The Heart of Worship',
            'series'      => 'Spirit-Led Life',
            'seriesSlug'  => 'spirit-led-life',
            'seriesColor' => '#e85d26',
            'seriesCount' => 7,
            'speaker'     => 'Pastor Grace Mensah',
            'speakerRole' => 'City Life International Church',
            'speakerImg'  => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=200&h=200&q=80',
            'date'        => 'Feb 23, 2026',
            'duration'    => '40 min',
            'youtube'     => 'dQw4w9WgXcQ',
            'image'       => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1200&q=80',
            'about'       => 'Pastor Grace takes us on a journey into the heart of true worship — beyond songs and services, into a lifestyle of surrender and adoration. She reveals how worship transforms the worshipper and invites the presence of God into every situation.',
            'scripture'   => 'John 4:23-24',
            'topics'      => ['Worship', 'Surrender', 'Presence of God'],
            'hasOutline'  => false,
        ],
        'identity-in-christ' => [
            'title'       => 'Identity In Christ',
            'series'      => 'Foundations',
            'seriesSlug'  => 'foundations',
            'seriesColor' => '#2563eb',
            'seriesCount' => 5,
            'speaker'     => 'Bishop Robert Clarke',
            'speakerRole' => 'City Life International Church',
            'speakerImg'  => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=200&h=200&q=80',
            'date'        => 'Feb 16, 2026',
            'duration'    => '48 min',
            'youtube'     => 'dQw4w9WgXcQ',
            'image'       => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?auto=format&fit=crop&w=1200&q=80',
            'about'       => 'Bishop Clarke unpacks one of the most foundational truths of the Christian faith — who you are in Christ. Understanding your identity is the key to walking in freedom, purpose and authority. This message will transform how you see yourself and empower you to live from a place of security.',
            'scripture'   => '2 Corinthians 5:17-21',
            'topics'      => ['Identity', 'Freedom', 'New Creation'],
            'hasOutline'  => true,
        ],
    ];

    $sermon = $allSermons[$slug] ?? abort(404);

    // Build "Up Next" — other sermons excluding current, take 3
    $upNext = collect($allSermons)->except($slug)->take(3);

    // Build "More Messages" — 3 random different sermons
    $moreMessages = collect($allSermons)->except($slug)->shuffle()->take(3);
@endphp

@section('title', $sermon['title'] . ' — City Life International')

@section('content')
<div class="bg-[#f9fafb] text-[#101828]">

    {{-- ============================================================
         HERO — Dark banner with series badge + title
    ============================================================ --}}
    <section class="relative bg-[#111111] pt-16">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <span class="inline-flex h-[28px] items-center gap-1.5 rounded-full px-3.5 text-[11px] font-bold uppercase tracking-[0.08em] text-white" style="background-color: {{ $sermon['seriesColor'] }}">
                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z"/></svg>
                {{ $sermon['series'] }} Series
            </span>
            <h1 class="mt-4 text-[32px] font-extrabold leading-tight text-white sm:text-[40px]">{{ $sermon['title'] }}</h1>
            <a href="{{ route('media') }}" class="mt-3 inline-flex items-center gap-1.5 text-[13px] text-white/50 transition-colors hover:text-white/80">
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Media
            </a>
        </div>
    </section>

    {{-- ============================================================
         VIDEO PLAYER
    ============================================================ --}}
    <section class="bg-[#f9fafb]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" x-data="{ mode: 'watch' }">
            <div class="-mt-0 overflow-hidden rounded-2xl shadow-xl">
                <div class="relative aspect-video w-full bg-black">
                    <iframe
                        src="https://www.youtube.com/embed/{{ $sermon['youtube'] }}?rel=0&modestbranding=1"
                        title="{{ $sermon['title'] }}"
                        class="absolute inset-0 h-full w-full"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                    ></iframe>
                </div>
            </div>

            {{-- Watch / Listen toggle --}}
            <div class="mt-4 flex items-center gap-2">
                <button
                    @click="mode = 'watch'"
                    :class="mode === 'watch' ? 'bg-[#101828] text-white' : 'bg-white text-[#667085] border border-[#e5e7eb]'"
                    class="flex h-9 items-center gap-1.5 rounded-full px-4 text-[13px] font-semibold transition-all"
                >
                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.84A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.27l9.344-5.891a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                    Watch
                </button>
                <button
                    @click="mode = 'listen'"
                    :class="mode === 'listen' ? 'bg-[#101828] text-white' : 'bg-white text-[#667085] border border-[#e5e7eb]'"
                    class="flex h-9 items-center gap-1.5 rounded-full px-4 text-[13px] font-semibold transition-all"
                >
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M12 12h.01M18.364 5.636a9 9 0 010 12.728"/></svg>
                    Listen
                </button>
            </div>
        </div>
    </section>

    {{-- ============================================================
         MAIN CONTENT — Details + Sidebar
    ============================================================ --}}
    <section class="py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="flex flex-col gap-8 lg:flex-row">

                {{-- LEFT — Sermon details --}}
                <div class="flex-1">

                    {{-- About This Message --}}
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="h-[2px] w-5 bg-[#e85d26]"></span>
                            <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">About This Message</h2>
                        </div>
                        <p class="mt-4 text-[14px] leading-[1.8] text-[#667085]">
                            {{ $sermon['about'] }}
                        </p>
                    </div>

                    {{-- Key Scripture --}}
                    <div class="mt-8">
                        <div class="rounded-xl border-l-4 border-[#e85d26] bg-[#fff7ed] px-5 py-4">
                            <p class="text-[11px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">Key Scripture</p>
                            <p class="mt-1 text-[15px] font-semibold text-[#101828]">{{ $sermon['scripture'] }}</p>
                        </div>
                    </div>

                    {{-- Topics --}}
                    <div class="mt-8">
                        <p class="text-[11px] font-bold uppercase tracking-[0.08em] text-[#98a2b3]">Topics</p>
                        <div class="mt-2.5 flex flex-wrap gap-2">
                            @foreach ($sermon['topics'] as $topic)
                                <span class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] bg-white px-3.5 text-[12px] font-medium text-[#667085]">
                                    {{ $topic }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    {{-- Outline download --}}
                    @if ($sermon['hasOutline'])
                        <div class="mt-6">
                            <a href="#" class="inline-flex items-center gap-2 rounded-full border border-[#e5e7eb] bg-white px-4 py-2 text-[13px] font-semibold text-[#101828] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Outline available for download
                            </a>
                        </div>
                    @endif

                    {{-- Share --}}
                    <div class="mt-8 flex flex-wrap items-center gap-2">
                        <span class="flex items-center gap-1.5 text-[12px] text-[#98a2b3]">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                            Share:
                        </span>
                        <a href="#" class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] bg-white px-3 text-[12px] font-medium text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]">Facebook</a>
                        <a href="#" class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] bg-white px-3 text-[12px] font-medium text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]">X / Twitter</a>
                        <a href="#" class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] bg-white px-3 text-[12px] font-medium text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]">WhatsApp</a>
                        <button onclick="navigator.clipboard.writeText(window.location.href)" class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] bg-white px-3 text-[12px] font-medium text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]">Copy Link</button>
                    </div>

                </div>

                {{-- RIGHT — Sidebar --}}
                <div class="w-full shrink-0 space-y-5 lg:w-[300px]">

                    {{-- Speaker --}}
                    <div class="overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm">
                        <div class="border-b border-[#f3f4f6] px-5 py-3">
                            <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#98a2b3]">Speaker</p>
                        </div>
                        <div class="flex items-center gap-3 px-5 py-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full text-[14px] font-bold text-white" style="background-color: {{ $sermon['seriesColor'] }}">
                                {{ substr($sermon['speaker'], 0, 1) }}
                            </div>
                            <div>
                                <p class="text-[14px] font-bold text-[#101828]">{{ $sermon['speaker'] }}</p>
                                <p class="text-[12px] text-[#98a2b3]">{{ $sermon['speakerRole'] }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Part of Series --}}
                    <div class="overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm">
                        <div class="border-b border-[#f3f4f6] px-5 py-3">
                            <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#98a2b3]">Part of Series</p>
                        </div>
                        <div class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-white" style="background-color: {{ $sermon['seriesColor'] }}">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[14px] font-bold text-[#101828]">{{ $sermon['series'] }}</p>
                                    <p class="text-[12px] text-[#98a2b3]">{{ $sermon['seriesCount'] }} messages in series</p>
                                </div>
                            </div>
                            <a href="{{ route('media') }}" class="mt-4 flex h-9 items-center justify-center gap-1.5 rounded-lg border border-[#e5e7eb] text-[12px] font-semibold text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]">
                                View All In Series
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>

                    {{-- Up Next --}}
                    <div class="overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm">
                        <div class="border-b border-[#f3f4f6] px-5 py-3">
                            <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#98a2b3]">Up Next</p>
                        </div>
                        <div class="divide-y divide-[#f3f4f6]">
                            @foreach ($upNext as $nextSlug => $next)
                                <a href="{{ route('media.show', $nextSlug) }}" class="flex items-center gap-3 px-5 py-3.5 transition-colors hover:bg-[#f9fafb]">
                                    <div class="h-11 w-11 shrink-0 overflow-hidden rounded-lg">
                                        <img src="{{ $next['speakerImg'] }}" alt="{{ $next['speaker'] }}" class="h-full w-full object-cover">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-[13px] font-semibold text-[#101828]">{{ $next['title'] }}</p>
                                        <p class="text-[12px] text-[#98a2b3]">{{ $next['duration'] }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================
         MORE MESSAGES
    ============================================================ --}}
    <section class="border-t border-[#f3f4f6] py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="h-[2px] w-5 bg-[#e85d26]"></span>
                    <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">More Messages</h2>
                </div>
                <a href="{{ route('media') }}" class="flex items-center gap-1.5 text-[13px] font-semibold text-[#667085] transition-colors hover:text-[#e85d26]">
                    All Sermons
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($moreMessages as $moreSlug => $more)
                    <a href="{{ route('media.show', $moreSlug) }}" class="group overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm transition-shadow hover:shadow-md">
                        <div class="relative h-[200px] overflow-hidden">
                            <img src="{{ $more['image'] }}" alt="{{ $more['title'] }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute bottom-3 right-3 flex h-[26px] items-center rounded-md bg-black/70 px-2 text-[11px] font-semibold text-white">
                                {{ $more['duration'] }}
                            </div>
                        </div>
                        <div class="px-4 py-4">
                            <span class="text-[11px] font-bold uppercase tracking-[0.06em]" style="color: {{ $more['seriesColor'] }}">{{ $more['series'] }}</span>
                            <h3 class="mt-1 text-[15px] font-bold text-[#101828]">{{ $more['title'] }}</h3>
                            <p class="mt-1 text-[12px] text-[#98a2b3]">{{ $more['speaker'] }} · {{ $more['date'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    

</div>
@endsection
