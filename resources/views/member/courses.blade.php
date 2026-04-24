@extends('layouts.member')

@section('title', 'My Courses')

@section('content')

{{-- ── Page heading ── --}}
<div class="mb-8">
    <p class="text-[#e85d26] text-xs font-semibold uppercase tracking-widest mb-2">Courses</p>
    <h1 class="text-2xl font-extrabold text-gray-900">My Courses</h1>
    <p class="text-gray-500 text-sm mt-1">All your enrolled courses and progress at a glance.</p>
</div>

@if($enrollments->isEmpty())

{{-- Empty state --}}
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
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
    </a>
</div>

@else

<div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
    @foreach($enrollments as $enrollment)
    @php
        $course       = $enrollment->course;
        $totalLessons = $enrollment->course->lessons->where('is_published', true)->count();
        $doneLessons  = $enrollment->progress->whereNotNull('completed_at')->count();
        $progress     = $totalLessons > 0 ? round(($doneLessons / $totalLessons) * 100) : 0;
        $quizzesDone  = $enrollment->progress->whereNotNull('quiz_score')->count();
        $avgScore     = $enrollment->progress->whereNotNull('quiz_score')->avg('quiz_score');

        // Find the next unread lesson for the CTA — skip locked ones
        $completedLessonIds = $enrollment->progress->whereNotNull('completed_at')->pluck('lesson_id')->toArray();
        $enrolledAt = $enrollment->enrolled_at ?? $enrollment->created_at;
        $nextLesson = $course->lessons
            ->where('is_published', true)
            ->sortBy('lesson_number')
            ->first(fn($l) =>
                !in_array($l->id, $completedLessonIds) &&
                now()->gte($l->available_date ?? $enrolledAt->copy()->addWeeks($l->lesson_number - 1))
            );
        // Next locked lesson (for "available in X days" message)
        $nextLockedLesson = $nextLesson ? null : $course->lessons
            ->where('is_published', true)
            ->sortBy('lesson_number')
            ->first(fn($l) => !in_array($l->id, $completedLessonIds));
        $nextUnlockDate = $nextLockedLesson
            ? ($nextLockedLesson->available_date ?? $enrolledAt->copy()->addWeeks($nextLockedLesson->lesson_number - 1))
            : null;
    @endphp

    <div class="group rounded-2xl bg-white border border-gray-200 shadow-sm overflow-hidden hover:border-[#e85d26]/30 transition-colors flex flex-col">

        {{-- Course image --}}
        <div class="relative h-40 bg-[#1a1a1a] overflow-hidden shrink-0">
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

            {{-- Status badge --}}
            <div class="absolute top-3 left-3">
                @if($enrollment->status === 'completed')
                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-500/20 border border-emerald-500/30 px-2.5 py-1 text-xs font-bold text-emerald-300 backdrop-blur-sm">
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Completed
                    </span>
                @else
                    <span class="inline-flex items-center rounded-full bg-[#e85d26]/20 border border-[#e85d26]/30 px-2.5 py-1 text-xs font-bold text-[#e85d26] backdrop-blur-sm">
                        In Progress
                    </span>
                @endif
            </div>

            {{-- Progress % --}}
            <div class="absolute top-3 right-3 rounded-full bg-black/60 border border-white/20 px-2.5 py-1 text-xs font-bold text-white backdrop-blur-sm">
                {{ $progress }}%
            </div>
        </div>

        <div class="flex flex-col flex-1 p-5 space-y-4">

            {{-- Category + title --}}
            <div>
                @if($course->category)
                    <span class="inline-flex items-center rounded-full bg-[#e85d26]/15 border border-[#e85d26]/25 px-2.5 py-0.5 text-xs font-medium text-[#e85d26] mb-2">
                        {{ $course->category }}
                    </span>
                @endif
                <h3 class="font-bold text-gray-900 leading-snug line-clamp-2">{{ $course->title }}</h3>
                @if($course->leader)
                    <p class="text-xs text-gray-500 mt-1">{{ $course->leader->name }}</p>
                @endif
            </div>

            {{-- Progress bar --}}
            <div>
                <div class="flex items-center justify-between text-xs text-gray-500 mb-1.5">
                    <span>{{ $doneLessons }} / {{ $totalLessons }} lessons</span>
                    @if($avgScore !== null)
                        <span>Avg score: {{ round($avgScore) }}%</span>
                    @endif
                </div>
                <div class="h-1.5 w-full rounded-full bg-gray-200">
                    <div class="h-1.5 rounded-full bg-[#e85d26] transition-all" style="width: {{ $progress }}%"></div>
                </div>
            </div>

            {{-- Stats row --}}
            <div class="flex items-center gap-4 text-xs text-gray-500">
                <span class="flex items-center gap-1">
                    <svg class="h-3.5 w-3.5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    {{ $quizzesDone }} quiz{{ $quizzesDone !== 1 ? 'zes' : '' }} done
                </span>
                @if($enrollment->certificate_issued)
                    <span class="flex items-center gap-1 text-emerald-500">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                        Certificate issued
                    </span>
                @endif
            </div>

            {{-- CTA --}}
            <div class="mt-auto pt-1">
                @if($nextLesson)
                    <a
                        href="{{ route('member.lesson.show', ['courseSlug' => $course->slug, 'lessonSlug' => $nextLesson->slug]) }}"
                        class="flex items-center justify-center gap-2 rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-4 py-2.5 text-sm font-semibold text-white transition-colors"
                    >
                        Continue Learning
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                @elseif($nextLockedLesson)
                    <div class="flex items-center gap-2 rounded-full border border-gray-200 bg-gray-50 px-4 py-2.5">
                        <svg class="h-4 w-4 shrink-0 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span class="text-xs text-gray-500">
                            Next lesson available {{ \Carbon\Carbon::parse($nextUnlockDate)->diffForHumans() }}
                        </span>
                    </div>
                @else
                    <a
                        href="{{ route('courses.show', $course->slug) }}"
                        class="flex items-center justify-center gap-2 rounded-full border border-gray-200 bg-white hover:bg-gray-50 px-4 py-2.5 text-sm font-semibold text-gray-700 transition-colors"
                    >
                        View Course
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endif
            </div>

        </div>
    </div>
    @endforeach
