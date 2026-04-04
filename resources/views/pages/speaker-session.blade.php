@extends('layouts.app')

@section('title', 'Speaker Session — City Life International')
@section('meta_description', 'Access teaching sessions and resources from our Bible School speakers.')

@push('head')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush

@section('content')
@php
    $totalSessions = $sessionsByYear->flatten()->count();
@endphp

<div x-data="speakerSession()" class="bg-[#f9fafb] text-[#101828]">

    {{-- ============================================================
         HERO — full-width cover image
    ============================================================ --}}
    <section class="relative overflow-hidden pt-16">
        <div class="absolute inset-0">
            <img
                src="{{ $speaker->cover_image_url }}"
                alt="{{ $speaker->name }}"
                class="h-full w-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-black/20 to-[#f9fafb]"></div>
        </div>
        <div class="relative min-h-[260px]"></div>
    </section>

    {{-- ============================================================
         SPEAKER PROFILE HEADER
    ============================================================ --}}
    <section class="-mt-20 relative z-10 pb-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-end">
                {{-- Avatar --}}
                <div class="h-[140px] w-[140px] shrink-0 overflow-hidden rounded-2xl border-4 border-white shadow-lg">
                    <img
                        src="{{ $speaker->image_url }}"
                        alt="{{ $speaker->name }}"
                        class="h-full w-full object-cover object-center"
                    >
                </div>

                {{-- Info --}}
                <div class="pb-1">
                    <span class="inline-flex h-[24px] items-center rounded-md bg-[#e85d26] px-3 text-[10px] font-bold uppercase tracking-[0.08em] text-white">
                        {{ $speaker->role }}
                    </span>
                    <h1 class="mt-2 text-[28px] font-extrabold leading-tight text-[#101828] sm:text-[34px]">
                        {{ $speaker->name }}
                    </h1>
                    <p class="mt-0.5 text-[14px] text-[#667085]">{{ $speaker->church }}</p>

                    {{-- Media counts --}}
                    <div class="mt-3 flex flex-wrap items-center gap-4 text-[13px] text-[#667085]">
                        <span class="flex items-center gap-1.5">
                            <svg class="h-4 w-4 text-[#e85d26]" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.84A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.27l9.344-5.891a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                            <strong class="text-[#101828]">{{ $speaker->videos_count }}</strong> Videos
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="h-4 w-4 text-[#667085]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M12 12h.01M18.364 5.636a9 9 0 010 12.728"/></svg>
                            <strong class="text-[#101828]">{{ $speaker->audios_count }}</strong> Audios
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <strong class="text-[#101828]">{{ $totalSessions }}</strong> Sessions
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         MAIN CONTENT — About + Sessions | Sidebar
    ============================================================ --}}
    <section class="pb-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-8 lg:flex-row">

                {{-- LEFT — Main content --}}
                <div class="flex-1">

                    {{-- About --}}
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="h-[2px] w-5 bg-[#e85d26]"></span>
                            <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">About</h2>
                        </div>
                        <p class="mt-4 text-[14px] leading-relaxed text-[#667085]">
                            {{ $speaker->bio }}
                        </p>
                    </div>

                    {{-- Teaching Sessions — grouped by year --}}
                    <div class="mt-10 space-y-4">

                        @foreach ($sessionsByYear as $year => $yearSessions)
                        @php
                            $yearIsUnlocked = in_array($year, $unlockedYears);
                            $sessionCount   = $yearSessions->count();
                        @endphp

                        <div x-data="unlockFlow('{{ $speaker->first_name }}', '{{ $speaker->slug }}', {{ $year }})"
                             class="overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm">

                            @if ($yearIsUnlocked)

                                {{-- ── UNLOCKED: year header + sessions list ── --}}
                                <div class="flex items-center justify-between border-b border-[#f3f4f6] px-5 py-4">
                                    <div class="flex items-center gap-2.5">
                                        <span class="h-[2px] w-4 bg-[#e85d26]"></span>
                                        <h2 class="text-[13px] font-bold uppercase tracking-[0.08em] text-[#101828]">{{ $year }} Sessions</h2>
                                        <span class="rounded-full bg-[#f3f4f6] px-2 py-0.5 text-[11px] font-semibold text-[#667085]">{{ $sessionCount }}</span>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-[#dcfce7] px-2.5 py-1 text-[11px] font-bold text-[#16a34a]">
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        Unlocked
                                    </span>
                                </div>
                                <div class="divide-y divide-[#f9fafb] px-5 py-2">
                                    @foreach ($yearSessions as $session)
                                        <div class="flex items-center gap-4 py-3">
                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg {{ $session->type === 'video' ? 'bg-[#fff7ed] text-[#e85d26]' : 'bg-[#f0f9ff] text-[#2563eb]' }}">
                                                @if ($session->type === 'video')
                                                    <svg class="h-4.5 w-4.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.84A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.27l9.344-5.891a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                                                @else
                                                    <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M12 12h.01M18.364 5.636a9 9 0 010 12.728"/></svg>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="truncate text-[14px] font-semibold text-[#101828]">{{ $session->title }}</h4>
                                                <div class="mt-0.5 flex items-center gap-2 text-[12px] text-[#98a2b3]">
                                                    <span>{{ ucfirst($session->type) }}</span>
                                                    @if ($session->duration)
                                                        <span>·</span><span>{{ $session->duration }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <a href="{{ route('bible-school.resources.play', [$speaker->slug, $session->slug]) }}"
                                               class="flex h-8 shrink-0 items-center gap-1.5 rounded-lg bg-[#e85d26] px-3.5 text-[12px] font-semibold text-white transition-colors hover:bg-[#d14f1e]">
                                                @if ($session->type === 'video')
                                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.84A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.27l9.344-5.891a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>Watch
                                                @else
                                                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M12 12h.01M18.364 5.636a9 9 0 010 12.728"/></svg>Listen
                                                @endif
                                            </a>
                                        </div>
                                    @endforeach
                                </div>

                            @else

                                {{-- ── LOCKED: compact row + expandable form ── --}}
                                <div class="flex items-center justify-between px-5 py-4"
                                     :class="step !== 'closed' ? 'border-b border-[#f3f4f6]' : ''">
                                    <div class="flex items-center gap-2.5">
                                        <svg class="h-4 w-4 shrink-0 text-[#e85d26]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                                        <h2 class="text-[13px] font-bold uppercase tracking-[0.08em] text-[#101828]">{{ $year }} Sessions</h2>
                                        <span class="rounded-full bg-[#f3f4f6] px-2 py-0.5 text-[11px] font-semibold text-[#667085]">{{ $sessionCount }}</span>
                                    </div>
                                    <button
                                        x-show="step === 'closed'"
                                        @click="step = 'email'"
                                        class="inline-flex h-8 items-center gap-1.5 rounded-lg bg-[#e85d26] px-3.5 text-[12px] font-semibold text-white transition-colors hover:bg-[#d14f1e]">
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                        Request Access Code
                                    </button>
                                    <button
                                        x-show="step !== 'closed' && step !== 'unlocked'"
                                        x-cloak
                                        @click="step = 'closed'"
                                        class="text-[12px] text-[#98a2b3] hover:text-[#667085]">
                                        Cancel
                                    </button>
                                </div>

                                {{-- Expandable unlock form --}}
                                <div x-show="step !== 'closed'" x-cloak class="px-6 py-6 text-center">

                                    {{-- STEP 1: Email --}}
                                    <template x-if="step === 'email'">
                                        <div>
                                            <h3 class="text-[17px] font-extrabold text-[#101828]">Unlock {{ $year }} Sessions</h3>
                                            <p class="mx-auto mt-1.5 max-w-sm text-[13px] leading-relaxed text-[#667085]">
                                                Enter your email to receive a one-time code for <strong class="text-[#101828]">{{ $speaker->first_name }}'s {{ $year }}</strong> sessions.
                                            </p>
                                            <div class="mx-auto mt-5 max-w-sm space-y-3">
                                                <input
                                                    x-model="email"
                                                    type="email"
                                                    placeholder="Enter your email address"
                                                    class="h-[44px] w-full rounded-xl border border-[#e5e7eb] bg-[#f9fafb] px-4 text-[14px] text-[#101828] placeholder-[#98a2b3] outline-none focus:border-[#e85d26] focus:ring-2 focus:ring-[#e85d26]/15"
                                                    @keydown.enter="consent && email ? sendCode() : null"
                                                >
                                                <label class="flex cursor-pointer items-start gap-2.5 text-left">
                                                    <input x-model="consent" type="checkbox" class="mt-0.5 h-4 w-4 shrink-0 rounded border-[#d1d5db] text-[#e85d26]">
                                                    <span class="text-[12px] leading-relaxed text-[#667085]">
                                                        I consent to my email being used to send a one-time access code.
                                                    </span>
                                                </label>
                                                <button
                                                    @click="sendCode()"
                                                    :disabled="!consent || !email || loading"
                                                    class="inline-flex h-[44px] w-full items-center justify-center gap-2 rounded-xl bg-[#e85d26] text-[14px] font-semibold text-white transition-colors hover:bg-[#d14f1e] disabled:opacity-40">
                                                    <span x-show="!loading">Send Access Code</span>
                                                    <span x-show="loading" x-cloak>Sending…</span>
                                                </button>
                                                <template x-if="error">
                                                    <p class="text-[12px] text-red-500" x-text="error"></p>
                                                </template>
                                            </div>
                                        </div>
                                    </template>

                                    {{-- STEP 2: Verify code --}}
                                    <template x-if="step === 'verify'">
                                        <div>
                                            <h3 class="text-[17px] font-extrabold text-[#101828]">Check Your Inbox</h3>
                                            <p class="mx-auto mt-1.5 max-w-sm text-[13px] leading-relaxed text-[#667085]">
                                                We sent a code to <strong class="text-[#101828]" x-text="email"></strong>. Enter it below.
                                            </p>
                                            <div class="mx-auto mt-5 max-w-sm space-y-3">
                                                <input
                                                    x-model="code"
                                                    type="text"
                                                    placeholder="e.g. BS1234"
                                                    maxlength="6"
                                                    inputmode="text"
                                                    class="h-[44px] w-full rounded-xl border border-[#e5e7eb] bg-[#f9fafb] px-4 text-center text-[18px] font-bold uppercase tracking-[0.2em] text-[#101828] placeholder-[#d1d5db] outline-none focus:border-[#e85d26] focus:ring-2 focus:ring-[#e85d26]/15"
                                                    @keydown.enter="code.length === 6 ? verifyCode() : null"
                                                >
                                                <button
                                                    @click="verifyCode()"
                                                    :disabled="code.length !== 6 || loading"
                                                    class="inline-flex h-[44px] w-full items-center justify-center gap-2 rounded-xl bg-[#e85d26] text-[14px] font-semibold text-white transition-colors hover:bg-[#d14f1e] disabled:opacity-40">
                                                    <span x-show="!loading">Verify Code</span>
                                                    <span x-show="loading" x-cloak>Verifying…</span>
                                                </button>
                                                <template x-if="error">
                                                    <p class="text-[12px] text-red-500" x-text="error"></p>
                                                </template>
                                                <button @click="step = 'email'" class="text-[12px] text-[#98a2b3] hover:text-[#667085]">← Change email</button>
                                            </div>
                                        </div>
                                    </template>

                                    {{-- STEP 3: Success --}}
                                    <template x-if="step === 'unlocked'">
                                        <div class="flex flex-col items-center gap-2 py-2">
                                            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-[#dcfce7]">
                                                <svg class="h-6 w-6 text-[#16a34a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                            </div>
                                            <p class="text-[14px] font-semibold text-[#101828]">{{ $year }} Sessions Unlocked!</p>
                                            <p class="text-[12px] text-[#667085]">Refreshing…</p>
                                        </div>
                                    </template>

                                </div>

                            @endif
                        </div>
                        @endforeach

                    </div>
                </div>

                {{-- RIGHT — Sidebar --}}
                <div class="w-full shrink-0 space-y-5 lg:w-[280px]">

                    {{-- Other Speakers --}}
                    <div class="overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm">
                        <div class="border-b border-[#f3f4f6] px-5 py-4">
                            <h3 class="text-[13px] font-bold uppercase tracking-[0.06em] text-[#101828]">Other Speakers</h3>
                        </div>
                        <div class="divide-y divide-[#f3f4f6]">
                            @foreach ($otherSpeakers as $other)
                                <a href="{{ route('bible-school.resources.show', $other->slug) }}" class="flex items-center gap-3 px-5 py-3.5 transition-colors hover:bg-[#f9fafb]">
                                    <div class="h-10 w-10 shrink-0 overflow-hidden rounded-full">
                                        <img src="{{ $other->image_url }}" alt="{{ $other->name }}" class="h-full w-full object-cover object-center">
                                    </div>
                                    <div>
                                        <p class="text-[13px] font-semibold text-[#101828]">{{ $other->name }}</p>
                                        <p class="text-[12px] text-[#98a2b3]">{{ $other->sessions_count }} sessions</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- All Speakers link --}}
                    <a href="{{ route('bible-school.resources') }}" class="flex items-center justify-center gap-2 rounded-2xl border border-[#f3f4f6] bg-white px-5 py-3.5 text-[13px] font-semibold text-[#667085] shadow-sm transition-colors hover:text-[#e85d26]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        All Speakers
                    </a>

                    {{-- Bible School Home link --}}
                    <a href="{{ route('bible-school') }}" class="flex items-center justify-center gap-2 rounded-2xl border border-[#f3f4f6] bg-white px-5 py-3.5 text-[13px] font-semibold text-[#667085] shadow-sm transition-colors hover:text-[#e85d26]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Bible School Home
                    </a>

                </div>
            </div>
        </div>
    </section>

</div>
@endsection

@push('scripts')
<script>
function unlockFlow(firstName, speakerSlug, year) {
    return {
        step: 'closed',      // 'closed' | 'email' | 'verify' | 'unlocked'
        email: '',
        consent: false,
        code: '',
        loading: false,
        error: '',

        async sendCode() {
            this.error = '';
            this.loading = true;
            try {
                const res = await fetch('/session-access/send-code', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        email: this.email,
                        speaker_slug: speakerSlug,
                        year: year,
                    }),
                });
                const data = await res.json();
                if (!res.ok) {
                    this.error = data.message || 'Something went wrong.';
                    return;
                }
                this.step = 'verify';
            } catch (e) {
                this.error = 'Network error. Please try again.';
            } finally {
                this.loading = false;
            }
        },

        async verifyCode() {
            this.error = '';
            this.loading = true;
            try {
                const res = await fetch('/session-access/verify-code', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        email: this.email,
                        code: this.code,
                        speaker_slug: speakerSlug,
                        year: year,
                    }),
                });
                const data = await res.json();
                if (!res.ok) {
                    this.error = data.message || 'Invalid or expired code.';
                    return;
                }
                this.step = 'unlocked';
                setTimeout(() => window.location.reload(), 1500);
            } catch (e) {
                this.error = 'Network error. Please try again.';
            } finally {
                this.loading = false;
            }
        },
    };
}
</script>
@endpush
