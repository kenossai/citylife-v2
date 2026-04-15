@extends('layouts.app')

@section('title', 'Our Life Groups — City Life International')
@section('meta_description', 'Explore the life groups at City Life International Church. Find your place to belong and grow.')

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
        <div class="relative mx-auto flex min-h-[260px] max-w-7xl flex-col items-center justify-center px-4 py-16 text-center sm:min-h-[300px] sm:px-6 lg:px-8">
            <p class="mb-3 text-[11px] font-semibold uppercase tracking-[0.35em] text-[#e85d26]">Our Life Groups</p>
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl">Life Groups</h1>
            <nav class="mt-4 flex items-center gap-2 text-xs uppercase tracking-[0.24em] text-white/65">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white">Life Groups</span>
            </nav>
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
                life groups exist to help you discover who you are in Christ, connect with others, and make a difference
                in your community and the world.
            </p>
        </div>
    </section>

    {{-- ============================================================
         LIFE GROUP CARDS GRID
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
