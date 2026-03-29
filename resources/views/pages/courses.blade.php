@extends('layouts.app')

@section('title', 'Courses & Training — City Life International')
@section('meta_description', 'Explore Bible School courses and training programmes at City Life International. Theology, leadership, prayer, evangelism and more.')

@php
    $courses = [
        [
            'category'    => 'Theology',
            'catColor'    => 'bg-[#7c3aed]',
            'level'       => 'Beginner',
            'levelColor'  => 'border-[#2563eb] text-[#2563eb]',
            'certificate' => true,
            'title'       => 'Foundations of Faith',
            'description' => 'Build an unshakeable foundation in your Christian faith with this comprehensive 8-week introduction to biblical theology.',
            'instructor'  => 'Bishop Robert Clarke',
            'stars'       => 5.0,
            'weeks'       => 8,
            'lessons'     => 32,
            'students'    => 248,
            'price'       => 'Free',
            'image'       => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?auto=format&fit=crop&w=600&q=80',
            'url'         => '#',
        ],
        [
            'category'    => 'Leadership',
            'catColor'    => 'bg-[#16a34a]',
            'level'       => 'Intermediate',
            'levelColor'  => 'border-[#f97316] text-[#f97316]',
            'certificate' => true,
            'title'       => 'Leadership School',
            'description' => 'Equip yourself to lead with character, courage and clarity. A comprehensive 12-week leadership development programme rooted in biblical principles.',
            'instructor'  => 'Pastor James Okafor',
            'stars'       => 5.0,
            'weeks'       => 12,
            'lessons'     => 48,
            'students'    => 124,
            'price'       => '£60',
            'image'       => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=600&q=80',
            'url'         => '#',
        ],
        [
            'category'    => 'Prayer',
            'catColor'    => 'bg-[#dc2626]',
            'level'       => 'All Levels',
            'levelColor'  => 'border-[#7c3aed] text-[#7c3aed]',
            'certificate' => false,
            'title'       => 'School of Prayer',
            'description' => 'Discover the transformative power of prayer and build a consistent, powerful prayer life through this 6-week school.',
            'instructor'  => 'Bishop Robert Clarke',
            'stars'       => 5.0,
            'weeks'       => 6,
            'lessons'     => 24,
            'students'    => 312,
            'price'       => 'Free',
            'image'       => 'https://images.unsplash.com/photo-1461378810796-1bd3f1ce3c73?auto=format&fit=crop&w=600&q=80',
            'url'         => '#',
        ],
        [
            'category'    => 'Evangelism',
            'catColor'    => 'bg-[#f97316]',
            'level'       => 'All Levels',
            'levelColor'  => 'border-[#7c3aed] text-[#7c3aed]',
            'certificate' => false,
            'title'       => 'Evangelism Training',
            'description' => 'Get equipped to share your faith naturally and boldly. This 4-week course will give you the tools, confidence and strategy you need.',
            'instructor'  => 'Pastor Michael Adisa',
            'stars'       => 4.0,
            'weeks'       => 4,
            'lessons'     => 16,
            'students'    => 189,
            'price'       => 'Free',
            'image'       => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?auto=format&fit=crop&w=600&q=80',
            'url'         => '#',
        ],
        [
            'category'    => 'Family Life',
            'catColor'    => 'bg-[#ec4899]',
            'level'       => 'Couples',
            'levelColor'  => 'border-[#ec4899] text-[#ec4899]',
            'certificate' => false,
            'title'       => 'Marriage & Family',
            'description' => 'A transformative 6-week course for married couples and those preparing for marriage, built on God\'s design for the family.',
            'instructor'  => 'Pastor James & Mrs. Okafor',
            'stars'       => 5.0,
            'weeks'       => 6,
            'lessons'     => 24,
            'students'    => 97,
            'price'       => '£30 per couple',
            'image'       => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=600&q=80',
            'url'         => '#',
        ],
        [
            'category'    => 'Worship',
            'catColor'    => 'bg-[#a855f7]',
            'level'       => 'All Levels',
            'levelColor'  => 'border-[#7c3aed] text-[#7c3aed]',
            'certificate' => true,
            'title'       => 'Worship & Arts School',
            'description' => 'Develop your gifts as a musician, singer, dancer, or creative and discover how to lead others into God\'s presence.',
            'instructor'  => 'Samuel Akin',
            'stars'       => 4.0,
            'weeks'       => 8,
            'lessons'     => 32,
            'students'    => 76,
            'price'       => '£40',
            'image'       => 'https://images.unsplash.com/photo-1507676184212-d03ab07a01bf?auto=format&fit=crop&w=600&q=80',
            'url'         => '#',
        ],
    ];

    $categories = ['All', 'Theology', 'Leadership', 'Prayer', 'Evangelism', 'Family Life', 'Worship'];

    $featured = array_slice($courses, 0, 2);
@endphp

@push('head')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush

