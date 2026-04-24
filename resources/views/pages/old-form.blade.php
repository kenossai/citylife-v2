<section id="connect" class="relative overflow-hidden bg-[#16131c] py-16 lg:py-24">
        @if($ministry->image_path)
        <div class="absolute inset-0 opacity-10">
            <img src="{{ $ministry->image_path }}" alt="" class="h-full w-full object-cover">
        </div>
        @endif
        <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                {{-- Left: Info --}}
                <div>
                    <div class="mb-4 flex items-center gap-3">
                        <span class="h-px w-8 bg-[#e85d26]"></span>
                        <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">Get Involved</span>
                    </div>
                    <h2 class="text-[30px] font-extrabold leading-tight text-white sm:text-[40px]">
                        Ready To Join {{ $ministry->name }}?
                    </h2>
                    <p class="mt-4 text-[15px] leading-relaxed text-white/60">
                        We'd love to have you on the team! Fill in the form and one of our leaders will get in touch with you to help you get started.
                    </p>

                    <div class="mt-8 space-y-4">
                        @if ($ministry->meeting_schedule)
                            <div class="flex items-center gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/8">
                                    <svg class="h-5 w-5 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[12px] font-bold uppercase tracking-wider text-white/40">Schedule</p>
                                    <p class="text-sm text-white/80">{{ $ministry->meeting_schedule }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($ministry->location)
                            <div class="flex items-center gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/8">
                                    <svg class="h-5 w-5 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[12px] font-bold uppercase tracking-wider text-white/40">Location</p>
                                    <p class="text-sm text-white/80">{{ $ministry->location }}</p>
                                </div>
                            </div>
                        @endif
                        @if (count($displayLeaders))
                            <div class="flex items-center gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/8">
                                    <svg class="h-5 w-5 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[12px] font-bold uppercase tracking-wider text-white/40">{{ count($displayLeaders) === 1 ? 'Leader' : 'Leaders' }}</p>
                                    <p class="text-sm text-white/80">{{ collect($displayLeaders)->map(fn($l) => $l['name'] . ($l['role'] ? ' · ' . $l['role'] : ''))->join(', ') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Right: Form Card --}}
                <div class="rounded-2xl border border-white/10 bg-white/5 p-8 backdrop-blur-sm">
                    <h3 class="text-xl font-bold text-white">Connect With Us</h3>
                    <p class="mt-1 text-[13px] text-white/50">Fill in your details and we'll reach out to you.</p>

                    @if(session('connect_success'))
                    <div class="mt-4 rounded-lg bg-emerald-500/20 border border-emerald-500/30 px-4 py-3 text-sm font-medium text-emerald-300">
                        {{ session('connect_success') }}
                    </div>
                    @endif

                    <form class="mt-6 space-y-4" method="POST" action="{{ route('ministries.connect', $ministry->slug) }}">
                        @csrf
                        <div>
                            <label class="mb-1.5 block text-[12px] font-semibold uppercase tracking-wider text-white/60">Full Name</label>
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
                            <label class="mb-1.5 block text-[12px] font-semibold uppercase tracking-wider text-white/60">Email Address</label>
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
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
