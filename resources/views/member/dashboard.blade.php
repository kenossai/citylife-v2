@extends('layouts.member')

@section('title', 'Dashboard')

@section('content')

{{-- ── Flash message ──────────────────────────────────────────────────── --}}
@if (session('status'))
<div class="mb-6 rounded-xl bg-[#e85d26]/10 border border-[#e85d26]/25 px-4 py-3 text-sm text-[#e85d26]">
    {{ session('status') }}
</div>
@endif

{{-- ── Page heading ───────────────────────────────────────────────────── --}}
<div class="mb-8">
    <h1 class="text-2xl font-extrabold text-gray-900">
        Welcome back, {{ $member->first_name }}!
    </h1>
    <p class="text-gray-500 text-sm mt-1">Here's an overview of your learning journey.</p>
</div>

{{-- ── Stat cards ─────────────────────────────────────────────────────── --}}
<div class="grid grid-cols-2 gap-4 lg:grid-cols-4 mb-10">

    {{-- Enrolled Courses --}}
    <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-5">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Enrolled</span>
            <div class="h-8 w-8 rounded-lg bg-[#e85d26]/15 flex items-center justify-center">
                <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-gray-900">{{ $enrolledCount }}</p>
        <p class="text-xs text-gray-500 mt-1">Active courses</p>
    </div>

    {{-- Lessons Read --}}
    <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-5">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Lessons</span>
            <div class="h-8 w-8 rounded-lg bg-[#e85d26]/15 flex items-center justify-center">
                <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-gray-900">{{ $totalLessonsRead }}</p>
        <p class="text-xs text-gray-500 mt-1">of {{ $totalLessons }} total</p>
    </div>

    {{-- Avg Quiz Score --}}
    <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-5">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Quiz Score</span>
            <div class="h-8 w-8 rounded-lg bg-[#e85d26]/15 flex items-center justify-center">
                <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-gray-900">
            {{ $avgQuizScore !== null ? round($avgQuizScore) . '%' : '—' }}
        </p>
        <p class="text-xs text-gray-500 mt-1">Average score</p>
    </div>

    {{-- Certificates --}}
    <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-5">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Certificates</span>
            <div class="h-8 w-8 rounded-lg bg-[#e85d26]/15 flex items-center justify-center">
                <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-gray-900">{{ $certificatesEarned }}</p>
        <p class="text-xs text-gray-500 mt-1">Earned</p>
    </div>

</div>

