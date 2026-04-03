@extends('layouts.app')

@section('title', $book->title . ' — City Life International')
@section('meta_description', Str::limit($book->subtitle ?? $book->description, 160))

@push('head')
<style>[x-cloak]{display:none!important}</style>
@endpush

@section('content')
<div class="bg-[#f9fafb] text-[#101828]" x-data="{ tab: 'overview' }">

    {{-- ============================================================
         HERO
    ============================================================ --}}
    <section class="relative overflow-hidden bg-[#18151a] pt-20 pb-0">

        {{-- Background blurred cover --}}
        @if($book->featured_image_url)
        <div class="absolute inset-0">
            <img src="{{ $book->featured_image_url }}" alt="" class="h-full w-full object-cover opacity-20 blur-sm scale-105">
            <div class="absolute inset-0 bg-gradient-to-b from-[#18151a]/70 via-[#18151a]/80 to-[#18151a]"></div>
        </div>
        @endif

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-[13px] text-white/40 mb-8">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">🏠 Home</a>
                <svg class="h-3.5 w-3.5 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('books.index') }}" class="hover:text-white transition-colors">Books</a>
                <svg class="h-3.5 w-3.5 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white/70 truncate max-w-[200px]">{{ $book->title }}</span>
            </div>

            <div class="flex flex-col gap-8 pb-12 lg:flex-row lg:items-end lg:gap-12">

                {{-- Book cover --}}
                <div class="shrink-0">
                    <div class="relative w-44 sm:w-52 overflow-hidden rounded-xl shadow-2xl shadow-black/60 ring-1 ring-white/10">
                        @if($book->featured_image_url)
                            <img src="{{ $book->featured_image_url }}" alt="{{ $book->title }}" class="w-full object-cover">
                        @else
                            <div class="aspect-[3/4] bg-gradient-to-br from-[#e85d26]/30 to-[#1c1820] flex flex-col items-center justify-center p-5 text-center">
                                <svg class="h-10 w-10 text-white/30 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-white/40">City Life Press</span>
                                <span class="mt-1 text-sm font-bold text-white leading-snug">{{ $book->title }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Book info --}}
                <div class="flex-1 min-w-0">

                    {{-- Category badges --}}
                    @if($book->categories)
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($book->categories as $cat)
                        <a href="{{ route('books.index') }}?category={{ urlencode($cat) }}"
                           class="inline-flex h-[24px] items-center rounded-md bg-[#e85d26] px-2.5 text-[11px] font-bold text-white hover:bg-[#d4521f] transition-colors">
                            {{ $cat }}
                        </a>
                        @endforeach
                    </div>
                    @endif

                    <h1 class="text-[32px] font-extrabold text-white leading-tight sm:text-[44px]">{{ $book->title }}</h1>
                    @if($book->subtitle)
                    <p class="mt-2 text-[16px] text-white/55 leading-relaxed">{{ $book->subtitle }}</p>
                    @endif

                    {{-- Author row --}}
                    <div class="mt-5 flex items-center gap-3">
                        @if($book->leader?->image_path)
                            <img src="{{ $book->leader->image_path }}" alt="{{ $book->author }}" class="h-9 w-9 rounded-full object-cover ring-2 ring-white/20">
                        @else
                            <div class="h-9 w-9 rounded-full bg-[#e85d26]/20 flex items-center justify-center ring-2 ring-white/10">
                                <span class="text-sm font-bold text-[#e85d26]">{{ strtoupper(substr($book->author, 0, 1)) }}</span>
                            </div>
                        @endif
                        <div>
                            <p class="text-[14px] font-semibold text-white">{{ $book->author }}</p>
                            @if($book->leader?->role)
                            <p class="text-[12px] text-white/40">{{ $book->leader->role }}</p>
                            @endif
                        </div>

                        @if($book->star_rating > 0)
                        <div class="ml-4 flex items-center gap-1.5">
                            <div class="flex items-center gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="h-4 w-4 {{ $i <= round($book->star_rating) ? 'text-amber-400' : 'text-white/20' }}" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                            </div>
                            <span class="text-[13px] font-semibold text-white">{{ number_format($book->star_rating, 1) }}</span>
                            @if($book->review_count > 0)
                            <span class="text-[12px] text-white/40">({{ number_format($book->review_count) }} reviews)</span>
                            @endif
                        </div>
                        @endif
                    </div>

                    {{-- Meta row --}}
                    <div class="mt-4 flex flex-wrap items-center gap-5 text-[13px] text-white/50">
                        @if($book->page_count)
                        <span class="flex items-center gap-1.5">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            {{ $book->page_count }} pages
                        </span>
                        @endif
                        @if($book->publisher)
                        <span class="flex items-center gap-1.5">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            {{ $book->publisher }}
                        </span>
                        @endif
                        @if($book->published_month)
                        <span class="flex items-center gap-1.5">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $book->published_month }}
                        </span>
                        @endif
                    </div>

                    {{-- CTA --}}
                    <div class="mt-7 flex flex-wrap items-center gap-3">
                        @if($book->amazon_url)
                        <a href="{{ $book->amazon_url }}" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 rounded-full bg-[#e85d26] px-7 py-3 text-[14px] font-bold text-white shadow-lg shadow-[#e85d26]/30 hover:bg-[#d4521f] transition-colors">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Get This Book on Amazon
                        </a>
                        @endif
                        @if($book->kindle_url)
                        <a href="{{ $book->kindle_url }}" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-5 py-3 text-[14px] font-semibold text-white backdrop-blur-sm hover:bg-white/20 transition-colors">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            Kindle Edition
                        </a>
                        @endif
                        <button
                            onclick="if(navigator.share){navigator.share({title:'{{addslashes($book->title)}}',url:window.location.href})}"
                            class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white backdrop-blur-sm hover:bg-white/20 transition-colors">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Tabs --}}
            <div class="flex gap-1 border-b border-white/10 -mx-4 px-4 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                @foreach([['overview','Overview'],['author','About Author']] as [$key,$label])
                <button
                    @click="tab = '{{ $key }}'"
                    :class="tab === '{{ $key }}' ? 'border-[#e85d26] text-white' : 'border-transparent text-white/40 hover:text-white/70'"
                    class="border-b-2 pb-3 pt-1 px-4 text-[13px] font-semibold transition-colors whitespace-nowrap">
                    {{ $label }}
                </button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         BODY
    ============================================================ --}}
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-8 lg:flex-row lg:items-start">

            {{-- ===== LEFT (tab content) ===== --}}
            <div class="flex-1 min-w-0">

                {{-- Overview tab --}}
                <div x-show="tab === 'overview'" x-cloak>
                    <div class="rounded-2xl bg-white p-6 shadow-sm sm:p-8">
                        <div class="mb-4 flex items-center gap-3">
                            <span class="h-[3px] w-6 rounded-full bg-[#e85d26]"></span>
                            <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">About This Book</h2>
                        </div>
                        @if($book->description)
                        <p class="text-[14px] leading-relaxed text-[#667085] whitespace-pre-line">{{ $book->description }}</p>
                        @else
                        <p class="text-[13px] text-[#98a2b3]">No description available.</p>
                        @endif
                    </div>
                </div>

                {{-- About Author tab --}}
                <div x-show="tab === 'author'" x-cloak>
                    <div class="rounded-2xl bg-white p-6 shadow-sm sm:p-8">

                        {{-- Author card --}}
                        <div class="flex items-start gap-4 mb-6">
