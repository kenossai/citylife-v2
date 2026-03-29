@extends('layouts.app')

@section('title', $event['title'] . ' — City Life International')
@section('meta_description', \Illuminate\Support\Str::limit($event['description'], 150))

@php
    $detailCards = [
        [
            'label' => 'Date',
            'value' => $event['weekday'] . ', ' . $event['date_label'],
        ],
        [
            'label' => 'Time',
            'value' => $event['time_label'],
        ],
        [
            'label' => 'Location',
            'value' => $event['location'],
        ],
        [
            'label' => 'Access',
            'value' => $event['badge'],
        ],
    ];
@endphp

@section('content')
<div class="bg-[#f5f1ea]">
    <section class="relative isolate overflow-hidden bg-[#16131c] pt-16">
        <div class="absolute inset-0">
            <img
                src="{{ $event['image'] }}"
                alt="{{ $event['title'] }}"
                class="h-full w-full object-cover object-center opacity-30"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-[#16131c]/82 via-[#16131c]/78 to-[#16131c]"></div>
        </div>

        <div class="relative mx-auto max-w-6xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
            <nav class="flex items-center gap-2 text-[11px] uppercase tracking-[0.24em] text-white/58">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <a href="{{ route('events') }}" class="transition-colors hover:text-white">Events</a>
                <span>/</span>
                <span class="text-white">{{ $event['title'] }}</span>
            </nav>

            <div class="mt-8 grid gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-end">
                <div>
                    <div class="flex flex-wrap gap-2">
                        <span class="rounded-full bg-[#ff784f] px-3 py-1 text-[10px] font-bold uppercase tracking-[0.24em] text-white">
                            {{ $event['category'] }}
                        </span>
                        <span class="rounded-full border border-white/14 bg-white/8 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.24em] text-white">
                            {{ $event['badge'] }}
                        </span>
                    </div>

                    <h1 class="mt-5 text-4xl font-extrabold tracking-tight text-white sm:text-5xl">{{ $event['title'] }}</h1>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-white/72 sm:text-[15px]">
                        {{ $event['description'] }}
                    </p>

                    <div class="mt-7 flex flex-wrap gap-3 text-sm text-white/84">
                        <span class="rounded-full border border-white/12 bg-white/8 px-4 py-2">
                            {{ $event['weekday'] }}, {{ $event['date_label'] }}
                        </span>
                        <span class="rounded-full border border-white/12 bg-white/8 px-4 py-2">
                            {{ $event['time_label'] }}
                        </span>
                        <span class="rounded-full border border-white/12 bg-white/8 px-4 py-2">
                            {{ $event['location'] }}
                        </span>
                    </div>
                </div>

                <div class="overflow-hidden rounded-[28px] border border-white/10 bg-white/6 shadow-[0_24px_70px_rgba(0,0,0,0.22)]">
                    <img
                        src="{{ $event['image'] }}"
                        alt="{{ $event['title'] }}"
                        class="h-[260px] w-full object-cover"
                    >
                </div>
            </div>
        </div>
    </section>

    <section class="pb-16 pt-12 sm:pb-20">
        <div class="mx-auto grid max-w-6xl gap-8 px-4 sm:px-6 lg:grid-cols-[1fr_340px] lg:px-8">
            <div class="rounded-[28px] border border-[#ece1d6] bg-white px-6 py-7 shadow-[0_24px_70px_rgba(17,12,15,0.08)] sm:px-8 sm:py-8">
                <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#ff6d42]">Event Overview</p>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-[#211c24]">What to expect</h2>

                <div class="mt-5 space-y-4 text-sm leading-7 text-[#655e57] sm:text-[15px]">
                    <p>
                        {{ $event['description'] }}
                    </p>
                    <p>
                        Expect heartfelt worship, practical biblical encouragement, and a welcoming atmosphere where people can connect with others and grow in faith together.
                    </p>
                    <p>
                        If this will be your first time with us, arrive a few minutes early and our welcome team will be ready to help you find your way around.
                    </p>
                </div>

                <div class="mt-8 rounded-[24px] bg-[#faf6ef] px-5 py-5">
                    <p class="text-[11px] font-bold uppercase tracking-[0.28em] text-[#a09488]">Need More Info?</p>
                    <p class="mt-3 text-sm leading-7 text-[#655e57]">
                        Reach out to the City Life team before you come and we will help with any questions about parking, accessibility, children, or what your first visit will look like.
                    </p>
                    <a
                        href="mailto:info@citylifeinternational.com"
                        class="mt-4 inline-flex items-center gap-2 rounded-full bg-[#18141d] px-5 py-3 text-[12px] font-bold uppercase tracking-[0.18em] text-white transition-colors hover:bg-[#ff6d42]"
                    >
                        Contact The Team
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            <aside class="space-y-5">
                <div class="rounded-[28px] border border-[#ece1d6] bg-white px-6 py-6 shadow-[0_24px_70px_rgba(17,12,15,0.08)]">
                    <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#ff6d42]">Event Details</p>

                    <div class="mt-5 space-y-4">
                        @foreach ($detailCards as $detail)
                            <div class="rounded-[20px] bg-[#faf6ef] px-4 py-4">
                                <p class="text-[10px] font-bold uppercase tracking-[0.24em] text-[#9a9187]">{{ $detail['label'] }}</p>
                                <p class="mt-2 text-sm font-semibold leading-6 text-[#231f27]">{{ $detail['value'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-[28px] border border-[#ece1d6] bg-[#18141d] px-6 py-6 text-white shadow-[0_24px_70px_rgba(17,12,15,0.12)]">
                    <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#ff8d6a]">Plan Your Visit</p>
                    <p class="mt-4 text-sm leading-7 text-white/70">
                        We would love to welcome you in person. Come a little early, grab a coffee, and let our team help you settle in.
                    </p>
                    <a
                        href="{{ route('events') }}"
                        class="mt-5 inline-flex items-center gap-2 rounded-full bg-white px-5 py-3 text-[12px] font-bold uppercase tracking-[0.18em] text-[#18141d] transition-colors hover:bg-[#ff6d42] hover:text-white"
                    >
                        View All Events
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </aside>
        </div>
    </section>

    <section class="border-t border-[#ece1d6] bg-white py-14 sm:py-16">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#ff6d42]">More To Explore</p>
                    <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-[#211c24]">Other upcoming gatherings</h2>
                </div>
                <a href="{{ route('events') }}" class="text-sm font-semibold text-[#ff6d42] transition-colors hover:text-[#d95b34]">Back to all events</a>
            </div>

            <div class="mt-8 grid gap-5 md:grid-cols-3">
                @foreach ($relatedEvents as $relatedEvent)
                    <a
                        href="{{ $relatedEvent['route'] }}"
                        class="group overflow-hidden rounded-[24px] border border-[#ece1d6] bg-[#faf7f1] transition-transform duration-300 hover:-translate-y-1 hover:shadow-[0_18px_45px_rgba(16,10,14,0.08)]"
                    >
                        <div class="relative h-[210px] overflow-hidden bg-[#17141a]">
                            <img
                                src="{{ $relatedEvent['image'] }}"
                                alt="{{ $relatedEvent['title'] }}"
                                class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/45 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 rounded-[16px] bg-white px-4 py-3 shadow-lg">
                                <p class="text-[10px] font-bold uppercase tracking-[0.24em] text-[#ff6d42]">{{ $relatedEvent['month'] }}</p>
                                <p class="mt-1 text-2xl font-extrabold leading-none text-[#1f1a22]">{{ $relatedEvent['day'] }}</p>
                            </div>
                        </div>

                        <div class="px-5 py-5">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#9a9187]">
                                {{ $relatedEvent['weekday'] }} • {{ $relatedEvent['time_label'] }}
                            </p>
                            <h3 class="mt-3 text-[22px] font-extrabold leading-tight text-[#201c24]">{{ $relatedEvent['title'] }}</h3>
                            <p class="mt-3 text-sm leading-7 text-[#6d655d]">{{ $relatedEvent['description'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
