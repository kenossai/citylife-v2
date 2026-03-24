@extends('layouts.app')

@section('title', 'City Life International — A Spiritual Family')

@section('content')

{{-- ============================================================
     HERO SECTION
     ============================================================ --}}
<section class="relative min-h-screen flex items-center overflow-hidden bg-[#0f0f0f]" x-data="heroSlider()">

    {{-- Background slides --}}
    <div class="absolute inset-0 z-0">
        {{-- Slide 1 --}}
        <div x-show="current === 0" x-transition:enter="transition-opacity ease-in-out duration-[1500ms]" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in-out duration-[1500ms]" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/55 to-transparent z-10"></div>
            <img src="{{ asset('images/slide-1.png') }}" alt="Worship" class="w-full h-full object-cover">
        </div>
        {{-- Slide 2 --}}
        <div x-show="current === 1" x-transition:enter="transition-opacity ease-in-out duration-[1500ms]" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in-out duration-[1500ms]" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/55 to-transparent z-10"></div>
            <img src="{{ asset('images/slide-2.png') }}" alt="Community" class="w-full h-full object-cover">
        </div>
        {{-- Slide 3 --}}
        <div x-show="current === 2" x-transition:enter="transition-opacity ease-in-out duration-[1500ms]" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in-out duration-[1500ms]" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/55 to-transparent z-10"></div>
            <img src="{{ asset('images/slide-3.jpg') }}" alt="Praise" class="w-full h-full object-cover">
        </div>
    </div>

    {{-- Per-slide text content --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-32 w-full">
        <div class="relative min-h-[340px] sm:min-h-[320px]">

        {{-- Slide 1 Content --}}
        <div x-show="current === 0"
             x-transition:enter="transition-all ease-in-out duration-[1000ms] delay-[400ms]"
             x-transition:enter-start="opacity-0 translate-y-8"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition-all ease-in-out duration-[600ms]"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="absolute inset-0 max-w-2xl">
            <p class="text-[#e85d26] text-sm font-semibold uppercase tracking-widest mb-3">— Pass It On</p>
            <h1 class="text-white text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                We Are A <span class="text-[#e85d26]">Spiritual</span><br>Family Full Of His Spirit.
            </h1>
            <p class="text-gray-300 text-base sm:text-lg mb-8 max-w-lg leading-relaxed">
                Join us as we grow together in faith, love, and community. Everyone is welcome at City Life International.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ url('/about-citylife') }}" class="inline-flex items-center gap-2 bg-[#e85d26] hover:bg-[#cf4f1e] text-white font-semibold px-6 py-3 rounded-full transition-colors text-sm">
                    Join With Us
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ url('/sermons') }}" class="inline-flex items-center gap-2 text-white border border-white/30 hover:border-white/60 font-semibold px-6 py-3 rounded-full transition-colors text-sm backdrop-blur-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    Watch Online
                </a>
            </div>
        </div>

        {{-- Slide 2 Content --}}
        <div x-show="current === 1"
             x-transition:enter="transition-all ease-in-out duration-[1000ms] delay-[400ms]"
             x-transition:enter-start="opacity-0 translate-y-8"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition-all ease-in-out duration-[600ms]"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="absolute inset-0 max-w-2xl">
            <p class="text-[#e85d26] text-sm font-semibold uppercase tracking-widest mb-3">— Connected in Christ</p>
            <h1 class="text-white text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                Building A <span class="text-[#e85d26]">Community</span><br>That Loves Like Family.
            </h1>
            <p class="text-gray-300 text-base sm:text-lg mb-8 max-w-lg leading-relaxed">
                From small groups to Sunday gatherings, we're a church family rooted in love, prayer, and growing together in faith.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ url('/our-ministry') }}" class="inline-flex items-center gap-2 bg-[#e85d26] hover:bg-[#cf4f1e] text-white font-semibold px-6 py-3 rounded-full transition-colors text-sm">
                    Our Ministries
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ url('/sermons') }}" class="inline-flex items-center gap-2 text-white border border-white/30 hover:border-white/60 font-semibold px-6 py-3 rounded-full transition-colors text-sm backdrop-blur-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    Watch Online
                </a>
            </div>
        </div>

        {{-- Slide 3 Content --}}
        <div x-show="current === 2"
             x-transition:enter="transition-all ease-in-out duration-[1000ms] delay-[400ms]"
             x-transition:enter-start="opacity-0 translate-y-8"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition-all ease-in-out duration-[600ms]"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="absolute inset-0 max-w-2xl">
            <p class="text-[#e85d26] text-sm font-semibold uppercase tracking-widest mb-3">— Sent With Purpose</p>
            <h1 class="text-white text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                Reaching The <span class="text-[#e85d26]">Nations</span><br>One Life At A Time.
            </h1>
            <p class="text-gray-300 text-base sm:text-lg mb-8 max-w-lg leading-relaxed">
                We believe in global impact through local faithfulness — partnering with missions worldwide to spread the love of Christ.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ url('/missions') }}" class="inline-flex items-center gap-2 bg-[#e85d26] hover:bg-[#cf4f1e] text-white font-semibold px-6 py-3 rounded-full transition-colors text-sm">
                    Our Missions
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ url('/sermons') }}" class="inline-flex items-center gap-2 text-white border border-white/30 hover:border-white/60 font-semibold px-6 py-3 rounded-full transition-colors text-sm backdrop-blur-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    Watch Online
                </a>
            </div>
        </div>

        </div>
    </div>

    {{-- Service Times Card --}}
    <div class="absolute bottom-10 right-6 lg:right-16 z-20 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl px-6 py-5 text-white hidden lg:block">
        <p class="text-xs font-semibold uppercase tracking-widest text-[#e85d26] mb-3">Service Times</p>
        <div class="space-y-2 text-sm">
            <div class="flex items-center gap-3">
                <span class="w-2 h-2 rounded-full bg-[#e85d26] flex-shrink-0"></span>
                <span><strong>Sunday</strong> — 9:00 AM &amp; 11:00 AM</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="w-2 h-2 rounded-full bg-yellow-400 flex-shrink-0"></span>
                <span><strong>Wednesday</strong> — 7:00 PM</span>
            </div>
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                <span class="text-gray-300">123 City Life Ave, Your City</span>
            </div>
        </div>
    </div>

    {{-- Prev / Next --}}
    <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 hidden lg:flex w-10 h-10 bg-white/10 hover:bg-white/20 border border-white/20 rounded-full items-center justify-center text-white transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 hidden lg:flex w-10 h-10 bg-white/10 hover:bg-white/20 border border-white/20 rounded-full items-center justify-center text-white transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>

    {{-- Slide Dots --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex gap-2">
        <template x-for="(_, i) in 3" :key="i">
            <button @click="current = i" :class="current === i ? 'bg-[#e85d26] w-6' : 'bg-white/40 w-2'" class="h-2 rounded-full transition-all duration-300"></button>
        </template>
    </div>
</section>

{{-- ============================================================
     ABOUT SECTION
     ============================================================ --}}
<section class="py-0 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2">

            {{-- Image — full-bleed left column, no padding --}}
            <div class="relative h-72 lg:h-auto lg:min-h-[540px]">
                <img src="https://images.unsplash.com/photo-1581056771107-24ca5f033842?w=900&q=80"
                     alt="City Life Church Building"
                     class="absolute inset-0 w-full h-full object-cover">
            </div>

            {{-- Text — padded right column --}}
            <div class="px-8 py-16 lg:px-16 lg:py-20 flex flex-col justify-center">
                <p class="text-[#e85d26] text-sm font-semibold uppercase tracking-widest mb-3">— About Us</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight mb-4">
                    City Life A Vibrant<br>Christian Community
                </h2>
                <p class="text-gray-400 text-xs mb-5 uppercase tracking-wider">Established Since — 10th of February 2004</p>
                <p class="text-gray-600 leading-relaxed mb-4">
                    City Life is a vibrant Christian church in the heart of Sheffield with the purpose to make disciples of Jesus Christ for the transformation of the city.
                </p>
                <p class="text-gray-600 leading-relaxed mb-8">
                    We believe in the heritage of our faith and the vision God has called us towards, helping people encounter God's love every day.
                </p>
                <div>
                    <a href="{{ url('/about-citylife') }}"
                       class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-700 text-white font-semibold px-7 py-3 rounded-full transition-colors text-sm">
                        More About Us
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     MINISTRIES SECTION
     ============================================================ --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-14">
            <p class="text-[#e85d26] text-sm font-semibold uppercase tracking-widest mb-2">Get Involved</p>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-3">Our Ministries</h2>
            <p class="text-gray-500 max-w-md mx-auto">Find your place to serve, grow, and connect with others in our thriving ministries.</p>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @php
            $ministries = [
                ['icon' => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3', 'color' => 'bg-orange-50 text-[#e85d26]', 'name' => 'Worship', 'desc' => 'Experience the presence of God through Spirit-filled praise and worship every Sunday.'],
                ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'color' => 'bg-blue-50 text-blue-600', 'name' => 'Community Groups', 'desc' => 'Connect with others in small groups designed to grow together in faith.'],
                ['icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064', 'color' => 'bg-orange-50 text-[#e85d26]', 'name' => 'Missions', 'desc' => 'We partner with missionaries globally to spread the Gospel to the ends of the earth.'],
                ['icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'color' => 'bg-red-50 text-red-500', 'name' => 'Outreach', 'desc' => 'Serving our city with love and compassion through local outreach initiatives.'],
                ['icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'color' => 'bg-green-50 text-green-600', 'name' => 'Bible Study', 'desc' => 'Deepen your understanding of Scripture through our weekly study sessions.'],
                ['icon' => 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'bg-purple-50 text-purple-600', 'name' => 'Youth & Kids', 'desc' => 'A safe and fun environment for children and teens to discover their faith.'],
            ];
            @endphp

            @foreach($ministries as $ministry)
            <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow group">
                <div class="w-12 h-12 rounded-xl {{ $ministry['color'] }} flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $ministry['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="text-gray-900 font-bold text-base mb-2">{{ $ministry['name'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ $ministry['desc'] }}</p>
                <a href="{{ url('/our-ministry') }}" class="text-[#e85d26] text-sm font-semibold hover:underline inline-flex items-center gap-1">
                    Learn More
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</section>

{{-- ============================================================
     LATEST MESSAGE / SERMONS SECTION
     ============================================================ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- Text --}}
            <div>
                <p class="text-[#e85d26] text-sm font-semibold uppercase tracking-widest mb-2">Latest Message</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight mb-5">
                    Grow in the<br>
                    <span class="text-[#e85d26]">Word of God</span>
                </h2>
                <p class="text-gray-500 italic mb-2 text-sm">"Walking in the Spirit" — Pastor David Williams takes us through Galatians 5 and explores what it means to truly live a Spirit-led life in today's world.</p>
                <p class="text-gray-400 text-xs mb-8 uppercase tracking-wider">March 22, 2026 · Sunday Morning Service</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ url('/sermons') }}"
                       class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-full transition-colors text-sm">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        Watch Sermon
                    </a>
                    <a href="{{ url('/sermons') }}"
                       class="inline-flex items-center gap-2 border-2 border-gray-200 hover:border-gray-400 text-gray-700 font-semibold px-6 py-3 rounded-full transition-colors text-sm">
                        All Messages
                    </a>
                </div>
            </div>

            {{-- Video Thumbnail --}}
            <div class="relative rounded-2xl overflow-hidden shadow-xl group cursor-pointer">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&q=80"
                     alt="Sermon Video"
                     class="w-full h-64 lg:h-80 object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                    <div class="w-16 h-16 bg-white/90 hover:bg-white rounded-full flex items-center justify-center shadow-lg transition-colors">
                        <svg class="w-6 h-6 text-[#e85d26] ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     UPCOMING EVENTS SECTION
     ============================================================ --}}
<section class="bg-white pt-16 pb-0">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-12">
        <p class="text-[#e85d26] text-xs font-bold uppercase tracking-[0.2em] mb-4">Upcoming Events</p>
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight">
            Events To Help<br>Your Christian Journey
        </h2>
    </div>
</section>

<section class="bg-[#eeeefc] py-14">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        @php
        $events = [
            [
                'title'  => 'Good Friday Service',
                'date'   => '28 Mar, 2026',
                'target' => '2026-03-28T19:00:00',
                'image'  => 'https://images.unsplash.com/photo-1519406596751-0a3ccc4937fe?w=800&q=80',
                'slug'   => 'good-friday-service',
            ],
            [
                'title'  => 'Easter Sunday Celebration',
                'date'   => '06 Apr, 2026',
                'target' => '2026-04-06T09:00:00',
                'image'  => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&q=80',
                'slug'   => 'easter-sunday-celebration',
            ],
        ];
        @endphp

        {{-- 2-column event layout, no card wrapper --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            @foreach($events as $event)
            <div x-data="countdown('{{ $event['target'] }}')" class="flex flex-col">

                {{-- Poster image on top --}}
                <div class="w-full h-72 rounded-2xl overflow-hidden shadow-md mb-6">
                    <img src="{{ $event['image'] }}"
                         alt="{{ $event['title'] }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                </div>

                {{-- Info below --}}
                <div>
                    <h3 class="text-xl font-extrabold text-gray-900 uppercase leading-tight mb-2">
                        {{ $event['title'] }}
                    </h3>
                    <p class="text-gray-500 text-sm mb-5">{{ $event['date'] }}</p>

                    {{-- Live countdown --}}
                    <div class="flex gap-2 mb-5">
                        <div class="bg-[#dcdcf8] rounded-xl w-14 py-3 text-center">
                            <p class="text-2xl font-extrabold text-[#5b5fc7] leading-none" x-text="days">00</p>
                            <p class="text-[9px] font-bold text-gray-500 uppercase tracking-wide mt-1">Days</p>
                        </div>
                        <div class="bg-[#dcdcf8] rounded-xl w-14 py-3 text-center">
                            <p class="text-2xl font-extrabold text-[#5b5fc7] leading-none" x-text="hours">00</p>
                            <p class="text-[9px] font-bold text-gray-500 uppercase tracking-wide mt-1">Hours</p>
                        </div>
                        <div class="bg-[#dcdcf8] rounded-xl w-14 py-3 text-center">
                            <p class="text-2xl font-extrabold text-[#5b5fc7] leading-none" x-text="minutes">00</p>
                            <p class="text-[9px] font-bold text-gray-500 uppercase tracking-wide mt-1">Min</p>
                        </div>
                        <div class="bg-[#dcdcf8] rounded-xl w-14 py-3 text-center">
                            <p class="text-2xl font-extrabold text-[#5b5fc7] leading-none" x-text="seconds">00</p>
                            <p class="text-[9px] font-bold text-gray-500 uppercase tracking-wide mt-1">Sec</p>
                        </div>
                    </div>

                    <a href="{{ url('/events/' . $event['slug']) }}"
                       class="inline-flex items-center gap-2 text-gray-800 font-bold text-xs uppercase tracking-widest hover:text-[#e85d26] hover:gap-3 transition-all">
                        View Details
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            @endforeach

        </div>

        {{-- View all CTA --}}
        <div class="mt-12 flex items-center justify-center gap-5">
            <span class="text-gray-700 font-semibold text-sm">View all upcoming events</span>
            <a href="{{ url('/events') }}"
               class="inline-flex items-center gap-2 border-2 border-gray-800 hover:bg-gray-800 hover:text-white text-gray-800 font-bold text-sm uppercase tracking-wider px-6 py-3 rounded-full transition-colors">
                All Events
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

    </div>
</section>

{{-- ============================================================
     MISSIONS SECTION
     ============================================================ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- Text --}}
            <div>
                <p class="text-[#e85d26] text-sm font-semibold uppercase tracking-widest mb-2">Serving Beyond Our Walls</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight mb-5">
                    Missions &<br>
                    <span class="text-[#e85d26]">Outreach</span>
                </h2>
                <p class="text-gray-600 leading-relaxed mb-8">
                    We are called to go beyond our four walls and share the love of Christ with our city and the world. From local food drives to international mission trips, we're actively making a difference.
                </p>

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-6 mb-8">
                    <div>
                        <p class="text-2xl font-extrabold text-[#e85d26]">15+</p>
                        <p class="text-xs text-gray-500 mt-1">Mission Partners</p>
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-[#e85d26]">12</p>
                        <p class="text-xs text-gray-500 mt-1">Countries Reached</p>
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-[#e85d26]">500+</p>
                        <p class="text-xs text-gray-500 mt-1">Families Served</p>
                    </div>
                </div>
                <a href="{{ url('/missions') }}"
                   class="inline-flex items-center gap-2 bg-[#e85d26] hover:bg-[#cf4f1e] text-white font-semibold px-6 py-3 rounded-full transition-colors text-sm">
                    Get Involved
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            {{-- Images Grid --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="row-span-2 rounded-2xl overflow-hidden shadow-md">
                    <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=600&q=80"
                         alt="Missions" class="w-full h-full object-cover">
                </div>
                <div class="rounded-2xl overflow-hidden shadow-md">
                    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=600&q=80"
                         alt="Outreach" class="w-full h-48 object-cover">
                </div>
                <div class="rounded-2xl overflow-hidden shadow-md">
                    <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=600&q=80"
                         alt="Community" class="w-full h-48 object-cover">
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     VOLUNTEER / CTA BANNER
     ============================================================ --}}
<section class="relative py-24 bg-[#111111] overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1600&q=80"
             alt="Volunteer"
             class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-r from-[#111111] via-[#111111]/80 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-stretch">
            <div>
                <p class="text-[#e85d26] text-sm font-semibold uppercase tracking-widest mb-3">Volunteer / Outreach</p>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-6">
                    Serving People.<br>
                    Sharing Hope.<br>
                    Transforming Lives.
                </h2>
                <p class="text-gray-400 leading-relaxed mb-8 max-w-lg">
                    At City Life International Church, we are committed to serving people and communities through faith-filled, compassion-driven support. Through worship, outreach, and community initiatives, we enjoy and share the hope that transforms lives. Together, we make a lasting difference in lives, families, and our city.
                </p>
                <a href="{{ url('/contact') }}"
                   class="inline-flex items-center gap-2 bg-[#e85d26] hover:bg-[#cf4f1e] text-white font-semibold px-6 py-3 rounded-full transition-colors text-sm">
                    Get Involved
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            {{-- Two large images, offset stacked --}}
            <div class="hidden lg:flex items-start gap-5 pt-6">
                <div class="rounded-2xl overflow-hidden shadow-xl flex-1">
                    <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?w=900&q=80"
                         alt="Service" class="w-full h-[580px] object-cover">
                </div>
                <div class="rounded-2xl overflow-hidden shadow-xl flex-1 mt-14">
                    <img src="https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=900&q=80"
                         alt="Helping" class="w-full h-[580px] object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function heroSlider() {
    return {
        current: 0,
        total: 3,
        timer: null,
        init() {
            this.timer = setInterval(() => this.next(), 6000);
        },
        next() {
            this.current = (this.current + 1) % this.total;
        },
        prev() {
            this.current = (this.current - 1 + this.total) % this.total;
        }
    }
}

function countdown(targetDate) {
    return {
        days: '00', hours: '00', minutes: '00', seconds: '00',
        timer: null,
        init() {
            this.tick();
            this.timer = setInterval(() => this.tick(), 1000);
        },
        tick() {
            const diff = new Date(targetDate) - new Date();
            if (diff <= 0) {
                this.days = this.hours = this.minutes = this.seconds = '00';
                clearInterval(this.timer);
                return;
            }
            const pad = n => String(Math.floor(n)).padStart(2, '0');
            this.days    = pad(diff / 86400000);
            this.hours   = pad((diff % 86400000) / 3600000);
            this.minutes = pad((diff % 3600000) / 60000);
            this.seconds = pad((diff % 60000) / 1000);
        }
    }
}
</script>
@endpush
