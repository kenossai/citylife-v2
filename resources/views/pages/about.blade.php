@extends('layouts.app')

@section('title', 'About Us — City Life International')
@section('meta_description', 'Learn about City Life International Church, a vibrant Spirit-filled community in the heart of Sheffield making disciples of Jesus Christ.')

@php
    $aboutImage = $aboutSection->image_path
        ? asset('storage/' . $aboutSection->image_path)
        : 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?auto=format&fit=crop&w=1200&q=80';

    $heroImage = 'https://images.unsplash.com/photo-1507692049790-de58290a4334?auto=format&fit=crop&w=1800&q=80';

    $featureCards = [
        [
            'eyebrow' => 'Our Leadership',
            'title' => 'Meet the people helping steward the vision and care of our church family.',
            'image' => 'https://res.cloudinary.com/devguy/image/upload/v1775746158/citylife/leadership/leadership_mxm7fz.png',
            'href' => url('/leadership'),
        ],
        [
            'eyebrow' => 'Our Core Values',
            'title' => 'See the convictions that shape how we worship, disciple, and serve together.',
            'image' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=900&q=80',
            'href' => url('/about-citylife') . '#core-values',
        ],
        [
            'eyebrow' => 'Our Outreach',
            'title' => 'Discover how we serve our city and extend the love of Christ beyond Sunday.',
            'image' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?auto=format&fit=crop&w=900&q=80',
            'href' => url('/about-citylife') . '#worship-centres',
        ],
    ];
@endphp

@push('head')
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
@endpush

