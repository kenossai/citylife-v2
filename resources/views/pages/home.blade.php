@extends('layouts.app')

@section('title', 'City Life International — A Spiritual Family')

@section('content')

{{-- ============================================================
     HERO SECTION
     ============================================================ --}}
@if($heroSlides->isNotEmpty())
<section class="relative min-h-screen flex items-center overflow-hidden bg-[#0f0f0f]" x-data="heroSlider({{ $heroSlides->count() }})">

    {{-- Background slides --}}
    <div class="absolute inset-0 z-0">
        @foreach($heroSlides as $i => $slide)
        <div x-show="current === {{ $i }}" x-transition:enter="transition-opacity ease-in-out duration-[1500ms]" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in-out duration-[1500ms]" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/55 to-transparent z-10"></div>
            <img src="{{ asset('storage/' . $slide->image_path) }}" alt="{{ $slide->heading }}" class="w-full h-full object-cover">
        </div>
        @endforeach
    </div>

    {{-- Per-slide text content --}}
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-32 w-full">
        <div class="relative min-h-[340px] sm:min-h-[320px]">

        @foreach($heroSlides as $i => $slide)
        <div x-show="current === {{ $i }}"
             x-transition:enter="transition-all ease-in-out duration-[1000ms] delay-[400ms]"
             x-transition:enter-start="opacity-0 translate-y-8"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition-all ease-in-out duration-[600ms]"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="absolute inset-0 max-w-2xl">
            @if($slide->eyebrow)
            <p class="text-[#e85d26] text-sm font-semibold uppercase tracking-widest mb-3">{{ $slide->eyebrow }}</p>
            @endif
            <h1 class="text-white text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                {!! nl2br(e($slide->heading)) !!}
            </h1>
            @if($slide->description)
            <p class="text-gray-300 text-base sm:text-lg mb-8 max-w-lg leading-relaxed">
                {{ $slide->description }}
            </p>
            @endif
            <div class="flex flex-wrap gap-4">
                <a href="{{ url('/about-citylife') }}" class="inline-flex items-center gap-2 bg-[#e85d26] hover:bg-[#cf4f1e] text-white font-semibold px-6 py-3 rounded-full transition-colors text-sm">
                    Join With Us
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ route('media') }}" class="inline-flex items-center gap-2 text-white border border-white/30 hover:border-white/60 font-semibold px-6 py-3 rounded-full transition-colors text-sm backdrop-blur-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    Watch Online
                </a>
            </div>
        </div>
        @endforeach

        </div>
    </div>

    {{-- Service Times Card --}}
    <div class="absolute bottom-10 right-6 lg:right-16 z-20 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl px-6 py-5 text-white hidden lg:block">
        <p class="text-xs font-semibold uppercase tracking-widest text-[#e85d26] mb-3">Service Times</p>
        <div class="space-y-2 text-sm">
            <div class="flex items-center gap-3">
                <span class="w-2 h-2 rounded-full bg-[#e85d26] flex-shrink-0"></span>
                <span><strong>Sunday</strong> - 10:00 AM - 12:00 PM</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="w-2 h-2 rounded-full bg-yellow-400 flex-shrink-0"></span>
                <span><strong>Thursday Prayer</strong> - 7:30 PM</span>
            </div>
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                <span class="text-gray-300">1 South Parade Shalesmoor, Sheffield, S3 8SS</span>
            </div>
        </div>
    </div>

    {{-- Prev / Next --}}
    @if($heroSlides->count() > 1)
    <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 hidden lg:flex w-10 h-10 bg-white/10 hover:bg-white/20 border border-white/20 rounded-full items-center justify-center text-white transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 hidden lg:flex w-10 h-10 bg-white/10 hover:bg-white/20 border border-white/20 rounded-full items-center justify-center text-white transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>

    {{-- Slide Dots --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex gap-2">
        <template x-for="(_, i) in {{ $heroSlides->count() }}" :key="i">
            <button @click="current = i" :class="current === i ? 'bg-[#e85d26] w-6' : 'bg-white/40 w-2'" class="h-2 rounded-full transition-all duration-300"></button>
        </template>
    </div>
    @endif
</section>
@endif

{{-- ============================================================
     ABOUT SECTION
     ============================================================ --}}
<section class="py-0 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2">

            {{-- Image — full-bleed left column, no padding --}}
            <div class="relative h-72 lg:h-auto lg:min-h-[540px]">
                <img src="{{ $aboutSection->image_path }}"
                     alt="{{ $aboutSection->heading }}"
                     class="absolute inset-0 w-full h-full object-cover">
            </div>

            {{-- Text — padded right column --}}
            <div class="px-8 py-16 lg:px-16 lg:py-20 flex flex-col justify-center">
                <p class="text-[#e85d26] text-sm font-semibold uppercase tracking-widest mb-3">— About Us</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight mb-4">
                    {!! nl2br(e($aboutSection->heading)) !!}
                </h2>
                @if($aboutSection->established_text)
                <p class="text-gray-400 text-xs mb-5 uppercase tracking-wider">Established Since — {{ $aboutSection->established_text }}</p>
                @endif
                @if($aboutSection->body_1)
                <p class="text-gray-600 leading-relaxed mb-4">
                    {{ $aboutSection->body_1 }}
                </p>
                @endif
                @if($aboutSection->body_2)
                <p class="text-gray-600 leading-relaxed mb-8">
                    {{ $aboutSection->body_2 }}
                </p>
                @endif
                @if($aboutSection->btn_text && $aboutSection->btn_url)
                <div>
                    <a href="{{ url($aboutSection->btn_url) }}"
                       class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-700 text-white font-semibold px-7 py-3 rounded-full transition-colors text-sm">
                        {{ $aboutSection->btn_text }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
                @endif
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     MINISTRIES SECTION
     ============================================================ --}}
@if($ministries->isNotEmpty())
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-14">
            <p class="text-[#e85d26] text-sm font-semibold uppercase tracking-widest mb-2">Get Involved</p>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-3">Our Life Groups</h2>
            <p class="text-gray-500 max-w-md mx-auto">Find your place to serve, grow, and connect with others in our thriving life groups.</p>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($ministries as $ministry)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group">
                {{-- @if($ministry->image_path)
                <div class="h-44 overflow-hidden">
                    <img src="{{ $ministry->image_path }}" alt="{{ $ministry->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                @endif --}}
                <div class="p-6">
                    @if($ministry->category_label)
                    <span class="inline-block text-[#e85d26] text-xs font-bold uppercase tracking-wider mb-2">{{ $ministry->category_label }}</span>
                    @endif
                    <h3 class="text-gray-900 font-bold text-base mb-2">{{ $ministry->name }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ Str::limit($ministry->description, 120) }}</p>
                    <a href="{{ route('ministries.show', $ministry->slug) }}" class="text-[#e85d26] text-sm font-semibold hover:underline inline-flex items-center gap-1">
                        Learn More
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('ministries') }}" class="inline-flex items-center gap-2 border-2 border-gray-900 hover:bg-gray-900 hover:text-white text-gray-900 font-bold text-sm uppercase tracking-wider px-7 py-3 rounded-full transition-colors">
                View All Groups
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

    </div>
</section>
@endif

{{-- ============================================================
     LATEST MESSAGE / SERMONS SECTION
     ============================================================ --}}
@if($featuredSermon)
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
                <p class="text-gray-500 italic mb-2 text-sm">"{{ $featuredSermon->title }}" — {{ $featuredSermon->speaker_name }}{{ $featuredSermon->scripture_text ? ' takes us through ' . $featuredSermon->scripture_text : '' }}{{ $featuredSermon->description ? '. ' . Str::limit($featuredSermon->description, 150) : '' }}</p>
                <p class="text-gray-400 text-xs mb-8 uppercase tracking-wider">{{ $featuredSermon->preached_at->format('F j, Y') }}{{ $featuredSermon->service_label ? ' · ' . $featuredSermon->service_label : '' }}</p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ $featuredSermon->slug ? route('media.show', $featuredSermon->slug) : route('media') }}"
                       class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-700 text-white font-semibold px-6 py-3 rounded-full transition-colors text-sm">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        Watch Sermon
                    </a>
                    <a href="{{ route('media') }}"
                       class="inline-flex items-center gap-2 border-2 border-gray-200 hover:border-gray-400 text-gray-700 font-semibold px-6 py-3 rounded-full transition-colors text-sm">
                        All Messages
                    </a>
                </div>
            </div>

            {{-- Video Thumbnail --}}
            <a href="{{ $featuredSermon->slug ? route('media.show', $featuredSermon->slug) : route('media') }}"
               class="relative rounded-2xl overflow-hidden shadow-xl group cursor-pointer block">
                @php
                    $heroThumb = $featuredSermon->thumbnail_path
                        ? (\Illuminate\Support\Str::startsWith($featuredSermon->thumbnail_path, ['http://', 'https://'])
                            ? $featuredSermon->thumbnail_path
                            : asset('storage/' . ltrim($featuredSermon->thumbnail_path, '/')))
                        : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&q=80';
                @endphp
                <img src="{{ $heroThumb }}"
                     alt="{{ $featuredSermon->title }}"
                     class="w-full h-64 lg:h-80 object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                    <div class="w-16 h-16 bg-white/90 hover:bg-white rounded-full flex items-center justify-center shadow-lg transition-colors">
                        <svg class="w-6 h-6 text-[#e85d26] ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ============================================================
     UPCOMING EVENTS SECTION
     ============================================================ --}}
