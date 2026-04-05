@extends('layouts.app')

@section('title', 'Contact Us — City Life International')
@section('meta_description', 'Get in touch with City Life International Church in Sheffield. We would love to hear from you — whether you have a question, prayer request, or just want to connect.')

@php
    $enquiryTypes = [
        'general'      => 'General Enquiry',
        'prayer'       => 'Prayer Request',
        'volunteering' => 'Volunteering',
        'events'       => 'Events',
        'bible-school' => 'Bible School',
        'other'        => 'Other',
    ];

    $serviceTimes = [
        ['day' => 'Sunday', 'times' => ['9:00 AM - Adult Bible Study', '10:00 AM - Main Service']],
        ['day' => 'Thursday', 'times' => ['7:30 PM - Prayer Meeting']],
        // ['day' => 'Friday', 'times' => ['7:00 PM — Prayer Meeting']],
    ];
@endphp

@section('content')
<div class="bg-[#f7f3ee]">

{{-- ── HERO ───────────────────────────────────────────────────────────────── --}}
<section class="relative isolate overflow-hidden bg-[#120e11] pt-16">
    <div class="absolute inset-0">
        <img src="{{ asset('images/slide-1.png') }}" alt="City Life International" class="h-full w-full object-cover object-center opacity-30">
        <div class="absolute inset-0 bg-gradient-to-b from-[#120e11]/70 via-[#120e11]/60 to-[#120e11]"></div>
    </div>

    <div class="relative mx-auto flex min-h-[260px] max-w-7xl flex-col items-center justify-center px-4 py-16 text-center sm:min-h-[300px] sm:px-6 lg:px-8">
        <p class="mb-3 text-[11px] font-semibold uppercase tracking-[0.35em] text-[#e85d26]">City Life International</p>
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl">Contact Us</h1>
        <p class="mt-4 max-w-xl text-base text-white/60 sm:text-lg">We would love to hear from you. Reach out for any reason, We're here to help.</p>
        <nav class="mt-4 flex items-center gap-2 text-xs uppercase tracking-[0.24em] text-white/65">
            <a href="{{ url('/') }}" class="transition-colors hover:text-white">Home</a>
            <span>/</span>
            <span class="text-white">Contact</span>
        </nav>
    </div>
</section>

