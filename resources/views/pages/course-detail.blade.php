@extends('layouts.app')

@php
    $catColors = [
        'Theology'   => 'bg-[#7c3aed]',
        'Leadership' => 'bg-[#16a34a]',
        'Prayer'     => 'bg-[#dc2626]',
        'Evangelism' => 'bg-[#f97316]',
        'Family Life'=> 'bg-[#ec4899]',
        'Worship'    => 'bg-[#a855f7]',
        'Bible Study'=> 'bg-[#2563eb]',
    ];
    $getCatColor = fn ($cat) => $catColors[$cat] ?? 'bg-[#6b7280]';
    $getWeeks    = fn ($s, $e) => ($s && $e) ? (int) ceil($s->diffInDays($e) / 7) : null;
    $instructorName    = $course->instructor_name;
    $instructorInitial = strtoupper(substr($instructorName, 0, 1));
@endphp

@section('title', $course->title . ' — City Life International')
@section('meta_description', Str::limit($course->description, 160))

@push('head')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush

@section('content')
<div class="bg-[#f9fafb] text-[#101828]" x-data="courseDetail()">

    {{-- ============================================================
         HERO
    ============================================================ --}}
    <section class="relative overflow-hidden pt-16">
        <div class="absolute inset-0">
            @if ($course->image_path)
                <img src="{{ $course->image_path }}" alt="{{ $course->title }}" class="h-full w-full object-cover">
            @else
                <div class="h-full w-full {{ $getCatColor($course->category) }}"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/60 to-black/40"></div>
        </div>

        <div class="relative mx-auto flex min-h-[280px] max-w-7xl flex-col justify-end px-4 pb-8 sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <div class="mb-5 flex items-center gap-2 text-[13px] text-white/50">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">🏠 Home</a>
                <svg class="h-3.5 w-3.5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('courses') }}" class="transition-colors hover:text-white">Courses</a>
                <svg class="h-3.5 w-3.5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white/80">{{ $course->title }}</span>
            </div>

            {{-- Badges --}}
            <div class="flex flex-wrap items-center gap-2">
                @if ($course->category)
                    <span class="inline-flex h-[24px] items-center rounded-md px-2.5 text-[11px] font-bold text-white {{ $getCatColor($course->category) }}">{{ $course->category }}</span>
                @endif
                @if ($course->has_certificate)
                    <span class="inline-flex h-[24px] items-center gap-1 rounded-md bg-[#f97316] px-2.5 text-[11px] font-bold text-white">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        Certificate Awarded
                    </span>
                @endif
                @if ($course->is_registration_open)
                    <span class="inline-flex h-[24px] items-center rounded-md bg-[#16a34a] px-2.5 text-[11px] font-bold text-white">Registration Open</span>
                @endif
            </div>

            <h1 class="mt-3 text-[36px] font-extrabold leading-tight text-white sm:text-[44px]">{{ $course->title }}</h1>

            {{-- Meta row --}}
            @php $weeks = $getWeeks($course->start_date, $course->end_date); @endphp
            <div class="mt-4 flex flex-wrap items-center gap-4 text-[13px] text-white/70">
                @if ($instructorName)
                    <span class="flex items-center gap-1.5">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        {{ $instructorName }}
                    </span>
                @endif
                @if ($weeks)
                    <span class="flex items-center gap-1.5">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-width="2" d="M12 6v6l4 2"/></svg>
                        {{ $weeks }} weeks
                    </span>
                @endif
                @if ($course->lessons->count())
                    <span class="flex items-center gap-1.5">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $course->lessons->count() }} lessons
                    </span>
                @endif
            </div>

        </div>
    </section>

    {{-- ============================================================
         BODY — 2-column layout
    ============================================================ --}}
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- Back link --}}
        <a href="{{ route('courses') }}" class="mb-8 inline-flex items-center gap-2 text-[13px] font-medium text-[#667085] transition-colors hover:text-[#101828]">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Courses
        </a>

        <div class="flex flex-col gap-10 lg:flex-row">

            {{-- ========== LEFT COLUMN ========== --}}
            <div class="flex-1 min-w-0">

                {{-- ABOUT THIS COURSE --}}
                <div class="rounded-2xl bg-white p-6 shadow-sm sm:p-8">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="h-[3px] w-6 rounded-full bg-[#e85d26]"></span>
                        <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">About This Course</h2>
                    </div>
                    <p class="text-[14px] leading-relaxed text-[#667085]">{{ $course->description }}</p>
                </div>

                {{-- COURSE CURRICULUM --}}
                <div class="mt-6 rounded-2xl bg-white p-6 shadow-sm sm:p-8">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="h-[3px] w-6 rounded-full bg-[#e85d26]"></span>
                        <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">Course Lessons</h2>
                        @if ($course->lessons->isNotEmpty())
                            <span class="ml-auto text-[12px] text-[#98a2b3]">{{ $course->lessons->count() }} {{ Str::plural('lesson', $course->lessons->count()) }}</span>
                        @endif
                    </div>

                    @if ($course->lessons->isEmpty())
                        <p class="text-[13px] text-[#98a2b3]">Lessons will be published soon.</p>
                    @else
                        <div class="divide-y divide-[#f3f4f6]">
                            @foreach ($course->lessons as $lesson)
                                <div x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }">
                                    <button
                                        type="button"
                                        @click="open = !open"
                                        class="flex w-full items-center gap-3 py-4 text-left"
                                    >
                                        <span class="flex p-2 h-[26px] w-[26px] shrink-0 items-center justify-center rounded-full border-2 border-[#e85d26] text-[14px] font-bold text-[#e85d26]">
                                            {{ $lesson->lesson_number ?? $loop->iteration }}
                                        </span>
                                        <span class="flex-1 text-[14px] font-semibold text-[#101828]">{{ $lesson->title }}</span>
                                        <svg :class="{ 'rotate-180': open }" class="h-5 w-5 shrink-0 text-[#98a2b3] transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>

                                    <div x-show="open" x-cloak x-collapse class="pb-4">
                                        @if ($lesson->description)
                                            <p class="mb-3 text-[13px] leading-relaxed text-[#667085]">{{ $lesson->description }}</p>
                                        @endif
                                        @if ($lesson->content)
                                            <div class="prose prose-sm max-w-none text-[#374151]">{!! $lesson->content !!}</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- YOUR INSTRUCTOR --}}
