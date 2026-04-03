@extends('layouts.app')

@section('title', 'Upcoming Events — City Life International')
@section('meta_description', 'See upcoming services, celebrations, and community gatherings at City Life International.')
@section('body_class', 'bg-white')
@section('main_class', 'bg-white')

@php
    $heroImage = asset('images/slide-1.png');

    $eventCategories = collect([
        'Worship',
        'Special',
        'Youth',
        'Outreach',
        'Training',
        'Men',
        'Conference',
    ])->values();

    $categoryStyles = [
        'Worship' => [
            'badge' => 'bg-[#ffedd4] text-[#ca3500]',
        ],
        'Special' => [
            'badge' => 'bg-[#f3e8ff] text-[#8200db]',
        ],
        'Youth' => [
            'badge' => 'bg-[#dcfce7] text-[#15803d]',
        ],
        'Outreach' => [
            'badge' => 'bg-[#ffe4e6] text-[#be123c]',
        ],
        'Training' => [
            'badge' => 'bg-[#dbeafe] text-[#1d4ed8]',
        ],
        'Men' => [
            'badge' => 'bg-[#fef3c7] text-[#b45309]',
        ],
        'Conference' => [
            'badge' => 'bg-[#fef3c7] text-[#92400e]',
        ],
        'default' => [
            'badge' => 'bg-[#f3f4f6] text-[#4b5563]',
        ],
    ];

    $categoryClass = function (?string $category) use ($categoryStyles): array {
        return $categoryStyles[$category] ?? $categoryStyles['default'];
    };

    $serviceTimes = [
        [
            'icon' => '🙌',
            'label' => 'Sunday',
            'time' => '9:00 AM & 11:00 AM',
            'note' => 'Main Services',
        ],
        [
            'icon' => '📖',
            'label' => 'Wednesday',
            'time' => '7:00 PM',
            'note' => 'Midweek Service',
        ],
        [
            'icon' => '⚡',
            'label' => 'Friday',
            'time' => '7:00 PM',
            'note' => 'Youth Night',
        ],
    ];
@endphp

@push('head')
<style>
    [x-cloak] { display: none !important; }

    .events-page {
        overflow-x: hidden;
    }

    @media (min-width: 1024px) {
        .events-hero {
            height: 386px;
        }

        .events-hero-inner {
            height: 386px;
            padding-top: 64px;
        }

        .events-featured-card {
            height: 361.5px;
        }

        .events-directory-item {
            height: var(--row-height);
        }

        .events-directory-grid {
            grid-template-columns: 96px 160px minmax(0, 1fr) 166.5625px;
        }

        .events-service-shell {
            max-width: 896px;
        }

        .events-service-card {
            height: 170px;
        }

        .events-subscribe-shell {
            min-height: 40px;
        }
    }
</style>
@endpush

