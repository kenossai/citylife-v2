@extends('layouts.member')

@section('title', 'My Certificates')

@section('content')

{{-- ── Page heading ── --}}
<div class="mb-8">
    <p class="text-[#e85d26] text-xs font-semibold uppercase tracking-widest mb-2">Bible School</p>
    <h1 class="text-2xl font-extrabold text-gray-900">My Certificates</h1>
    <p class="text-gray-500 text-sm mt-1">Certificates you've earned by completing courses.</p>
</div>

{{-- ── Earned certificates ── --}}
@if($certificates->isNotEmpty())

<div class="mb-6 flex items-center gap-3">
    <div class="h-0.5 w-5 bg-[#e85d26]"></div>
    <h2 class="text-xs font-bold uppercase tracking-widest text-gray-500">Earned Certificates</h2>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
    @foreach($certificates as $cert)
    @php
        $course     = $cert['course'];
        $enrollment = $cert['enrollment'];
        $grade      = $cert['grade'];
        $issuedAt   = $cert['issued_at'];
        $weeks      = $cert['duration_weeks'];
        $instructor = $course->instructor_name;
    @endphp

    <div class="rounded-2xl overflow-hidden bg-white border border-gray-200 shadow-sm flex flex-col">

        {{-- Gradient header --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-purple-500 via-purple-400 to-pink-500 px-6 pt-8 pb-10 flex flex-col items-center text-center">

            {{-- Decorative concentric rings --}}
            <div class="pointer-events-none absolute inset-0 flex items-center justify-center">
                <div class="h-56 w-56 rounded-full border border-white/10"></div>
            </div>
            <div class="pointer-events-none absolute inset-0 flex items-center justify-center">
                <div class="h-40 w-40 rounded-full border border-white/10"></div>
            </div>
            <div class="pointer-events-none absolute inset-0 flex items-center justify-center">
                <div class="h-24 w-24 rounded-full border border-white/10"></div>
            </div>

            {{-- Medal icon --}}
            <div class="relative z-10 mb-4 flex h-14 w-14 items-center justify-center rounded-full border-2 border-white/30 bg-white/20">
                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 4H8l-1 5h10l-1-5z"/>
                    <circle cx="12" cy="15" r="4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 9l-2 10M15 9l2 10"/>
                </svg>
            </div>

            <p class="relative z-10 text-[11px] font-semibold uppercase tracking-[0.15em] text-white/80 mb-1">
                Certificate of Completion
            </p>
            <h3 class="relative z-10 text-lg font-extrabold text-white leading-snug">
                {{ $course->title }}
            </h3>
        </div>

        {{-- Body --}}
        <div class="flex-1 px-5 py-4">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-sm font-bold text-gray-900">{{ $member->full_name }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">
                        @if($instructor){{ $instructor }}@endif
                        @if($instructor && $weeks) &middot; @endif
                        @if($weeks){{ $weeks }} {{ Str::plural('week', $weeks) }}@endif
                    </p>
                </div>

                @if($grade)
                @php
                    $gradeBg    = $grade === 'Distinction' ? 'bg-amber-100 text-amber-700 border-amber-200'
                                : ($grade === 'Merit'      ? 'bg-blue-100 text-blue-700 border-blue-200'
                                                           : 'bg-green-100 text-green-700 border-green-200');
                @endphp
                <span class="shrink-0 inline-flex items-center rounded-full border {{ $gradeBg }} px-3 py-1 text-xs font-bold">
                    {{ $grade }}
                </span>
                @endif
            </div>

            @if($issuedAt)
            <div class="mt-3 flex items-center gap-1.5 text-xs text-gray-500">
                <svg class="h-4 w-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Issued: {{ $issuedAt->format('jS F Y') }}
            </div>
            @endif
        </div>

        {{-- Actions --}}
        <div class="px-5 pb-5 flex items-center gap-2">
            <a href="{{ route('member.certificates.view', $enrollment->id) }}"
               class="flex-1 inline-flex items-center justify-center gap-2 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 px-4 py-2.5 text-sm font-bold text-white transition-all shadow-sm">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                View Certificate
            </a>
            <a href="{{ route('member.certificates.view', $enrollment->id) }}?print=1"
               target="_blank"
               class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 hover:text-gray-800 transition-colors">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
            </a>
            <button type="button"
                    onclick="navigator.share ? navigator.share({ title: '{{ addslashes($course->title) }}', url: '{{ route('member.certificates.view', $enrollment->id) }}' }) : null"
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 hover:text-gray-800 transition-colors">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                </svg>
            </button>
        </div>
    </div>
    @endforeach
</div>

@else
{{-- Empty state --}}
<div class="flex flex-col items-center justify-center py-24 text-center">
    <div class="h-20 w-20 rounded-3xl bg-purple-50 border border-purple-100 flex items-center justify-center mb-5">
        <svg class="h-10 w-10 text-purple-400" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 4H8l-1 5h10l-1-5z"/>
            <circle cx="12" cy="15" r="4" stroke-linecap="round" stroke-linejoin="round"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 9l-2 10M15 9l2 10"/>
        </svg>
    </div>
    <h3 class="text-base font-bold text-gray-900 mb-1">No certificates yet</h3>
    <p class="text-sm text-gray-500 mb-6 max-w-xs">Complete a course to earn your first certificate of completion.</p>
    <a href="{{ route('member.courses') }}"
       class="inline-flex items-center gap-2 rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-6 py-2.5 text-sm font-semibold text-white transition-colors">
        View My Courses
    </a>
</div>
@endif

@endsection