{{-- ── Continue Learning ───────────────────────────────────────────────── --}}
@if($activeCourses->isNotEmpty())
<section class="mb-10">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-base font-bold text-gray-900 uppercase tracking-wide">Continue Learning</h2>
        <a href="{{ route('member.courses') }}" class="text-sm text-[#e85d26] hover:text-[#cf4f1e] transition-colors flex items-center gap-1">
            All Courses
            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        @foreach($activeCourses as $enrollment)
        @php
            $course   = $enrollment->course;
            $progress = $enrollment->progress_percentage;
        @endphp
        <div class="group rounded-2xl bg-white border border-gray-200 shadow-sm overflow-hidden hover:border-[#e85d26]/40 transition-colors">

            {{-- Course image banner --}}
            <div class="relative h-36 bg-[#1a1a1a] overflow-hidden">
                @if($course->image_path)
                    <img
                        src="{{ Storage::url($course->image_path) }}"
                        alt="{{ $course->title }}"
                        class="h-full w-full object-cover opacity-60 group-hover:opacity-70 transition-opacity"
                    />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                @else
                    <div class="absolute inset-0 bg-gradient-to-br from-[#e85d26]/20 to-transparent"></div>
                @endif
                {{-- Progress badge --}}
                <div class="absolute top-3 right-3 rounded-full bg-black/60 border border-white/20 px-2.5 py-1 text-xs font-bold text-white backdrop-blur-sm">
                    {{ round($progress) }}%
                </div>
            </div>

            <div class="p-4 space-y-3">
                {{-- Tags --}}
                <div class="flex flex-wrap gap-1.5">
                    @if($course->category)
                        <span class="inline-flex items-center rounded-full bg-[#e85d26]/15 border border-[#e85d26]/25 px-2.5 py-0.5 text-xs font-medium text-[#e85d26]">
                            {{ $course->category }}
                        </span>
                    @endif
                    <span class="inline-flex items-center rounded-full bg-gray-100 border border-gray-200 px-2.5 py-0.5 text-xs font-medium text-gray-600">
                        {{ $enrollment->quiz_completed }} quiz{{ $enrollment->quiz_completed !== 1 ? 'zes' : '' }} done
                    </span>
                </div>

                <h3 class="font-semibold text-gray-900 leading-snug line-clamp-2">
                    {{ $course->title }}
                </h3>

                {{-- Progress bar --}}
                <div>
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-1.5">
                        <span>{{ $enrollment->lessons_done_count }} / {{ $enrollment->total_lessons }} lessons</span>
                    </div>
                    <div class="h-1.5 w-full rounded-full bg-gray-200">
                        <div class="h-1.5 rounded-full bg-[#e85d26] transition-all" style="width: {{ $progress }}%"></div>
                    </div>
                </div>

                {{-- Next lesson chip --}}
                @if($enrollment->next_lesson)
                    <div class="flex items-center gap-2 rounded-lg bg-gray-50 border border-gray-200 px-3 py-2">
                        <svg class="h-3.5 w-3.5 text-[#e85d26] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="text-xs text-gray-600 truncate">Next: {{ $enrollment->next_lesson->title }}</span>
                    </div>
                @elseif($enrollment->next_locked_lesson)
                    @php
                        $lockedEnrolledAt   = $enrollment->enrolled_at ?? $enrollment->created_at;
                        $lockedUnlockDate   = $enrollment->next_locked_lesson->available_date
                            ?? $lockedEnrolledAt->copy()->addWeeks($enrollment->next_locked_lesson->lesson_number - 1);
                    @endphp
                    <div class="flex items-center gap-2 rounded-lg bg-gray-50 border border-gray-200 px-3 py-2">
                        <svg class="h-3.5 w-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span class="text-xs text-gray-500 truncate">Available {{ \Carbon\Carbon::parse($lockedUnlockDate)->diffForHumans() }}</span>
                    </div>
                @endif

                {{-- CTA --}}
                @if($enrollment->next_lesson)
                <a
                    href="{{ route('member.lesson.show', ['courseSlug' => $course->slug, 'lessonSlug' => $enrollment->next_lesson->slug]) }}"
                    class="mt-1 flex items-center justify-center gap-2 rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-4 py-2.5 text-sm font-semibold text-white transition-colors"
                >
                    Continue Reading
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                @else
                <a
                    href="{{ route('courses.show', $course->slug) }}"
                    class="mt-1 flex items-center justify-center gap-2 rounded-full border border-gray-200 bg-white hover:bg-gray-50 px-4 py-2.5 text-sm font-semibold text-gray-700 transition-colors"
                >
                    View Course
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ── Explore More Courses ────────────────────────────────────────────── --}}
@if($exploreCourses->isNotEmpty())
<section class="mb-10">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-base font-bold text-gray-900 uppercase tracking-wide">Explore More Courses</h2>
        <a href="{{ route('courses') }}" class="text-sm text-[#e85d26] hover:text-[#cf4f1e] transition-colors flex items-center gap-1">
            Other Courses
            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>

    <div class="flex gap-4 overflow-x-auto pb-2 -mx-1 px-1 snap-x snap-mandatory">
        @foreach($exploreCourses as $course)
        <a
            href="{{ route('courses.show', $course->slug) }}"
            class="snap-start shrink-0 w-52 rounded-2xl bg-white border border-gray-200 shadow-sm hover:border-[#e85d26]/40 overflow-hidden group transition-colors"
        >
            <div class="h-28 bg-[#1a1a1a] overflow-hidden relative">
                @if($course->image_path)
                    <img
                        src="{{ Storage::url($course->image_path) }}"
                        alt="{{ $course->title }}"
                        class="h-full w-full object-cover opacity-60 group-hover:opacity-70 transition-opacity"
                    />
                @else
                    <div class="absolute inset-0 bg-gradient-to-br from-[#e85d26]/15 to-transparent"></div>
                @endif
            </div>
            <div class="p-3 space-y-1.5">
                @if($course->category)
                    <span class="inline-flex rounded-full bg-[#e85d26]/15 border border-[#e85d26]/20 px-2 py-0.5 text-xs font-medium text-[#e85d26]">
                        {{ $course->category }}
                    </span>
                @endif
                <p class="text-sm font-semibold text-gray-900 leading-snug line-clamp-2">
                    {{ $course->title }}
                </p>
                @if($course->leader)
                    <p class="text-xs text-gray-600">{{ $course->leader->name }}</p>
                @endif
            </div>
        </a>
        @endforeach
    </div>
