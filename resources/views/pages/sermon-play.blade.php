@extends('layouts.app')

@php
    use Illuminate\Support\Str;

    // ── YouTube ID extraction ──────────────────────────────────────
    $youtubeId = null;
    if ($sermon->video_url) {
        preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $sermon->video_url, $m);
        $youtubeId = $m[1] ?? null;
    }

    // ── Thumbnail ─────────────────────────────────────────────────
    $thumbnail = null;
    if ($sermon->thumbnail_path) {
        $thumbnail = Str::startsWith($sermon->thumbnail_path, ['http://', 'https://'])
            ? $sermon->thumbnail_path
            : asset('storage/' . ltrim($sermon->thumbnail_path, '/'));
    } else {
        $thumbnail = asset('images/slide-1.png');
    }

    // ── Speaker info ──────────────────────────────────────────────
    $speakerName  = $sermon->speaker_name;
    $speakerImage = null;
    if ($sermon->leader?->image_path) {
        $path = $sermon->leader->image_path;
        $speakerImage = Str::startsWith($path, ['http://', 'https://'])
            ? $path
            : asset('storage/' . ltrim($path, '/'));
    }

    // ── Notes ─────────────────────────────────────────────────────
    $hasNotesDownload = filled($sermon->notes_path);
    $hasNotesContent  = filled($sermon->notes_content);

    // ── Related sermons thumbnail helper ─────────────────────────
    $relatedThumb = fn ($s) => $s->thumbnail_path
        ? (Str::startsWith($s->thumbnail_path, ['http://', 'https://'])
            ? $s->thumbnail_path
            : asset('storage/' . ltrim($s->thumbnail_path, '/')))
        : asset('images/slide-1.png');
@endphp

@section('title', $sermon->title . ' — City Life International')
@section('meta_description', Str::limit(strip_tags($sermon->description ?? ''), 160))

