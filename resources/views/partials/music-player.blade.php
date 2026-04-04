<div
    x-data="musicPlayer({{ $music->autoplay ? 'true' : 'false' }})"
    x-init="init()"
    x-show="visible"
    x-cloak
    style="display:none"
    class="fixed bottom-0 left-0 right-0 z-50 flex items-center gap-3 bg-[#18151a]/95 px-4 py-3 shadow-2xl backdrop-blur-sm sm:bottom-4 sm:left-4 sm:right-auto sm:rounded-2xl sm:px-5"
>
    {{-- Album thumb / waveform icon --}}
    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#e85d26]/20">
        <svg class="h-5 w-5 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
        </svg>
    </div>

    {{-- Track info --}}
    <div class="min-w-0 flex-1 sm:w-44">
        <p class="truncate text-[13px] font-semibold text-white">{{ $music->title }}</p>
        @if ($music->artist)
            <p class="truncate text-[11px] text-white/50">{{ $music->artist }}</p>
        @endif
    </div>

    {{-- Controls --}}
    <div class="flex items-center gap-2">
        {{-- Click-to-start prompt (shown before first interaction) --}}
        <button
            x-show="needsInteraction"
            @click="start()"
            class="flex items-center gap-1.5 rounded-lg bg-[#e85d26] px-3 py-1.5 text-[11px] font-bold text-white">
            <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.84A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.27l9.344-5.891a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
            Play
        </button>

        {{-- Play / Pause --}}
        <button
            x-show="!needsInteraction"
            @click="togglePlay()"
            class="flex h-8 w-8 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20">
            <svg x-show="!playing" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.84A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.27l9.344-5.891a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
            <svg x-show="playing" x-cloak class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm4-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
        </button>

        {{-- Mute / Unmute --}}
        <button
            x-show="!needsInteraction"
            @click="toggleMute()"
            class="flex h-8 w-8 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20">
            <svg x-show="!muted" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.536 8.464a5 5 0 010 7.072M12 6.253v13m0-13L6.586 9H4a1 1 0 00-1 1v4a1 1 0 001 1h2.586L12 18.747"/></svg>
            <svg x-show="muted" x-cloak class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" clip-rule="evenodd"/><path stroke-linecap="round" stroke-linejoin="round" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"/></svg>
        </button>
    </div>

    {{-- Dismiss --}}
    <button
        @click="visible = false; audio.pause()"
        class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full text-white/30 transition hover:text-white/70">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>

    {{-- Hidden audio element --}}
    <audio
        x-ref="audio"
        src="{{ $music->url }}"
        loop
        preload="none"
    ></audio>
</div>

@push('scripts')
<script>
function musicPlayer(autoplay) {
    return {
        visible: true,
        playing: false,
        muted: false,
        needsInteraction: true,
        audio: null,

        init() {
            this.audio = this.$refs.audio;

            this.audio.addEventListener('play',  () => this.playing = true);
            this.audio.addEventListener('pause', () => this.playing = false);

            if (autoplay) {
                // Try silent autoplay — browsers allow muted autoplay
                this.audio.muted = true;
                this.muted = true;
                this.audio.play().then(() => {
                    this.needsInteraction = false;
                    this.playing = true;
                }).catch(() => {
                    // Blocked — show the "Play" button prompt
                    this.needsInteraction = true;
                });
            }
        },

        start() {
            this.audio.muted = false;
            this.muted = false;
            this.audio.play().then(() => {
                this.needsInteraction = false;
                this.playing = true;
            });
        },

        togglePlay() {
            if (this.audio.paused) {
                this.audio.play();
            } else {
                this.audio.pause();
            }
        },

        toggleMute() {
            this.audio.muted = !this.audio.muted;
            this.muted = this.audio.muted;
        },
    };
}
</script>
@endpush
