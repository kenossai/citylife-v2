@extends('layouts.app')

@section('title', 'Join ' . $ministry->name . ' — City Life International')
@section('meta_description', 'Get connected with ' . $ministry->name . ' at City Life International Church.')

@php
    try {
        $linkedLeaders = $ministry->leaders;
    } catch (\Exception $e) {
        $linkedLeaders = collect();
    }

    $displayLeaders = $linkedLeaders->isNotEmpty()
        ? $linkedLeaders->map(fn ($l) => ['name' => $l->name, 'role' => $l->role])->all()
        : ($ministry->leader_name ? [['name' => $ministry->leader_name, 'role' => $ministry->leader_role]] : []);
@endphp

@section('content')

{{-- ── Full-screen hero section with form ── --}}
<section class="relative min-h-screen bg-[#16131c] flex items-center py-20">

    {{-- Background image --}}
    @if($ministry->image_path)
    <div class="absolute inset-0">
        <img src="{{ $ministry->image_path }}" alt="{{ $ministry->name }}" class="h-full w-full object-cover object-center opacity-20">
        <div class="absolute inset-0 bg-gradient-to-r from-[#16131c] via-[#16131c]/90 to-[#16131c]/70"></div>
    </div>
    @endif

    <div class="relative mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8">
        {{-- Back link --}}
        <a
            href="{{ route('ministries.show', $ministry->slug) }}"
            class="mb-8 inline-flex items-center gap-2 text-sm text-white/50 hover:text-white transition-colors"
        >
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to {{ $ministry->name }}
        </a>

        <div class="grid gap-12 lg:grid-cols-2 lg:items-center">

            {{-- Left: Info --}}
            <div>
                <div class="mb-4 flex items-center gap-3">
                    <span class="h-px w-8 bg-[#e85d26]"></span>
                    <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">Get Involved</span>
                </div>

                <h1 class="text-[32px] font-extrabold leading-tight text-white sm:text-[44px]">
                    Ready To Join<br>{{ $ministry->name }}?
                </h1>

                <p class="mt-4 text-[15px] leading-relaxed text-white/60">
                    We'd love to have you on the team! Fill in the form and one of our leaders will get in touch with you to help you get started.
                </p>

                <div class="mt-8 space-y-4">
                    @if($ministry->meeting_schedule)
                    <div class="flex items-start gap-3">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#e85d26]/15">
                            <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/>
                            </svg>
                        </span>
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-widest text-white/40">Schedule</p>
                            <p class="text-sm text-white/80">{{ $ministry->meeting_schedule }}</p>
                        </div>
                    </div>
                    @endif

                    @if($ministry->location)
                    <div class="flex items-start gap-3">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#e85d26]/15">
                            <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </span>
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-widest text-white/40">Location</p>
                            <p class="text-sm text-white/80">{{ $ministry->location }}</p>
                        </div>
                    </div>
                    @endif

                    @if(count($displayLeaders) > 0)
                    <div class="flex items-start gap-3">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#e85d26]/15">
                            <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-widest text-white/40">{{ count($displayLeaders) > 1 ? 'Leaders' : 'Leader' }}</p>
                            <p class="text-sm text-white/80">
                                {{ collect($displayLeaders)->map(fn($l) => $l['name'] . ($l['role'] ? ' · ' . $l['role'] : ''))->join(', ') }}
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Right: Form Card --}}
            <div class="rounded-2xl border border-white/10 bg-white/5 p-8 backdrop-blur-sm">
                <h2 class="text-xl font-bold text-white">Connect With Us</h2>
                <p class="mt-1 text-[13px] text-white/50">Fill in your details and we'll reach out to you.</p>

                @if(session('connect_success'))
                <div class="mt-4 rounded-lg bg-emerald-500/20 border border-emerald-500/30 px-4 py-3 text-sm font-medium text-emerald-300">
                    {{ session('connect_success') }}
                </div>
                @endif

                <form class="mt-6 space-y-4" method="POST" action="{{ route('ministries.connect', $ministry->slug) }}">
                    @csrf
                    <div>
                        <label class="mb-1.5 block text-[12px] font-semibold uppercase tracking-wider text-white/60">Full Name <span class="text-[#e85d26]">*</span></label>
                        <input
                            type="text"
                            name="full_name"
                            value="{{ old('full_name') }}"
                            placeholder="Your full name"
                            class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-white/30 outline-none transition focus:border-[#e85d26] focus:ring-1 focus:ring-[#e85d26] @error('full_name') border-red-500/60 @enderror"
                        >
                        @error('full_name')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="mb-1.5 block text-[12px] font-semibold uppercase tracking-wider text-white/60">Email Address <span class="text-[#e85d26]">*</span></label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="your@email.com"
                            class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-white/30 outline-none transition focus:border-[#e85d26] focus:ring-1 focus:ring-[#e85d26] @error('email') border-red-500/60 @enderror"
                        >
                        @error('email')<p class="mt-1 text-xs text-red-400">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="mb-1.5 block text-[12px] font-semibold uppercase tracking-wider text-white/60">Phone Number</label>
                        <input
                            type="tel"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="+44 7000 000 000"
                            class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-white/30 outline-none transition focus:border-[#e85d26] focus:ring-1 focus:ring-[#e85d26]"
                        >
                    </div>

                    <div>
                        <label class="mb-1.5 block text-[12px] font-semibold uppercase tracking-wider text-white/60">Message</label>
                        <textarea
                            name="message"
                            rows="3"
                            placeholder="Tell us a bit about yourself…"
                            class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-white/30 outline-none transition focus:border-[#e85d26] focus:ring-1 focus:ring-[#e85d26]"
                        >{{ old('message') }}</textarea>
                    </div>

                    <button
                        type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-[#e85d26] to-[#ff8904] px-6 py-3.5 text-sm font-bold text-white shadow-lg transition-opacity hover:opacity-90"
                    >
                        Submit
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

@endsection
