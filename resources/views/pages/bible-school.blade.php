@extends('layouts.app')

@section('title', 'Bible School International — City Life International')
@section('meta_description', 'Bible School International at City Life — equipping believers with deep biblical knowledge, proven leadership skills, and a heart on fire for God.')

@push('head')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush

@section('content')
<div class="bg-white text-[#101828]">

    {{-- ============================================================
         HERO
    ============================================================ --}}
    <section class="relative overflow-hidden pt-16">
        <div class="absolute inset-0">
            <img
                src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1800&q=80"
                alt="Bible School International"
                class="h-full w-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>
        </div>

        <div class="relative mx-auto flex min-h-[340px] max-w-7xl flex-col justify-center px-4 sm:px-6 lg:px-8">
            <div class="max-w-xl">
                <div class="inline-flex h-[30px] items-center rounded-full border border-[#ff8904]/40 bg-[#1a1a2e] px-4 text-[11px] font-bold uppercase tracking-[0.12em] text-[#ff8904]">
                    <svg class="mr-2 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0121 12.5V17l-9 5-9-5v-4.5c0-.946.217-1.841.605-2.64L12 14z"/>
                    </svg>
                    City Life International
                </div>

                <h1 class="mt-5 text-[44px] font-extrabold leading-[1.05] tracking-tight text-white sm:text-[56px]">
                    Bible School<br>International
                </h1>

                <p class="mt-4 max-w-md text-[15px] italic leading-relaxed text-white/60">
                    Equipping believers with deep biblical knowledge, proven leadership skills, and a heart on fire for God.
                </p>
            </div>
        </div>
    </section>

    {{-- ============================================================
         ABOUT OUR BIBLE SCHOOL
    ============================================================ --}}
    <section class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-12 lg:flex-row lg:items-center lg:gap-16">

                {{-- Left — Images --}}
                <div class="flex gap-4 lg:w-1/2">
                    <div class="h-[340px] w-1/2 overflow-hidden rounded-2xl">
                        <img
                            src="https://images.unsplash.com/photo-1504052434569-70ad5836ab65?auto=format&fit=crop&w=600&q=80"
                            alt="Bishop teaching"
                            class="h-full w-full object-cover grayscale"
                        >
                    </div>
                    <div class="h-[340px] w-1/2 overflow-hidden rounded-2xl">
                        <img
                            src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=600&q=80"
                            alt="Bible school classroom"
                            class="h-full w-full object-cover"
                            style="filter: saturate(0.6) hue-rotate(140deg) brightness(0.85);"
                        >
                    </div>
                </div>

                {{-- Right — Text --}}
                <div class="lg:w-1/2">
                    <p class="text-[13px] font-medium text-[#98a2b3]">About Our Bible School</p>
                    <h2 class="mt-2 text-[32px] font-extrabold leading-tight text-[#101828] sm:text-[38px]">
                        Empowering Lives<br>Through Biblical<br>Teaching
                    </h2>

                    <p class="mt-5 text-[14px] leading-relaxed text-[#667085]">
                        Welcome to Bible School International, a comprehensive program designed to deepen your understanding of God's Word and equip you for effective ministry. Our Bible School features internationally renowned speakers who bring years of experience and biblical insight.
                    </p>
                    <p class="mt-3 text-[14px] leading-relaxed text-[#667085]">
                        Through our structured curriculum, you'll engage with powerful teaching sessions covering essential biblical topics, theology, and practical ministry applications. Each session is carefully designed to build your faith and transform your life.
                    </p>

                    <h3 class="mt-6 text-[15px] font-bold text-[#101828]">What You'll Experience:</h3>
                    <ul class="mt-3 space-y-2">
                        @foreach ([
                            'In-depth biblical teaching from experienced ministers',
                            'Comprehensive video and audio resources',
                            'Organized sessions by year and speaker',
                            'Access to archived teachings from previous years',
                            'Life-changing insights and practical applications',
                        ] as $item)
                            <li class="flex items-start gap-2 text-[14px] text-[#667085]">
                                <span class="mt-1 text-[#667085]">—</span>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a
                            href="{{ route('bible-school.resources') }}"
                            class="inline-flex h-[44px] items-center gap-2.5 rounded-full bg-[#1a1a2e] px-6 text-[13px] font-semibold text-white transition-colors hover:bg-[#2a2a3e]"
                        >
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.84A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.27l9.344-5.891a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                            Browse Resources
                        </a>
                        <a
                            href="{{ route('courses') }}"
                            class="inline-flex h-[44px] items-center rounded-full bg-[#e85d26] px-6 text-[13px] font-semibold text-white transition-colors hover:bg-[#d14f1e]"
                        >
                            Register Now
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection
