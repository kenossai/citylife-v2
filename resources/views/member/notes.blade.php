<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Notes – {{ $lesson->title }} — {{ $course->title }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full min-h-screen bg-white font-sans antialiased" x-data="{ sidebarOpen: false }">

{{-- ── Top bar ── --}}
<header class="fixed inset-x-0 top-0 z-40 flex h-12 items-center justify-between border-b border-gray-200 bg-[#111111] px-4 lg:px-6">
    {{-- Left: Back + Course title --}}
    <div class="flex min-w-0 items-center gap-3">
        <button
            @click="sidebarOpen = !sidebarOpen"
            class="lg:hidden flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 hover:bg-white/10 hover:text-white transition-colors"
        >
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <a
            href="{{ route('member.courses') }}"
            class="flex items-center gap-1.5 text-sm text-gray-400 hover:text-white transition-colors shrink-0"
        >
            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            My Courses
        </a>
        <span class="text-gray-600 text-sm hidden sm:block">|</span>
        <span class="hidden truncate text-sm font-semibold text-white sm:block">{{ $course->title }}</span>
    </div>

    {{-- Right: Progress --}}
    <div class="flex items-center gap-3 shrink-0">
        <div class="hidden sm:flex items-center gap-2">
            <div class="h-1.5 w-28 rounded-full bg-white/10 overflow-hidden">
                <div class="h-1.5 rounded-full bg-[#e85d26] transition-all" style="width: {{ $progressPercent }}%"></div>
            </div>
            <span class="text-xs font-bold text-white">{{ $progressPercent }}%</span>
        </div>
    </div>
</header>

<div class="flex h-full min-h-screen pt-12">

    {{-- ── Mobile sidebar overlay ── --}}
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 z-30 bg-black/50 lg:hidden"
    ></div>

    {{-- ── Left sidebar — Course content ── --}}
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-40 mt-12 w-72 overflow-y-auto bg-white border-r border-gray-200 transition-transform duration-300 lg:static lg:mt-0 lg:translate-x-0 lg:shrink-0"
    >
        {{-- Sidebar header --}}
        <div class="sticky top-0 bg-white border-b border-gray-100 px-5 py-3.5 z-10">
            <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Course Content</p>
            <div class="mt-1 flex items-center justify-between">
                <p class="text-xs font-semibold text-gray-700">{{ $completedCount }}/{{ $totalLessons }} done</p>
                <div class="h-1 w-24 rounded-full bg-gray-200 overflow-hidden">
                    <div class="h-1 rounded-full bg-[#e85d26]" style="width: {{ $progressPercent }}%"></div>
                </div>
            </div>
        </div>

        <nav>
            @foreach($grouped as $groupName => $groupLessons)
            @php
                $groupIsOpen = $groupLessons->contains('id', $lesson->id);
                $quizLesson  = $groupLessons->first(fn($l) => !empty($l->quiz_questions));
                $quizScore   = $quizLesson ? $progressMap->get($quizLesson->id)?->quiz_score : null;
            @endphp
            <div x-data="{ open: {{ $groupIsOpen ? 'true' : 'false' }} }" class="border-b border-gray-100">

                {{-- Group header --}}
                <button
                    @click="open = !open"
                    class="flex w-full items-start justify-between px-5 py-4 text-left transition-colors hover:bg-gray-50"
                >
                    <div>
                        <p class="text-sm font-bold leading-snug text-gray-900">{{ $groupName }}</p>
                        <p class="mt-0.5 text-xs text-gray-400">{{ $groupLessons->count() }} {{ Str::plural('lesson', $groupLessons->count()) }}</p>
                    </div>
                    <svg
                        :class="open ? 'rotate-180' : ''"
                        class="mt-0.5 h-4 w-4 shrink-0 text-gray-400 transition-transform duration-200"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Lessons in this group --}}
                <div x-show="open" x-collapse>
                    @foreach($groupLessons as $sideLesson)
                    @php
                        $sideProgress    = $progressMap->get($sideLesson->id);
                        $isDone          = $sideProgress?->completed_at !== null;
                        $isCurrent       = $sideLesson->id === $lesson->id;
                        $minRead         = max(1, (int) ceil(str_word_count(strip_tags($sideLesson->content ?? '')) / 200));
                        $slideEnrolledAt = $enrollment->enrolled_at ?? $enrollment->created_at;
                        $slideUnlock     = $sideLesson->available_date ?? $slideEnrolledAt->copy()->addWeeks($sideLesson->lesson_number - 1);
                        $isLocked        = now()->lt($slideUnlock);
                    @endphp
                    @if($isLocked)
                    <div class="flex items-center gap-3 px-5 py-3 opacity-50 cursor-not-allowed">
                    @else
                    <a
                        href="{{ route('member.lesson.show', ['courseSlug' => $course->slug, 'lessonSlug' => $sideLesson->slug]) }}"
                        class="flex items-center gap-3 px-5 py-3 transition-colors {{ $isCurrent ? 'bg-orange-50' : 'hover:bg-gray-50' }}"
                    >
                    @endif
                        {{-- Status icon --}}
                        @if($isLocked)
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-gray-200">
                                <svg class="h-3.5 w-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </span>
                        @elseif($isDone)
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-emerald-500">
                                <svg class="h-3.5 w-3.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                        @else
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full border-2
                                {{ $isCurrent ? 'border-[#e85d26]' : 'border-gray-300' }}">
                                @if($isCurrent)
                                    <span class="h-2 w-2 rounded-full bg-[#e85d26]"></span>
                                @endif
                            </span>
                        @endif

                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium leading-snug line-clamp-2
                                {{ $isLocked ? 'text-gray-400' : ($isCurrent ? 'text-[#e85d26]' : ($isDone ? 'text-gray-500' : 'text-gray-800')) }}">
                                {{ $sideLesson->title }}
                            </p>
                            @if($isLocked)
                                <p class="mt-0.5 text-xs text-gray-400">Week {{ $sideLesson->lesson_number }}</p>
                            @else
                                <p class="mt-0.5 text-xs text-gray-400">{{ $minRead }} min</p>
                            @endif
                        </div>
                    @if($isLocked)
                    </div>
                    @else
                    </a>
                    @endif
                    @endforeach

                    {{-- Module Quiz row --}}
                    @if($quizLesson)
                    @php
                        $quizEnrolledAt = $enrollment->enrolled_at ?? $enrollment->created_at;
                        $quizUnlockDate = $quizLesson->available_date ?? $quizEnrolledAt->copy()->addWeeks($quizLesson->lesson_number - 1);
                        $quizIsLocked   = now()->lt($quizUnlockDate);
                    @endphp
                    @if($quizIsLocked)
                    <div class="flex items-center gap-3 px-5 py-3 opacity-50 cursor-not-allowed">
                    @else
                    <a
                        href="{{ route('member.lesson.quiz-page', ['courseSlug' => $course->slug, 'lessonSlug' => $quizLesson->slug]) }}"
                        class="flex items-center gap-3 px-5 py-3 transition-colors {{ $quizScore !== null ? 'bg-purple-50' : 'hover:bg-purple-50/50' }}"
                    >
                    @endif
                        @if($quizIsLocked)
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-gray-200">
                            <svg class="h-3.5 w-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        @else
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-purple-500">
                            <svg class="h-3.5 w-3.5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </span>
                        @endif
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold {{ $quizIsLocked ? 'text-gray-400' : 'text-purple-700' }}">Module Quiz</p>
                            @if($quizIsLocked)
                                <p class="text-xs text-gray-400">Locked</p>
                            @elseif($quizScore !== null)
                                <p class="text-xs font-medium text-purple-500">Score: {{ $quizScore }}%</p>
                            @else
                                <p class="text-xs text-gray-400">Not taken yet</p>
                            @endif
                        </div>
                        @if(!$quizIsLocked)
                        <span class="shrink-0 text-xs font-bold text-purple-500">Quiz</span>
                        @endif
                    @if($quizIsLocked)
                    </div>
                    @else
                    </a>
                    @endif
                    @endif
                </div>

            </div>
            @endforeach
        </nav>
    </aside>

    {{-- ── Main content ── --}}
    <div class="flex min-w-0 flex-1 flex-col">

        {{-- Tab bar --}}
        <div class="sticky top-12 z-20 border-b border-gray-200 bg-white px-6 lg:px-10">
            <div class="flex items-center gap-0">
                <a href="{{ route('member.lesson.show', ['courseSlug' => $course->slug, 'lessonSlug' => $lesson->slug]) }}"
                   class="flex items-center gap-2 border-b-2 border-transparent text-gray-500 hover:text-gray-700 px-4 py-3.5 text-sm font-semibold transition-colors">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Lesson
                </a>
                <a href="{{ route('member.lesson.notes-page', ['courseSlug' => $course->slug, 'lessonSlug' => $lesson->slug]) }}"
                   class="flex items-center gap-2 border-b-2 border-[#e85d26] text-[#e85d26] px-4 py-3.5 text-sm font-semibold">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Notes
                </a>
                @if(!empty($lesson->quiz_questions))
                <a href="{{ route('member.lesson.quiz-page', ['courseSlug' => $course->slug, 'lessonSlug' => $lesson->slug]) }}"
                   class="flex items-center gap-2 border-b-2 border-transparent text-gray-500 hover:text-gray-700 px-4 py-3.5 text-sm font-semibold transition-colors">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Quiz
                    @if($quizScore !== null)
                        <span class="ml-1 rounded-full bg-emerald-100 px-1.5 py-0.5 text-[10px] font-bold text-emerald-700">{{ $quizScore }}%</span>
                    @endif
                </a>
                @endif
            </div>
        </div>

        {{-- ── NOTES CONTENT ── --}}
        <div class="flex-1 overflow-y-auto px-6 py-8 lg:px-12 pb-28 max-w-3xl">

            {{-- Flash --}}
            @if(session('status'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
            @endif

            {{-- Header --}}
            <div class="mb-6">
                <h1 class="text-2xl font-extrabold text-gray-900">My Notes</h1>
                <p class="mt-1 text-sm text-gray-500">{{ $lesson->title }}</p>
            </div>

            {{-- Notes form --}}
            <form
                method="POST"
                action="{{ route('member.lesson.notes', ['courseSlug' => $course->slug, 'lessonSlug' => $lesson->slug]) }}"
            >
                @csrf
                <textarea
                    name="notes"
                    rows="18"
                    placeholder="Write your notes here…"
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-5 py-4 text-sm text-gray-800 placeholder-gray-400 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition resize-none"
                >{{ old('notes', $progress?->notes) }}</textarea>

                @error('notes')
                <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                @enderror

                <div class="mt-4 flex justify-end">
                    <button
                        type="submit"
                        class="flex items-center gap-2 rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-6 py-2.5 text-sm font-semibold text-white transition-colors"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Notes
                    </button>
                </div>
            </form>
        </div>

        {{-- ── Bottom nav bar ── --}}
        <div class="fixed inset-x-0 bottom-0 z-20 border-t border-gray-200 bg-white px-4 py-3 flex items-center justify-between gap-3 lg:ml-72">

            {{-- Previous --}}
            @if($prevLesson)
            <a
                href="{{ route('member.lesson.show', ['courseSlug' => $course->slug, 'lessonSlug' => $prevLesson->slug]) }}"
                class="flex items-center gap-1.5 rounded-full border border-gray-200 bg-white hover:bg-gray-50 px-4 py-2 text-sm font-semibold text-gray-700 transition-colors"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Previous
            </a>
            @else
            <div></div>
            @endif

            {{-- Next --}}
            @if($nextLesson && !$nextLessonLocked)
            <a
                href="{{ route('member.lesson.show', ['courseSlug' => $course->slug, 'lessonSlug' => $nextLesson->slug]) }}"
                class="flex items-center gap-2 rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-6 py-2.5 text-sm font-semibold text-white transition-colors"
            >
                Next Lesson
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            @elseif($nextLesson && $nextLessonLocked)
            <span class="flex items-center gap-2 rounded-full border border-gray-200 bg-gray-100 px-6 py-2.5 text-sm font-semibold text-gray-400 cursor-not-allowed">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Next Lesson
            </span>
            @else
            <a
                href="{{ route('member.dashboard') }}"
                class="flex items-center gap-2 rounded-full border border-gray-200 bg-white hover:bg-gray-50 px-6 py-2.5 text-sm font-semibold text-gray-700 transition-colors"
            >
                Back to Dashboard
            </a>
            @endif

        </div>

    </div>{{-- /main --}}
</div>{{-- /flex wrapper --}}

</body>
</html>