@if($upcomingEvents->isNotEmpty())
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

        {{-- 2-column event layout, no card wrapper --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            @foreach($upcomingEvents as $event)
            <div x-data="countdown('{{ $event->event_at->toIso8601String() }}')" class="flex flex-col">

                {{-- Poster image on top --}}
                <div class="w-full h-72 rounded-2xl overflow-hidden shadow-md mb-6">
                    @php
                        $eventImg = $event->image_path;
                        if ($eventImg && !str_starts_with($eventImg, 'http')) {
                            $eventImg = asset('storage/' . ltrim($eventImg, '/'));
                        }
                    @endphp
                    <img src="{{ $eventImg }}"
                         alt="{{ $event->title }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                </div>

                {{-- Info below --}}
                <div>
                    <h3 class="text-xl font-extrabold text-gray-900 uppercase leading-tight mb-2">
                        {{ $event->title }}
                    </h3>
                    <p class="text-gray-500 text-sm mb-5">{{ $event->event_at->format('d M, Y') }}</p>

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

                    <a href="{{ url('/events/' . $event->slug) }}"
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
@endif

{{-- ============================================================
     MISSIONS SECTION
     ============================================================ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- Text --}}
            <div>
                @if($missionsSection->eyebrow)
                <p class="text-[#e85d26] text-sm font-semibold uppercase tracking-widest mb-2">{{ $missionsSection->eyebrow }}</p>
                @endif
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight mb-5">
                    {!! nl2br(e($missionsSection->heading)) !!}
                </h2>
                @if($missionsSection->description)
                <p class="text-gray-600 leading-relaxed mb-8">
                    {{ $missionsSection->description }}
                </p>
                @endif

                @if($missionsSection->btn_text && $missionsSection->btn_url)
                <a href="{{ url($missionsSection->btn_url) }}"
                   class="inline-flex items-center gap-2 bg-[#e85d26] hover:bg-[#cf4f1e] text-white font-semibold px-6 py-3 rounded-full transition-colors text-sm">
                    {{ $missionsSection->btn_text }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                @endif
            </div>

            {{-- Images Grid --}}
            @if($missionsSection->images && count($missionsSection->images))
            <div class="grid grid-cols-2 gap-4">
                @foreach($missionsSection->images as $i => $image)
                <div class="{{ $i === 0 ? 'row-span-2' : '' }} rounded-2xl overflow-hidden shadow-md">
                    <img src="{{ $image['url'] }}"
                         alt="Missions" class="w-full {{ $i === 0 ? 'h-full' : 'h-full' }} object-cover">
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
</section>

{{-- ============================================================
     VOLUNTEER / CTA BANNER
     ============================================================ --}}
<section class="relative py-24 bg-[#111111] overflow-hidden">
    <div class="absolute inset-0 z-0">
        @if($ctaSection->background_image)
        @php
            $ctaBg = \Illuminate\Support\Str::startsWith($ctaSection->background_image, ['http://', 'https://'])
                ? $ctaSection->background_image
                : asset('storage/' . ltrim($ctaSection->background_image, '/'));
        @endphp
        <img src="{{ $ctaBg }}"
             alt="Volunteer"
             class="w-full h-full object-cover opacity-30">
        @endif
        <div class="absolute inset-0 bg-gradient-to-r from-[#111111] via-[#111111]/80 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-stretch">
            <div>
                @if($ctaSection->eyebrow)
                <p class="text-[#e85d26] text-sm font-semibold uppercase tracking-widest mb-3">{{ $ctaSection->eyebrow }}</p>
                @endif
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-6">
                    {!! nl2br(e($ctaSection->heading)) !!}
                </h2>
                @if($ctaSection->description)
                <p class="text-gray-400 leading-relaxed mb-8 max-w-lg">
                    {{ $ctaSection->description }}
                </p>
                @endif
                @if($ctaSection->btn_text && $ctaSection->btn_url)
                <a href="{{ url($ctaSection->btn_url) }}"
                   class="inline-flex items-center gap-2 bg-[#e85d26] hover:bg-[#cf4f1e] text-white font-semibold px-6 py-3 rounded-full transition-colors text-sm">
                    {{ $ctaSection->btn_text }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                @endif
            </div>

            {{-- Two large images, offset stacked --}}
            @if($ctaSection->side_images && count($ctaSection->side_images) >= 2)
            <div class="hidden lg:flex items-start gap-5 pt-6">
                @foreach(array_slice($ctaSection->side_images, 0, 2) as $sideIndex => $sideImg)
                @php
                    $sideUrl = \Illuminate\Support\Str::startsWith($sideImg['url'], ['http://', 'https://'])
                        ? $sideImg['url']
                        : asset('storage/' . ltrim($sideImg['url'], '/'));
                @endphp
                <div class="rounded-2xl overflow-hidden shadow-xl flex-1{{ $sideIndex === 1 ? ' mt-14' : '' }}">
                    <img src="{{ $sideUrl }}"
                         alt="{{ $sideIndex === 0 ? 'Service' : 'Helping' }}" class="w-full h-[500px] object-cover">
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function heroSlider(total) {
    return {
        current: 0,
        total: total,
        timer: null,
        init() {
            if (this.total > 1) {
                this.timer = setInterval(() => this.next(), 6000);
            }
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