@section('content')
<div class="events-page bg-white text-[#101828] pt-16">

    <section class="events-hero relative overflow-hidden">
        <div class="absolute inset-0">
            <img
                src="{{ $heroImage }}"
                alt="Upcoming events at City Life International"
                class="h-full w-full object-cover"
            >
            <div class="absolute inset-0 bg-black/72"></div>
        </div>

        <div class="events-hero-inner relative mx-auto flex h-[300px] max-w-[1143px] flex-col items-center justify-center px-6 text-center">
            <div class="inline-flex h-[30px] items-center rounded-full border border-white/20 bg-white/10 px-4 text-[12px] font-bold uppercase tracking-[0.1em] text-[#ff8904]">
                <svg class="mr-2 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                What's On
            </div>

            <h1 class="mt-3 text-[42px] font-medium leading-none text-white sm:text-[60px] sm:tracking-[0.004em]">
                Upcoming Events
            </h1>

            <div class="mt-3 flex items-center gap-2 text-[14px] text-white/60">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">🏠 Home</a>
                <svg class="h-4 w-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white">Events</span>
            </div>
        </div>
    </section>

    <section class="bg-[#f7f5f0] py-16">
        <div class="mx-auto max-w-[1143px] px-6">
            <div class="flex items-center gap-2">
                <span class="h-0.5 w-6 bg-[#fb2c36]"></span>
                <p class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#fb2c36]">Featured Events</p>
            </div>

            <div class="mt-8 grid gap-6 lg:grid-cols-2">
                @foreach ($featuredEvents as $featuredEvent)
                    @php($styles = $categoryClass($featuredEvent['category']))

                    <a
                        href="{{ $featuredEvent['route'] }}"
                        class="events-featured-card group overflow-hidden rounded-[24px] bg-white shadow-[0_4px_6px_-1px_rgba(0,0,0,0.1),0_2px_4px_-2px_rgba(0,0,0,0.1)]"
                    >
                        <div class="relative h-[240px] overflow-hidden">
                            <img
                                src="{{ $featuredEvent['image'] }}"
                                alt="{{ $featuredEvent['title'] }}"
                                class="h-full w-full object-cover"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                            <span class="absolute left-4 top-4 inline-flex h-6 items-center rounded-full px-3 text-[12px] font-bold {{ $styles['badge'] }}">
                                {{ $featuredEvent['category'] }}
                            </span>

                            <div class="absolute inset-x-4 bottom-4">
                                <h2 class="text-[20px] font-medium leading-[1.375] text-white">
                                    {{ $featuredEvent['title'] }}
                                </h2>

                                <div class="mt-1 flex flex-wrap items-center gap-3 text-[12px] text-white/70">
                                    <span class="inline-flex items-center gap-1.5">
                                        <svg class="h-3.5 w-3.5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $featuredEvent['day'] }} {{ $featuredEvent['month'] }} {{ $featuredEvent['year'] }}
                                    </span>
                                    <span class="inline-flex items-center gap-1.5">
                                        <svg class="h-3.5 w-3.5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $featuredEvent['time_label'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="px-5 pt-5 pb-5">
                            <p class="h-[45.5px] overflow-hidden text-[14px] leading-[1.625] text-[#6a7282]">
                                {{ $featuredEvent['description'] }}
                            </p>

                            <div class="mt-4 flex items-center justify-between gap-4">
                                <span class="inline-flex items-center gap-1.5 text-[12px] text-[#99a1af]">
                                    <svg class="h-3.5 w-3.5 text-[#ff6900]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0L6.343 16.657A8 8 0 1117.657 16.657z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ Illuminate\Support\Str::limit($featuredEvent['location'], 24) }}
                                </span>

                                <span class="inline-flex items-center gap-1.5 text-[14px] font-semibold text-[#ff6900]">
                                    {{ $featuredEvent['requires_registration'] ? 'Register' : 'View Details' }}
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-16">
        <div
            x-data="eventsDirectory(@js($events->all()), @js($eventCategories), @js(collect($categoryStyles)->mapWithKeys(fn (array $styles, string $category) => [$category => $styles['badge']])->all()))"
            class="mx-auto max-w-[1143px] px-6"
        >
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex h-7 items-center justify-center text-[#667085]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h18M6 12h12m-9 7h6"/>
                        </svg>
                    </span>

                    <template x-for="tab in tabs" :key="tab.key">
                        <button
                            type="button"
                            @click="setCategory(tab.key)"
                            :class="activeCategory === tab.key ? 'bg-[#101828] text-white' : 'bg-[#f3f4f6] text-[#4a5565] hover:text-[#101828]'"
                            class="inline-flex h-7 items-center rounded-full px-4 text-[12px] font-semibold transition-colors"
                        >
                            <span x-text="tab.label"></span>
                        </button>
                    </template>
                </div>

                <label class="relative block w-full lg:w-[200px]">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#98a2b3]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z"/>
                        </svg>
                    </span>
                    <input
                        x-model.debounce.250ms="search"
                        type="text"
                        placeholder="Search events..."
                        class="h-9 w-full rounded-full border border-[#f3f4f6] bg-[#f3f4f6] pl-10 pr-4 text-[14px] text-[#101828] outline-none transition-colors placeholder:text-[#99a1af] focus:border-[#d0d5dd] focus:bg-white"
                    >
                </label>
            </div>

            <div class="mt-10 space-y-5">
                <template x-for="item in filteredItems" :key="item.id">
                    <article
                        class="events-directory-item overflow-hidden rounded-[16px] border border-[#f3f4f6] bg-white shadow-[0_1px_2px_rgba(16,24,40,0.04)]"
                        :style="'--row-height:' + item.row_height + 'px'"
                    >
                        <div class="events-directory-grid grid h-full grid-cols-1 md:grid-cols-[96px_160px_minmax(0,1fr)_166.5625px]">
                            <div class="flex h-24 w-full shrink-0 items-center justify-center gap-2 bg-[linear-gradient(117deg,#ff6900_0%,#fb2c36_100%)] text-white md:h-full md:w-auto md:flex-col md:gap-0">
                                <span class="text-[30px] font-black leading-none tracking-[0.013em]" x-text="item.day"></span>
                                <span class="text-[12px] font-bold uppercase tracking-[0.1em] text-white/80" x-text="item.month"></span>
                                <span class="text-[12px] text-white/60" x-text="item.year"></span>
                            </div>

                            <div class="h-48 w-full shrink-0 overflow-hidden md:h-full md:w-auto">
                                <img
                                    :src="item.image"
                                    :alt="item.title"
                                    class="h-full w-full object-cover"
                                >
                            </div>

                            <div class="flex flex-1 flex-col justify-between px-6 py-6">
                                <div>
                                    <span
                                        class="inline-flex h-5 items-center rounded-full px-2.5 text-[12px] font-bold"
                                        :class="categoryBadgeClass(item.category)"
                                        x-text="item.category"
                                    ></span>

                                    <h3 class="mt-2 text-[18px] font-medium leading-7 text-[#101828]" x-text="item.title"></h3>

                                    <p
                                        class="mt-2 max-w-[605px] text-[14px] leading-[1.625] text-[#99a1af]"
                                        x-text="item.description"
                                    ></p>
                                </div>

                                <div class="mt-5 flex flex-wrap items-center gap-x-4 gap-y-2 text-[12px] text-[#99a1af]">
                                    <span class="inline-flex items-center gap-1.5">
                                        <svg class="h-3.5 w-3.5 text-[#ff6900]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span x-text="item.time_label"></span>
                                    </span>

                                    <span class="inline-flex items-center gap-1.5">
                                        <svg class="h-3.5 w-3.5 text-[#ff6900]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0L6.343 16.657A8 8 0 1117.657 16.657z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span x-text="item.location"></span>
                                    </span>
                                </div>
                            </div>

                            <div class="flex w-full shrink-0 items-center justify-end px-6 pb-6 md:w-auto md:justify-center md:px-6 md:pb-0">
                                <a
                                    :href="item.route"
                                    class="inline-flex h-9 w-[118.5625px] items-center justify-center rounded-full bg-[#101828] px-5 text-[12px] font-semibold text-white transition-colors hover:bg-[#1d2939]"
                                    x-text="item.requires_registration ? 'Register Now' : 'View Details'"
                                ></a>
                            </div>
                        </div>
                    </article>
                </template>

                <div
                    x-cloak
                    x-show="filteredItems.length === 0"
                    class="rounded-[16px] border border-dashed border-[#d0d5dd] px-6 py-10 text-center"
                >
                    <p class="text-[18px] font-medium text-[#101828]">No matching events found</p>
                    <p class="mt-2 text-[14px] text-[#98a2b3]">Try another category or search term.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#1c1c24] py-16">
        <div class="mx-auto max-w-[1143px] px-6">
            <div class="events-service-shell mx-auto text-center">
                <div class="flex items-center justify-center gap-2">
                    <span class="h-0.5 w-6 bg-[#ff6900]"></span>
                    <p class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#ff6900]">Every Week</p>
                    <span class="h-0.5 w-6 bg-[#ff6900]"></span>
                </div>

                <h2 class="mt-4 text-[34px] font-medium leading-tight text-white sm:text-[36px]">
                    Regular Service Times
                </h2>

                <div class="mt-10 grid gap-5 lg:grid-cols-3">
                    @foreach ($serviceTimes as $service)
                        <div class="events-service-card rounded-[16px] border border-white/10 bg-white/5 px-6 py-6 text-center">
                            <div class="text-[30px] leading-9 text-white">{{ $service['icon'] }}</div>
                            <p class="mt-4 text-[18px] font-black text-white">{{ $service['label'] }}</p>
                            <p class="mt-1 text-[14px] font-semibold text-[#ff8904]">{{ $service['time'] }}</p>
                            <p class="mt-1 text-[12px] text-white/40">{{ $service['note'] }}</p>
                        </div>
                    @endforeach
                </div>

                <p class="mt-8 text-[14px] text-white/40">
                    All services held at 1 South Parade, Sheffield S1 2BJ
                </p>
            </div>
        </div>
    </section>

    <section class="bg-[#f3f4f6]">
        <div class="events-subscribe-shell mx-auto flex max-w-[1143px] flex-col gap-4 px-6 py-4 lg:flex-row lg:items-center lg:gap-6 lg:py-0">
            <div class="flex items-center gap-3 lg:w-[200px] lg:py-4">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-[#ff8904] via-[#fb2c36] to-[#9810fa] text-[14px] text-white">
                    🔥
                </span>
                <span class="text-[20px] font-black tracking-[-0.02em] text-[#101828]">Subscribe Now</span>
            </div>

            <div class="flex flex-1 flex-col gap-3 lg:flex-row lg:items-center lg:py-3">
                <label class="relative block flex-1">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#98a2b3]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l8.293 5.293a1 1 0 001.414 0L21 8m-18 9h18a2 2 0 002-2V9a2 2 0 00-2-2H3a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                        </svg>
                    </span>
                    <input
                        type="email"
                        placeholder="Enter Your Email"
                        class="h-10 w-full rounded-full border border-[#e5e7eb] bg-white pl-11 pr-4 text-[14px] text-[#101828] shadow-[0_1px_3px_rgba(0,0,0,0.1),0_1px_2px_rgba(0,0,0,0.1)] outline-none placeholder:text-[#99a1af]"
                    >
                </label>

                <button
                    type="button"
                    class="inline-flex h-10 items-center justify-center rounded-full bg-[#101828] px-6 text-[14px] font-semibold text-white transition-colors hover:bg-[#1d2939]"
                >
                    Subscribe Now
                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </section>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('eventsDirectory', (items, categories, badgeClasses) => ({
            items,
            activeCategory: 'all',
            search: '',
            badgeClasses,
            tabs: [
                { key: 'all', label: 'All' },
                ...categories.map((category) => ({ key: category, label: category })),
            ],

            get filteredItems() {
                const query = this.search.trim().toLowerCase();

                return this.items.filter((item) => {
                    const matchesCategory =
                        this.activeCategory === 'all' || item.category === this.activeCategory;

                    const haystack = [
                        item.title,
                        item.description,
                        item.location,
                        item.category,
                        item.badge,
                        item.date_label,
                        item.time_label,
                    ]
                        .join(' ')
                        .toLowerCase();

                    return matchesCategory && (!query || haystack.includes(query));
                });
            },

            setCategory(category) {
                this.activeCategory = category;
            },

            categoryBadgeClass(category) {
                return this.badgeClasses[category] || this.badgeClasses.default;
            },
        }));
    });
</script>
@endpush
