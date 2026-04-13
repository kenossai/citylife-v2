@extends('layouts.app')

@section('title', 'Bible School Speakers & Archives — City Life International')
@section('meta_description', 'Access powerful teaching sessions from our world-class faculty. Browse by speaker or filter by year.')

@push('head')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush

@section('content')
<div x-data="speakersPage()" class="bg-[#f9fafb] text-[#101828]">

    {{-- ============================================================
         HERO
    ============================================================ --}}
    <section class="relative overflow-hidden pt-16">
        <div class="absolute inset-0">
            <img
                src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1800&q=80"
                alt="Bible School Speakers & Archives"
                class="h-full w-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/60 to-black/80"></div>
        </div>

        <div class="relative mx-auto py-5 flex min-h-[340px] max-w-7xl flex-col items-center justify-center px-4 text-center sm:px-6 lg:px-8">
            <div class="inline-flex h-[30px] items-center rounded-full bg-[#e85d26] px-4 text-[11px] font-bold uppercase tracking-[0.12em] text-white">
                <svg class="mr-2 h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z"/></svg>
                Teaching Resources
            </div>

            <h1 class="mt-5 text-[40px] font-extrabold leading-[1.1] tracking-tight text-white sm:text-[52px]">
                Bible School Speakers<br>& Archives
            </h1>

            <p class="mx-auto mt-4 max-w-lg text-[15px] leading-relaxed text-white/60">
                Access powerful teaching sessions from our world-class faculty. Browse by speaker or filter by year — then unlock sessions with a single email.
            </p>

            {{-- Search --}}
            <div class="mt-8 py-5 w-full max-w-md">
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-[#98a2b3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input
                        x-model="search"
                        type="text"
                        placeholder="Search speakers or roles..."
                        class="h-[48px] w-full rounded-full border border-white/20 bg-white pl-12 pr-5 text-[14px] text-[#101828] placeholder-[#98a2b3] shadow-lg outline-none focus:ring-2 focus:ring-[#e85d26]/40"
                    >
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         MAIN CONTENT — Speakers Grid + Sidebar
    ============================================================ --}}
    <section class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-8 lg:flex-row">

                {{-- LEFT — Speakers --}}
                <div class="flex-1">
                    {{-- Stats bar --}}
                    <div class="mb-6 flex items-center justify-between text-[13px] text-[#667085]">
                        <span>Showing <strong class="text-[#101828]" x-text="filteredSpeakers.length"></strong> speakers</span>
                        <span class="flex items-center gap-1.5">
                            <svg class="h-4 w-4 text-[#98a2b3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <span x-text="totalSessions"></span> total sessions
                        </span>
                    </div>

                    {{-- Speakers grid --}}
                    <div class="grid gap-6 sm:grid-cols-2">
                        <template x-for="speaker in filteredSpeakers" :key="speaker.slug">
                            <div class="overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm transition-shadow hover:shadow-md">
                                {{-- Image --}}
                                <div class="relative aspect-[4/3] overflow-hidden">
                                    <img :src="speaker.image" :alt="speaker.name" class="h-full w-full object-cover object-top">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                                    {{-- Year badges --}}
                                    <div class="absolute left-3 top-3 flex gap-1.5">
                                        <template x-for="year in speaker.years" :key="year">
                                            <span class="inline-flex h-[26px] items-center rounded-md bg-[#101828]/80 px-2.5 text-[11px] font-bold text-white backdrop-blur-sm" x-text="year"></span>
                                        </template>
                                    </div>
                                    {{-- Lock icon (if locked) --}}
                                    <template x-if="speaker.locked">
                                        <span class="absolute right-3 top-3 flex h-[30px] w-[30px] items-center justify-center rounded-lg bg-[#e85d26] text-white shadow">
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                                        </span>
                                    </template>
                                </div>

                                {{-- Info --}}
                                <div class="px-4 pb-4 pt-3.5">
                                    <p class="text-[11px] font-bold uppercase tracking-[0.08em] text-[#e85d26]" x-text="speaker.role"></p>
                                    <a :href="'/bible-school/resources/' + speaker.slug">
                                        <h3 class="mt-1 text-[16px] font-bold text-[#101828]" x-text="speaker.name"></h3>
                                    </a>
                                    <p class="mt-0.5 text-[13px] text-[#667085]" x-text="speaker.church"></p>

                                    {{-- Media counts --}}
                                    <div class="mt-3 flex items-center gap-4 text-[12px] text-[#98a2b3]">
                                        <span class="flex items-center gap-1">
                                            <svg class="h-3.5 w-3.5 text-[#e85d26]" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.84A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.27l9.344-5.891a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                                            <span x-text="speaker.videos + ' Videos'"></span>
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="h-3.5 w-3.5 text-[#667085]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M12 12h.01M18.364 5.636a9 9 0 010 12.728M9.172 14.828L12 12m0 0l2.828-2.828"/></svg>
                                            <span x-text="speaker.audios + (speaker.audios === 1 ? ' Audio' : ' Audios')"></span>
                                        </span>
                                        <span class="ml-auto text-[12px] font-medium text-[#667085]">Sessions</span>
                                    </div>

                                    {{-- View Sessions button --}}
                                    <div class="mt-4 border-t border-[#f3f4f6] pt-3">
                                        <a :href="'/bible-school/resources/' + speaker.slug" class="flex items-center justify-between text-[13px] font-semibold text-[#101828] transition-colors hover:text-[#e85d26]">
                                            <span class="flex items-center gap-2">
                                                <svg class="h-4 w-4 text-[#e85d26]" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.84A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.27l9.344-5.891a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                                                View Sessions
                                            </span>
                                            <svg class="h-4 w-4 text-[#98a2b3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    {{-- Empty state --}}
                    <div x-show="filteredSpeakers.length === 0" x-cloak class="mt-8 rounded-2xl border border-[#f3f4f6] bg-white p-10 text-center">
                        <svg class="mx-auto h-12 w-12 text-[#d0d5dd]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <p class="mt-3 text-[15px] font-semibold text-[#101828]">No speakers found</p>
                        <p class="mt-1 text-[13px] text-[#667085]">Try adjusting your search or filter.</p>
                    </div>
                </div>

                {{-- RIGHT — Sidebar --}}
                <div class="w-full shrink-0 space-y-6 lg:w-[280px]">

                    {{-- Archive Widget --}}
                    <div class="overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm">
                        <div class="flex items-center gap-2 border-b border-[#f3f4f6] px-5 py-4">
                            <svg class="h-5 w-5 text-[#e85d26]" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"/><path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"/></svg>
                            <h3 class="text-[14px] font-bold text-[#101828]">ARCHIVE</h3>
                        </div>
                        <div class="p-4">
                            {{-- All Years --}}
                            <button
                                @click="activeYear = 'all'"
                                :class="activeYear === 'all' ? 'bg-[#e85d26] text-white' : 'bg-[#f9fafb] text-[#101828] hover:bg-[#f3f4f6]'"
                                class="flex w-full items-center justify-between rounded-lg px-4 py-2.5 text-[13px] font-semibold transition-colors"
                            >
                                <span>All Years</span>
                                <span
                                    :class="activeYear === 'all' ? 'bg-white/20 text-white' : 'bg-[#e85d26] text-white'"
                                    class="inline-flex h-[22px] min-w-[28px] items-center justify-center rounded-md px-1.5 text-[11px] font-bold"
                                    x-text="totalSessions"
                                ></span>
                            </button>

                            {{-- Year list --}}
                            <div class="mt-2 space-y-1">
                                <template x-for="year in years" :key="year.value">
                                    <button
                                        @click="activeYear = year.value"
                                        :class="activeYear === year.value ? 'bg-[#fff7ed] text-[#e85d26] font-semibold' : 'text-[#667085] hover:bg-[#f9fafb]'"
                                        class="flex w-full items-center justify-between rounded-lg px-4 py-2 text-[13px] transition-colors"
                                    >
                                        <span x-text="year.value"></span>
                                        <span class="text-[12px] text-[#98a2b3]" x-text="year.sessions + ' sessions'"></span>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>

                    {{-- Sessions Locked Card --}}
                    <div class="overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white p-5 shadow-sm">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#fff7ed] text-[#e85d26]">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                        </div>
                        <h3 class="mt-3 text-[15px] font-bold text-[#101828]">Sessions Are Locked</h3>
                        <p class="mt-1.5 text-[13px] leading-relaxed text-[#667085]">
                            Click any speaker to access their sessions. You'll need to verify your email to unlock all teaching materials — it takes less than a minute.
                        </p>
                        <ul class="mt-4 space-y-2">
                            <li class="flex items-center gap-2 text-[13px] text-[#667085]">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#e85d26]"></span>
                                Secure one-time code
                            </li>
                            <li class="flex items-center gap-2 text-[13px] text-[#667085]">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#16a34a]"></span>
                                Free to access
                            </li>
                            <li class="flex items-center gap-2 text-[13px] text-[#667085]">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#2563eb]"></span>
                                Instant delivery
                            </li>
                        </ul>
                    </div>

                    {{-- Back to Bible School --}}
                    <a href="{{ route('bible-school') }}" class="flex items-center justify-center gap-2 rounded-2xl border border-[#f3f4f6] bg-white px-5 py-3.5 text-[13px] font-semibold text-[#667085] shadow-sm transition-colors hover:text-[#e85d26]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Back to Bible School
                    </a>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection

@push('scripts')
<script>
function speakersPage() {
    return {
        search: '',
        activeYear: 'all',

        speakers: @json($speakers),
        years: @json($years),

        get totalSessions() {
            return this.years.reduce((sum, y) => sum + y.sessions, 0);
        },

        get filteredSpeakers() {
            let result = this.speakers;

            if (this.activeYear !== 'all') {
                result = result.filter(s => s.years.includes(this.activeYear));
            }

            if (this.search.trim()) {
                const q = this.search.toLowerCase();
                result = result.filter(s =>
                    s.name.toLowerCase().includes(q) ||
                    s.role.toLowerCase().includes(q)
                );
            }

            return result;
        },
    };
}
</script>
@endpush
