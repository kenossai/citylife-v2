@extends('layouts.member')

@section('title', 'My Progress')

@section('content')

{{-- ── Page heading ── --}}
<div class="mb-8">
    <p class="text-[#e85d26] text-xs font-semibold uppercase tracking-widest mb-2">Bible School</p>
    <h1 class="text-2xl font-extrabold text-gray-900">My Progress</h1>
    <p class="text-gray-500 text-sm mt-1">Track your study activity and course completion.</p>
</div>

{{-- ── Study Activity Heatmap ── --}}
<div class="mb-10 rounded-2xl bg-white border border-gray-200 shadow-sm p-6">
    <div class="flex items-center gap-2 mb-5">
        <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <h2 class="text-sm font-bold text-gray-900">Study Activity — Last 5 Weeks</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-separate" style="border-spacing: 0 4px;">
            <thead>
                <tr>
                    <th class="w-20 pr-3"></th>
                    @foreach(['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $day)
                    <th class="text-center text-xs font-medium text-gray-400 pb-2">{{ $day }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($heatmap as $weekIndex => $weekDays)
                <tr>
                    <td class="pr-3 text-right text-xs text-gray-400 whitespace-nowrap">
                        {{ $weekIndex === 4 ? 'This week' : (4 - $weekIndex).' wks ago' }}
                    </td>
                    @foreach($weekDays as $cell)
                    @php
                        $count = $cell['count'];
                        if ($cell['isFuture']) {
                            $bg = 'bg-gray-50 border border-gray-100';
                        } elseif ($count === 0) {
                            $bg = 'bg-gray-100';
                        } elseif ($count === 1) {
                            $bg = 'bg-orange-200';
                        } elseif ($count === 2) {
                            $bg = 'bg-orange-400';
                        } elseif ($count === 3) {
                            $bg = 'bg-orange-500';
                        } else {
                            $bg = 'bg-red-500';
                        }
                    @endphp
                    <td class="px-1">
                        <div
                            title="{{ $count > 0 ? $count.' lesson'.($count > 1 ? 's' : '').' — '.\Carbon\Carbon::parse($cell['date'])->format('D d M') : \Carbon\Carbon::parse($cell['date'])->format('D d M') }}"
                            class="h-8 rounded-lg {{ $bg }} transition-colors"
                        ></div>
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Legend --}}
    <div class="mt-4 flex items-center justify-end gap-2">
        <span class="text-xs text-gray-400">Less</span>
        <div class="h-4 w-6 rounded bg-gray-100"></div>
        <div class="h-4 w-6 rounded bg-orange-200"></div>
        <div class="h-4 w-6 rounded bg-orange-400"></div>
        <div class="h-4 w-6 rounded bg-orange-500"></div>
        <div class="h-4 w-6 rounded bg-red-500"></div>
        <span class="text-xs text-gray-400">More</span>
    </div>
</div>

{{-- ── Course Breakdown ── --}}
@if($courseBreakdowns->isNotEmpty())
<div class="mb-6 flex items-center gap-3">
    <div class="h-0.5 w-5 bg-[#e85d26]"></div>
    <h2 class="text-xs font-bold uppercase tracking-widest text-gray-500">Course Breakdown</h2>
</div>

<div class="space-y-6">
    @foreach($courseBreakdowns as $breakdown)
    @php
        $course   = $breakdown['course'];
        $modules  = $breakdown['modules'];
        $hours    = floor($breakdown['minutesStudied'] / 60);
        $mins     = $breakdown['minutesStudied'] % 60;
        $timeStr  = $hours > 0 ? '~'.$hours.'.'.(int)round($mins/6).'h' : '~'.$breakdown['minutesStudied'].'m';
    @endphp
    <div class="rounded-2xl overflow-hidden border border-gray-200 shadow-sm">

        {{-- Gradient header --}}
        <div class="relative bg-gradient-to-r from-[#e85d26] to-[#b83010] px-6 py-5 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/20 border border-white/30">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-white leading-snug">{{ $course->title }}</h3>
                    @if($course->instructor_name)
                    <p class="text-xs text-white/70 mt-0.5">{{ $course->instructor_name }}</p>
                    @endif
                </div>
            </div>
            <div class="text-right shrink-0">
                <p class="text-3xl font-extrabold text-white leading-none">{{ $breakdown['progressPercent'] }}%</p>
                <p class="text-xs text-white/70 mt-0.5">complete</p>
            </div>
        </div>

        {{-- Stats row --}}
        <div class="bg-white px-6 py-4 border-b border-gray-100 flex flex-wrap items-center gap-x-5 gap-y-2">
            <span class="flex items-center gap-1.5 text-xs text-gray-600">
                <svg class="h-3.5 w-3.5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
                </svg>
                <span class="font-semibold text-gray-900">{{ $breakdown['completedLessons'] }} / {{ $breakdown['totalLessons'] }}</span> lessons read
            </span>
            <span class="flex items-center gap-1.5 text-xs text-gray-600">
                <svg class="h-3.5 w-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-semibold text-gray-900">{{ $timeStr }}</span> studied
            </span>
            @if($breakdown['totalQuizzes'] > 0)
            <span class="flex items-center gap-1.5 text-xs text-gray-600">
                <svg class="h-3.5 w-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-semibold text-gray-900">{{ $breakdown['quizzesDone'] }} / {{ $breakdown['totalQuizzes'] }}</span> quizzes done
            </span>
            @endif
            @if($course->category)
            <span class="inline-flex items-center rounded-full bg-[#e85d26]/10 border border-[#e85d26]/20 px-2.5 py-0.5 text-xs font-semibold text-[#e85d26]">
                {{ $course->category }}
            </span>
            @endif
        </div>

        {{-- Module rows --}}
        <div class="bg-white divide-y divide-gray-100 rounded-b-2xl">
            @foreach($modules as $moduleIndex => $module)
            @php
                $isComplete   = $module['percent'] === 100;
                $isInProgress = $module['percent'] > 0 && $module['percent'] < 100;
            @endphp
            <div class="flex items-center gap-4 px-6 py-4">

                {{-- Icon --}}
                @if($isComplete)
                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-500">
                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </span>
                @elseif($isInProgress)
                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#e85d26]">
                    <span class="text-xs font-bold text-white">{{ $moduleIndex + 1 }}</span>
                </span>
                @else
                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-gray-100 border border-gray-200">
                    <span class="text-xs font-semibold text-gray-400">{{ $moduleIndex + 1 }}</span>
                </span>
                @endif

                {{-- Name + bar --}}
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">{{ $module['name'] }}</p>
                    <div class="mt-1.5 h-1.5 w-full rounded-full bg-gray-100 overflow-hidden">
                        @if($module['percent'] > 0)
                        <div
                            class="h-1.5 rounded-full transition-all {{ $isComplete ? 'bg-emerald-500' : 'bg-[#e85d26]' }}"
                            style="width: {{ $module['percent'] }}%"
                        ></div>
                        @endif
                    </div>
                </div>

                {{-- Count --}}
                <span class="shrink-0 text-xs text-gray-400 font-medium">{{ $module['completed'] }}/{{ $module['total'] }}</span>

                {{-- Quiz badge --}}
                @if($module['quiz_score'] !== null)
                <span class="shrink-0 inline-flex items-center rounded-full bg-emerald-50 border border-emerald-200 px-2.5 py-0.5 text-xs font-bold text-emerald-700">
                    Quiz: {{ $module['quiz_score'] }}%
                </span>
                @else
                <span class="shrink-0 w-20"></span>
                @endif

            </div>
            @endforeach
        </div>

    </div>
    @endforeach
</div>
@else
<div class="flex flex-col items-center justify-center py-20 text-center">
    <div class="h-16 w-16 rounded-2xl bg-[#e85d26]/15 border border-[#e85d26]/20 flex items-center justify-center mb-4">
        <svg class="h-8 w-8 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
    </div>
    <h3 class="text-base font-bold text-gray-900 mb-1">No progress yet</h3>
    <p class="text-sm text-gray-500 mb-6">Enrol in a course to start tracking your progress.</p>
    <a href="{{ route('courses') }}" class="inline-flex items-center gap-2 rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-6 py-2.5 text-sm font-semibold text-white transition-colors">
        Browse Courses
    </a>
</div>
@endif

@endsection
