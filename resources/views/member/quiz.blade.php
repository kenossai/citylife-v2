<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Quiz — {{ $lesson->title }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="min-h-screen bg-[#eeebe6] font-sans antialiased" x-data="quizApp" x-cloak>

{{-- ── TOP NAV ── --}}
<header class="flex h-14 items-center justify-between px-5 sm:px-8">
    <a
        href="{{ route('member.lesson.show', ['courseSlug' => $course->slug, 'lessonSlug' => $lesson->slug]) }}"
        class="flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-800 transition-colors"
    >
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Lesson
    </a>

    <div class="flex items-center gap-4 text-sm">
        {{-- Timer --}}
        <span class="flex items-center gap-1.5 font-semibold text-[#e85d26]">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <path stroke-linecap="round" d="M12 6v6l4 2"/>
            </svg>
            <span x-text="formattedTime">0:00</span>
        </span>
        {{-- Question counter --}}
        <span class="font-medium text-gray-400">
            <span x-text="currentIndex + 1">1</span>
            <span class="mx-0.5 text-gray-300">/</span>
            <span x-text="questions.length">5</span>
        </span>
    </div>
</header>

{{-- ── SEGMENTED PROGRESS BAR ── --}}
<div class="flex gap-1.5 px-5 sm:px-8">
    <template x-for="(q, i) in questions" :key="i">
        <div
            class="h-1 flex-1 rounded-full transition-colors duration-500"
            :class="i <= currentIndex ? 'bg-[#e85d26]' : 'bg-gray-300/60'"
        ></div>
    </template>
</div>

{{-- ── QUIZ QUESTION ── --}}
<main
    class="mx-auto max-w-lg px-5 sm:px-8 pt-10 pb-10"
    x-show="!completed"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    {{-- Quiz label --}}
    <p class="mb-5 text-[11px] font-bold uppercase tracking-widest text-[#e85d26]">
        Quiz{{ $lesson->week_group ? ' — ' . Str::upper($lesson->week_group) : '' }}
    </p>

    {{-- Question text --}}
    <h1
        class="mb-8 text-xl sm:text-2xl font-extrabold leading-snug text-gray-900"
        x-text="currentQuestion.question"
    ></h1>

    {{-- Answer options --}}
    <div class="space-y-3">
        <template x-for="(option, oIndex) in (currentQuestion.options || [])" :key="oIndex">
            <button
                @click="selectAnswer(oIndex)"
                :disabled="answered"
                class="w-full flex items-center gap-4 rounded-2xl bg-white px-5 py-4 text-left shadow-sm transition-all duration-200 cursor-pointer disabled:cursor-default"
                :class="optionClasses(oIndex)"
            >
                {{-- Letter badge --}}
                <span
                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border-2 text-xs font-bold transition-all duration-200"
                    :class="badgeClasses(oIndex)"
                    x-text="['A','B','C','D'][oIndex]"
                ></span>
                {{-- Option text --}}
                <span class="text-sm font-medium text-gray-800" x-text="option"></span>
            </button>
        </template>
    </div>

    {{-- Action button --}}
    <div class="mt-8">
        {{-- Check Answer (before answering) --}}
        <button
            x-show="!answered"
            @click="checkAnswer()"
            :disabled="selectedAnswer === null"
            class="w-full rounded-2xl bg-gradient-to-r from-[#e85d26] to-[#f0835a] py-4 text-base font-bold text-white shadow-lg transition-opacity disabled:opacity-40 disabled:cursor-not-allowed"
        >
            Check Answer
        </button>

        {{-- Next Question (after answering, not last) --}}
        <button
            x-show="answered && !isLastQuestion"
            @click="nextQuestion()"
            class="w-full rounded-2xl bg-gradient-to-r from-[#e85d26] to-[#f0835a] py-4 text-base font-bold text-white shadow-lg"
        >
            Next Question
            <svg class="inline ml-2 h-4 w-4 -mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        {{-- See Results (after answering, last question) --}}
        <button
            x-show="answered && isLastQuestion"
            @click="finishQuiz()"
            class="w-full rounded-2xl bg-gradient-to-r from-[#e85d26] to-[#f0835a] py-4 text-base font-bold text-white shadow-lg"
        >
            See Results
            <svg class="inline ml-2 h-4 w-4 -mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </button>
    </div>

    {{-- Feedback pill (appears after answering) --}}
    <div
        x-show="answered"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="mt-4 flex items-center justify-center"
    >
        <span
            class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold"
            :class="isCorrect ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700'"
        >
            <svg x-show="isCorrect" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <svg x-show="!isCorrect" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <span x-text="isCorrect ? 'Correct!' : 'Not quite — keep going'"></span>
        </span>
    </div>
</main>

{{-- ── RESULTS SCREEN ── --}}
<div
    x-show="completed"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    class="fixed inset-0 flex flex-col items-center justify-center bg-[#eeebe6] px-6 text-center"
    style="display: none;"
>
    {{-- Score ring --}}
    <div class="relative mb-6 flex h-32 w-32 items-center justify-center">
        <svg class="absolute inset-0 h-full w-full -rotate-90" viewBox="0 0 36 36">
            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#e0dbd4" stroke-width="2.5"/>
            <circle
                cx="18" cy="18" r="15.9" fill="none"
                stroke="#e85d26" stroke-width="2.5"
                stroke-dasharray="100"
                :stroke-dashoffset="100 - score"
                stroke-linecap="round"
                style="transition: stroke-dashoffset 1s ease-out;"
            />
        </svg>
        <div class="text-center">
            <span class="block text-3xl font-extrabold text-gray-900" x-text="score + '%'"></span>
        </div>
    </div>

    {{-- Status badge --}}
    <span
        class="mb-3 inline-flex items-center gap-1.5 rounded-full px-4 py-1.5 text-sm font-bold"
        :class="score >= 60 ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700'"
    >
        <svg x-show="score >= 60" class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
        </svg>
        <svg x-show="score < 60" class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <span x-text="score >= 60 ? 'Passed' : 'Keep Studying'"></span>
    </span>

    <h2 class="text-2xl font-extrabold text-gray-900 mb-1">Quiz Complete</h2>
    <p class="text-sm text-gray-500 mb-1">
        <span x-text="correctCount"></span> correct out of <span x-text="questions.length"></span> questions
    </p>
    <p class="text-xs text-gray-400 mb-10">
        Time: <span x-text="formattedTime"></span>
    </p>

    {{-- Actions --}}
    <div class="w-full max-w-xs space-y-3">
        <a
            href="{{ route('member.lesson.show', ['courseSlug' => $course->slug, 'lessonSlug' => $lesson->slug]) }}"
            class="block w-full rounded-2xl bg-gradient-to-r from-[#e85d26] to-[#f0835a] py-4 text-base font-bold text-white shadow-lg text-center"
        >
            Back to Lesson
        </a>
        <button
            @click="resetQuiz()"
            class="block w-full rounded-2xl border-2 border-gray-300 bg-transparent py-3.5 text-base font-semibold text-gray-600 hover:border-gray-400 hover:text-gray-800 transition-colors"
        >
            Retake Quiz
        </button>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('quizApp', () => ({
            questions: @js($lesson->quiz_questions ?? []),
            submitUrl: @js(route('member.lesson.quiz', ['courseSlug' => $course->slug, 'lessonSlug' => $lesson->slug])),
            csrfToken: '',

            currentIndex: 0,
        selectedAnswer: null,
        answered: false,
        correctCount: 0,
        userAnswers: [],
        elapsed: 0,
        _timer: null,
        completed: false,
        score: 0,

            init() {
                this.csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
                this._timer = setInterval(() => this.elapsed++, 1000);
            },

            get currentQuestion() {
                return this.questions[this.currentIndex] ?? { question: '', options: [] };
            },
            get correctAnswer() {
                return parseInt(this.currentQuestion.answer ?? -1);
            },
            get isLastQuestion() {
                return this.currentIndex === this.questions.length - 1;
            },
            get isCorrect() {
                return this.selectedAnswer === this.correctAnswer;
            },
            get formattedTime() {
                const m = String(Math.floor(this.elapsed / 60)).padStart(2, '0');
                const s = String(this.elapsed % 60).padStart(2, '0');
                return m + ':' + s;
            },

            optionClasses(oIndex) {
                if (!this.answered) {
                    return this.selectedAnswer === oIndex
                        ? 'ring-2 ring-[#e85d26] shadow-md'
                        : 'hover:shadow-md';
                }
                if (oIndex === this.correctAnswer) return 'ring-2 ring-emerald-400 bg-emerald-50';
                if (oIndex === this.selectedAnswer) return 'ring-2 ring-red-400 bg-red-50';
                return 'opacity-50';
            },

            badgeClasses(oIndex) {
                if (!this.answered) {
                    return this.selectedAnswer === oIndex
                        ? 'border-[#e85d26] bg-[#e85d26] text-white'
                        : 'border-gray-300 text-gray-500';
                }
                if (oIndex === this.correctAnswer) return 'border-emerald-400 bg-emerald-400 text-white';
                if (oIndex === this.selectedAnswer && oIndex !== this.correctAnswer) return 'border-red-400 bg-red-400 text-white';
                return 'border-gray-200 text-gray-300';
            },

            selectAnswer(index) {
                if (!this.answered) this.selectedAnswer = index;
            },

            checkAnswer() {
                if (this.selectedAnswer === null) return;
                this.answered = true;
                if (this.isCorrect) this.correctCount++;
                this.userAnswers[this.currentIndex] = this.selectedAnswer;
            },

            nextQuestion() {
                this.currentIndex++;
                this.selectedAnswer = null;
                this.answered = false;
            },

            async finishQuiz() {
                clearInterval(this._timer);
                this.userAnswers[this.currentIndex] = this.selectedAnswer;
                this.score = Math.round((this.correctCount / this.questions.length) * 100);
                this.completed = true;
                try {
                    const fd = new FormData();
                    fd.append('_token', this.csrfToken);
                    this.userAnswers.forEach((ans, i) => fd.append('answers[' + i + ']', ans));
                    await fetch(this.submitUrl, { method: 'POST', body: fd });
                } catch (_) {}
            },

            resetQuiz() {
                clearInterval(this._timer);
                this.currentIndex = 0;
                this.selectedAnswer = null;
                this.answered = false;
                this.correctCount = 0;
                this.userAnswers = [];
                this.elapsed = 0;
                this.completed = false;
                this.score = 0;
                this._timer = setInterval(() => this.elapsed++, 1000);
            },
        }));
    });
</script>

</body>
</html>