</section>
@endif

{{-- ── Quiz History ────────────────────────────────────────────────────── --}}
<section class="mb-10">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-base font-bold text-gray-900 uppercase tracking-wide">Quiz History</h2>
    </div>

    @if($quizHistory->isNotEmpty())
    <div class="rounded-2xl bg-white border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead>
                <tr class="bg-gray-50">
                    <th class="py-3 pl-5 pr-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Course</th>
                    <th class="px-3 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Quiz (Lesson)</th>
                    <th class="px-3 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide w-40">Score</th>
                    <th class="px-3 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">Result</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($quizHistory as $progress)
                @php $score = $progress->quiz_score; $passed = $score >= 60; @endphp
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-3 pl-5 pr-3 font-medium text-gray-900 max-w-xs">
                        <span class="line-clamp-1">{{ $progress->enrollment->course->title ?? '—' }}</span>
                    </td>
                    <td class="px-3 py-3 text-gray-600 max-w-xs">
                        <span class="line-clamp-1">{{ $progress->lesson->title ?? '—' }}</span>
                    </td>
                    <td class="px-3 py-3">
                        <div class="flex items-center gap-2">
                            <div class="h-1.5 w-24 rounded-full bg-gray-200 overflow-hidden">
                                <div
                                    class="h-1.5 rounded-full {{ $passed ? 'bg-emerald-500' : 'bg-red-500' }} transition-all"
                                    style="width: {{ $score }}%"
                                ></div>
                            </div>
                            <span class="text-xs font-semibold text-gray-700">{{ $score }}%</span>
                        </div>
                    </td>
                    <td class="px-3 py-3">
                        @if($passed)
                            <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 border border-emerald-200 px-2.5 py-0.5 text-xs font-semibold text-emerald-700">
                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Passed
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-full bg-red-50 border border-red-200 px-2.5 py-0.5 text-xs font-semibold text-red-600">
                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                Failed
                            </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="rounded-2xl bg-white border border-gray-200 px-6 py-10 text-center">
        <p class="text-sm text-gray-500">No quizzes completed yet. Finish a lesson with a quiz to see your results here.</p>
    </div>
    @endif
</section>

{{-- Empty state --}}
@if($enrolledCount === 0)
<div class="flex flex-col items-center justify-center py-20 text-center">
    <div class="h-16 w-16 rounded-2xl bg-[#e85d26]/15 border border-[#e85d26]/20 flex items-center justify-center mb-4">
        <svg class="h-8 w-8 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
    </div>
    <h3 class="text-base font-bold text-gray-900 mb-1">No courses yet</h3>
    <p class="text-sm text-gray-500 mb-6">Browse our available courses and start learning today.</p>
    <a href="{{ route('courses') }}" class="inline-flex items-center gap-2 rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-6 py-2.5 text-sm font-semibold text-white transition-colors">
        Browse Courses
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    </a>
</div>
@endif

@endsection
