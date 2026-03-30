@extends('layouts.app')

@section('title', 'Resources — City Life International')
@section('meta_description', 'Explore books and sermon notes from City Life International to grow in faith, leadership, and spiritual life.')

@php
    $books = [
        [
            'category'   => 'Spiritual Growth',
            'catColor'   => 'bg-[#1a2332] text-[#ff8904]',
            'title'      => 'The Spirit-Filled Life',
            'author'     => 'Bishop Robert Clarke',
            'pages'      => 214,
            'stars'      => 5,
            'image'      => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&w=600&q=80',
            'url'        => '#',
        ],
        [
            'category'   => 'Leadership',
            'catColor'   => 'bg-[#0c2a1a] text-[#34d399]',
            'title'      => 'Walking With Purpose',
            'author'     => 'Pastor James Okafor',
            'pages'      => 178,
            'stars'      => 5,
            'image'      => 'https://images.unsplash.com/photo-1519791883288-dc8bd696e667?auto=format&fit=crop&w=600&q=80',
            'url'        => '#',
        ],
        [
            'category'   => 'Faith',
            'catColor'   => 'bg-[#1e1a2e] text-[#a78bfa]',
            'title'      => 'Unshakeable Faith',
            'author'     => 'Ps. Michael Adisa',
            'pages'      => 156,
            'stars'      => 3,
            'image'      => 'https://images.unsplash.com/photo-1508002366005-75a695ee2d17?auto=format&fit=crop&w=600&q=80',
            'url'        => '#',
        ],
        [
            'category'   => 'Prayer',
            'catColor'   => 'bg-[#2a1a24] text-[#f472b6]',
            'title'      => 'Praying Through The Psalms',
            'author'     => 'Bishop Robert Clarke',
            'pages'      => 132,
            'stars'      => 5,
            'image'      => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=600&q=80',
            'url'        => '#',
        ],
    ];

    $sermonNotes = [
        [
            'category'   => 'Foundations',
            'title'      => 'Understanding Salvation',
            'speaker'    => 'Bishop Robert Clarke',
            'pages'      => 12,
            'date'       => 'Jan 2026',
            'url'        => '#',
        ],
        [
            'category'   => 'Holy Spirit',
            'title'      => 'The Gifts of the Spirit',
            'speaker'    => 'Pastor James Okafor',
            'pages'      => 18,
            'date'       => 'Feb 2026',
            'url'        => '#',
        ],
        [
            'category'   => 'Prayer',
            'title'      => 'Building A Prayer Life',
            'speaker'    => 'Ps. Michael Adisa',
            'pages'      => 10,
            'date'       => 'Feb 2026',
            'url'        => '#',
        ],
        [
            'category'   => 'Leadership',
            'title'      => 'Servant Leadership in the Church',
            'speaker'    => 'Bishop Robert Clarke',
            'pages'      => 14,
            'date'       => 'Mar 2026',
            'url'        => '#',
        ],
        [
            'category'   => 'Faith',
            'title'      => 'Faith That Moves Mountains',
            'speaker'    => 'Pastor James Okafor',
            'pages'      => 16,
            'date'       => 'Mar 2026',
            'url'        => '#',
        ],
        [
            'category'   => 'Discipleship',
            'title'      => 'Making Disciples in Your World',
            'speaker'    => 'Ps. Michael Adisa',
            'pages'      => 11,
            'date'       => 'Mar 2026',
            'url'        => '#',
        ],
    ];

    $categoryBadgeColors = [
        'Spiritual Growth' => 'bg-[#fff7ed] text-[#c2410c]',
        'Leadership'       => 'bg-[#eff6ff] text-[#1d4ed8]',
        'Faith'            => 'bg-[#f0fdf4] text-[#15803d]',
        'Prayer'           => 'bg-[#fdf4ff] text-[#7e22ce]',
        'Discipleship'     => 'bg-[#fef9c3] text-[#854d0e]',
        'Holy Spirit'      => 'bg-[#fff1f2] text-[#be123c]',
        'Foundations'      => 'bg-[#f0f9ff] text-[#0369a1]',
        'default'          => 'bg-[#f3f4f6] text-[#4b5563]',
    ];
@endphp

@push('head')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush

