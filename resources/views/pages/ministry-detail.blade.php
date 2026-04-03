@extends('layouts.app')

@section('title', $ministry->name . ' Ministry — City Life International')
@section('meta_description', \Illuminate\Support\Str::limit($ministry->description ?? '', 150))

@php
    $aboutParagraphs = $ministry->about_text
        ? array_filter(explode("\n\n", $ministry->about_text))
        : [];

    $galleryImages = is_array($ministry->gallery_images) ? $ministry->gallery_images : [];

    $leaderName  = $ministry->leader?->name       ?? $ministry->leader_name;
    $leaderRole  = $ministry->leader?->role       ?? $ministry->leader_role;
    $leaderImage = $ministry->leader?->image_path ?? $ministry->leader_image;
@endphp

@section('content')
<div class="bg-white text-[#101828]">

    {{-- ================================================================
         HERO
    ================================================================ --}}
    <section class="relative isolate overflow-hidden bg-[#16131c] pt-16">
        <div class="absolute inset-0">
            @if($ministry->image_path)
            <img
                src="{{ $ministry->image_path }}"
                alt="{{ $ministry->name }}"
                class="h-full w-full object-cover object-center opacity-30"
            >
            @endif
            <div class="absolute inset-0 bg-gradient-to-b from-[#16131c]/80 via-[#16131c]/75 to-[#16131c]"></div>
        </div>

        <div class="relative mx-auto max-w-6xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-[11px] uppercase tracking-[0.24em] text-white/58">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <a href="{{ route('ministries') }}" class="transition-colors hover:text-white">Ministries</a>
                <span>/</span>
                <span class="text-white">{{ $ministry->name }}</span>
            </nav>

            <div class="mt-8 grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-end">
                <div>
                    @if($ministry->category_label)
                        <div class="flex flex-wrap gap-2">
                            <span class="rounded-full border border-white/14 bg-white/8 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.24em] text-white">
                                {{ $ministry->category_label }}
                            </span>
                        </div>
                    @endif

                    {{-- Title & Subtitle --}}
                    <h1 class="mt-5 text-4xl font-extrabold tracking-tight text-white sm:text-5xl">{{ $ministry->name }}</h1>
                    @if ($ministry->subtitle)
                        <p class="mt-2 text-base font-medium text-[#e85d26]">{{ $ministry->subtitle }}</p>
                    @endif

                    @if($ministry->description)
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-white/72 sm:text-[15px]">
                        {{ $ministry->description }}
                    </p>
                    @endif

                    {{-- Quick Info Pills --}}
                    <div class="mt-7 flex flex-wrap gap-3 text-sm text-white/84">
                        @if ($ministry->meeting_schedule)
                            <span class="inline-flex items-center gap-2 rounded-full border border-white/12 bg-white/8 px-4 py-2">
                                <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $ministry->meeting_schedule }}
                            </span>
                        @endif
                        @if ($ministry->location)
                            <span class="inline-flex items-center gap-2 rounded-full border border-white/12 bg-white/8 px-4 py-2">
                                <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                {{ $ministry->location }}
                            </span>
                        @endif
                        @if ($leaderName)
                            <span class="inline-flex items-center gap-2 rounded-full border border-white/12 bg-white/8 px-4 py-2">
                                <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                {{ $leaderName }}
                            </span>
                        @endif
                    </div>

                    {{-- CTA Button --}}
                    <div class="mt-8">
                        <a
                            href="#connect"
                            class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#e85d26] to-[#ff8904] px-7 py-3.5 text-sm font-bold text-white shadow-lg transition-opacity hover:opacity-90"
                        >
                            Connect Now
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Hero Image Card --}}
                @if($ministry->image_path)
                <div class="overflow-hidden rounded-[28px] border border-white/10 bg-white/6 shadow-[0_24px_70px_rgba(0,0,0,0.22)]">
                    <img
                        src="{{ $ministry->image_path }}"
                        alt="{{ $ministry->name }}"
                        class="h-[280px] w-full object-cover sm:h-[320px]"
                    >
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ================================================================
         WHO WE ARE — About Section
    ================================================================ --}}
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-start">
                {{-- Left: Text --}}
                <div>
                    <div class="mb-4 flex items-center gap-3">
                        <span class="h-px w-8 bg-[#e85d26]"></span>
                        <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">Who We Are</span>
                    </div>
                    <h2 class="text-[30px] font-extrabold leading-tight text-[#101828] sm:text-[38px]">
                        About {{ $ministry->name }}
                    </h2>

                    <div class="mt-6 space-y-4 text-[15px] leading-relaxed text-[#667085]">
                        @foreach ($aboutParagraphs as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>

                {{-- Right: Vision Quote Card --}}
                @if ($ministry->vision_quote)
                    <div class="rounded-2xl border-l-4 border-[#e85d26] bg-gradient-to-br from-[#fff7f3] to-[#fff1eb] p-8 shadow-sm">
                        <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-[#e85d26]/10">
                            <svg class="h-5 w-5 text-[#e85d26]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151C7.563 6.068 6 8.789 6 11h4.017v10H0z"/>
                            </svg>
                        </div>
                        <p class="text-[16px] font-semibold leading-relaxed text-[#101828]">
                            "{{ $ministry->vision_quote }}"
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

    {{-- ================================================================
         GALLERY — Life In Worship
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
                        Life In {{ $ministry->name }}
                    </h2>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($galleryImages as $image)
                        <div class="group overflow-hidden rounded-2xl">
                            <img
                                src="{{ $image }}"
                                alt="{{ $ministry->name }} gallery"
                                class="h-[220px] w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ================================================================
         MINISTRY LEADER
    ================================================================ --}}
    @if ($leaderName)
    <section class="bg-[#f9fafb] py-16 lg:py-24">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center">
                <div class="mb-4 flex items-center justify-center gap-3">
                    <span class="h-px w-8 bg-[#e85d26]"></span>
                    <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">Our Leader</span>
                    <span class="h-px w-8 bg-[#e85d26]"></span>
                </div>
                <h2 class="text-[30px] font-extrabold leading-tight text-[#101828] sm:text-[38px]">
                    Meet The Leader
                </h2>
            </div>

            <div class="mx-auto max-w-sm">
                <div class="rounded-2xl border border-[#f3f4f6] bg-white p-6 text-center shadow-sm">
                    @if ($leaderImage)
                        <img
                            src="{{ $leaderImage }}"
                            alt="{{ $leaderName }}"
                            class="mx-auto h-24 w-24 rounded-full object-cover ring-4 ring-[#e85d26]/10"
                        >
                    @endif
                    <h3 class="mt-4 text-[16px] font-bold text-[#101828]">{{ $leaderName }}</h3>
                    @if ($leaderRole)
                        <p class="mt-1 text-[13px] font-medium text-[#e85d26]">{{ $leaderRole }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ================================================================
         READY TO JOIN — Connect Form
    ================================================================ --}}
    <section id="connect" class="relative overflow-hidden bg-[#16131c] py-16 lg:py-24">
        @if($ministry->image_path)
        <div class="absolute inset-0 opacity-10">
            <img src="{{ $ministry->image_path }}" alt="" class="h-full w-full object-cover">
        </div>
        @endif
        <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                {{-- Left: Info --}}
                <div>
                    <div class="mb-4 flex items-center gap-3">
                        <span class="h-px w-8 bg-[#e85d26]"></span>
                        <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">Get Involved</span>
                    </div>
                    <h2 class="text-[30px] font-extrabold leading-tight text-white sm:text-[40px]">
                        Ready To Join {{ $ministry->name }}?
                    </h2>
                    <p class="mt-4 text-[15px] leading-relaxed text-white/60">
                        We'd love to have you on the team! Fill in the form and one of our leaders will get in touch with you to help you get started.
                    </p>

                    <div class="mt-8 space-y-4">
                        @if ($ministry->meeting_schedule)
                            <div class="flex items-center gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/8">
                                    <svg class="h-5 w-5 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[12px] font-bold uppercase tracking-wider text-white/40">Schedule</p>
                                    <p class="text-sm text-white/80">{{ $ministry->meeting_schedule }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($ministry->location)
                            <div class="flex items-center gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/8">
                                    <svg class="h-5 w-5 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[12px] font-bold uppercase tracking-wider text-white/40">Location</p>
                                    <p class="text-sm text-white/80">{{ $ministry->location }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($leaderName)
                            <div class="flex items-center gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/8">
                                    <svg class="h-5 w-5 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[12px] font-bold uppercase tracking-wider text-white/40">Leader</p>
                                    <p class="text-sm text-white/80">{{ $leaderName }}@if ($leaderRole) · {{ $leaderRole }}@endif</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Right: Form Card --}}
                <div class="rounded-2xl border border-white/10 bg-white/5 p-8 backdrop-blur-sm">
                    <h3 class="text-xl font-bold text-white">Connect With Us</h3>
                    <p class="mt-1 text-[13px] text-white/50">Fill in your details and we'll reach out to you.</p>

                    <form class="mt-6 space-y-4" onsubmit="return false;">
                        <div>
                            <label class="mb-1.5 block text-[12px] font-semibold uppercase tracking-wider text-white/60">Full Name</label>
                            <input
                                type="text"
                                placeholder="Your full name"
                                class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-white/30 outline-none transition focus:border-[#e85d26] focus:ring-1 focus:ring-[#e85d26]"
                            >
                        </div>
                        <div>
                            <label class="mb-1.5 block text-[12px] font-semibold uppercase tracking-wider text-white/60">Email Address</label>
                            <input
                                type="email"
                                placeholder="your@email.com"
                                class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-white/30 outline-none transition focus:border-[#e85d26] focus:ring-1 focus:ring-[#e85d26]"
                            >
                        </div>
                        <div>
                            <label class="mb-1.5 block text-[12px] font-semibold uppercase tracking-wider text-white/60">Phone Number</label>
                            <input
                                type="tel"
                                placeholder="+44 7000 000 000"
                                class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-white/30 outline-none transition focus:border-[#e85d26] focus:ring-1 focus:ring-[#e85d26]"
                            >
                        </div>
                        <div>
                            <label class="mb-1.5 block text-[12px] font-semibold uppercase tracking-wider text-white/60">Message</label>
                            <textarea
                                rows="3"
                                placeholder="Tell us a bit about yourself…"
                                class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-white/30 outline-none transition focus:border-[#e85d26] focus:ring-1 focus:ring-[#e85d26]"
                            ></textarea>
                        </div>
                        <button
                            type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-[#e85d26] to-[#ff8904] px-6 py-3.5 text-sm font-bold text-white shadow-lg transition-opacity hover:opacity-90"
                        >
                            Submit
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================================
         OTHER MINISTRIES
    ================================================================ --}}
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center">
                <div class="mb-4 flex items-center justify-center gap-3">
                    <span class="h-px w-8 bg-[#e85d26]"></span>
                    <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">Explore More</span>
                    <span class="h-px w-8 bg-[#e85d26]"></span>
                </div>
                <h2 class="text-[30px] font-extrabold leading-tight text-[#101828] sm:text-[38px]">
                    Other Ministries
                </h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($otherMinistries as $other)
                    <a
                        href="{{ route('ministries.show', $other->slug ?? '#') }}"
                        class="group overflow-hidden rounded-2xl bg-white shadow-md transition-shadow hover:shadow-lg"
                    >
                        <div class="relative h-[180px] overflow-hidden">
                            <img
                                src="{{ $other->image_path }}"
                                alt="{{ $other->name }}"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                            @if ($other->category_label)
                                <span class="absolute right-3 top-3 rounded-full bg-[#e85d26] px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-white">
                                    {{ $other->category_label }}
                                </span>
                            @endif

                            <div class="absolute bottom-3 left-4 right-4">
                                <h3 class="text-[18px] font-extrabold leading-tight text-white">{{ $other->name }}</h3>
                                @if ($other->subtitle)
                                    <p class="mt-0.5 text-[12px] font-medium text-white/70">{{ $other->subtitle }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="px-5 py-4">
                            <span class="inline-flex items-center gap-2 text-[13px] font-bold text-[#e85d26] transition-colors group-hover:text-[#ff8904]">
                                Learn More
                                <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- View All Button --}}
            <div class="mt-10 text-center">
                <a
                    href="{{ route('ministries') }}"
                    class="inline-flex items-center gap-2 rounded-full border-2 border-[#e85d26] px-7 py-3 text-sm font-bold text-[#e85d26] transition-colors hover:bg-[#e85d26] hover:text-white"
                >
                    View All Ministries
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