@section('content')
<div class="bg-white text-[#101828]" x-data="coursesPage()">

    {{-- ============================================================
         HERO
    ============================================================ --}}
    <section class="relative overflow-hidden pt-16">
        <div class="absolute inset-0">
            <img
                src="https://images.unsplash.com/photo-1504052434569-70ad5836ab65?auto=format&fit=crop&w=1800&q=80"
                alt="Courses & Training"
                class="h-full w-full object-cover"
            >
            <div class="absolute inset-0 bg-black/65"></div>
        </div>

        <div class="relative mx-auto flex h-[260px] max-w-7xl flex-col items-center justify-center px-4 text-center sm:px-6 lg:px-8">
            <div class="inline-flex h-[28px] items-center rounded-full border border-white/20 bg-white/10 px-4 text-[11px] font-bold uppercase tracking-[0.12em] text-[#ff8904]">
                <svg class="mr-2 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0121 12.5V17l-9 5-9-5v-4.5c0-.946.217-1.841.605-2.64L12 14z"/>
                </svg>
                Bible School
            </div>

            <h1 class="mt-4 text-[48px] font-extrabold leading-none tracking-tight text-white sm:text-[56px]">
                Courses & Training
            </h1>

            <div class="mt-3 flex items-center gap-2 text-[13px] text-white/50">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">🏠 Home</a>
                <svg class="h-3.5 w-3.5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white/80">Courses</span>
            </div>
        </div>
    </section>

    {{-- ============================================================
         POPULAR RIGHT NOW — 2 featured horizontal cards
    ============================================================ --}}
    <section class="bg-white py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mb-8 flex items-center gap-3">
                <span class="h-[3px] w-8 rounded-full bg-[#e85d26]"></span>
                <p class="text-[13px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">Popular Right Now</p>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                @foreach ($featured as $course)
                <div class="flex overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-[0_2px_8px_rgba(0,0,0,0.06)] transition-shadow hover:shadow-[0_8px_24px_rgba(0,0,0,0.1)]">
                    {{-- Image side --}}
                    <div class="relative hidden w-[200px] shrink-0 sm:block">
                        <img
                            src="{{ $course['image'] }}"
                            alt="{{ $course['title'] }}"
                            class="h-full w-full object-cover"
                        >
                        <div class="absolute left-3 top-3 flex h-9 w-9 items-center justify-center rounded-full bg-[#e85d26] text-white shadow-md">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6.3 2.84A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.27l9.344-5.891a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Content side --}}
                    <div class="flex flex-1 flex-col justify-center px-5 py-5 sm:px-6">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="inline-flex h-[22px] items-center rounded-md px-2.5 text-[11px] font-bold text-white {{ $course['catColor'] }}">{{ $course['category'] }}</span>
                            <span class="inline-flex h-[22px] items-center rounded-md border px-2.5 text-[11px] font-bold {{ $course['levelColor'] }}">{{ $course['level'] }}</span>
                        </div>

                        <h3 class="mt-2.5 text-[18px] font-bold leading-snug text-[#101828]">{{ $course['title'] }}</h3>
                        <p class="mt-1.5 text-[13px] leading-relaxed text-[#667085] line-clamp-2">{{ $course['description'] }}</p>

                        {{-- Stars --}}
                        <div class="mt-3 flex items-center gap-1.5">
                            <div class="flex items-center gap-0.5">
                                @for ($s = 1; $s <= 5; $s++)
                                    <svg class="h-3.5 w-3.5 {{ $s <= floor($course['stars']) ? 'text-[#ff8904]' : 'text-[#e5e7eb]' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-[12px] text-[#667085]">({{ $course['students'] }} students)</span>
                        </div>

                        {{-- Meta row --}}
                        <div class="mt-3 flex items-center gap-4 text-[12px] text-[#98a2b3]">
                            <span class="flex items-center gap-1">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-width="2" d="M12 6v6l4 2"/></svg>
                                {{ $course['weeks'] }} weeks
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                {{ $course['lessons'] }} lessons
                            </span>
                            <span class="ml-auto text-[15px] font-bold {{ $course['price'] === 'Free' ? 'text-[#16a34a]' : 'text-[#101828]' }}">{{ $course['price'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ============================================================
         FILTER BAR + SEARCH
    ============================================================ --}}
    <section class="border-b border-[#e5e7eb] bg-white">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">

            {{-- Filter pills --}}
            <div class="flex flex-wrap items-center gap-2.5">
                <svg class="h-4 w-4 text-[#98a2b3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>

                @foreach ($categories as $cat)
                    <button
                        type="button"
                        @click="activeFilter = '{{ $cat }}'; search = ''"
                        :class="activeFilter === '{{ $cat }}' ? 'bg-[#101828] text-white shadow-sm' : 'border border-[#e5e7eb] text-[#667085] hover:text-[#101828] hover:border-[#d0d5dd]'"
                        class="inline-flex h-[32px] items-center rounded-full px-4 text-[12px] font-semibold transition-colors"
                    >{{ $cat }}</button>
                @endforeach
            </div>

            {{-- Search --}}
            <label class="relative block w-full sm:w-56">
                <span class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-[#98a2b3]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z"/>
                    </svg>
                </span>
                <input
                    x-model.debounce.200ms="search"
                    type="text"
                    placeholder="Search courses..."
                    class="h-[36px] w-full rounded-lg border border-[#e5e7eb] bg-white pl-10 pr-4 text-[13px] text-[#101828] outline-none transition-colors placeholder:text-[#99a1af] focus:border-[#d0d5dd] focus:ring-1 focus:ring-[#d0d5dd]"
                >
            </label>
        </div>
    </section>

    {{-- ============================================================
         COURSES GRID — 3-column card layout
    ============================================================ --}}
    <section class="bg-white pb-20 pt-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($courses as $i => $course)
                    <div
                        x-show="(activeFilter === 'All' || activeFilter === '{{ $course['category'] }}') && (!search || '{{ strtolower($course['title'] . ' ' . $course['instructor'] . ' ' . $course['category']) }}'.includes(search.toLowerCase()))"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-[0_2px_8px_rgba(0,0,0,0.08)] transition-shadow hover:shadow-[0_8px_24px_rgba(0,0,0,0.12)]"
                    >
                        {{-- Image --}}
                        <div class="relative aspect-[16/10] overflow-hidden">
                            <img
                                src="{{ $course['image'] }}"
                                alt="{{ $course['title'] }}"
                                class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                            >
                            {{-- Category badge --}}
                            <span class="absolute left-3 top-3 inline-flex h-[24px] items-center rounded-md px-2.5 text-[11px] font-bold text-white {{ $course['catColor'] }}">
                                {{ $course['category'] }}
                            </span>
                            {{-- Free badge --}}
                            @if ($course['price'] === 'Free')
                                <span class="absolute right-3 top-3 inline-flex h-[24px] items-center rounded-md bg-[#16a34a] px-2.5 text-[11px] font-bold text-white">
                                    Free
                                </span>
                            @endif
                            {{-- Instructor overlay --}}
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent px-4 pb-3 pt-8">
                                <p class="text-[12px] font-medium text-white/90">{{ $course['instructor'] }}</p>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="flex flex-1 flex-col px-4 pb-5 pt-3.5">
                            {{-- Level + Certificate badges --}}
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="inline-flex h-[22px] items-center rounded-md border px-2 text-[11px] font-bold {{ $course['levelColor'] }}">
                                    {{ $course['level'] }}
                                </span>
                                @if ($course['certificate'])
                                    <span class="inline-flex h-[22px] items-center gap-1 rounded-md bg-[#16a34a] px-2 text-[11px] font-bold text-white">
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                        Certificate
                                    </span>
                                @endif
                            </div>

                            <h3 class="mt-2.5 text-[15px] font-bold leading-snug text-[#101828]">{{ $course['title'] }}</h3>
                            <p class="mt-1 text-[12px] leading-relaxed text-[#667085] line-clamp-3">{{ $course['description'] }}</p>

                            {{-- Stars --}}
                            <div class="mt-3 flex items-center gap-1.5">
                                <div class="flex items-center gap-0.5">
                                    @for ($s = 1; $s <= 5; $s++)
                                        <svg class="h-3.5 w-3.5 {{ $s <= floor($course['stars']) ? 'text-[#ff8904]' : 'text-[#e5e7eb]' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-[12px] font-medium text-[#101828]">{{ number_format($course['stars'], 1) }}</span>
                            </div>

                            {{-- Meta row --}}
                            <div class="mt-2.5 flex items-center gap-3 text-[12px] text-[#98a2b3]">
                                <span class="flex items-center gap-1">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-width="2" d="M12 6v6l4 2"/></svg>
                                    {{ $course['weeks'] }} weeks
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14a3 3 0 100-6 3 3 0 000 6z"/></svg>
                                    {{ $course['students'] }}
                                </span>
                                <span class="ml-auto text-[14px] font-bold {{ $course['price'] === 'Free' ? 'text-[#16a34a]' : 'text-[#101828]' }}">{{ $course['price'] }}</span>
                            </div>

                            {{-- CTA button --}}
                            <div class="mt-auto pt-4">
                                <a
                                    href="{{ $course['url'] }}"
                                    class="flex w-full items-center justify-center gap-2 rounded-lg bg-[#e85d26] py-2.5 text-[13px] font-semibold text-white transition-colors hover:bg-[#d14f1e]"
                                >
                                    View Course
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Empty state --}}
            <div
                x-cloak
                x-show="emptyState"
                class="mt-10 rounded-2xl border border-dashed border-[#d0d5dd] px-6 py-14 text-center"
            >
                <p class="text-[18px] font-semibold text-[#101828]">No courses found</p>
                <p class="mt-1 text-[14px] text-[#98a2b3]">Try a different filter or search term.</p>
            </div>
        </div>
    </section>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('coursesPage', () => ({
            activeFilter: 'All',
            search: '',
            get emptyState() {
                const courses = @json(array_map(fn($c) => ['cat' => $c['category'], 'text' => strtolower($c['title'].' '.$c['instructor'].' '.$c['category'])], $courses));
                return courses.every(c =>
                    (this.activeFilter !== 'All' && c.cat !== this.activeFilter) ||
                    (this.search && !c.text.includes(this.search.toLowerCase()))
                );
            },
        }));
    });
</script>
@endpush