@section('content')
<div class="bg-[#f9fafb] text-[#101828]">

    {{-- ============================================================
         HERO
    ============================================================ --}}
    <section class="relative bg-[#111111] pt-16">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center gap-2">
                @if ($sermon->series)
                    <span class="inline-flex h-[28px] items-center gap-1.5 rounded-full px-3.5 text-[11px] font-bold uppercase tracking-[0.08em] text-white"
                          style="background-color: {{ $sermon->series->color ?? '#e85d26' }}">
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/></svg>
                        {{ $sermon->series->title }}
                    </span>
                @endif
                @if ($sermon->service_label)
                    <span class="inline-flex h-[28px] items-center gap-1.5 rounded-full bg-white/10 px-3.5 text-[11px] font-bold uppercase tracking-[0.08em] text-white">
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z"/></svg>
                        {{ $sermon->service_label }}
                    </span>
                @endif
            </div>
            <h1 class="mt-4 text-[32px] font-extrabold leading-tight text-white sm:text-[40px]">{{ $sermon->title }}</h1>
            <p class="mt-2 text-[13px] text-white/50">
                {{ $speakerName }}
                @if ($sermon->preached_at)
                    · {{ $sermon->preached_at->format('M j, Y') }}
                @endif
            </p>
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
            <div class="overflow-hidden rounded-2xl shadow-xl">
                <div class="relative aspect-video w-full bg-black">
                    @if ($youtubeId)
                        <iframe
                            src="https://www.youtube.com/embed/{{ $youtubeId }}?rel=0&modestbranding=1"
                            title="{{ $sermon->title }}"
                            class="absolute inset-0 h-full w-full"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                        ></iframe>
                    @elseif ($sermon->video_url)
                        <iframe
                            src="{{ $sermon->video_url }}"
                            title="{{ $sermon->title }}"
                            class="absolute inset-0 h-full w-full"
                            frameborder="0"
                            allowfullscreen
                        ></iframe>
                    @else
                        <div class="absolute inset-0 flex flex-col items-center justify-center gap-3">
                            <img src="{{ $thumbnail }}" alt="{{ $sermon->title }}" class="absolute inset-0 h-full w-full object-cover opacity-30">
                            <div class="relative text-center">
                                <p class="text-[15px] font-semibold text-white">Video not available</p>
                                <p class="mt-1 text-[13px] text-white/50">No video URL has been added for this sermon.</p>
                            </div>
                        </div>
                    @endif
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

                    @if ($sermon->description)
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="h-[2px] w-5 bg-[#e85d26]"></span>
                                <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">About This Message</h2>
                            </div>
                            <p class="mt-4 text-[14px] leading-[1.8] text-[#667085]">
                                {{ $sermon->description }}
                            </p>
                        </div>
                    @endif

                    @if ($hasNotesContent)
                        <div class="mt-8">
                            <div class="flex items-center gap-2">
                                <span class="h-[2px] w-5 bg-[#e85d26]"></span>
                                <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">Sermon Notes</h2>
                            </div>
                            <div class="prose prose-sm mt-4 max-w-none overflow-y-auto max-h-[480px] rounded-xl border border-[#f3f4f6] bg-white px-5 py-4 text-[#667085]">
                                @if ($sermon->notes_format === 'plain')
                                    {!! nl2br(e($sermon->notes_content)) !!}
                                @else
                                    {!! $sermon->notes_content !!}
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ($sermon->scripture)
                        <div class="mt-8">
                            <div class="rounded-xl border-l-4 border-[#e85d26] bg-[#fff7ed] px-5 py-4">
                                <p class="text-[11px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">Key Scripture</p>
                                <p class="mt-1 text-[15px] font-semibold text-[#101828]">{{ $sermon->scripture }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($hasNotesDownload)
                        <div class="mt-6">
                            <a
                                href="{{ asset('storage/' . ltrim($sermon->notes_path, '/')) }}"
                                target="_blank"
                                rel="noopener"
                                class="inline-flex items-center gap-2 rounded-full border border-[#e5e7eb] bg-white px-4 py-2 text-[13px] font-semibold text-[#101828] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]"
                            >
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Download Sermon Notes
                            </a>
                        </div>
                    @endif

                    {{-- Share --}}
                    <div class="mt-8 flex flex-wrap items-center gap-2">
                        <span class="flex items-center gap-1.5 text-[12px] text-[#98a2b3]">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                            Share:
                        </span>
                        @php
                            $shareUrl   = url()->current();
                            $shareTitle = urlencode($sermon->title);
                        @endphp
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank" rel="noopener"
                           class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] bg-white px-3 text-[12px] font-medium text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]">Facebook</a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ $shareTitle }}" target="_blank" rel="noopener"
                           class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] bg-white px-3 text-[12px] font-medium text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]">X / Twitter</a>
                        <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ urlencode($shareUrl) }}" target="_blank" rel="noopener"
                           class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] bg-white px-3 text-[12px] font-medium text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]">WhatsApp</a>
                        <button onclick="navigator.clipboard.writeText(window.location.href)"
                                class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] bg-white px-3 text-[12px] font-medium text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]">Copy Link</button>
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
                            @if ($speakerImage)
                                <img src="{{ $speakerImage }}" alt="{{ $speakerName }}" class="h-10 w-10 shrink-0 rounded-full object-cover">
                            @else
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#e85d26] text-[14px] font-bold text-white">
                                    {{ strtoupper(substr($speakerName, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <p class="text-[14px] font-bold text-[#101828]">{{ $speakerName }}</p>
                                <p class="text-[12px] text-[#98a2b3]">City Life International</p>
                            </div>
                        </div>
                    </div>

                    {{-- Sermon details --}}
                    <div class="overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm">
                        <div class="border-b border-[#f3f4f6] px-5 py-3">
                            <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#98a2b3]">Details</p>
                        </div>
                        <div class="divide-y divide-[#f9fafb] px-5 py-1">
                            @if ($sermon->preached_at)
                                <div class="flex items-center justify-between py-3">
                                    <span class="text-[12px] text-[#98a2b3]">Date</span>
                                    <span class="text-[13px] font-semibold text-[#101828]">{{ $sermon->preached_at->format('M j, Y') }}</span>
                                </div>
                            @endif
                            @if ($sermon->service_label)
                                <div class="flex items-center justify-between py-3">
                                    <span class="text-[12px] text-[#98a2b3]">Service</span>
                                    <span class="text-[13px] font-semibold text-[#101828]">{{ $sermon->service_label }}</span>
                                </div>
                            @endif
                            @if ($sermon->scripture)
                                <div class="flex items-center justify-between py-3">
                                    <span class="text-[12px] text-[#98a2b3]">Scripture</span>
                                    <span class="text-[13px] font-semibold text-[#101828]">{{ $sermon->scripture }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Part of Series --}}
                    @if ($sermon->series)
                        @php
                            $seriesCount = $sermon->series->sermons()->count();
                            $seriesColor = $sermon->series->color ?? '#e85d26';
                        @endphp
                        <div class="overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm">
                            <div class="border-b border-[#f3f4f6] px-5 py-3">
                                <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#98a2b3]">Part of Series</p>
                            </div>
                            <div class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-white"
                                         style="background-color: {{ $seriesColor }}">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-[14px] font-bold text-[#101828]">{{ $sermon->series->title }}</p>
                                        <p class="text-[12px] text-[#98a2b3]">{{ $seriesCount }} {{ Str::plural('message', $seriesCount) }} in series</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Up Next --}}
                    @if ($related->isNotEmpty())
                        <div class="overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm">
                            <div class="border-b border-[#f3f4f6] px-5 py-3">
                                <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#98a2b3]">Up Next</p>
                            </div>
                            <div class="divide-y divide-[#f3f4f6]">
                                @foreach ($related->take(3) as $next)
                                    <a href="{{ route('media.show', $next->slug) }}" class="flex items-center gap-3 px-5 py-3.5 transition-colors hover:bg-[#f9fafb]">
                                        <div class="h-11 w-11 shrink-0 overflow-hidden rounded-lg bg-[#f3f4f6]">
                                            <img src="{{ $relatedThumb($next) }}" alt="{{ $next->title }}" class="h-full w-full object-cover">
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="truncate text-[13px] font-semibold text-[#101828]">{{ $next->title }}</p>
                                            <p class="text-[12px] text-[#98a2b3]">{{ $next->speaker_name }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </section>

    {{-- ============================================================
         MORE MESSAGES
    ============================================================ --}}
    @if ($related->count() > 3)
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
                    @foreach ($related->skip(3)->take(3) as $more)
                        <a href="{{ route('media.show', $more->slug) }}" class="group overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm transition-shadow hover:shadow-md">
                            <div class="relative h-[200px] overflow-hidden">
                                <img src="{{ $relatedThumb($more) }}" alt="{{ $more->title }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                                @if ($more->preached_at)
                                    <div class="absolute bottom-3 right-3 flex h-[26px] items-center rounded-md bg-black/70 px-2 text-[11px] font-semibold text-white">
                                        {{ $more->preached_at->format('M j, Y') }}
                                    </div>
                                @endif
                            </div>
                            <div class="px-4 py-4">
                                @if ($more->service_label)
                                    <span class="text-[11px] font-bold uppercase tracking-[0.06em] text-[#e85d26]">{{ $more->service_label }}</span>
                                @endif
                                <h3 class="mt-1 text-[15px] font-bold text-[#101828]">{{ $more->title }}</h3>
                                <p class="mt-1 text-[12px] text-[#98a2b3]">{{ $more->speaker_name }}@if($more->preached_at) · {{ $more->preached_at->format('M j, Y') }}@endif</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</div>
@endsection