@if ($instructorName)
                <div class="mt-6 rounded-2xl bg-white p-6 shadow-sm sm:p-8">
                    <div class="flex items-start gap-4">
                        @if ($course->leader && $course->leader->image_path)
                            <img src="{{ $course->leader->image_path }}" alt="{{ $instructorName }}" class="h-12 w-12 shrink-0 rounded-xl object-cover">
                        @else
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl {{ $getCatColor($course->category) }} text-[18px] font-bold text-white">
                                {{ $instructorInitial }}
                            </div>
                        @endif
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">Your Instructor</p>
                            <h3 class="mt-0.5 text-[16px] font-bold text-[#101828]">{{ $instructorName }}</h3>
                            @if ($course->leader?->role)
                                <p class="text-[12px] text-[#98a2b3]">{{ $course->leader->role }}</p>
                            @endif
                            @if ($course->leader?->bio)
                                <p class="mt-2 text-[13px] leading-relaxed text-[#667085]">{{ $course->leader->bio }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                {{-- SHARE --}}
                <div class="mt-6 flex flex-wrap items-center gap-3 rounded-2xl bg-white px-6 py-4 shadow-sm">
                    <span class="flex items-center gap-2 text-[13px] font-medium text-[#667085]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                        Share this course:
                    </span>
                    <a href="#" class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] px-3.5 text-[12px] font-medium text-[#374151] transition-colors hover:border-[#d0d5dd] hover:bg-[#f9fafb]">Facebook</a>
                    <a href="#" class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] px-3.5 text-[12px] font-medium text-[#374151] transition-colors hover:border-[#d0d5dd] hover:bg-[#f9fafb]">X / Twitter</a>
                    <a href="#" class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] px-3.5 text-[12px] font-medium text-[#374151] transition-colors hover:border-[#d0d5dd] hover:bg-[#f9fafb]">WhatsApp</a>
                    <button type="button" @click="copyLink()" class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] px-3.5 text-[12px] font-medium text-[#374151] transition-colors hover:border-[#d0d5dd] hover:bg-[#f9fafb]">
                        <span x-text="copied ? 'Copied!' : 'Copy Link'"></span>
                    </button>
                </div>

            </div>

            {{-- ========== RIGHT COLUMN (Sidebar) ========== --}}
            <div class="w-full lg:w-[340px] lg:shrink-0">
                <div class="sticky top-20 space-y-6">

                    {{-- ENROL CARD --}}
                    <div class="overflow-hidden rounded-2xl bg-white shadow-sm">
                        <div class="bg-gradient-to-br from-[#e85d26] to-[#f97316] px-6 py-5">
                            <p class="text-[11px] font-bold uppercase tracking-[0.1em] text-white/70">Enrol Now</p>
                            @php $weeks = $getWeeks($course->start_date, $course->end_date); @endphp
                            <p class="mt-1 text-[13px] text-white/60">
                                {{ $weeks ? $weeks . ' weeks' : '' }}
                                {{ $weeks && $course->lessons->count() ? ' · ' : '' }}
                                {{ $course->lessons->count() ? $course->lessons->count() . ' lessons' : '' }}
                            </p>
                        </div>

                        <div class="space-y-3 px-6 py-5">
                            @if (session('enrol_success'))
                                <div class="rounded-lg bg-green-50 px-4 py-3 text-[13px] text-green-700">
                                    {{ session('enrol_success') }}
                                </div>
                            @elseif (session('enrol_error'))
                                <div class="rounded-lg bg-red-50 px-4 py-3 text-[13px] text-red-700">
                                    {{ session('enrol_error') }}
                                </div>
                            @endif

                            @if ($errors->has('name') || $errors->has('email'))
                                <div class="rounded-lg bg-red-50 px-4 py-3 text-[13px] text-red-700">
                                    @foreach ($errors->all() as $error) <p>{{ $error }}</p> @endforeach
                                </div>
                            @endif

                            <form method="POST" action="{{ route('courses.enrol', $course->slug) }}">
                                @csrf
                                <div class="space-y-3">
                                    <input
                                        type="text"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Full Name *"
                                        class="h-[42px] w-full rounded-lg border border-[#e5e7eb] px-4 text-[13px] text-[#101828] outline-none placeholder:text-[#98a2b3] focus:border-[#d0d5dd] focus:ring-1 focus:ring-[#d0d5dd]"
                                    >
                                    <input
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="Email Address *"
                                        class="h-[42px] w-full rounded-lg border border-[#e5e7eb] px-4 text-[13px] text-[#101828] outline-none placeholder:text-[#98a2b3] focus:border-[#d0d5dd] focus:ring-1 focus:ring-[#d0d5dd]"
                                    >
                                    <button
                                        type="submit"
                                        @class([
                                            'h-[44px] w-full rounded-lg text-[14px] font-semibold text-white transition-colors',
                                            'bg-[#e85d26] hover:bg-[#d14f1e]' => $course->is_registration_open,
                                            'cursor-not-allowed bg-[#d0d5dd]'  => ! $course->is_registration_open,
                                        ])
                                        @if (! $course->is_registration_open) disabled @endif
                                    >
                                        {{ $course->is_registration_open ? 'Register Now' : 'Coming Soon' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- THIS COURSE INCLUDES --}}
                    <div class="rounded-2xl bg-white p-6 shadow-sm">
                        <h3 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#667085]">This Course Includes</h3>
                        <ul class="mt-4 space-y-3">
                            @if ($course->lessons->count())
                                <li class="flex items-start gap-2.5 text-[13px] text-[#667085]">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#16a34a]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    {{ $course->lessons->count() }} on-demand lessons
                                </li>
                            @endif
                            @if ($course->has_certificate)
                                <li class="flex items-start gap-2.5 text-[13px] text-[#667085]">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#16a34a]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    Certificate of completion
                                </li>
                            @endif
                            @if ($course->start_date)
                                <li class="flex items-start gap-2.5 text-[13px] text-[#667085]">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#16a34a]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    Starts {{ $course->start_date->format('j F Y') }}
                                </li>
                            @endif
                            <li class="flex items-start gap-2.5 text-[13px] text-[#667085]">
                                <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#16a34a]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Lifetime access to materials
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('courseDetail', () => ({
            copied: false,
            copyLink() {
                navigator.clipboard.writeText(window.location.href);
                this.copied = true;
                setTimeout(() => this.copied = false, 2000);
            },
        }));
    });
</script>
@endpush