@if($book->leader?->image_path)
                                <img src="{{ $book->leader->image_path }}" alt="{{ $book->author }}" class="h-16 w-16 rounded-full object-cover ring-2 ring-[#f2f4f7] shrink-0">
                        @else
                                <div class="h-16 w-16 shrink-0 rounded-full bg-[#e85d26]/10 flex items-center justify-center">
                                    <span class="text-2xl font-extrabold text-[#e85d26]">{{ strtoupper(substr($book->author, 0, 1)) }}</span>
                                </div>
                        @endif
                            <div>
                                <h3 class="text-[17px] font-extrabold text-[#101828]">{{ $book->author }}</h3>
                                @if($book->leader?->role)
                                <p class="text-[13px] font-semibold text-[#e85d26] mt-0.5">{{ $book->leader->role }}</p>
                                @endif
                            </div>
                        </div>

                        @if($book->leader?->bio)
                        <div class="mb-4 flex items-center gap-3">
                            <span class="h-[3px] w-6 rounded-full bg-[#e85d26]"></span>
                            <h4 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">Biography</h4>
                        </div>
                        <p class="text-[14px] leading-relaxed text-[#667085] whitespace-pre-line mb-6">{{ $book->leader->bio }}</p>
                        @endif

                        @if($book->leader)
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('leadership') }}"
                               class="inline-flex items-center gap-2 rounded-full border border-[#e4e7ec] px-4 py-2 text-[13px] font-semibold text-[#344054] hover:border-[#e85d26] hover:text-[#e85d26] transition-colors">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                View Author Profile
                            </a>
                            @if($relatedBooks->isNotEmpty())
                            <a href="{{ route('books.index') }}"
                               class="inline-flex items-center gap-2 rounded-full border border-[#e4e7ec] px-4 py-2 text-[13px] font-semibold text-[#344054] hover:border-[#e85d26] hover:text-[#e85d26] transition-colors">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                All Books by This Author
                            </a>
                            @endif
                        </div>
                        @endif
                    </div>

                    {{-- More by author --}}
                    @if($relatedBooks->isNotEmpty())
                    <div class="mt-6 rounded-2xl bg-white p-6 shadow-sm sm:p-8">
                        <div class="mb-5 flex items-center gap-3">
                            <span class="h-[3px] w-6 rounded-full bg-[#e85d26]"></span>
                            <h4 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">More by {{ Str::before($book->author, ' ') }}</h4>
                        </div>
                        <div class="divide-y divide-[#f2f4f7]">
                            @foreach($relatedBooks->take(5) as $related)
                            <a href="{{ route('books.show', $related->slug) }}"
                               class="flex items-center gap-4 py-4 group first:pt-0 last:pb-0">
                                <div class="h-14 w-10 shrink-0 overflow-hidden rounded-md bg-gradient-to-br from-[#e85d26]/20 to-[#1c1820]">
                                    @if($related->featured_image_url)
                                        <img src="{{ $related->featured_image_url }}" alt="{{ $related->title }}" class="h-full w-full object-cover">
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[14px] font-semibold text-[#101828] group-hover:text-[#e85d26] transition-colors truncate">{{ $related->title }}</p>
                                    @if($related->page_count)
                                    <p class="text-[12px] text-[#98a2b3]">{{ $related->page_count }} pages</p>
                                    @endif
                                    @if($related->star_rating > 0)
                                    <div class="mt-0.5 flex items-center gap-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                        <svg class="h-3 w-3 {{ $i <= round($related->star_rating) ? 'text-amber-400' : 'text-gray-200' }}" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        @endfor
                                    </div>
                                    @endif
                                </div>
                                <svg class="h-4 w-4 shrink-0 text-[#d0d5dd] group-hover:text-[#e85d26] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- ===== RIGHT SIDEBAR ===== --}}
            <div class="w-full shrink-0 lg:w-72 xl:w-80">

                {{-- Purchase card --}}
                <div class="rounded-2xl bg-white p-6 shadow-sm mb-5">
                    @if($book->amazon_url)
                    <a href="{{ $book->amazon_url }}" target="_blank" rel="noopener noreferrer"
                       class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#e85d26] px-5 py-3.5 text-[14px] font-bold text-white shadow-sm hover:bg-[#d4521f] transition-colors">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Get This Book on Amazon
                    </a>
                    @else
                    <div class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#f2f4f7] px-5 py-3.5 text-[14px] font-bold text-[#98a2b3]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Coming Soon
                    </div>
                    @endif

                    @if($book->kindle_url)
                    <div class="mt-3 border-t border-[#f2f4f7] pt-4">
                        <p class="mb-2 text-[11px] font-semibold uppercase tracking-wider text-[#98a2b3]">Also Available As</p>
                        <a href="{{ $book->kindle_url }}" target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-3 rounded-lg border border-[#e4e7ec] px-4 py-2.5 text-[13px] font-semibold text-[#344054] hover:border-[#e85d26] hover:text-[#e85d26] transition-colors">
                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            Kindle Edition <span class="ml-auto text-[11px] text-[#98a2b3]">via Amazon</span>
                        </a>
                    </div>
                    @endif

                    {{-- Book details --}}
                    @if($book->publisher || $book->published_month || $book->page_count || $book->isbn || $book->language || $book->format)
                    <div class="mt-4 border-t border-[#f2f4f7] pt-4">
                        <p class="mb-3 text-[11px] font-semibold uppercase tracking-wider text-[#98a2b3]">Book Details</p>
                        <dl class="space-y-2">
                            @if($book->author)
                            <div class="flex justify-between text-[13px]">
                                <dt class="text-[#98a2b3]">Author</dt>
                                <dd class="font-medium text-[#101828] text-right max-w-[160px]">{{ $book->author }}</dd>
                            </div>
                            @endif
                            @if($book->publisher)
                            <div class="flex justify-between text-[13px]">
                                <dt class="text-[#98a2b3]">Publisher</dt>
                                <dd class="font-medium text-[#101828]">{{ $book->publisher }}</dd>
                            </div>
                            @endif
                            @if($book->published_month)
                            <div class="flex justify-between text-[13px]">
                                <dt class="text-[#98a2b3]">Published</dt>
                                <dd class="font-medium text-[#101828]">{{ $book->published_month }}</dd>
                            </div>
                            @endif
                            @if($book->page_count)
                            <div class="flex justify-between text-[13px]">
                                <dt class="text-[#98a2b3]">Pages</dt>
                                <dd class="font-medium text-[#101828]">{{ $book->page_count }}</dd>
                            </div>
                            @endif
                            @if($book->isbn)
                            <div class="flex justify-between text-[13px]">
                                <dt class="text-[#98a2b3]">ISBN</dt>
                                <dd class="font-medium text-[#101828] text-right">{{ $book->isbn }}</dd>
                            </div>
                            @endif
                            @if($book->language)
                            <div class="flex justify-between text-[13px]">
                                <dt class="text-[#98a2b3]">Language</dt>
                                <dd class="font-medium text-[#101828]">{{ $book->language }}</dd>
                            </div>
                            @endif
                            @if($book->format)
                            <div class="flex justify-between text-[13px]">
                                <dt class="text-[#98a2b3]">Format</dt>
                                <dd class="font-medium text-[#101828]">{{ $book->format }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                    @endif

                    {{-- Share --}}
                    <div class="mt-4 border-t border-[#f2f4f7] pt-4">
                        <p class="mb-2 text-[11px] font-semibold uppercase tracking-wider text-[#98a2b3]">Share This Book</p>
                        <button
                            onclick="if(navigator.share){navigator.share({title:'{{addslashes($book->title)}}',url:window.location.href})}else{navigator.clipboard.writeText(window.location.href)}"
                            class="flex w-full items-center justify-center gap-2 rounded-lg border border-[#e4e7ec] px-4 py-2.5 text-[13px] font-semibold text-[#344054] hover:border-[#e85d26] hover:text-[#e85d26] transition-colors">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                            Share with Friends
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
