@extends('layouts.app')

@section('title', 'Our Ministries — City Life International')
@section('meta_description', 'Explore the ministries at City Life International Church. Find your place to belong and grow.')

@section('content')
<div class="bg-white text-[#101828]">

    {{-- ============================================================
         HERO
    ============================================================ --}}
    <section class="relative overflow-hidden pt-16">
        <div class="absolute inset-0">
            <img
                src="https://images.unsplash.com/photo-1438232992991-995b7058bbb3?auto=format&fit=crop&w=1800&q=80"
                alt=""
                class="h-full w-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-[#101828]/80 to-[#101828]/60"></div>
        </div>
        <div class="relative flex min-h-[220px] flex-col items-center justify-center text-center">
            {{-- Badge --}}
            <div class="mb-3 inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 backdrop-blur-sm">
                <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-15.75 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                </svg>
                <span class="text-[12px] font-bold uppercase tracking-[0.15em] text-[#e85d26]">Our Ministries</span>
            </div>

            <h1 class="text-[40px] font-extrabold leading-tight text-white sm:text-[52px]">Ministries</h1>

            {{-- Breadcrumb --}}
            <div class="mt-3 flex items-center gap-2 text-[13px] text-white/60">
                <a href="{{ route('home') }}" class="flex items-center gap-1 transition-colors hover:text-white">
                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z"/></svg>
                    Home
                </a>
                <span>&gt;</span>
                <span class="text-white">Ministries</span>
            </div>
        </div>
    </section>

    {{-- ============================================================
         INTRO
    ============================================================ --}}
    <section class="py-14 lg:py-20">
        <div class="mx-auto max-w-3xl px-4 text-center sm:px-6 lg:px-8">
            {{-- Decorative line + label --}}
            <div class="mb-4 flex items-center justify-center gap-3">
                <span class="h-px w-8 bg-[#e85d26]"></span>
                <span class="text-[12px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">A Place For Everyone</span>
                <span class="h-px w-8 bg-[#e85d26]"></span>
            </div>
            <h2 class="text-[30px] font-extrabold leading-tight text-[#101828] sm:text-[40px]">
                Find Your Place To Belong &amp; Grow
            </h2>
            <p class="mt-5 text-[15px] leading-relaxed text-[#667085]">
                At City Life International Church, we believe every person has a gift, a calling and a place to belong. Our
                ministries exist to help you discover who you are in Christ, connect with others, and make a difference
                in your community and the world.
            </p>
        </div>
    </section>

    {{-- ============================================================
         MINISTRY CARDS GRID
    ============================================================ --}}
    <section class="pb-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

                @foreach ($ministries as $ministry)
                    <div class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-md transition-shadow hover:shadow-lg">

                        {{-- Card Image --}}
                        <div class="relative h-[200px] overflow-hidden">
                            <img
                                src="{{ $ministry->image_path }}"
                                alt="{{ $ministry->name }}"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                            {{-- Category tag --}}
                            @if ($ministry->category_label ?? null)
                                <span class="absolute right-3 top-3 rounded-full bg-[#e85d26] px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-white">
                                    {{ $ministry->category_label }}
                                </span>
                            @endif

                            {{-- Title overlay --}}
                            <div class="absolute bottom-3 left-4 right-4">
                                <h3 class="text-[18px] font-extrabold leading-tight text-white">{{ $ministry->name }}</h3>
                                @if ($ministry->subtitle)
                                    <p class="mt-0.5 text-[12px] font-medium text-white/70">{{ $ministry->subtitle }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- Card Body --}}
                        <div class="flex flex-1 flex-col px-5 pb-5 pt-4">
                            <p class="text-[13px] leading-relaxed text-[#667085] line-clamp-3">
                                {{ $ministry->description }}
                            </p>

                            {{-- Meets & Leader --}}
                            <div class="mt-4 space-y-1.5 border-t border-[#f3f4f6] pt-4 text-[12px]">
                                @if ($ministry->meeting_schedule)
                                    <div class="flex items-start gap-2">
                                        <span class="font-bold text-[#101828]">Meets:</span>
                                        <span class="text-[#667085]">{{ $ministry->meeting_schedule }}</span>
                                    </div>
                                @endif
                                @if ($ministry->leader_name)
                                    <div class="flex items-start gap-2">
                                        <span class="font-bold text-[#101828]">Leader:</span>
                                        <span class="text-[#667085]">{{ $ministry->leader_name }}</span>
                                    </div>
                                @endif
                            </div>

                            {{-- CTA Button --}}
                            <div class="mt-5">
                                <a
                                    href="{{ $ministry->slug ? route('ministries.show', $ministry->slug) : '#' }}"
                                    class="flex w-full items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-[#e85d26] to-[#ff8904] px-5 py-2.5 text-[13px] font-bold text-white transition-opacity hover:opacity-90"
                                >
                                    Learn More
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </section>

</div>
@endsection
