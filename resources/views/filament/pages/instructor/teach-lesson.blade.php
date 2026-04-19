<x-filament-panels::page>

    @if(! $lesson)
        <div class="flex items-center justify-center py-24 text-gray-400 dark:text-gray-500 text-sm">
            No published lessons found for this course.
        </div>
    @else

    {{-- Two-column teaching layout --}}
    <div x-data="{ sidebarOpen: true }" class="flex gap-0 -mx-6 -mt-6" style="min-height: calc(100vh - 9rem);">

        {{-- ── LEFT: Lesson Sidebar ───────────────────────────────────────── --}}
        <aside
            :style="sidebarOpen ? 'width: 18rem; overflow-y: auto;' : 'width: 2.5rem; overflow: hidden;'"
            class="shrink-0 border-r border-gray-200 dark:border-white/10 bg-white dark:bg-gray-900 transition-all duration-300 ease-in-out relative"
        >
            {{-- Sidebar toggle button --}}
            <button
                @click="sidebarOpen = !sidebarOpen"
                :title="sidebarOpen ? 'Collapse sidebar' : 'Expand sidebar'"
                class="absolute top-3.5 right-2 z-20 flex h-7 w-7 items-center justify-center rounded-lg text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
            >
                <svg
                    :class="sidebarOpen ? '' : 'rotate-180'"
                    class="h-4 w-4 transition-transform duration-300"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            {{-- Sidebar header --}}
            <div x-show="sidebarOpen" class="sticky top-0 z-10 bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-white/10 px-5 py-4 pr-10">
                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">Course Content</p>
                <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white leading-snug">{{ $course->title }}</p>
                <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">{{ $totalLessons }} {{ \Illuminate\Support\Str::plural('lesson', $totalLessons) }}</p>
            </div>

            {{-- Grouped lessons --}}
            <nav x-show="sidebarOpen">
                @foreach($this->grouped as $groupName => $groupLessons)
                @php $groupIsOpen = $groupLessons->contains('id', $lesson->id); @endphp
                <div
                    x-data="{ open: {{ $groupIsOpen ? 'true' : 'false' }} }"
                    class="border-b border-gray-100 dark:border-white/5"
                >
                    {{-- Group toggle --}}
                    <button
                        @click="open = !open"
                        class="flex w-full items-start justify-between px-5 py-3.5 text-left hover:bg-gray-50 dark:hover:bg-white/[0.03] transition-colors"
                    >
                        <div>
                            <p class="text-sm font-bold leading-snug text-gray-900 dark:text-white">{{ $groupName }}</p>
                            <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">{{ $groupLessons->count() }} {{ \Illuminate\Support\Str::plural('lesson', $groupLessons->count()) }}</p>
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
                            $isCurrent = $sideLesson->id === $lesson->id;
                            $hasQuiz   = ! empty($sideLesson->quiz_questions);
                            $sideMin   = max(1, (int) ceil(\Illuminate\Support\Str::wordCount(strip_tags($sideLesson->content ?? '')) / 200));
                        @endphp
                        <a
                            href="{{ \App\Filament\Pages\Instructor\TeachLessonPage::getUrl(['course' => $course->id, 'lesson' => $sideLesson->id]) }}"
                            wire:navigate
                            class="flex items-center gap-3 px-5 py-3 transition-colors
                                {{ $isCurrent
                                    ? 'bg-amber-50 dark:bg-amber-950/20 border-r-2 border-amber-500'
                                    : 'hover:bg-gray-50 dark:hover:bg-white/[0.03]'
                                }}"
                        >
                            {{-- Lesson number badge --}}
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full text-xs font-bold
                                {{ $isCurrent
                                    ? 'bg-amber-500 text-white'
                                    : 'bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400'
                                }}">
                                {{ $sideLesson->lesson_number }}
                            </span>

                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium leading-snug line-clamp-2
                                    {{ $isCurrent ? 'text-amber-700 dark:text-amber-400' : 'text-gray-800 dark:text-gray-200' }}">
                                    {{ $sideLesson->title }}
                                </p>
                                <p class="mt-0.5 text-xs text-gray-400 dark:text-gray-500">{{ $sideMin }} min</p>
                            </div>

                            @if($hasQuiz)
                                <span class="shrink-0 rounded px-1 py-0.5 text-[10px] font-bold bg-violet-100 dark:bg-violet-950/40 text-violet-600 dark:text-violet-400">Q</span>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </nav>
        </aside>

        {{-- ── RIGHT: Lesson Content ───────────────────────────────────────── --}}
        <div class="flex-1 min-w-0 overflow-y-auto bg-white dark:bg-gray-950 px-8 lg:px-14 py-10">

            {{-- Lesson meta badges --}}
            <div class="flex flex-wrap items-center gap-2.5 mb-5">
                @if($lesson->week_group)
                    <span class="inline-flex items-center rounded-full bg-violet-100 dark:bg-violet-950/40 px-3 py-0.5 text-xs font-semibold text-violet-700 dark:text-violet-400 ring-1 ring-inset ring-violet-200 dark:ring-violet-800">
                        {{ $lesson->week_group }}
                    </span>
                @endif
                <span class="flex items-center gap-1.5 text-xs text-gray-400 dark:text-gray-500">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $minRead }} min read
                    &nbsp;·&nbsp;
                    Lesson {{ $lessonPosition }} of {{ $totalLessons }}
                </span>
            </div>

            {{-- Title --}}
            <h1 class="text-2xl font-bold text-gray-950 dark:text-white mb-1">{{ $lesson->title }}</h1>

            @if($course->instructor_name)
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-8">by {{ $course->instructor_name }}</p>
            @else
                <div class="mb-8"></div>
            @endif

            {{-- Lesson content --}}
            <div class="prose prose-gray dark:prose-invert max-w-none
                prose-headings:font-bold prose-headings:text-gray-900 dark:prose-headings:text-white
                prose-a:text-amber-600 dark:prose-a:text-amber-400
                prose-strong:text-gray-900 dark:prose-strong:text-white">
                {!! $lesson->content !!}
            </div>

            {{-- Quiz notice --}}
            @if(! empty($lesson->quiz_questions))
            <div class="mt-10 rounded-xl bg-violet-50 dark:bg-violet-950/30 ring-1 ring-inset ring-violet-200 dark:ring-violet-800 px-5 py-4 flex items-start gap-3">
                <svg class="mt-0.5 h-5 w-5 text-violet-600 dark:text-violet-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-sm font-semibold text-violet-900 dark:text-violet-300">Quiz Included</p>
                    <p class="text-xs text-violet-600 dark:text-violet-400 mt-0.5">
                        This lesson has {{ count($lesson->quiz_questions) }} quiz question{{ count($lesson->quiz_questions) !== 1 ? 's' : '' }} for students.
                    </p>
                </div>
            </div>
            @endif

            {{-- ── Prev / Next navigation ── --}}
            <div class="mt-12 flex items-center justify-between border-t border-gray-100 dark:border-white/10 pt-8">
                @if($prevLesson)
                    <a
                        href="{{ \App\Filament\Pages\Instructor\TeachLessonPage::getUrl(['course' => $course->id, 'lesson' => $prevLesson->id]) }}"
                        wire:navigate
                        class="group flex items-center gap-2 rounded-xl bg-gray-50 dark:bg-gray-800 px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 ring-1 ring-gray-200 dark:ring-white/10 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors max-w-xs"
                    >
                        <svg class="h-4 w-4 shrink-0 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-200 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                        <span class="truncate">{{ $prevLesson->title }}</span>
                    </a>
                @else
                    <div></div>
                @endif

                @if($nextLesson)
                    <a
                        href="{{ \App\Filament\Pages\Instructor\TeachLessonPage::getUrl(['course' => $course->id, 'lesson' => $nextLesson->id]) }}"
                        wire:navigate
                        class="group flex items-center gap-2 rounded-xl bg-amber-500 hover:bg-amber-400 px-4 py-3 text-sm font-semibold text-white transition-colors max-w-xs"
                    >
                        <span class="truncate">{{ $nextLesson->title }}</span>
                        <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endif
            </div>

        </div>
    </div>

    @endif
</x-filament-panels::page>
