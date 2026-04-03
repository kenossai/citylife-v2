@extends('layouts.app')

@section('title', 'Speaker Session — City Life International')
@section('meta_description', 'Access teaching sessions and resources from our Bible School speakers.')

@push('head')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush

@section('content')
@php $isLocked = !$unlocked; @endphp

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
                            <strong class="text-[#101828]">{{ $sessions->count() }}</strong> Sessions
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

                    {{-- Teaching Sessions --}}
                    <div class="mt-10">
                        <div class="flex items-center gap-3">
                            <span class="h-[2px] w-5 bg-[#e85d26]"></span>
                            <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">Teaching Sessions</h2>
                            @if ($isLocked)
                                <span class="inline-flex h-[24px] items-center gap-1.5 rounded-md bg-[#fff7ed] px-2.5 text-[11px] font-bold text-[#e85d26]">
                                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                                    Locked
                                </span>
                            @endif
                        </div>

                        @if ($isLocked)
                            {{-- Locked state — two-step unlock card --}}
                            <div class="mt-6 overflow-hidden rounded-2xl bg-[#13131f] p-8 text-center shadow-xl"
                                 x-data="unlockFlow('{{ $speaker->first_name }}', '{{ $speaker->slug }}')"
                            >
                                {{-- ===== STEP 1: Enter email ===== --}}
                                <template x-if="step === 'email'">
                                    <div>
                                        {{-- Lock icon --}}
                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-[#ff8904]/30 to-[#e85d26]/30 ring-1 ring-[#ff8904]/20">
                                            <svg class="h-7 w-7 text-[#ff8904]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                                        </div>

                                        {{-- Badge --}}
                                        <div class="mt-5 inline-flex h-[26px] items-center gap-1.5 rounded-full border border-[#ff8904]/30 bg-[#ff8904]/10 px-3 text-[10px] font-bold uppercase tracking-[0.1em] text-[#ff8904]">
                                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z"/></svg>
                                            Bible School International
                                        </div>

                                        <h3 class="mt-4 text-[22px] font-extrabold text-white">Access Teaching Resources</h3>
                                        <p class="mx-auto mt-2 max-w-sm text-[13px] leading-relaxed text-white/50">
                                            Enter your email to receive a one-time code and unlock all of <strong class="text-white/80">{{ $speaker['firstName'] }}</strong>'s sessions.
                                        </p>

                                        {{-- Email input --}}
                                        <div class="mx-auto mt-6 max-w-sm">
                                            <input
                                                x-model="email"
                                                type="email"
                                                placeholder="Enter your email address"
                                                class="h-[46px] w-full rounded-xl border border-white/10 bg-white/5 px-4 text-[14px] text-white placeholder-white/30 outline-none focus:border-[#e85d26]/50 focus:ring-2 focus:ring-[#e85d26]/20"
                                                @keydown.enter="consent && email ? sendCode() : null"
                                            >
                                        </div>

                                        {{-- Data consent checkbox --}}
                                        <div class="mx-auto mt-4 max-w-sm">
                                            <label class="flex items-start gap-2.5 text-left">
                                                <input
                                                    x-model="consent"
                                                    type="checkbox"
                                                    class="mt-0.5 h-4 w-4 shrink-0 rounded border-white/20 bg-white/5 text-[#e85d26] focus:ring-[#e85d26]/30"
                                                >
                                                <span class="text-[12px] leading-relaxed text-white/45">
                                                    I consent to my email being used to send a one-time access code and agree to the <a href="#" class="text-[#ff8904] underline hover:text-[#e85d26]">Privacy Policy</a>.
                                                </span>
                                            </label>
                                        </div>

                                        {{-- Error message --}}
                                        <template x-if="error">
                                            <p class="mx-auto mt-3 max-w-sm text-[12px] text-red-400" x-text="error"></p>
                                        </template>

                                        {{-- Unlock button --}}
                                        <div class="mx-auto mt-4 max-w-sm">
                                            <button
                                                @click="sendCode()"
                                                :disabled="!consent || !email || loading"
                                                :class="consent && email && !loading ? 'opacity-100 hover:shadow-[#e85d26]/25 hover:brightness-110' : 'opacity-50 cursor-not-allowed'"
                                                class="flex h-[46px] w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-[#e85d26] to-[#ff8904] text-[14px] font-bold text-white shadow-lg transition-all"
                                            >
                                                <template x-if="!loading">
                                                    <span class="flex items-center gap-2">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                                        Unlock Sessions
                                                    </span>
                                                </template>
                                                <template x-if="loading">
                                                    <span class="flex items-center gap-2">
                                                        <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                                        Sending…
                                                    </span>
                                                </template>
                                            </button>
                                        </div>

                                        {{-- Trust badges --}}
                                        <div class="mt-5 flex items-center justify-center gap-4 text-[11px] text-white/35">
                                            <span class="flex items-center gap-1">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                                Secure
                                            </span>
                                            <span>·</span>
                                            <span>One-time code</span>
                                            <span>·</span>
                                            <span>Free access</span>
                                        </div>
                                    </div>
                                </template>

                                {{-- ===== STEP 2: Verify code ===== --}}
                                <template x-if="step === 'verify'">
                                    <div>
                                        {{-- Check icon --}}
                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#0d3320] ring-1 ring-[#16a34a]/30">
                                            <svg class="h-7 w-7 text-[#16a34a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>

                                        <h3 class="mt-5 text-[22px] font-extrabold text-white">Check Your Inbox</h3>
                                        <p class="mx-auto mt-2 max-w-sm text-[13px] leading-relaxed text-white/50">
                                            We sent a 6-digit code to <strong class="text-white/80" x-text="email"></strong>
                                        </p>

                                        {{-- Code input --}}
                                        <div class="mx-auto mt-5 max-w-sm">
                                            <input
                                                x-model="code"
                                                type="text"
                                                maxlength="6"
                                                inputmode="numeric"
                                                placeholder="Enter 6-digit code"
                                                class="h-[52px] w-full rounded-xl border border-white/10 bg-white/5 px-4 text-center font-mono text-[18px] tracking-[0.25em] text-white placeholder-white/30 outline-none focus:border-[#16a34a]/50 focus:ring-2 focus:ring-[#16a34a]/20"
                                                @keydown.enter="code.length === 6 ? verifyCode() : null"
                                            >
                                        </div>

                                        {{-- Error message --}}
                                        <template x-if="error">
                                            <p class="mx-auto mt-3 max-w-sm text-[12px] text-red-400" x-text="error"></p>
                                        </template>

                                        {{-- Verify button --}}
                                        <div class="mx-auto mt-4 max-w-sm">
                                            <button
                                                @click="verifyCode()"
                                                :disabled="code.length !== 6 || loading"
                                                :class="code.length === 6 && !loading ? 'opacity-100 hover:brightness-110' : 'opacity-50 cursor-not-allowed'"
                                                class="flex h-[46px] w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-[#16a34a] to-[#22d3ee] text-[14px] font-bold text-white shadow-lg transition-all"
                                            >
                                                <template x-if="!loading">
                                                    <span class="flex items-center gap-2">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                        Verify & Unlock
                                                    </span>
                                                </template>
                                                <template x-if="loading">
                                                    <span class="flex items-center gap-2">
                                                        <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                                        Verifying…
                                                    </span>
                                                </template>
                                            </button>
                                        </div>

                                        {{-- Go back link --}}
                                        <p class="mt-5 text-[12px] text-white/35">
                                            Didn't receive it? <button @click="step = 'email'; code = ''; error = ''" class="text-white/50 underline hover:text-white/70">Go back and resend</button>
                                        </p>
                                    </div>
                                </template>

                                {{-- ===== STEP 3: Unlocked ===== --}}
                                <template x-if="step === 'unlocked'">
                                    <div>
                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#0d3320] ring-1 ring-[#16a34a]/30">
                                            <svg class="h-7 w-7 text-[#16a34a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        </div>
                                        <h3 class="mt-5 text-[22px] font-extrabold text-white">Sessions Unlocked!</h3>
                                        <p class="mx-auto mt-2 max-w-sm text-[13px] text-white/50">Refreshing the page…</p>
                                    </div>
                                </template>
                            </div>
                        @else
                            {{-- Unlocked sessions list --}}
                            <div class="mt-6 space-y-3">
                                @foreach ($sessions as $session)
                                    <div class="flex items-center gap-4 rounded-xl border border-[#f3f4f6] bg-white px-4 py-3.5 shadow-sm transition-shadow hover:shadow-md">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg {{ $session->type === 'video' ? 'bg-[#fff7ed] text-[#e85d26]' : 'bg-[#f0f9ff] text-[#2563eb]' }}">
                                            @if ($session->type === 'video')
                                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.84A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.27l9.344-5.891a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                                            @else
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M12 12h.01M18.364 5.636a9 9 0 010 12.728"/></svg>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-[14px] font-semibold text-[#101828]">{{ $session->title }}</h4>
                                            <div class="mt-0.5 flex items-center gap-3 text-[12px] text-[#98a2b3]">
                                                <span>{{ ucfirst($session->type) }}</span>
                                                <span>·</span>
                                                <span>{{ $session->duration }}</span>
                                                <span>·</span>
                                                <span>{{ $session->year }}</span>
                                            </div>
                                        </div>
                                        <button class="flex h-9 items-center gap-1.5 rounded-lg bg-[#e85d26] px-4 text-[12px] font-semibold text-white transition-colors hover:bg-[#d14f1e]"
                                            onclick="window.location='{{ route('bible-school.resources.play', [$speaker->slug, $session->slug]) }}'">
                                            @if ($session->type === 'video')
                                                <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.84A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.27l9.344-5.891a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                                                Watch
                                            @else
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M12 12h.01M18.364 5.636a9 9 0 010 12.728"/></svg>
                                                Listen
                                            @endif
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
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
                                        <p class="text-[12px] text-[#98a2b3]">{{ $other->sessions()->active()->count() }} sessions</p>
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
function unlockFlow(firstName, speakerSlug) {
    return {
        step: 'email',       // 'email' | 'verify' | 'unlocked'
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
