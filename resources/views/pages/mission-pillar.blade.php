@extends('layouts.app')

@section('title', $pillar->title . ' — Missions — City Life International')
@section('meta_description', \Illuminate\Support\Str::limit($pillar->description ?? '', 150))

@php
    $pillarImage = $pillar->image_path
        ? \Illuminate\Support\Facades\Storage::url($pillar->image_path)
        : 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?auto=format&fit=crop&w=1800&q=80';

    $hasAboutText = filled($pillar->about_text);

    $galleryImages = is_array($pillar->gallery_images) ? $pillar->gallery_images : [];
@endphp

@section('content')
<div class="bg-white text-[#101828]">

    {{-- ================================================================
         HERO
    ================================================================ --}}
    <section class="relative isolate overflow-hidden bg-[#16131c] pt-16">
        <div class="absolute inset-0">
            <img
                src="{{ $pillarImage }}"
                alt="{{ $pillar->title }}"
                class="h-full w-full object-cover object-center opacity-28"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-[#16131c]/80 via-[#16131c]/75 to-[#16131c]"></div>
        </div>

        <div class="relative mx-auto max-w-6xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="flex flex-wrap items-center gap-2 text-[11px] uppercase tracking-[0.24em] text-white/58">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <a href="{{ route('missions') }}" class="transition-colors hover:text-white">Missions</a>
                <span>/</span>
                <span class="text-white">{{ $pillar->title }}</span>
            </nav>

            <div class="mt-8 grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-end">
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="rounded-full px-3 py-1 text-[10px] font-bold uppercase tracking-[0.24em] {{ $pillar->type === 'home' ? 'bg-emerald-500/15 text-emerald-300' : 'bg-sky-500/15 text-sky-300' }}">
                            {{ $pillar->type === 'home' ? 'Home Mission' : 'Abroad Mission' }}
                        </span>
                    </div>

                    <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-white sm:text-5xl">{{ $pillar->title }}</h1>

                    @if ($pillar->subtitle)
                        <p class="mt-2 text-base font-medium text-[#e85d26]">{{ $pillar->subtitle }}</p>
                    @endif

                    <p class="mt-4 max-w-2xl text-sm leading-7 text-white/72 sm:text-[15px]">
                        {{ \Illuminate\Support\Str::limit($pillar->description, 120) }}
                    </p>

                    @if ($pillar->leaders->isNotEmpty())
                        <div class="mt-6 flex flex-wrap items-center gap-3">
                            <div class="flex -space-x-2">
                                @foreach ($pillar->leaders->take(4) as $leader)
                                    @if ($leader->image_path)
                                        <img
                                            src="{{ $leader->image_path }}"
                                            alt="{{ $leader->name }}"
                                            title="{{ $leader->name }}"
                                            onerror="this.style.display='none';this.nextElementSibling.style.display='inline-flex'"
                                            class="h-8 w-8 rounded-full object-cover ring-2 ring-[#16131c]"
                                        >
                                        <span style="display:none" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-[#e85d26]/20 ring-2 ring-[#16131c] text-[13px] font-bold text-[#e85d26]">
                                            {{ mb_strtoupper(mb_substr($leader->name, 0, 1)) }}
                                        </span>
                                    @else
                                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-[#e85d26]/20 ring-2 ring-[#16131c] text-[13px] font-bold text-[#e85d26]">
                                            {{ mb_strtoupper(mb_substr($leader->name, 0, 1)) }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                            <span class="text-[13px] text-white/60">{{ $pillar->leaders->pluck('name')->join(', ') }}</span>
                        </div>
                    @endif

                    <div class="mt-8">
                        <a
                            href="{{ route('missions') }}"
                            class="inline-flex items-center gap-2 rounded-full border border-white/20 px-6 py-2.5 text-[13px] font-semibold text-white transition-colors hover:border-white hover:bg-white/8"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                            Back to Missions
                        </a>
                    </div>
                </div>

                {{-- Hero Image Card --}}
                <div class="overflow-hidden rounded-[24px] border border-white/10 shadow-[0_24px_70px_rgba(0,0,0,0.28)]">
                    <img
                        src="{{ $pillarImage }}"
                        alt="{{ $pillar->title }}"
                        class="h-[260px] w-full object-cover sm:h-[310px]"
                    >
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================================
         ABOUT
    ================================================================ --}}
    @if ($hasAboutText || $pillar->vision_quote)
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-start">
                {{-- Left: Text --}}
                <div>
                    <div class="mb-4 flex items-center gap-3">
                        <span class="h-px w-8 bg-[#e85d26]"></span>
                        <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">About This Mission</span>
                    </div>
                    <h2 class="text-[30px] font-extrabold leading-tight text-[#101828] sm:text-[38px]">
                        {{ $pillar->title }}
                    </h2>

                    @if ($hasAboutText)
                        <div class="prose prose-sm sm:prose-base mt-6 max-w-none text-[#667085] prose-headings:text-[#101828] prose-a:text-[#e85d26] prose-strong:text-[#101828]">
                            {!! $pillar->about_text !!}
                        </div>
                    @endif
                </div>

                {{-- Right: Vision Quote --}}
                @if ($pillar->vision_quote)
                    <div class="rounded-2xl border-l-4 border-[#e85d26] bg-gradient-to-br from-[#fff7f3] to-[#fff1eb] p-8 shadow-sm">
                        <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-[#e85d26]/10">
                            <svg class="h-5 w-5 text-[#e85d26]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151C7.563 6.068 6 8.789 6 11h4.017v10H0z"/>
                            </svg>
                        </div>
                        <p class="text-[16px] font-semibold leading-relaxed text-[#101828]">
                            "{{ $pillar->vision_quote }}"
                        </p>
                        <div class="mt-5 flex items-center gap-3">
                            <span class="h-px w-6 bg-[#e85d26]"></span>
                            <span class="text-[12px] font-bold uppercase tracking-[0.12em] text-[#e85d26]">Our Vision</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- ================================================================
         GALLERY
    ================================================================ --}}
    @if (!empty($galleryImages))
        <section class="bg-[#f9fafb] py-16 lg:py-24">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="mb-10 text-center">
                    <div class="mb-4 flex items-center justify-center gap-3">
                        <span class="h-px w-8 bg-[#e85d26]"></span>
                        <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">Gallery</span>
                        <span class="h-px w-8 bg-[#e85d26]"></span>
                    </div>
                    <h2 class="text-[30px] font-extrabold leading-tight text-[#101828] sm:text-[38px]">
                        Life On The Ground
                    </h2>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($galleryImages as $image)
                        <div class="group overflow-hidden rounded-2xl">
                            <img
                                src="{{ $image['url'] ?? $image }}"
                                alt="{{ $pillar->title }} gallery"
                                class="h-[220px] w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ================================================================
         LEADERS
    ================================================================ --}}
    @if ($pillar->leaders->isNotEmpty())
    <section class="{{ empty($galleryImages) ? 'bg-[#f9fafb]' : 'bg-white' }} py-16 lg:py-24">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center">
                <div class="mb-4 flex items-center justify-center gap-3">
                    <span class="h-px w-8 bg-[#e85d26]"></span>
                    <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">{{ $pillar->leaders->count() === 1 ? 'Leader In Charge' : 'Leaders In Charge' }}</span>
                    <span class="h-px w-8 bg-[#e85d26]"></span>
                </div>
                <h2 class="text-[30px] font-extrabold leading-tight text-[#101828] sm:text-[38px]">
                    {{ $pillar->leaders->count() === 1 ? 'Meet The Leader' : 'Meet The Leaders' }}
                </h2>
            </div>

            <div class="mx-auto grid gap-6 {{ $pillar->leaders->count() === 1 ? 'max-w-sm' : ($pillar->leaders->count() === 2 ? 'max-w-xl grid-cols-2' : 'max-w-3xl grid-cols-2 sm:grid-cols-3') }}">
                @foreach ($pillar->leaders as $leader)
                    <div class="rounded-2xl border border-[#f3f4f6] bg-white p-6 text-center shadow-sm">
                        @if ($leader->image_path)
                            <img
                                src="{{ $leader->image_path }}"
                                alt="{{ $leader->name }}"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'"
                                class="mx-auto h-24 w-24 rounded-full object-cover ring-4 ring-[#e85d26]/10"
                            >
                            <div style="display:none" class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-[#e85d26]/10 text-3xl font-bold text-[#e85d26]">
                                {{ mb_strtoupper(mb_substr($leader->name, 0, 1)) }}
                            </div>
                        @else
                            <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-[#e85d26]/10 text-3xl font-bold text-[#e85d26]">
                                {{ mb_strtoupper(mb_substr($leader->name, 0, 1)) }}
                            </div>
                        @endif
                        <h3 class="mt-4 text-[16px] font-bold text-[#101828]">{{ $leader->name }}</h3>
                        @if ($leader->role)
                            <p class="mt-1 text-[13px] font-medium text-[#e85d26]">{{ $leader->role }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ================================================================
         OTHER PILLARS
    ================================================================ --}}
    @if ($otherPillars->isNotEmpty())
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center">
                <div class="mb-4 flex items-center justify-center gap-3">
                    <span class="h-px w-8 bg-[#e85d26]"></span>
                    <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">Explore More</span>
                    <span class="h-px w-8 bg-[#e85d26]"></span>
                </div>
                <h2 class="text-[30px] font-extrabold leading-tight text-[#101828] sm:text-[38px]">
                    Other Mission Areas
                </h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($otherPillars as $other)
                    @php
                        $otherImage = $other->image_path
                            ? \Illuminate\Support\Facades\Storage::url($other->image_path)
                            : 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?auto=format&fit=crop&w=900&q=80';
                    @endphp
                    <a
                        href="{{ $other->slug ? route('missions.show', $other->slug) : route('missions') }}"
                        class="group overflow-hidden rounded-2xl bg-white shadow-md transition-shadow hover:shadow-lg"
                    >
                        <div class="relative h-[180px] overflow-hidden">
                            <img
                                src="{{ $otherImage }}"
                                alt="{{ $other->title }}"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            <span class="absolute right-3 top-3 rounded-full px-2.5 py-0.5 text-[9px] font-bold uppercase tracking-widest {{ $other->type === 'home' ? 'bg-emerald-100 text-emerald-700' : 'bg-sky-100 text-sky-700' }}">
                                {{ ucfirst($other->type) }}
                            </span>
                            <div class="absolute bottom-3 left-4 right-4">
                                <h3 class="text-[18px] font-extrabold leading-tight text-white">{{ $other->title }}</h3>
                            </div>
                        </div>
                        <div class="px-5 py-4">
                            <p class="text-[13px] leading-6 text-[#667085] line-clamp-2">{{ $other->description }}</p>
                            <span class="mt-3 inline-flex items-center gap-1.5 text-[12px] font-bold text-[#e85d26] transition-colors group-hover:text-[#cf4f1e]">
                                Learn More
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-10 text-center">
                <a
                    href="{{ route('missions') }}"
                    class="inline-flex items-center gap-2 rounded-full border border-[#d8cfc4] px-6 py-2.5 text-[13px] font-semibold text-[#2b252d] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]"
                >
                    View All Mission Areas
                </a>
            </div>
        </div>
    </section>
    @endif

</div>
@endsection