</div>

@endif

{{-- ── Life Group Suggestion Modal ── --}}
@if(session('suggest_life_group') && $lifeGroups->isNotEmpty())
<div
    x-data="{ open: true, step: 1 }"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    role="dialog"
    aria-modal="true"
>
    {{-- Backdrop --}}
    <div
        class="absolute inset-0 bg-black/60 backdrop-blur-sm"
        @click="open = false"
        x-transition.opacity
    ></div>

    {{-- Step 1: Ask --}}
    <div
        x-show="step === 1"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="relative z-10 w-full max-w-md rounded-2xl bg-white p-8 shadow-2xl text-center"
    >
        <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#e85d26]/10">
            <svg class="h-8 w-8 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
            </svg>
        </div>

        {{-- Congratulations --}}
        <div class="mb-1 flex items-center justify-center gap-1.5">
            <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <span class="text-xs font-bold uppercase tracking-widest text-yellow-500">Course Complete</span>
            <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
        </div>
        <h2 class="text-2xl font-extrabold text-gray-900">Congratulations! 🎉</h2>
        <p class="mt-1 text-sm font-medium text-gray-500">You've successfully completed the course.</p>

        <div class="my-5 h-px w-full bg-gray-100"></div>

        <h3 class="text-lg font-extrabold text-gray-900">Join a Life Group?</h3>
        <p class="mt-2 text-sm text-gray-500 leading-relaxed">
            Now that you've completed the course, why not take your next step and get connected with a Life Group?
        </p>

        <div class="mt-7 flex flex-col gap-3 sm:flex-row sm:justify-center">
            <button
                @click="step = 2"
                class="flex items-center justify-center gap-2 rounded-full bg-[#e85d26] px-7 py-2.5 text-sm font-semibold text-white hover:bg-[#cf4f1e] transition-colors"
            >
                Yes, See Life Groups
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            <button
                @click="open = false"
                class="rounded-full border border-gray-200 px-7 py-2.5 text-sm font-semibold text-gray-500 hover:bg-gray-50 transition-colors"
            >
                Maybe later
            </button>
        </div>
    </div>

    {{-- Step 2: Life Group list --}}
    <div
        x-show="step === 2"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="relative z-10 w-full max-w-2xl rounded-2xl bg-white shadow-2xl overflow-hidden"
        style="max-height: 90vh;"
    >
        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
            <div>
                <h2 class="text-lg font-extrabold text-gray-900">Choose a Life Group</h2>
                <p class="text-xs text-gray-400 mt-0.5">Select one to connect with them</p>
            </div>
            <button @click="open = false" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 transition-colors">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Scrollable list --}}
        <div class="overflow-y-auto p-4" style="max-height: calc(90vh - 70px);">
            <div class="grid gap-3 sm:grid-cols-2">
                @foreach($lifeGroups as $lg)
                <a
                    href="{{ route('ministries.join', $lg->slug) }}"
                    class="group flex items-center gap-4 rounded-xl border border-gray-100 bg-gray-50 p-4 hover:border-[#e85d26]/40 hover:bg-[#e85d26]/5 transition-colors"
                >
                    @if($lg->image_path)
                    <div class="h-12 w-12 shrink-0 overflow-hidden rounded-xl">
                        <img src="{{ $lg->image_path }}" alt="{{ $lg->name }}" class="h-full w-full object-cover">
                    </div>
                    @else
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#e85d26]/10">
                        <svg class="h-6 w-6 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                        </svg>
                    </div>
                    @endif

                    <div class="min-w-0 flex-1">
                        @if($lg->category_label)
                        <p class="text-[10px] font-bold uppercase tracking-widest text-[#e85d26] mb-0.5">{{ $lg->category_label }}</p>
                        @endif
                        <p class="text-sm font-bold text-gray-900 group-hover:text-[#e85d26] transition-colors truncate">{{ $lg->name }}</p>
                        @if($lg->subtitle)
                        <p class="text-xs text-gray-500 truncate">{{ $lg->subtitle }}</p>
                        @endif
                        @if($lg->meeting_schedule)
                        <p class="mt-1 text-[11px] text-gray-400">{{ $lg->meeting_schedule }}</p>
                        @endif
                    </div>

                    <svg class="h-4 w-4 shrink-0 text-gray-300 group-hover:text-[#e85d26] transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

@endsection