@section('content')
<div class="bg-[#f7f3ee]">
    <section class="relative isolate overflow-hidden bg-[#120e11] pt-16">
        <div class="absolute inset-0">
            <img
                src="{{ $heroImage }}"
                alt="Worship gathering"
                class="h-full w-full object-cover object-center opacity-35"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-[#120e11]/80 via-[#120e11]/70 to-[#120e11]"></div>
        </div>

        <div class="relative mx-auto flex min-h-[260px] max-w-7xl flex-col items-center justify-center px-4 py-16 text-center sm:min-h-[300px] sm:px-6 lg:px-8">
            <p class="mb-3 text-[11px] font-semibold uppercase tracking-[0.35em] text-[#e85d26]">City Life International</p>
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl">About Us</h1>
            <nav class="mt-4 flex items-center gap-2 text-xs uppercase tracking-[0.24em] text-white/65">
                <a href="{{ url('/') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white">About Us</span>
            </nav>
        </div>
    </section>

    <section id="story" class="relative z-10 -mt-12 pb-18 sm:-mt-16 sm:pb-24 lg:-mt-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-0 lg:grid-cols-[1.08fr_0.92fr] lg:items-end">
                <div class="relative min-h-[340px] overflow-hidden rounded-[30px] bg-[#1a1517] shadow-[0_25px_80px_rgba(16,12,14,0.28)] sm:min-h-[460px] lg:rounded-[34px]">
                    <img
                        src="{{ $aboutSection->image_path }}"
                        alt="City Life worship moment"
                        class="absolute inset-0 h-full w-full object-cover"
                    >
                    <div class="absolute inset-0 bg-gradient-to-r from-[#100c0f]/60 via-transparent to-transparent"></div>
                </div>

                <div class="relative lg:-ml-16 xl:-ml-24">
                    <div class="rounded-[30px] bg-white px-7 py-8 shadow-[0_25px_80px_rgba(16,12,14,0.16)] sm:px-10 sm:py-10 lg:rounded-[34px] lg:px-12 lg:py-12">
                        <div class="mb-5 flex items-center gap-3">
                            <span class="h-px w-10 bg-[#e85d26]"></span>
                            <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#e85d26]">About Us</p>
                        </div>

                        <h2 class="max-w-lg text-3xl font-extrabold leading-tight text-[#222025] sm:text-4xl">
                            {{ $aboutSection->heading ?? 'City Life A Vibrant Christian Community' }}
                        </h2>

                        <p class="mt-3 text-[11px] font-semibold uppercase tracking-[0.28em] text-[#9e9a93]">
                            {{ $aboutSection->established_text ?? 'Affiliated With: Assemblies of God' }}
                        </p>

                        <div class="mt-6 space-y-4 text-sm leading-7 text-[#66615b] sm:text-[15px]">
                            <p>
                                {{ $aboutSection->body_1 ?? 'City Life is a vibrant, Spirit-filled multicultural church at the heart of Sheffield. We are committed to worship, discipleship, community, and mission while helping people encounter the transforming love of God.' }}
                            </p>
                            <p>
                                {{ $aboutSection->body_2 ?? 'We believe in the heritage of our faith, passed down through Scripture and carried forward with fresh faith for this generation. Our desire is to make disciples of Jesus Christ for the transformation of the city and the world.' }}
                            </p>
                            <p>
                                Whether you are exploring faith for the first time or have walked with Jesus for years, you are welcome here. Come as you are and discover a church family built on love, truth, and purpose.
                            </p>
                        </div>

                        <div class="mt-8">
                            <a
                                href="{{ $aboutSection->btn_url ?: url('/about-citylife') }}"
                                class="inline-flex items-center gap-2 rounded-full bg-[#18151a] px-7 py-3 text-sm font-semibold text-white transition-colors hover:bg-[#e85d26]"
                            >
                                {{ $aboutSection->btn_text ?? 'More About Us' }}
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="core-values" class="pb-18 sm:pb-24">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center sm:mb-12">
                <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#e85d26]">Our Key Beliefs</p>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-[#27242a] sm:text-4xl">Core Values That Guide Us</h2>
            </div>

            @if($coreValues->count())
            <div
                x-data="coreValuesCarousel({{ $coreValues->count() }})"
                class="relative"
                @mouseenter="stop()"
                @mouseleave="start()"
            >
                <div class="rounded-[30px] bg-white p-4 shadow-[0_24px_70px_rgba(17,12,15,0.12)] sm:p-6 lg:rounded-[34px] lg:p-7">
                    <div
                        x-ref="slides"
                        class="relative min-h-[760px] overflow-hidden transition-[height] duration-700 ease-[cubic-bezier(0.22,1,0.36,1)] sm:min-h-[700px] lg:min-h-[430px]"
                        :style="activeHeight ? { height: activeHeight } : {}"
                    >
                        @foreach ($coreValues as $index => $value)
                            <article
                                data-slide="{{ $index }}"
                                x-show="current === {{ $index }}"
                                x-cloak
                                x-transition:enter="transform transition duration-700 ease-[cubic-bezier(0.22,1,0.36,1)]"
                                x-transition:enter-start="opacity-0 translate-y-5 scale-[0.985]"
                                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                x-transition:leave="transform transition duration-400 ease-in"
                                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                x-transition:leave-end="opacity-0 -translate-y-3 scale-[0.985]"
                                class="absolute inset-x-0 top-0 grid w-full gap-6 lg:grid-cols-[0.92fr_1.08fr] lg:items-center"
                            >
                                <div class="relative min-h-[270px] overflow-hidden rounded-[24px] bg-[#19161b] sm:min-h-[340px] lg:min-h-[390px]">
                                    @if($value->image_path)
                                    <img
                                        src="{{ $value->image_path }}"
                                        alt="{{ $value->tag }}"
                                        class="absolute inset-0 h-full w-full object-cover"
                                    >
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/35 via-transparent to-transparent"></div>
                                    <span class="absolute left-4 top-4 rounded-full bg-white px-3 py-1 text-[10px] font-extrabold uppercase tracking-[0.26em] text-[#1b1820] shadow-sm">
                                        {{ $value->tag }}
                                    </span>
                                </div>

                                <div class="px-1 py-2 sm:px-2 lg:px-4">
                                    <h3 class="max-w-xl text-2xl font-extrabold leading-tight text-[#201d24] sm:text-[32px]">
                                        {{ $value->heading }}
                                    </h3>

                                    <div class="mt-5 space-y-4 text-sm leading-7 text-[#66615b] sm:text-[15px]">
                                        @if($value->body_1)<p>{{ $value->body_1 }}</p>@endif
                                        @if($value->body_2)<p>{{ $value->body_2 }}</p>@endif
                                    </div>

                                    @if($value->quote)
                                    <div class="mt-6 border-l-2 border-[#e85d26] pl-4">
                                        <p class="text-sm italic leading-7 text-[#4d4742]">{{ $value->quote }}</p>
                                        @if($value->scripture)
                                        <p class="mt-2 text-[11px] font-bold uppercase tracking-[0.3em] text-[#e85d26]">{{ $value->scripture }}</p>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-center gap-4">
                    <button
                        @click="prev()"
                        class="flex h-10 w-10 items-center justify-center rounded-full border border-[#e5ddd3] bg-white text-[#554f49] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]"
                        aria-label="Previous value"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    <div class="flex items-center gap-2">
                        @foreach ($coreValues as $index => $value)
                            <button
                                @click="goTo({{ $index }})"
                                :class="current === {{ $index }} ? 'w-7 bg-[#e85d26]' : 'w-2.5 bg-[#d9d0c5]'"
                                class="h-2.5 rounded-full transition-all duration-300"
                                aria-label="Show {{ $value->tag }} value"
                            ></button>
                        @endforeach
                    </div>

                    <button
                        @click="next()"
                        class="flex h-10 w-10 items-center justify-center rounded-full border border-[#e5ddd3] bg-white text-[#554f49] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]"
                        aria-label="Next value"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>
            @endif
        </div>
    </section>

    <section class="pb-18 sm:pb-24">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($featureCards as $card)
                    <a
                        href="{{ $card['href'] }}"
                        class="group relative isolate flex min-h-[300px] overflow-hidden rounded-[28px] shadow-[0_18px_50px_rgba(17,12,15,0.12)]"
                    >
                        <img
                            src="{{ $card['image'] }}"
                            alt="{{ $card['eyebrow'] }}"
                            class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-[#121016] via-[#121016]/40 to-transparent"></div>

                        @if ($loop->last)
                            <div class="absolute inset-0 bg-[#4d2a73]/30 backdrop-blur-[2px]"></div>
                        @endif

                        <div class="relative flex w-full flex-col justify-end p-6 sm:p-7">
                            <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-white/80">{{ $card['eyebrow'] }}</p>
                            <p class="mt-4 max-w-[15rem] text-lg font-extrabold leading-tight text-white">{{ $card['title'] }}</p>
                            <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-[#ff8c62]">
                                View Details
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section id="worship-centres" class="pb-16 sm:pb-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-[30px] bg-[#151217] px-6 py-8 shadow-[0_28px_80px_rgba(17,12,15,0.24)] sm:px-8 sm:py-10 lg:rounded-[34px] lg:px-10 lg:py-12">
                <div class="absolute inset-0">
                    <img
                        src="https://images.unsplash.com/photo-1491438590914-bc09fcaaf77a?auto=format&fit=crop&w=1600&q=80"
                        alt=""
                        class="h-full w-full object-cover opacity-18"
                    >
                    <div class="absolute inset-0 bg-gradient-to-r from-[#141117] via-[#141117]/90 to-[#141117]/95"></div>
                </div>

                <div class="relative grid gap-8 lg:grid-cols-[0.82fr_1.18fr] lg:items-center">
                    <div class="max-w-sm">
                        <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#ff8c62]">Join Us In Person</p>
                        <h2 class="mt-4 text-4xl font-extrabold uppercase leading-[0.94] tracking-tight text-white sm:text-5xl">
                            Our
                            <br>
                            Worship
                            <br>
                            Centres
                        </h2>
                        <p class="mt-5 text-sm leading-7 text-white/70">
                            Gather with us across Sheffield and find a location where you can worship, connect, and grow in community.
                        </p>
                    </div>

                    <div class="grid gap-4 md:grid-cols-5">
                        @foreach ($worshipCentres as $centre)
                            <article class="rounded-[24px] bg-white/95 p-5 shadow-[0_18px_40px_rgba(0,0,0,0.18)] backdrop-blur">
                                <span class="inline-flex rounded-full bg-[#efe8e0] px-3 py-1 text-[10px] font-extrabold uppercase tracking-[0.28em] text-[#6b6259]">
                                    {{ $centre->label }}
                                </span>

                                <h3 class="mt-4 text-lg font-extrabold text-[#1f1b22]">{{ $centre->name }}</h3>

                                <div class="mt-3 space-y-2 text-sm leading-6 text-[#645f59]">
                                    <p>{{ $centre->address }}</p>
                                    @if($centre->landmark)<p>{{ $centre->landmark }}</p>@endif
                                    <p class="font-semibold text-[#302b33]">{{ $centre->times }}</p>
                                    @if($centre->phone)<p class="text-[#8b847b]">{{ $centre->phone }}</p>@endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('coreValuesCarousel', (total) => ({
            current: 0,
            total,
            timer: null,
            activeHeight: null,
            animating: false,

            init() {
                this.$nextTick(() => {
                    this.syncHeight();
                    this.start();
                });

                window.addEventListener('resize', () => {
                    this.syncHeight();
                });
            },

            start() {
                this.stop();
                this.timer = window.setInterval(() => this.goTo((this.current + 1) % this.total), 7000);
            },

            stop() {
                if (this.timer) {
                    window.clearInterval(this.timer);
                    this.timer = null;
                }
            },

            prev() {
                this.goTo((this.current - 1 + this.total) % this.total);
            },

            next() {
                this.goTo((this.current + 1) % this.total);
            },

            goTo(index) {
                if (index === this.current || this.animating) {
                    return;
                }

                this.animating = true;
                this.current = index;

                this.$nextTick(() => {
                    this.syncHeight();
                });

                window.setTimeout(() => {
                    this.animating = false;
                }, 720);

                this.start();
            },

            syncHeight() {
                const activeSlide = this.$refs.slides?.querySelector(`[data-slide="${this.current}"]`);

                if (activeSlide) {
                    this.activeHeight = `${activeSlide.scrollHeight}px`;
                }
            },
        }));
    });
</script>
@endpush
