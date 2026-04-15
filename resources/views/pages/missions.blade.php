@extends('layouts.app')

@section('title', 'Missions & Outreach — City Life International')
@section('meta_description', $missionsSection->description ?: 'Discover how City Life International serves communities locally and globally through missions, outreach, and compassionate action.')

@php
    $missionImages = collect($missionsSection->images ?? [])->pluck('url')->filter()->values();

    $heroImage = $missionImages->get(3) ?: 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=1800&q=80';
    $introImage = $missionImages->get(0) ?: 'https://images.unsplash.com/photo-1521295121783-8a321d551ad2?auto=format&fit=crop&w=1200&q=80';
    $impactImage = $missionImages->get(1) ?: 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?auto=format&fit=crop&w=1200&q=80';
    $tripImage = $missionImages->get(2) ?: 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1600&q=80';

    $introCtaUrl = filled($missionsSection->btn_url) && $missionsSection->btn_url !== '/missions'
        ? $missionsSection->btn_url
        : '#make-a-difference';

    $homePillars   = $pillars->where('type', 'home')->values();
    $abroadPillars = $pillars->where('type', 'abroad')->values();

    $homeCountries   = $countries->where('type', 'home')->values();
    $abroadCountries = $countries->where('type', 'abroad')->values();
@endphp

