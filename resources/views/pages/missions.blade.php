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

    $pillars = [
        [
            'number' => '01',
            'title' => 'Church Planting',
            'image' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?auto=format&fit=crop&w=900&q=80',
            'description' => 'We support pastors and pioneering teams who are planting gospel-centred churches in communities that need hope and healthy leadership.',
        ],
        [
            'number' => '02',
            'title' => 'Education & Training',
            'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=80',
            'description' => 'We invest in discipleship, leadership development, and practical training that equips people to flourish spiritually and vocationally.',
        ],
        [
            'number' => '03',
            'title' => 'Food Relief',
            'image' => 'https://images.unsplash.com/photo-1593113598332-cd59a93f7d74?auto=format&fit=crop&w=900&q=80',
            'description' => 'We respond to urgent need through food support, care packages, and trusted relief partnerships that serve families with dignity.',
        ],
        [
            'number' => '04',
            'title' => 'Clean Water Projects',
            'image' => 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?auto=format&fit=crop&w=900&q=80',
            'description' => 'We help fund sustainable water solutions that improve health, reduce vulnerability, and open doors for long-term community transformation.',
        ],
        [
            'number' => '05',
            'title' => 'Community Development',
            'image' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=900&q=80',
            'description' => 'We partner with local leaders and organisations to strengthen families, expand opportunity, and build resilient communities.',
        ],
        [
            'number' => '06',
            'title' => 'Prayer & Evangelism',
            'image' => 'https://images.unsplash.com/photo-1507692049790-de58290a4334?auto=format&fit=crop&w=900&q=80',
            'description' => 'Everything we do is grounded in prayer and a desire to share the love and message of Jesus with humility, clarity, and compassion.',
        ],
    ];

    $partners = [
        ['mark' => 'EC', 'name' => 'Eastgate Collective', 'region' => 'Kenya'],
        ['mark' => 'HM', 'name' => 'Hands of Mercy', 'region' => 'Uganda'],
        ['mark' => 'LT', 'name' => 'Living Truth', 'region' => 'India'],
        ['mark' => 'RW', 'name' => 'Restore Wells', 'region' => 'Tanzania'],
        ['mark' => 'NC', 'name' => 'New Communities', 'region' => 'United Kingdom'],
        ['mark' => 'BF', 'name' => 'Bread for Families', 'region' => 'Romania'],
        ['mark' => 'SS', 'name' => 'Strength to Stand', 'region' => 'Philippines'],
        ['mark' => 'HP', 'name' => 'Hope Partners', 'region' => 'Brazil'],
    ];

    $impactSteps = [
        'Pray regularly for our mission partners, local teams, and the communities they serve.',
        'Give financially so we can support urgent needs and long-term projects with consistency.',
        'Join a local outreach or a global trip and serve practically with humility and purpose.',
        'Offer your skills in mentoring, logistics, healthcare, media, administration, or hospitality.',
        'Help champion the vision by inviting others to serve and support what God is doing through missions.',
    ];
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

        <div class="relative mx-auto flex min-h-[220px] max-w-6xl flex-col items-center justify-center px-4 py-16 text-center sm:min-h-[250px] sm:px-6 lg:px-8">
            <h1 class="text-[34px] font-extrabold tracking-tight text-white sm:text-[42px]">Missions &amp; Outreach</h1>
            <nav class="mt-4 flex items-center gap-2 text-[11px] uppercase tracking-[0.24em] text-white/65">
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
                @foreach ($pillars as $pillar)
                    <article class="overflow-hidden rounded-[14px] border border-[#ede5da] bg-white shadow-[0_10px_28px_rgba(18,12,15,0.06)]">
                        <div class="relative h-36 overflow-hidden">
                            <img
                                src="{{ $pillar['image'] }}"
                                alt="{{ $pillar['title'] }}"
                                class="h-full w-full object-cover"
                            >
                            <span class="absolute left-4 top-4 inline-flex h-8 min-w-8 items-center justify-center rounded-full bg-[#e85d26] px-2 text-[10px] font-extrabold tracking-[0.12em] text-white">
                                {{ $pillar['number'] }}
                            </span>
                        </div>

                        <div class="px-5 py-5">
                            <h3 class="text-lg font-extrabold text-[#1f1b22]">{{ $pillar['title'] }}</h3>
                            <p class="mt-3 text-[13px] leading-6 text-[#6b655f]">{{ $pillar['description'] }}</p>
                            <a href="#make-a-difference" class="mt-4 inline-flex items-center gap-2 text-[11px] font-bold uppercase tracking-[0.22em] text-[#e85d26]">
                                Learn More
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="partners" class="bg-[#1a1b24] py-16 sm:py-18 lg:py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="mb-3 flex items-center justify-center gap-3">
                    <span class="h-px w-10 bg-[#e85d26]"></span>
                    <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#e85d26]">Partnership Network</p>
                    <span class="h-px w-10 bg-[#e85d26]"></span>
                </div>
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-[38px]">Our Global Partners</h2>
                <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-white/62 sm:text-[15px]">
                    We work alongside trusted ministries, churches, and humanitarian teams who are serving with integrity in their local context.
                </p>
            </div>

            <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($partners as $partner)
                    <article class="rounded-[12px] border border-white/8 bg-[#242532] px-5 py-6 text-center">
                        <span class="mx-auto inline-flex h-11 w-11 items-center justify-center rounded-full bg-white/8 text-[11px] font-extrabold uppercase tracking-[0.2em] text-[#ff915f]">
                            {{ $partner['mark'] }}
                        </span>
                        <h3 class="mt-4 text-[13px] font-bold uppercase tracking-[0.18em] text-white">{{ $partner['name'] }}</h3>
                        <p class="mt-1 text-[11px] uppercase tracking-[0.22em] text-white/45">{{ $partner['region'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section id="make-a-difference" class="bg-[#f7f4ef] py-16 sm:py-18 lg:py-20">
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
    </section>

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

    <section class="bg-[#f7f4ef] py-8 sm:py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-full bg-white px-4 py-4 shadow-[0_18px_45px_rgba(18,12,15,0.08)] ring-1 ring-[#efe8de] sm:px-5">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center">
                    <div class="flex items-center gap-3 lg:min-w-[210px]">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#e85d26] text-white">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-extrabold text-[#1c1820]">Subscribe Now</p>
                            <p class="text-xs uppercase tracking-[0.22em] text-[#9b9389]">Mission stories and prayer updates</p>
                        </div>
                    </div>

                    <form class="flex flex-1 flex-col gap-3 sm:flex-row" onsubmit="return false;">
                        <div class="flex flex-1 items-center gap-3 rounded-full border border-[#eee4d8] bg-[#faf6f1] px-4 py-3">
                            <svg class="h-4 w-4 shrink-0 text-[#9e9489]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <input
                                type="email"
                                placeholder="Enter Your Email"
                                class="min-w-0 flex-1 bg-transparent text-sm text-[#433d36] outline-none placeholder:text-[#a8a096]"
                            >
                        </div>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-full bg-[#18151a] px-6 py-3 text-sm font-semibold text-white transition-colors hover:bg-[#e85d26]"
                        >
                            Subscribe Now
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
