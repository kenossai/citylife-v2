@extends('layouts.member')

@section('title', 'My Courses')

@section('content')

{{-- ── Page heading ── --}}
<div class="mb-8">
    <p class="text-[#e85d26] text-xs font-semibold uppercase tracking-widest mb-2">Bible School</p>
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

@endsection
