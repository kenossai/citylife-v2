<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Certificate — {{ $enrollment->course->title }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            .cert-wrap { box-shadow: none !important; margin: 0 !important; }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100 font-sans antialiased py-10 px-4 print:bg-white print:p-0">

{{-- Top bar (hidden when printing) --}}
<div class="no-print max-w-3xl mx-auto mb-6 flex items-center justify-between">
    <a href="{{ route('member.certificates') }}"
       class="flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-900 transition-colors">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Back to Certificates
    </a>
    <div class="flex items-center gap-2">
        <button onclick="window.print()"
                class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors shadow-sm">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Save / Print
        </button>
    </div>
</div>

{{-- Certificate card --}}
<div class="cert-wrap max-w-3xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden">

    {{-- Header band --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-purple-600 via-purple-400 to-pink-500 px-12 pt-14 pb-16 flex flex-col items-center text-center">

        {{-- Decorative rings --}}
        <div class="pointer-events-none absolute inset-0 flex items-center justify-center">
            <div class="h-[500px] w-[500px] rounded-full border-[1.5px] border-white/10"></div>
        </div>
        <div class="pointer-events-none absolute inset-0 flex items-center justify-center">
            <div class="h-96 w-96 rounded-full border-[1.5px] border-white/10"></div>
        </div>
        <div class="pointer-events-none absolute inset-0 flex items-center justify-center">
            <div class="h-64 w-64 rounded-full border-[1.5px] border-white/10"></div>
        </div>
        <div class="pointer-events-none absolute inset-0 flex items-center justify-center">
            <div class="h-40 w-40 rounded-full border-[1.5px] border-white/10"></div>
        </div>

        {{-- Medal icon --}}
        <div class="relative z-10 mb-6 flex h-20 w-20 items-center justify-center rounded-full border-2 border-white/40 bg-white/20">
            <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" stroke-width="1.3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 4H8l-1 5h10l-1-5z"/>
                <circle cx="12" cy="15" r="4"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 9l-2 10M15 9l2 10"/>
            </svg>
        </div>

        <p class="relative z-10 text-xs font-semibold uppercase tracking-[0.2em] text-white/70 mb-2">
            Certificate of Completion
        </p>
        <h1 class="relative z-10 text-3xl font-extrabold text-white" style="font-family: 'Playfair Display', serif;">
            {{ $enrollment->course->title }}
        </h1>
        <p class="relative z-10 mt-2 text-sm text-white/60 uppercase tracking-widest">
            City Life International · Bible School
        </p>
    </div>

    {{-- Body --}}
    <div class="px-12 py-10">

        <p class="text-sm text-gray-400 uppercase tracking-widest font-semibold mb-1 text-center">This certifies that</p>
        <h2 class="text-4xl font-extrabold text-gray-900 text-center mb-6" style="font-family: 'Playfair Display', serif;">
            {{ $member->full_name }}
        </h2>

        <p class="text-center text-gray-600 text-sm leading-relaxed mb-8">
            has successfully completed the course
            <span class="font-semibold text-gray-900">{{ $enrollment->course->title }}</span>
            @if($enrollment->course->instructor_name)
            under the instruction of <span class="font-semibold text-gray-900">{{ $enrollment->course->instructor_name }}</span>
            @endif
            @if($durationWeeks)
            over a period of <span class="font-semibold text-gray-900">{{ $durationWeeks }} {{ Str::plural('week', $durationWeeks) }}</span>
            @endif
            and has demonstrated commitment to biblical learning and spiritual development.
        </p>

        {{-- Stats row --}}
        <div class="grid grid-cols-3 gap-4 mb-8">
            @if($completedAt)
            <div class="text-center rounded-xl bg-gray-50 border border-gray-100 px-4 py-3">
                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">Date Issued</p>
                <p class="text-sm font-bold text-gray-900">{{ $completedAt->format('jS M Y') }}</p>
            </div>
            @endif
            @if($durationWeeks)
            <div class="text-center rounded-xl bg-gray-50 border border-gray-100 px-4 py-3">
                <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-0.5">Duration</p>
                <p class="text-sm font-bold text-gray-900">{{ $durationWeeks }} {{ Str::plural('week', $durationWeeks) }}</p>
            </div>
            @endif
            @if($grade)
            @php
                $gradeBg = $grade === 'Distinction' ? 'bg-amber-50 border-amber-100 text-amber-800'
                         : ($grade === 'Merit'      ? 'bg-blue-50 border-blue-100 text-blue-800'
                                                    : 'bg-green-50 border-green-100 text-green-800');
            @endphp
            <div class="text-center rounded-xl border px-4 py-3 {{ $gradeBg }}">
                <p class="text-[10px] font-bold uppercase tracking-widest opacity-60 mb-0.5">Grade</p>
                <p class="text-sm font-extrabold">{{ $grade }}</p>
            </div>
            @endif
        </div>

        {{-- Divider + signature area --}}
        <div class="border-t border-gray-100 pt-8 flex items-end justify-between">
            <div class="text-center">
                <div class="h-px w-32 bg-gray-300 mb-2"></div>
                <p class="text-xs text-gray-500">
                    @if($enrollment->course->instructor_name)
                    {{ $enrollment->course->instructor_name }}
                    @else
                    City Life International
                    @endif
                </p>
                <p class="text-[10px] text-gray-400">Course Instructor</p>
            </div>

            <div class="flex flex-col items-center">
                <div class="h-12 w-12 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center mb-1">
                    <span class="text-white font-extrabold text-xs">CL</span>
                </div>
                <p class="text-[10px] text-gray-400">City Life International</p>
            </div>

            <div class="text-center">
                <div class="h-px w-32 bg-gray-300 mb-2"></div>
                <p class="text-xs text-gray-500">City Life International</p>
                <p class="text-[10px] text-gray-400">Authorised by</p>
            </div>
        </div>

        {{-- Certificate number --}}
        <p class="mt-6 text-center text-[10px] text-gray-300 uppercase tracking-widest">
            Certificate No. CL-{{ str_pad($enrollment->id, 6, '0', STR_PAD_LEFT) }}
            @if($completedAt) · {{ $completedAt->format('Y') }} @endif
        </p>
    </div>
</div>

<div class="no-print max-w-3xl mx-auto mt-6 text-center">
    <p class="text-xs text-gray-400">Use <strong>Save / Print</strong> above to download this certificate as a PDF.</p>
</div>

@if(request('print'))
<script>window.addEventListener('load', () => window.print())</script>
@endif

</body>
</html>