@section('content')
<div class="bg-[#f6f3ee]">
    <section class="relative overflow-hidden bg-[#141117] pt-16">
        <div class="absolute inset-0">
            <img
                src="{{ $heroImage }}"
                alt="Missions and outreach"
                class="h-full w-full object-cover object-center opacity-32"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-[#141117]/72 via-[#141117]/68 to-[#141117]"></div>
        </div>

        <div class="relative mx-auto flex min-h-[260px] max-w-7xl flex-col items-center justify-center px-4 py-16 text-center sm:min-h-[300px] sm:px-6 lg:px-8">
            <p class="mb-3 text-[11px] font-semibold uppercase tracking-[0.35em] text-[#e85d26]">City Life International</p>
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl">Missions & Outreach</h1>
            <nav class="mt-4 flex items-center gap-2 text-xs uppercase tracking-[0.24em] text-white/65">
                <a href="{{ url('/') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white">Missions</span>
            </nav>
        </div>
    </section>

    <section class="bg-white py-14 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-[1.02fr_0.98fr] lg:items-start">
                <div class="overflow-hidden rounded-[18px] bg-[#ede7de]">
                    <img
                        src="{{ $introImage }}"
                        alt="Mission globe"
                        class="h-[300px] w-full object-cover sm:h-[380px] lg:h-[430px]"
                    >
                </div>

                <div class="rounded-[18px] bg-white px-7 py-8 shadow-[0_18px_45px_rgba(18,12,15,0.10)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9 lg:-ml-10 lg:mt-10">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="h-px w-9 bg-[#e85d26]"></span>
                        <p class="text-[11px] font-bold uppercase tracking-[0.28em] text-[#e85d26]">Our Mission</p>
                    </div>

                    <h2 class="text-3xl font-extrabold leading-[1.06] text-[#222025] sm:text-[40px]">
                        Called To Go.
                        <br>
                        <span class="text-[#e85d26]">Sent To Transform.</span>
                    </h2>

                    <div class="mt-5 space-y-4 text-sm leading-7 text-[#6a645e] sm:text-[15px]">
                        <p>{{ $missionsSection->description ?: 'We are called to go beyond our four walls and share the love of Christ with our city and the world.' }}</p>
                        <p>
                            We believe mission is both local and global. That means serving practical needs, strengthening communities, and walking with people toward lasting hope in Jesus.
                        </p>
                        <p>
                            Through partnerships, prayer, generosity, and hands-on action, we want to be a church that carries compassion beyond Sunday.
                        </p>
                    </div>

                    <div class="mt-7">
                        <a
                            href="{{ $introCtaUrl }}"
                            class="inline-flex items-center gap-2 rounded-full bg-[#17141a] px-5 py-2.5 text-[13px] font-semibold text-white transition-colors hover:bg-[#e85d26]"
                        >
                            {{ $missionsSection->btn_text ?: 'Learn More' }}
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="mission-pillars" class="bg-[#f7f4ef] py-16 sm:py-18 lg:py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="mb-3 flex items-center justify-center gap-3">
                    <span class="h-px w-10 bg-[#e85d26]"></span>
                    <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#e85d26]">How We Serve</p>
                    <span class="h-px w-10 bg-[#e85d26]"></span>
                </div>
                <h2 class="text-3xl font-extrabold tracking-tight text-[#25212a] sm:text-[38px]">Our Mission Pillars</h2>
            </div>

            <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($pillars as $pillar)
                    @php
                        $pillarImage = $pillar->image_path
                            ? \Illuminate\Support\Facades\Storage::url($pillar->image_path)
                            : 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?auto=format&fit=crop&w=900&q=80';
                    @endphp
                    @if ($pillar->slug)
                    <a href="{{ route('missions.show', $pillar->slug) }}" class="group block">
                    @else
                    <div class="group">
                    @endif
                    <article class="overflow-hidden rounded-[14px] border border-[#ede5da] bg-white shadow-[0_10px_28px_rgba(18,12,15,0.06)] transition-shadow duration-300 group-hover:shadow-[0_16px_40px_rgba(18,12,15,0.13)]">
                        <div class="relative h-36 overflow-hidden">
                            <img
                                src="{{ $pillarImage }}"
                                alt="{{ $pillar->title }}"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >

                            <span class="absolute right-3 top-3 rounded-full px-2 py-0.5 text-[9px] font-bold uppercase tracking-widest {{ $pillar->type === 'home' ? 'bg-emerald-100 text-emerald-700' : 'bg-sky-100 text-sky-700' }}">
                                {{ ucfirst($pillar->type) }}
                            </span>
                        </div>

                        <div class="px-5 py-5">
                            <h3 class="text-lg font-extrabold text-[#1f1b22]">{{ $pillar->title }}</h3>
                            <p class="mt-2 text-[13px] leading-6 text-[#6b655f]">{{ \Illuminate\Support\Str::limit($pillar->description, 110) }}</p>
                            @if ($pillar->leaders->isNotEmpty())
                                <div class="mt-4 flex flex-wrap items-center gap-2">
                                    @foreach ($pillar->leaders->take(3) as $leader)
                                        @if ($leader->image_path)
                                            <img
                                                src="{{ \Illuminate\Support\Facades\Storage::url($leader->image_path) }}"
                                                alt="{{ $leader->name }}"
                                                title="{{ $leader->name }}"
                                                class="h-6 w-6 rounded-full object-cover ring-2 ring-white"
                                            >
                                        @endif
                                    @endforeach
                                    <span class="text-[11px] text-[#9a8f87]">{{ $pillar->leaders->pluck('name')->join(', ') }}</span>
                                </div>
                            @endif
                            @if ($pillar->slug)
                                <span class="mt-4 inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-[0.22em] text-[#e85d26] group-hover:underline">
                                    Learn More
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </span>
                            @endif
                        </div>
                    </article>
                    @if ($pillar->slug)
                    </a>
                    @else
                    </div>
                    @endif
                @empty
                    <p class="col-span-3 py-6 text-center text-sm text-[#9a938c]">No mission pillars have been added yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section id="partners" class="bg-[#1a1b24] py-16 sm:py-18 lg:py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="mb-3 flex items-center justify-center gap-3">
                    <span class="h-px w-10 bg-[#e85d26]"></span>
                    <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#e85d26]">Where We Serve</p>
                    <span class="h-px w-10 bg-[#e85d26]"></span>
                </div>
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-[38px]">Our Mission Countries</h2>
                <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-white/62 sm:text-[15px]">
                    We are currently active on the ground across {{ $countries->count() }} {{ $countries->count() === 1 ? 'nation' : 'nations' }}, bringing the gospel and practical support to communities in need.
                </p>
            </div>

            <div class="mt-10 grid gap-4 sm:grid-cols-2 max-w-xl mx-auto w-full">
                @forelse ($countries as $country)
                    <article class="rounded-[12px] border border-white/8 bg-[#242532] px-5 py-6 text-center">
                        @if ($country->flag)
                            <span class="mx-auto flex h-14 w-14 items-center justify-center text-4xl">
                                {{ $country->flag }}
                            </span>
                        @endif
                        <h3 class="mt-4 text-[13px] font-bold uppercase tracking-[0.18em] text-white">{{ $country->name }}</h3>
                        @if ($country->region)
                            <p class="mt-1 text-[11px] uppercase tracking-[0.22em] text-white/45">{{ $country->region }}</p>
                        @endif
                        <span class="mt-2 inline-block rounded-full px-2 py-0.5 text-[9px] font-bold uppercase tracking-widest {{ $country->type === 'home' ? 'bg-emerald-900/60 text-emerald-300' : 'bg-sky-900/60 text-sky-300' }}">
                            {{ ucfirst($country->type) }}
                        </span>
                    </article>
                @empty
                    <p class="col-span-2 py-4 text-center text-sm text-white/40">No mission countries have been added yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- <section id="make-a-difference" class="bg-[#f7f4ef] py-16 sm:py-18 lg:py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-[1.02fr_0.98fr] lg:items-start">
                <div class="overflow-hidden rounded-[18px] bg-[#e6e0d7]">
                    <img
                        src="{{ $impactImage }}"
                        alt="Volunteers making a difference"
                        class="h-[320px] w-full object-cover sm:h-[400px] lg:h-[430px]"
                    >
                </div>

                <div class="rounded-[18px] bg-white px-7 py-8 shadow-[0_18px_45px_rgba(18,12,15,0.10)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9 lg:-ml-10 lg:mt-10">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="h-px w-9 bg-[#e85d26]"></span>
                        <p class="text-[11px] font-bold uppercase tracking-[0.28em] text-[#e85d26]">Take Action</p>
                    </div>

                    <h2 class="text-3xl font-extrabold leading-[1.06] text-[#222025] sm:text-[40px]">
                        How You Can
                        <br>
                        <span class="text-[#e85d26]">Make A Difference</span>
                    </h2>

                    <div class="mt-6 space-y-3">
                        @foreach ($impactSteps as $step)
                            <div class="flex items-start gap-3">
                                <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#fff1ea] text-[#e85d26]">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </span>
                                <p class="text-[13px] leading-6 text-[#6a645e] sm:text-[15px]">{{ $step }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-7 flex flex-wrap gap-3">
                        <a
                            href="#mission-trip"
                            class="inline-flex items-center gap-2 rounded-full bg-[#e85d26] px-5 py-2.5 text-[13px] font-semibold text-white transition-colors hover:bg-[#cf4f1e]"
                        >
                            Donate Now
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>

                        <a
                            href="#mission-trip"
                            class="inline-flex items-center gap-2 rounded-full border border-[#d8cfc4] px-5 py-2.5 text-[13px] font-semibold text-[#2b252d] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]"
                        >
                            View Mission Trips
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section id="mission-trip" class="relative overflow-hidden bg-[#151217] py-16 sm:py-18 lg:py-20">
        <div class="absolute inset-0">
            <img
                src="{{ $tripImage }}"
                alt="Mission trip team"
                class="h-full w-full object-cover opacity-30"
            >
            <div class="absolute inset-0 bg-gradient-to-r from-[#141117]/90 via-[#141117]/84 to-[#141117]/90"></div>
        </div>

        <div class="relative mx-auto max-w-6xl px-4 text-center sm:px-6 lg:px-8">
            <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#ff8d63]">Upcoming Opportunity</p>
            <h2 class="mt-4 text-3xl font-extrabold leading-tight text-white sm:text-[40px]">
                Join Our Next
                <br class="hidden sm:block">
                Mission Trip - 2026
            </h2>
            <p class="mx-auto mt-5 max-w-2xl text-sm leading-7 text-white/68 sm:text-[15px]">
                Travel with a team, serve alongside local partners, and take part in meaningful ministry that strengthens communities and grows your faith.
            </p>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                <a
                    href="#make-a-difference"
                    class="inline-flex items-center gap-2 rounded-full bg-[#e85d26] px-5 py-2.5 text-[13px] font-semibold text-white transition-colors hover:bg-[#cf4f1e]"
                >
                    Join Now
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a
                    href="#partners"
                    class="inline-flex items-center gap-2 rounded-full border border-white/20 px-5 py-2.5 text-[13px] font-semibold text-white transition-colors hover:border-white hover:bg-white/8"
                >
                    View Partner List
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
