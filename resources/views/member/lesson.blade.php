<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $lesson->title }} — {{ $course->title }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="h-full min-h-screen bg-white font-sans antialiased"
    x-data="{
        activeTab: '{{ session('quiz_score') !== null ? 'quiz' : 'lesson' }}',
        sidebarOpen: false,
        quizSubmitted: {{ session('quiz_score') !== null ? 'true' : 'false' }},
        quizScore: {{ session('quiz_score') ?? 'null' }},
        quizCorrect: {{ session('quiz_correct') ?? 'null' }},
        quizTotal: {{ session('quiz_total') ?? 'null' }},
    }"
>

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
        x-data="{ openGroups: {{ json_encode($grouped->keys()->values()->all()) }} }"
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

        <nav class="py-2">
            @foreach($grouped as $groupName => $groupLessons)
            @php
                $groupComplete = $groupLessons->every(fn($l) => $progressMap->get($l->id)?->completed_at !== null);
            @endphp
            <div x-data="{ open: {{ $groupLessons->contains('id', $lesson->id) ? 'true' : 'true' }} }">
                {{-- Group header --}}
                <button
                    @click="open = !open"
                    class="flex w-full items-center justify-between px-5 py-3 text-left hover:bg-gray-50 transition-colors"
                >
                    <div>
                        <p class="text-xs font-bold text-gray-800 leading-tight">{{ $groupName }}</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">{{ $groupLessons->count() }} {{ Str::plural('lesson', $groupLessons->count()) }}</p>
                    </div>
                    <svg
                        :class="open ? 'rotate-180' : ''"
                        class="h-3.5 w-3.5 text-gray-400 transition-transform"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Lessons in this group --}}
                <div x-show="open" x-collapse>
                    @foreach($groupLessons as $sideLesson)
                    @php
                        $sideProgress  = $progressMap->get($sideLesson->id);
                        $isDone        = $sideProgress?->completed_at !== null;
                        $isCurrent     = $sideLesson->id === $lesson->id;
                        $hasQuiz       = !empty($sideLesson->quiz_questions);
                        $sideQuizScore = $sideProgress?->quiz_score;
                    @endphp
                    <a
                        href="{{ route('member.lesson.show', ['courseSlug' => $course->slug, 'lessonSlug' => $sideLesson->slug]) }}"
                        class="group/lesson flex items-start gap-3 px-5 py-2.5 transition-colors
                            {{ $isCurrent ? 'bg-orange-50 border-r-2 border-[#e85d26]' : 'hover:bg-gray-50' }}"
                    >
                        {{-- Status icon --}}
                        <div class="mt-0.5 shrink-0">
                            @if($isDone)
                                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-[#e85d26]">
                                    <svg class="h-3 w-3 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </span>
                            @elseif($isCurrent)
                                <span class="flex h-5 w-5 items-center justify-center rounded-full border-2 border-[#e85d26]">
                                    <span class="h-2 w-2 rounded-full bg-[#e85d26]"></span>
                                </span>
                            @else
                                <span class="flex h-5 w-5 items-center justify-center rounded-full border-2 border-gray-200 bg-white"></span>
                            @endif
                        </div>

                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-medium leading-tight {{ $isCurrent ? 'text-[#e85d26]' : ($isDone ? 'text-gray-600' : 'text-gray-700') }} line-clamp-2">
                                {{ $sideLesson->title }}
                            </p>
                            <div class="mt-1 flex items-center gap-2">
                                @if($hasQuiz)
                                    @if($sideQuizScore !== null)
                                        <span class="inline-flex items-center gap-0.5 rounded-full bg-emerald-50 border border-emerald-200 px-1.5 py-0.5 text-[9px] font-bold text-emerald-600">
                                            Score: {{ $sideQuizScore }}%
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-0.5 rounded-full bg-purple-50 border border-purple-200 px-1.5 py-0.5 text-[9px] font-medium text-purple-600">
                                            Quiz
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </a>
                    @endforeach
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
                <button
                    @click="activeTab = 'lesson'"
                    :class="activeTab === 'lesson' ? 'border-[#e85d26] text-[#e85d26]' : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="flex items-center gap-2 border-b-2 px-4 py-3.5 text-sm font-semibold transition-colors"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Lesson
                </button>
                <button
                    @click="activeTab = 'notes'"
                    :class="activeTab === 'notes' ? 'border-[#e85d26] text-[#e85d26]' : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="flex items-center gap-2 border-b-2 px-4 py-3.5 text-sm font-semibold transition-colors"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Notes
                </button>
                @if(!empty($lesson->quiz_questions))
                <button
                    @click="activeTab = 'quiz'"
                    :class="activeTab === 'quiz' ? 'border-[#e85d26] text-[#e85d26]' : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="flex items-center gap-2 border-b-2 px-4 py-3.5 text-sm font-semibold transition-colors"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    ? Quiz
                    @if($quizScore !== null)
                        <span class="ml-1 rounded-full bg-emerald-100 px-1.5 py-0.5 text-[10px] font-bold text-emerald-700">{{ $quizScore }}%</span>
                    @endif
                </button>
                @endif
            </div>
        </div>

        {{-- ── LESSON TAB ── --}}
        <div x-show="activeTab === 'lesson'" class="flex-1 overflow-y-auto px-6 py-8 lg:px-12 pb-28 max-w-3xl">

            {{-- Flash --}}
            @if(session('status'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
            @endif

            {{-- Lesson meta --}}
            <div class="mb-6 flex flex-wrap items-center gap-3">
                @if($lesson->week_group)
                <span class="inline-flex items-center rounded-full bg-purple-100 border border-purple-200 px-3 py-0.5 text-xs font-semibold text-purple-700">
                    {{ $lesson->week_group }}
                </span>
                @endif
                <span class="flex items-center gap-1.5 text-xs text-gray-400">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ ceil(str_word_count(strip_tags($lesson->content ?? '')) / 200) }} min read
                    &nbsp;·&nbsp;
                    @if($lessonPosition) Lesson {{ $lessonPosition }} of {{ $totalLessons }} @endif
                </span>

                {{-- Bookmark placeholder --}}
                <button class="ml-auto text-gray-300 hover:text-[#e85d26] transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                </button>
            </div>

            {{-- Title & author --}}
            <h1 class="mb-1 text-3xl font-extrabold leading-tight text-gray-900">{{ $lesson->title }}</h1>
            @if($course->instructor_name)
            <p class="mb-8 text-sm text-gray-500">by {{ $course->instructor_name }}</p>
            @endif

            {{-- Lesson body content --}}
            <div class="prose prose-gray max-w-none
                prose-headings:font-bold prose-headings:text-gray-900
                prose-h2:text-xl prose-h3:text-base
                prose-p:text-gray-700 prose-p:leading-relaxed
                prose-strong:text-gray-900
                prose-ul:text-gray-700 prose-ol:text-gray-700
                prose-blockquote:border-l-4 prose-blockquote:border-[#e85d26] prose-blockquote:pl-4 prose-blockquote:text-gray-600 prose-blockquote:italic
                prose-a:text-[#e85d26] hover:prose-a:underline">
                {!! $lesson->content !!}
            </div>

            {{-- Mark as read CTA --}}
            <div class="mt-12 rounded-2xl border border-gray-200 bg-gray-50 p-6 flex items-center justify-between gap-4">
                <div>
                    <p class="font-semibold text-gray-800">Finished reading?</p>
                    <p class="text-sm text-gray-500 mt-0.5">Mark this lesson as complete to track your progress.</p>
                </div>
                @if($progress?->completed_at)
                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 border border-emerald-200 px-4 py-2 text-sm font-semibold text-emerald-700">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Read
                </span>
                @else
                <form method="POST" action="{{ route('member.lesson.mark-read', ['courseSlug' => $course->slug, 'lessonSlug' => $lesson->slug]) }}">
                    @csrf
                    @if($nextLesson)
                        <input type="hidden" name="next" value="{{ $nextLesson->slug }}">
                    @endif
                    <button
                        type="submit"
                        class="flex items-center gap-2 rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-6 py-2.5 text-sm font-semibold text-white transition-colors"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Mark as Read
                    </button>
                </form>
                @endif
            </div>
        </div>

        {{-- ── NOTES TAB ── --}}
        <div x-show="activeTab === 'notes'" class="flex-1 overflow-y-auto px-6 py-8 lg:px-12 pb-28 max-w-3xl">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900">My Notes</h2>
                <p class="text-sm text-gray-500 mt-1">Your private notes for this lesson — only visible to you.</p>
            </div>

            @if(session('status') === 'Notes saved!')
            <div class="mb-4 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-700">
                Notes saved!
            </div>
            @endif

            <form
                method="POST"
                action="{{ route('member.lesson.notes', ['courseSlug' => $course->slug, 'lessonSlug' => $lesson->slug]) }}"
            >
                @csrf
                <textarea
                    name="notes"
                    rows="16"
                    placeholder="Write your notes, reflections, or key insights here…"
                    class="w-full rounded-2xl border border-gray-200 bg-white px-5 py-4 text-sm text-gray-700 leading-relaxed placeholder-gray-400 focus:border-[#e85d26] focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 resize-none"
                >{{ $progress?->notes }}</textarea>
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

        {{-- ── QUIZ TAB ── --}}
        @if(!empty($lesson->quiz_questions))
        <div x-show="activeTab === 'quiz'" class="flex-1 overflow-y-auto px-6 py-8 lg:px-12 pb-28 max-w-xl">

            @php $questionCount = count($lesson->quiz_questions); @endphp

            @if($quizScore !== null)
            {{-- Previous score card --}}
            <div class="mb-6 rounded-2xl border bg-white p-6 text-center shadow-sm
                {{ $quizScore >= 60 ? 'border-emerald-200' : 'border-orange-200' }}">
                <div class="mb-1 text-4xl font-extrabold {{ $quizScore >= 60 ? 'text-emerald-600' : 'text-orange-500' }}">
                    {{ $quizScore }}%
                </div>
                <p class="text-sm font-semibold {{ $quizScore >= 60 ? 'text-emerald-700' : 'text-orange-600' }}">
                    {{ $quizScore >= 60 ? 'Passed' : 'Keep Studying' }}
                </p>
                <p class="mt-1 text-xs text-gray-400">Your last score</p>
            </div>
            @endif

            {{-- Quiz info & launch card --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="mb-5 flex items-start gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#e85d26]/10">
                        <svg class="h-6 w-6 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-gray-900">Lesson Quiz</h2>
                        <p class="mt-0.5 text-sm text-gray-500">
                            {{ $questionCount }} {{ Str::plural('question', $questionCount) }} · Multiple choice
                        </p>
                        @if($lesson->week_group)
                        <span class="mt-2 inline-block text-xs font-semibold uppercase tracking-wide text-[#e85d26]">
                            {{ $lesson->week_group }}
                        </span>
                        @endif
                    </div>
                </div>

                <a
                    href="{{ route('member.lesson.quiz-page', ['courseSlug' => $course->slug, 'lessonSlug' => $lesson->slug]) }}"
                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#e85d26] hover:bg-[#cf4f1e] px-6 py-3 text-sm font-bold text-white transition-colors"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $quizScore !== null ? 'Retake Quiz' : 'Start Quiz' }}
                </a>
            </div>

        </div>
        @endif

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

            {{-- Quiz score badge --}}
            @if($quizScore !== null)
            <span class="hidden sm:inline-flex items-center gap-1.5 rounded-full bg-emerald-100 border border-emerald-200 px-4 py-2 text-sm font-bold text-emerald-700">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Quiz: {{ $quizScore }}%
            </span>
            @endif

            {{-- Mark as Read & Continue / Next --}}
            @if($progress?->completed_at)
                @if($nextLesson)
                <a
                    href="{{ route('member.lesson.show', ['courseSlug' => $course->slug, 'lessonSlug' => $nextLesson->slug]) }}"
                    class="flex items-center gap-2 rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-6 py-2.5 text-sm font-semibold text-white transition-colors"
                >
                    Next Lesson
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @else
                <a
                    href="{{ route('member.dashboard') }}"
                    class="flex items-center gap-2 rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-6 py-2.5 text-sm font-semibold text-white transition-colors"
                >
                    Back to Dashboard
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                @endif
            @else
            <form
                method="POST"
                action="{{ route('member.lesson.mark-read', ['courseSlug' => $course->slug, 'lessonSlug' => $lesson->slug]) }}"
            >
                @csrf
                @if($nextLesson)
                    <input type="hidden" name="next" value="{{ $nextLesson->slug }}">
                @endif
                <button
                    type="submit"
                    class="flex items-center gap-2 rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-6 py-2.5 text-sm font-semibold text-white transition-colors"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ $nextLesson ? 'Mark as Read & Continue' : 'Mark as Read' }}
                    @if($nextLesson)
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                    @endif
                </button>
            </form>
            @endif

        </div>

    </div>{{-- /main --}}
</div>{{-- /flex wrapper --}}

</body>
</html>
