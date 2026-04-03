@extends('layouts.app')

@php
    $sessionIndex = $allSessions->search(fn ($s) => $s->id === $session->id);
    $prevSession  = $sessionIndex > 0 ? $allSessions[$sessionIndex - 1] : null;
    $nextSession  = $sessionIndex < $allSessions->count() - 1 ? $allSessions[$sessionIndex + 1] : null;
@endphp

@section('title', $session->title . ' — ' . $speaker->name)

@section('content')

<div class="bg-[#f9fafb] text-[#101828]">

    {{-- ============================================================
         BREADCRUMB BAR
    ============================================================ --}}
    <section class="border-b border-[#e5e7eb] bg-white pt-16">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-1.5 text-[13px] text-[#98a2b3]">
                <a href="{{ route('bible-school') }}" class="transition-colors hover:text-[#e85d26]">City Life Bible School</a>
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('bible-school.resources') }}" class="transition-colors hover:text-[#e85d26]">Resources</a>
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('bible-school.resources.show', $speaker->slug) }}" class="transition-colors hover:text-[#e85d26]">{{ $speaker->name }}</a>
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="max-w-[200px] truncate text-[#101828]">{{ $session->title }}</span>
            </nav>

            {{-- Actions --}}
            <div class="hidden items-center gap-2 sm:flex">
                <button class="flex h-9 items-center gap-1.5 rounded-lg border border-[#e5e7eb] bg-white px-3.5 text-[12px] font-semibold text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                    Save
                </button>
                <a href="{{ route('bible-school.resources.show', $speaker->slug) }}" class="flex h-9 items-center gap-1.5 rounded-lg border border-[#e5e7eb] bg-white px-3.5 text-[12px] font-semibold text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================================
         VIDEO PLAYER
    ============================================================ --}}
    <section class="bg-black">
        <div class="mx-auto max-w-7xl">
            <div class="relative aspect-video w-full overflow-hidden">
                <iframe
                    src="https://www.youtube.com/embed/{{ $session->youtube_id }}?rel=0&modestbranding=1"
                    title="{{ $session->title }}"
                    class="absolute inset-0 h-full w-full"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </section>

    {{-- ============================================================
         MAIN CONTENT
    ============================================================ --}}
    <section class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-8 lg:flex-row">

                {{-- LEFT — Session details --}}
                <div class="flex-1">

                    {{-- Meta badges --}}
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="inline-flex h-[26px] items-center rounded-md px-2.5 text-[11px] font-bold uppercase tracking-[0.06em] {{ $session->type === 'video' ? 'bg-[#fff7ed] text-[#e85d26]' : 'bg-[#f0f9ff] text-[#2563eb]' }}">
                            {{ strtoupper($session->type) }}
                        </span>
                        <span class="text-[13px] text-[#98a2b3]">{{ $session->duration }}</span>
                        <span class="text-[13px] text-[#98a2b3]">·</span>
                        <span class="text-[13px] text-[#98a2b3]">{{ $session->year }}</span>
                    </div>

                    {{-- Title --}}
                    <h1 class="mt-4 text-[26px] font-extrabold leading-tight text-[#101828] sm:text-[30px]">
                        {{ $session->title }}
                    </h1>

                    {{-- Scripture reference --}}
                    <div class="mt-3 flex items-center gap-2 text-[14px] text-[#e85d26]">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/></svg>
                        <span class="font-semibold">{{ $session->scripture }}</span>
                    </div>

                    {{-- About --}}
                    <div class="mt-8">
                        <div class="flex items-center gap-2">
                            <span class="h-[2px] w-5 bg-[#e85d26]"></span>
                            <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">About This Session</h2>
                        </div>
                        <p class="mt-4 text-[14px] leading-[1.8] text-[#667085]">
                            {{ $session->about }}
                        </p>
                    </div>

                    {{-- Key Scripture --}}
                    <div class="mt-8">
                        <div class="flex items-center gap-2">
                            <span class="h-[2px] w-5 bg-[#e85d26]"></span>
                            <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">Key Scripture</h2>
                        </div>
                        <div class="mt-4 rounded-2xl border border-[#fde68a]/40 bg-gradient-to-br from-[#fffbeb] to-[#fef3c7]/50 p-6">
                            <div class="flex gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-[#d97706]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                                <p class="text-[15px] font-medium italic leading-relaxed text-[#92400e]">
                                    {{ $session->key_verse }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- RIGHT — Sidebar --}}
                <div class="w-full shrink-0 space-y-5 lg:w-[300px]">

                    {{-- Speaker Card --}}
                    <div class="overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm">
                        {{-- Cover --}}
                        <div class="relative h-[100px] overflow-hidden">
                            <img src="{{ $speaker->cover_image_url }}" alt="" class="h-full w-full object-cover">
                            <div class="absolute inset-0 bg-black/20"></div>
                        </div>
                        {{-- Avatar --}}
                        <div class="-mt-10 px-5">
                            <div class="relative inline-block">
                                <div class="h-[72px] w-[72px] overflow-hidden rounded-xl border-[3px] border-white shadow-md">
                                    <img src="{{ $speaker->image_url }}" alt="{{ $speaker->name }}" class="h-full w-full object-cover object-center">
                                </div>
                            </div>
                        </div>
                        {{-- Info --}}
                        <div class="px-5 pb-5 pt-3">
                            <span class="inline-flex h-[22px] items-center rounded-md bg-[#e85d26] px-2 text-[9px] font-bold uppercase tracking-[0.08em] text-white">
                                {{ $speaker->role }}
                            </span>
                            <h3 class="mt-2 text-[16px] font-bold text-[#101828]">{{ $speaker->name }}</h3>
                            <p class="mt-0.5 text-[12px] text-[#98a2b3]">{{ $speaker->church }}</p>
                            <a href="{{ route('bible-school.resources.show', $speaker->slug) }}" class="mt-4 flex h-9 items-center justify-center gap-1.5 rounded-lg bg-[#e85d26] text-[12px] font-semibold text-white transition-colors hover:bg-[#d14f1e]">
                                <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.84A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.27l9.344-5.891a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                                View All Sessions
                            </a>
                        </div>
                    </div>

                    {{-- Navigate Sessions --}}
                    <div class="overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm">
                        <div class="border-b border-[#f3f4f6] px-5 py-4">
                            <h3 class="text-[13px] font-bold uppercase tracking-[0.06em] text-[#101828]">Navigate Sessions</h3>
                        </div>
                        <div class="divide-y divide-[#f3f4f6]">
                            @if ($prevSession)
                                <a href="{{ route('bible-school.resources.play', [$speaker->slug, $prevSession->slug]) }}" class="flex items-center gap-3 px-5 py-3.5 transition-colors hover:bg-[#f9fafb]">
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-[#f3f4f6] text-[#667085]">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#98a2b3]">Previous</p>
                                        <p class="mt-0.5 truncate text-[13px] font-semibold text-[#101828]">{{ $prevSession->title }}</p>
                                    </div>
                                </a>
                            @else
                                <div class="flex items-center gap-3 px-5 py-3.5 opacity-40">
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-[#f3f4f6] text-[#667085]">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#98a2b3]">Previous</p>
                                        <p class="mt-0.5 text-[13px] text-[#98a2b3]">No previous session</p>
                                    </div>
                                </div>
                            @endif

                            @if ($nextSession)
                                <a href="{{ route('bible-school.resources.play', [$speaker->slug, $nextSession->slug]) }}" class="flex items-center gap-3 px-5 py-3.5 transition-colors hover:bg-[#f9fafb]">
                                    <div class="min-w-0 flex-1 text-right">
                                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#98a2b3]">Next</p>
                                        <p class="mt-0.5 truncate text-[13px] font-semibold text-[#101828]">{{ $nextSession->title }}</p>
                                    </div>
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-[#f3f4f6] text-[#667085]">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </div>
                                </a>
                            @else
                                <div class="flex items-center gap-3 px-5 py-3.5 opacity-40">
                                    <div class="min-w-0 flex-1 text-right">
                                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#98a2b3]">Next</p>
                                        <p class="mt-0.5 text-[13px] text-[#98a2b3]">No next session</p>
                                    </div>
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-[#f3f4f6] text-[#667085]">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- All Speakers --}}
                    <a href="{{ route('bible-school.resources') }}" class="flex items-center justify-center gap-2 rounded-2xl border border-[#f3f4f6] bg-white px-5 py-3.5 text-[13px] font-semibold text-[#667085] shadow-sm transition-colors hover:text-[#e85d26]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        All Speakers
                    </a>

                    {{-- Bible School Home --}}
                    <a href="{{ route('bible-school') }}" class="flex items-center justify-center gap-2 rounded-2xl border border-[#f3f4f6] bg-white px-5 py-3.5 text-[13px] font-semibold text-[#667085] shadow-sm transition-colors hover:text-[#e85d26]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z"/></svg>
                        Bible School Home
                    </a>

                </div>

            </div>
        </div>
    </section>

</div>
@endsection