@section('content')
<div class="bg-white text-[#101828]" x-data="resourcesPage()">

    {{-- ============================================================
         HERO — stacked-books background
    ============================================================ --}}
    <section class="relative overflow-hidden pt-16">
        <div class="absolute inset-0">
            <img
                src="https://images.unsplash.com/photo-1457369804613-52c61a468e7d?auto=format&fit=crop&w=1800&q=80"
                alt="Resource Library"
                class="h-full w-full object-cover"
            >
            <div class="absolute inset-0 bg-black/65"></div>
        </div>

        <div class="relative mx-auto flex h-[260px] max-w-7xl flex-col items-center justify-center px-4 text-center sm:px-6 lg:px-8">
            <div class="inline-flex h-[28px] items-center rounded-full border border-white/20 bg-white/10 px-4 text-[11px] font-bold uppercase tracking-[0.12em] text-[#ff8904]">
                <svg class="mr-2 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Resource Library
            </div>

            <h1 class="mt-4 text-[48px] font-extrabold leading-none tracking-tight text-white sm:text-[56px]">
                Resources
            </h1>

            <div class="mt-3 flex items-center gap-2 text-[13px] text-white/50">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">🏠 Home</a>
                <svg class="h-3.5 w-3.5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white/80">Resources</span>
            </div>
        </div>
    </section>

    {{-- ============================================================
         CATEGORY CARDS — 2 across matching the Figma colour blocks
    ============================================================ --}}
    <section class="bg-[#f5f5f0] py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                {{-- Books --}}
                <button
                    type="button"
                    @click="activeTab = 'books'; search = ''"
                    class="group relative flex flex-col justify-end overflow-hidden rounded-2xl px-6 pb-6 pt-10 text-left transition-transform hover:-translate-y-0.5"
                    :class="activeTab === 'books' ? 'ring-2 ring-[#e85d26] ring-offset-2' : ''"
                    style="background: linear-gradient(135deg, #c23a06 0%, #e85d26 100%)"
                >
                    <svg class="mb-2.5 h-8 w-8 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <p class="text-[20px] font-extrabold text-white">Books</p>
                    <p class="mt-0.5 text-[13px] font-medium text-white/60">{{ count($books) }}+ Titles</p>
                </button>

                {{-- Sermon Notes --}}
                <button
                    type="button"
                    @click="activeTab = 'notes'; search = ''"
                    class="group relative flex flex-col justify-end overflow-hidden rounded-2xl px-6 pb-6 pt-10 text-left transition-transform hover:-translate-y-0.5"
                    :class="activeTab === 'notes' ? 'ring-2 ring-[#2563eb] ring-offset-2' : ''"
                    style="background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 100%)"
                >
                    <svg class="mb-2.5 h-8 w-8 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M6 20h12a2 2 0 002-2V8l-6-6H6a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-[20px] font-extrabold text-white">Sermon Notes</p>
                    <p class="mt-0.5 text-[13px] font-medium text-white/60">{{ count($sermonNotes) }}+ PDFs</p>
                </button>

            </div>
        </div>
    </section>

    {{-- ============================================================
         TAB BAR + SEARCH
    ============================================================ --}}
    <section class="border-b border-[#e5e7eb] bg-white">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">

            {{-- Tab pills --}}
            <div class="flex items-center gap-4">
                <button
                    type="button"
                    @click="activeTab = 'books'; search = ''"
                    :class="activeTab === 'books' ? 'bg-[#101828] text-white shadow-sm' : 'text-[#667085] hover:text-[#101828]'"
                    class="inline-flex h-[34px] items-center rounded-full px-5 text-[13px] font-semibold transition-colors"
                >Books</button>

                <button
                    type="button"
                    @click="activeTab = 'notes'; search = ''"
                    :class="activeTab === 'notes' ? 'bg-[#101828] text-white shadow-sm' : 'text-[#667085] hover:text-[#101828]'"
                    class="inline-flex h-[34px] items-center rounded-full px-5 text-[13px] font-semibold transition-colors"
                >Sermon Notes</button>
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
                    :placeholder="activeTab === 'books' ? 'Search books...' : 'Search notes...'"
                    class="h-[36px] w-full rounded-lg border border-[#e5e7eb] bg-white pl-10 pr-4 text-[13px] text-[#101828] outline-none transition-colors placeholder:text-[#99a1af] focus:border-[#d0d5dd] focus:ring-1 focus:ring-[#d0d5dd]"
                >
            </label>
        </div>
    </section>

    {{-- ============================================================
         BOOKS GRID — 4-column card layout matching Figma
    ============================================================ --}}
    <section x-show="activeTab === 'books'" class="bg-white pb-16 pt-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($books as $i => $book)
                    <div
                        x-show="!search || '{{ strtolower($book['title'] . ' ' . $book['author'] . ' ' . $book['category']) }}'.includes(search.toLowerCase())"
                        class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-[0_2px_8px_rgba(0,0,0,0.08)] transition-shadow hover:shadow-[0_8px_24px_rgba(0,0,0,0.12)]"
                    >
                        {{-- Image --}}
                        <div class="relative aspect-[4/5] overflow-hidden">
                            <img
                                src="{{ $book['image'] }}"
                                alt="{{ $book['title'] }}"
                                class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                            >
                            <span class="absolute left-3 top-3 inline-flex h-[24px] items-center rounded-md px-2.5 text-[11px] font-bold {{ $book['catColor'] }}">
                                {{ $book['category'] }}
                            </span>
                        </div>

                        {{-- Content --}}
                        <div class="flex flex-1 flex-col px-4 pb-4 pt-3">
                            <h3 class="mt-2 text-[14px] font-bold leading-snug text-[#101828]">{{ $book['title'] }}</h3>
                            <p class="mt-0.5 text-[12px] text-[#98a2b3]">{{ $book['author'] }} · {{ $book['pages'] }} pages</p>

                            <div class="mt-auto pt-4">
                                <a
                                    href="{{ $book['url'] }}"
                                    class="block w-full rounded-lg bg-[#101828] py-2.5 text-center text-[12px] font-semibold text-white transition-colors hover:bg-[#1d2939]"
                                >Get This Book</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Empty state --}}
            <div
                x-cloak
                x-show="search && {{ collect($books)->map(fn($b) => "!'". strtolower($b['title'].' '.$b['author'].' '.$b['category'])."'.includes(search.toLowerCase())")->implode(' && ') }}"
                class="mt-10 rounded-2xl border border-dashed border-[#d0d5dd] px-6 py-14 text-center"
            >
                <p class="text-[18px] font-semibold text-[#101828]">No books found</p>
                <p class="mt-1 text-[14px] text-[#98a2b3]">Try a different search term.</p>
            </div>
        </div>
    </section>

    {{-- ============================================================
         SERMON NOTES GRID — 3-column PDF card layout
    ============================================================ --}}
    <section x-cloak x-show="activeTab === 'notes'" class="bg-white pb-16 pt-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($sermonNotes as $note)
                    @php($badge = $categoryBadgeColors[$note['category']] ?? $categoryBadgeColors['default'])
                    <div
                        x-show="!search || '{{ strtolower($note['title'] . ' ' . $note['speaker'] . ' ' . $note['category']) }}'.includes(search.toLowerCase())"
                        class="group flex items-start gap-4 rounded-2xl border border-[#f3f4f6] bg-white p-5 shadow-[0_2px_8px_rgba(0,0,0,0.06)] transition-shadow hover:shadow-[0_8px_24px_rgba(0,0,0,0.1)]"
                    >
                        {{-- PDF Icon --}}
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#1e3a5f] to-[#2563eb] text-white shadow-sm">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9l-5-6H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3v6h5"/>
                            </svg>
                        </div>

                        <div class="flex flex-1 flex-col">
                            <span class="inline-flex w-fit items-center rounded-full px-2 py-0.5 text-[11px] font-bold {{ $badge }}">
                                {{ $note['category'] }}
                            </span>
                            <h3 class="mt-1.5 text-[14px] font-bold leading-snug text-[#101828]">{{ $note['title'] }}</h3>
                            <p class="mt-0.5 text-[12px] text-[#98a2b3]">{{ $note['speaker'] }} · {{ $note['pages'] }} pages · {{ $note['date'] }}</p>

                            <a
                                href="{{ $note['url'] }}"
                                class="mt-3 inline-flex items-center gap-1.5 text-[13px] font-semibold text-[#2563eb] transition-colors hover:text-[#1d4ed8]"
                            >
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Download PDF
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Empty state --}}
            <div
                x-cloak
                x-show="search && {{ collect($sermonNotes)->map(fn($n) => "!'". strtolower($n['title'].' '.$n['speaker'].' '.$n['category'])."'.includes(search.toLowerCase())")->implode(' && ') }}"
                class="mt-10 rounded-2xl border border-dashed border-[#d0d5dd] px-6 py-14 text-center"
            >
                <p class="text-[18px] font-semibold text-[#101828]">No sermon notes found</p>
                <p class="mt-1 text-[14px] text-[#98a2b3]">Try a different search term.</p>
            </div>
        </div>
    </section>

    {{-- ============================================================
         APP DOWNLOAD CTA
    ============================================================ --}}
    <section class="bg-[#111118] py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center gap-6 sm:flex-row sm:items-center">
                <div class="flex h-[72px] w-[72px] shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-[#ff8904] via-[#fb2c36] to-[#9810fa] text-[32px] shadow-lg">
                    🔥
                </div>
                <div class="flex-1 text-center sm:text-left">
                    <h2 class="text-[24px] font-bold text-white">Download The City Life App</h2>
                    <p class="mt-1 max-w-lg text-[14px] leading-relaxed text-white/50">
                        Access all our sermons, devotionals, giving, events and live streams — right in your pocket. Available on iOS and Android.
                    </p>
                </div>
                <div class="flex gap-3">
                    <a
                        href="#"
                        class="inline-flex h-[42px] items-center gap-2 rounded-full border border-white/15 bg-white px-5 text-[13px] font-semibold text-[#101828] transition hover:bg-white/90"
                    >
                        🍎 App Store
                    </a>
                    <a
                        href="#"
                        class="inline-flex h-[42px] items-center gap-2 rounded-full border border-white/15 bg-white px-5 text-[13px] font-semibold text-[#101828] transition hover:bg-white/90"
                    >
                        🤖 Google Play
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('resourcesPage', () => ({
            activeTab: 'books',
            search: '',
        }));
    });
</script>
@endpush