{{-- ── CONTACT CARDS ───────────────────────────────────────────────────────── --}}
{{-- <section class="relative z-10 -mt-12 pb-6 sm:-mt-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-4 sm:grid-cols-3">
            <div class="flex items-start gap-4 rounded-2xl bg-white px-6 py-6 shadow-[0_8px_40px_rgba(16,12,14,0.10)]">
                <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-[#e85d26]/10">
                    <svg class="h-5 w-5 text-[#e85d26]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[0.28em] text-[#e85d26]">Visit Us</p>
                    <p class="mt-1 text-sm font-semibold text-[#27242a]">City Life International Church</p>
                    <p class="mt-0.5 text-sm text-[#66615b]">1 South Parade Shalesmoor, Sheffield, S3 8SS</p>
                </div>
            </div>

            <div class="flex items-start gap-4 rounded-2xl bg-white px-6 py-6 shadow-[0_8px_40px_rgba(16,12,14,0.10)]">
                <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-[#e85d26]/10">
                    <svg class="h-5 w-5 text-[#e85d26]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[0.28em] text-[#e85d26]">Email Us</p>
                    <p class="mt-1 text-sm font-semibold text-[#27242a]">General Enquiries</p>
                    <a href="mailto:admin1@citylifecc.com" class="mt-0.5 block text-sm text-[#e85d26] hover:underline">admin1@citylifecc.com</a>
                </div>
            </div>

            <div class="flex items-start gap-4 rounded-2xl bg-white px-6 py-6 shadow-[0_8px_40px_rgba(16,12,14,0.10)]">
                <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-[#e85d26]/10">
                    <svg class="h-5 w-5 text-[#e85d26]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[0.28em] text-[#e85d26]">Service Times</p>
                    @foreach ($serviceTimes as $s)
                    <p class="mt-1 text-sm font-semibold text-[#27242a]">{{ $s['day'] }}</p>
                    @foreach ($s['times'] as $t)
                    <p class="text-xs text-[#66615b]">{{ $t }}</p>
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section> --}}

{{-- ── MAIN CONTENT: FORM + LOCATIONS ─────────────────────────────────────── --}}
<section class="py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-[1fr_420px]">

            {{-- ── CONTACT FORM ─────────────────────────────────────────── --}}
            <div class="rounded-[30px] bg-white px-7 py-8 shadow-[0_25px_80px_rgba(16,12,14,0.10)] sm:px-10 sm:py-10 lg:rounded-[34px]">
                <div class="mb-7">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="h-px w-10 bg-[#e85d26]"></span>
                        <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#e85d26]">Send a Message</p>
                    </div>
                    <h2 class="text-2xl font-extrabold text-[#27242a] sm:text-3xl">We'd Love to Hear From You</h2>
                    <p class="mt-2 text-sm text-[#66615b]">Fill in the form below and we'll get back to you as soon as possible.</p>
                </div>

                @if (session('success'))
                <div class="mb-6 flex items-start gap-3 rounded-xl bg-green-50 border border-green-200 p-4">
                    <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
                @endif

                @if ($errors->has('rate_limit'))
                <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4">
                    <p class="text-sm font-medium text-red-700">{{ $errors->first('rate_limit') }}</p>
                </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" novalidate>
                    @csrf

                    {{-- Honeypot: hidden from real users, bots will fill it --}}
                    <div style="display:none" aria-hidden="true">
                        <label for="website">Website</label>
                        <input type="text" name="website" id="website" value="" autocomplete="off" tabindex="-1">
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-[#66615b]">Full Name <span class="text-[#e85d26]">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Your full name"
                                class="w-full rounded-xl border border-[#e8e3de] bg-[#faf8f6] px-4 py-3 text-sm text-[#27242a] placeholder-[#b5b0aa] transition focus:border-[#e85d26] focus:outline-none focus:ring-1 focus:ring-[#e85d26] @error('name') border-red-400 @enderror">
                            @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-[#66615b]">Email Address <span class="text-[#e85d26]">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="your@email.com"
                                class="w-full rounded-xl border border-[#e8e3de] bg-[#faf8f6] px-4 py-3 text-sm text-[#27242a] placeholder-[#b5b0aa] transition focus:border-[#e85d26] focus:outline-none focus:ring-1 focus:ring-[#e85d26] @error('email') border-red-400 @enderror">
                            @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-[#66615b]">Phone Number</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+44 7700 000000"
                                class="w-full rounded-xl border border-[#e8e3de] bg-[#faf8f6] px-4 py-3 text-sm text-[#27242a] placeholder-[#b5b0aa] transition focus:border-[#e85d26] focus:outline-none focus:ring-1 focus:ring-[#e85d26] @error('phone') border-red-400 @enderror">
                            @error('phone')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-[#66615b]">Enquiry Type <span class="text-[#e85d26]">*</span></label>
                            <select name="enquiry_type"
                                class="w-full rounded-xl border border-[#e8e3de] bg-[#faf8f6] px-4 py-3 text-sm text-[#27242a] transition focus:border-[#e85d26] focus:outline-none focus:ring-1 focus:ring-[#e85d26] @error('enquiry_type') border-red-400 @enderror">
                                @foreach ($enquiryTypes as $value => $label)
                                <option value="{{ $value }}" {{ old('enquiry_type', 'general') === $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('enquiry_type')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-[#66615b]">Subject <span class="text-[#e85d26]">*</span></label>
                            <input type="text" name="subject" value="{{ old('subject') }}" placeholder="What's it about?"
                                class="w-full rounded-xl border border-[#e8e3de] bg-[#faf8f6] px-4 py-3 text-sm text-[#27242a] placeholder-[#b5b0aa] transition focus:border-[#e85d26] focus:outline-none focus:ring-1 focus:ring-[#e85d26] @error('subject') border-red-400 @enderror">
                            @error('subject')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-[#66615b]">Message <span class="text-[#e85d26]">*</span></label>
                            <textarea name="message" rows="5" placeholder="Write your message here..."
                                class="w-full resize-none rounded-xl border border-[#e8e3de] bg-[#faf8f6] px-4 py-3 text-sm text-[#27242a] placeholder-[#b5b0aa] transition focus:border-[#e85d26] focus:outline-none focus:ring-1 focus:ring-[#e85d26] @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
                            @error('message')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="mt-6 space-y-4">
                        {{-- Cloudflare Turnstile --}}
                        <div
                            class="cf-turnstile"
                            data-sitekey="{{ config('services.turnstile.site_key') }}"
                            data-theme="light"
                        ></div>
                        @error('cf-turnstile-response')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror

                        <button type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-[#18151a] px-8 py-3.5 text-sm font-semibold text-white transition-colors hover:bg-[#e85d26] sm:w-auto">
                            Send Message
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        </button>
                    </div>
                </form>
            </div>

            {{-- ── SIDEBAR: LOCATIONS + SOCIAL ─────────────────────────── --}}
            <div class="flex flex-col gap-6">

                {{-- Service & location cards from DB --}}
                @if ($locations->isNotEmpty())
                @foreach ($locations as $location)
                <div class="rounded-2xl bg-white px-6 py-6 shadow-[0_8px_40px_rgba(16,12,14,0.08)]">
                    @if ($location->label)
                    <p class="mb-2 text-[10px] font-bold uppercase tracking-[0.3em] text-[#e85d26]">{{ $location->label }}</p>
                    @endif
                    <h3 class="text-base font-bold text-[#27242a]">{{ $location->name }}</h3>

                    @if ($location->address)
                    <p class="mt-2 flex items-start gap-2 text-sm text-[#66615b]">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 text-[#e85d26]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $location->address }}{{ $location->landmark ? ' · ' . $location->landmark : '' }}
                    </p>
                    @endif

                    @if ($location->times)
                    <p class="mt-1.5 flex items-start gap-2 text-sm text-[#66615b]">
                        <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:admin1@citylifecc.com" class="mt-0.5 block text-sm text-[#e85d26] hover:underline">admin1@citylifecc.com</a>
                    </p>
                    @endif

                    @if ($location->phone)
                    <p class="mt-1.5 flex items-center gap-2 text-sm text-[#66615b]">
                        <svg class="h-4 w-4 flex-shrink-0 text-[#e85d26]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a href="tel:{{ $location->phone }}" class="hover:text-[#e85d26] transition-colors">{{ $location->phone }}</a>
                    </p>
                    @endif
                </div>
                @endforeach
                <div class="flex items-start gap-4 rounded-2xl bg-white px-6 py-6 shadow-[0_8px_40px_rgba(16,12,14,0.10)]">
                <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-[#e85d26]/10">
                    <svg class="h-5 w-5 text-[#e85d26]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[0.28em] text-[#e85d26]">Service Times</p>
                    @foreach ($serviceTimes as $s)
                    <p class="mt-1 text-sm font-semibold text-[#27242a]">{{ $s['day'] }}</p>
                    @foreach ($s['times'] as $t)
                    <p class="text-xs text-[#66615b]">{{ $t }}</p>
                    @endforeach
                    @endforeach
                </div>
            </div>
                @else
                {{-- Fallback location card --}}
                <div class="rounded-2xl bg-white px-6 py-6 shadow-[0_8px_40px_rgba(16,12,14,0.08)]">
                    <p class="mb-2 text-[10px] font-bold uppercase tracking-[0.3em] text-[#e85d26]">Sheffield</p>
                    <h3 class="text-base font-bold text-[#27242a]">City Life International Church</h3>
                    <p class="mt-2 flex items-start gap-2 text-sm text-[#66615b]">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 text-[#e85d26]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Sheffield, South Yorkshire, UK
                    </p>
                    <p class="mt-1.5 flex items-start gap-2 text-sm text-[#66615b]">
                        <svg class="mt-0.5 h-4 w-4 flex-shrink-0 text-[#e85d26]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Sun 9:00 AM &amp; 11:15 AM · Wed 7:00 PM · Fri 7:00 PM
                    </p>
                </div>
                @endif

                {{-- Social / Connect --}}
                <div class="rounded-2xl bg-[#18151a] px-6 py-6">
                    <p class="mb-3 text-[10px] font-bold uppercase tracking-[0.3em] text-[#e85d26]">Connect Online</p>
                    <h3 class="text-base font-bold text-white">Follow Our Socials</h3>
                    <p class="mt-1.5 text-sm text-white/60">Stay connected with City Life through our social media channels.</p>
                    <div class="mt-4 flex flex-wrap gap-3">
                        <a href="https://facebook.com" target="_blank" rel="noopener"
                            class="flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs font-semibold text-white transition hover:bg-[#e85d26]">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                            Facebook
                        </a>
                        <a href="https://instagram.com" target="_blank" rel="noopener"
                            class="flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs font-semibold text-white transition hover:bg-[#e85d26]">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            Instagram
                        </a>
                        <a href="https://youtube.com" target="_blank" rel="noopener"
                            class="flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs font-semibold text-white transition hover:bg-[#e85d26]">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            YouTube
                        </a>
                    </div>
                </div>

            </div>{{-- /sidebar --}}
        </div>
    </div>
</section>

{{-- ── PLAN YOUR VISIT ─────────────────────────────────────────────────────── --}}
<section class="pb-20 sm:pb-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-[30px] bg-[#18151a] lg:rounded-[34px]">
            <div class="grid lg:grid-cols-2">
                <div class="px-8 py-10 sm:px-12 sm:py-12">
                    <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#e85d26]">Plan Your Visit</p>
                    <h2 class="mt-3 text-2xl font-extrabold text-white sm:text-3xl">New Here? You're Welcome.</h2>
                    <p class="mt-3 text-sm leading-7 text-white/60">
                        Whether you're visiting for the first time or returning after a long while, we want your experience at City Life to be warm, welcoming, and life-giving. No dress code, no pressure - just come as you are.
                    </p>
                    <ul class="mt-6 space-y-3">
                        @foreach ([['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'text' => 'Friendly team to welcome you at the door'], ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => 'Sunday services at 9:00 AM and 11:15 AM'], ['icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'text' => 'Vibrant children and youth programmes']] as $item)
                        <li class="flex items-center gap-3 text-sm text-white/70">
                            <span class="flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-full bg-[#e85d26]/15">
                                <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/></svg>
                            </span>
                            {{ $item['text'] }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ url('/about-citylife') }}"
                        class="mt-8 inline-flex items-center gap-2 rounded-full bg-[#e85d26] px-7 py-3 text-sm font-semibold text-white transition-colors hover:bg-[#cf4e1e]">
                        Learn More About Us
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <div class="hidden overflow-hidden lg:block">
                    <img src="{{ asset('images/slide-1.png') }}" alt="City Life gathering" class="h-full w-full object-cover opacity-60">
                </div>
            </div>
        </div>
    </div>
</section>

</div>
@endsection

@push('scripts')
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
@endpush
