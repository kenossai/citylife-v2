@extends('layouts.app')

@section('title', 'Books — City Life International')
@section('meta_description', 'Explore books published by City Life International Church leaders and pastors.')

@section('content')
<div class="bg-[#f9fafb] min-h-screen">

    {{-- Page Header --}}
    <section class="relative overflow-hidden bg-[#18151a] pt-24 pb-16">
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute -top-32 -right-32 h-96 w-96 rounded-full bg-[#e85d26]/10 blur-3xl"></div>
            <div class="absolute bottom-0 left-10 h-64 w-64 rounded-full bg-purple-600/10 blur-3xl"></div>
        </div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-[13px] text-white/40 mb-6">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">🏠 Home</a>
                <svg class="h-3.5 w-3.5 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white/70">Books</span>
            </div>
            <h1 class="text-4xl font-extrabold text-white sm:text-5xl">Books</h1>
            <p class="mt-3 text-[15px] text-white/50 max-w-xl">Explore books published by City Life International Church leaders and pastors.</p>
        </div>
    </section>

    {{-- Content --}}
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8"
         x-data="{ activeCategory: 'All' }">

        {{-- Category filters --}}
        @if($categories->count() > 1)
        <div class="mb-8 flex flex-wrap gap-2">
            @foreach($categories as $cat)
            <button
                @click="activeCategory = '{{ $cat }}'"
                :class="activeCategory === '{{ $cat }}'
                    ? 'bg-[#e85d26] text-white border-[#e85d26]'
                    : 'bg-white text-[#667085] border-[#e4e7ec] hover:border-[#e85d26] hover:text-[#e85d26]'"
                class="rounded-full border px-4 py-1.5 text-[13px] font-semibold transition-colors">
                {{ $cat }}
            </button>
            @endforeach
        </div>
        @endif

        @if($books->isEmpty())
        <div class="rounded-2xl bg-white border border-[#e4e7ec] px-8 py-20 text-center">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-[#f9fafb]">
                <svg class="h-7 w-7 text-[#98a2b3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h3 class="text-[15px] font-bold text-[#101828]">No books yet</h3>
            <p class="mt-1 text-[13px] text-[#98a2b3]">Check back soon.</p>
        </div>
        @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($books as $book)
            @php
                $bookCats = $book->categories ?? [];
            @endphp
            <div
                x-show="activeCategory === 'All' || {{ json_encode($bookCats) }}.includes(activeCategory)"
                class="group rounded-2xl bg-white shadow-sm border border-[#f2f4f7] overflow-hidden hover:shadow-md transition-shadow flex flex-col">

                {{-- Cover --}}
                <a href="{{ route('books.show', $book->slug) }}" class="relative block aspect-[3/4] overflow-hidden bg-gradient-to-br from-[#e85d26]/20 to-[#1c1820]">
                    @if($book->featured_image_url)
                        <img src="{{ $book->featured_image_url }}" alt="{{ $book->title }}"
                             class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                    @else
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center">
                            <svg class="h-12 w-12 text-white/30 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span class="text-white/70 text-xs font-semibold uppercase tracking-wider">City Life Press</span>
                            <span class="text-white text-sm font-bold mt-1 line-clamp-2">{{ $book->title }}</span>
                        </div>
                    @endif
                    @if($bookCats)
                        <div class="absolute top-3 left-3 flex flex-wrap gap-1">
                            @foreach(array_slice($bookCats, 0, 1) as $cat)
                            <span class="rounded-md bg-[#e85d26] px-2 py-0.5 text-[10px] font-bold text-white">{{ $cat }}</span>
                            @endforeach
                        </div>
                    @endif
                </a>

                {{-- Body --}}
                <div class="flex flex-col flex-1 p-4">
                    <a href="{{ route('books.show', $book->slug) }}" class="text-[15px] font-bold text-[#101828] hover:text-[#e85d26] transition-colors line-clamp-2 leading-snug">{{ $book->title }}</a>
                    <p class="mt-0.5 text-[12px] text-[#98a2b3]">{{ $book->author }}</p>

                    @if($book->star_rating > 0)
                    <div class="mt-2 flex items-center gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="h-3.5 w-3.5 {{ $i <= round($book->star_rating) ? 'text-amber-400' : 'text-gray-200' }}" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                        @if($book->review_count > 0)
                        <span class="ml-1 text-[11px] text-[#98a2b3]">({{ number_format($book->review_count) }})</span>
                        @endif
                    </div>
                    @endif

                    <div class="mt-auto pt-4 flex items-center justify-between">
                        @if($book->price)
                        <span class="text-[15px] font-extrabold text-[#101828]">£{{ number_format($book->price, 2) }}</span>
                        @endif
                        <a href="{{ route('books.show', $book->slug) }}"
                           class="ml-auto inline-flex items-center gap-1.5 rounded-full bg-[#e85d26] px-3.5 py-1.5 text-[12px] font-semibold text-white hover:bg-[#d4521f] transition-colors">
                            View Book
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
