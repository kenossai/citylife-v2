@extends('layouts.app')

@section('title', 'Give — City Life International')
@section('meta_description', 'Your generosity fuels the mission of City Life International Church — locally in Sheffield and globally across 14 nations.')

@section('content')

{{-- ============================================================
     HERO
============================================================ --}}
<section class="relative min-h-[120vh] flex items-center bg-[#0f0f0f] overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/slide-1.png') }}" alt="Give" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 w-full">
        <div class="max-w-xl">
            <span class="inline-flex items-center gap-2 bg-[#e85d26]/20 border border-[#e85d26]/40 text-[#e85d26] text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full mb-5">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
                Generosity
            </span>
            <h1 class="text-white text-5xl sm:text-6xl font-extrabold leading-tight mb-6">
                Give &amp;<br>
                <span class="text-[#e85d26]">Change Lives</span>
            </h1>
            <p class="text-gray-300 text-base sm:text-lg leading-relaxed mb-8 max-w-md">
                Your generosity fuels the mission of City Life International Church, reaching people locally in Sheffield and globally across 14 nations. Every gift, large or small, makes an eternal difference.
            </p>
            <div class="flex flex-wrap gap-3 text-sm text-gray-400">
                <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-[#e85d26]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg> 100% Secure</span>
                <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-[#e85d26]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Easy Recurring</span>
                <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-[#e85d26]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Gift Aid Ready</span>
            </div>
        </div>
    </div>

    {{-- Gift Aid Declaration card --}}
    <div class="hidden lg:block absolute right-8 xl:right-20 top-1/2 -translate-y-1/2 z-20 w-[440px] bg-[#1a1a1a] border border-white/10 rounded-2xl shadow-2xl text-white overflow-hidden">
        <div class="p-8 overflow-y-auto max-h-[calc(100vh+8rem)]">

            <div class="flex items-center gap-2 mb-5">
                <div class="w-8 h-8 bg-[#e85d26] rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold">Gift Aid Declaration</p>
                    <p class="text-xs text-gray-400">UK taxpayers only</p>
                </div>
            </div>

            @if(session('gift_aid_success'))
            <div class="mb-4 bg-green-500/10 border border-green-500/30 rounded-xl p-3 text-xs text-green-400">
                Declaration submitted successfully. Thank you!
            </div>
            @endif

            <form method="POST" action="{{ route('give.gift-aid') }}" novalidate>
                @csrf

                <div class="grid grid-cols-2 gap-2 mb-2">
                    <div>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name *"
                               class="w-full bg-white/10 border border-white/10 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-[#e85d26] @error('first_name') border-red-500 @enderror">
                        @error('first_name')<p class="text-red-400 text-[10px] mt-0.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name *"
                               class="w-full bg-white/10 border border-white/10 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-[#e85d26] @error('last_name') border-red-500 @enderror">
                        @error('last_name')<p class="text-red-400 text-[10px] mt-0.5">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2 mb-2">
                    <div>
                        <input type="text" name="address" value="{{ old('address') }}" placeholder="Address *"
                               class="w-full bg-white/10 border border-white/10 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-[#e85d26] @error('address') border-red-500 @enderror">
                        @error('address')<p class="text-red-400 text-[10px] mt-0.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <input type="text" name="postcode" value="{{ old('postcode') }}" placeholder="Postcode *"
                               class="w-full bg-white/10 border border-white/10 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-[#e85d26] @error('postcode') border-red-500 @enderror">
                        @error('postcode')<p class="text-red-400 text-[10px] mt-0.5">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2 mb-2">
                    <div>
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Phone Number *"
                               class="w-full bg-white/10 border border-white/10 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-[#e85d26] @error('phone') border-red-500 @enderror">
                        @error('phone')<p class="text-red-400 text-[10px] mt-0.5">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address *"
                               class="w-full bg-white/10 border border-white/10 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-[#e85d26] @error('email') border-red-500 @enderror">
                        @error('email')<p class="text-red-400 text-[10px] mt-0.5">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mb-0.5">
                    <input type="text" name="gift_aid_code" value="{{ old('gift_aid_code') }}" placeholder="Your Gift Aid Code *"
                           class="w-full bg-white/10 border border-white/10 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-[#e85d26] @error('gift_aid_code') border-red-500 @enderror">
                    @error('gift_aid_code')<p class="text-red-400 text-[10px] mt-0.5">{{ $message }}</p>@enderror
                </div>
                <p class="text-[10px] text-gray-500 mb-2">e.g., JS-tithe, AB-offering, CD-missions</p>

                <div class="mb-0.5">
                    <input type="date" name="declaration_date" value="{{ old('declaration_date') }}"
                           class="w-full bg-white/10 border border-white/10 rounded-lg px-3 py-2 text-sm text-gray-400 focus:outline-none focus:border-[#e85d26] [color-scheme:dark] @error('declaration_date') border-red-500 @enderror">
                    @error('declaration_date')<p class="text-red-400 text-[10px] mt-0.5">{{ $message }}</p>@enderror
                </div>
                <p class="text-[10px] text-gray-500 mb-3">Declaration Date</p>

                <div class="mb-4">
                    <label class="flex items-start gap-2.5 cursor-pointer">
                        <input type="checkbox" name="confirmed" value="1"
                               class="mt-0.5 w-4 h-4 rounded border-white/20 bg-white/10 text-[#e85d26] focus:ring-0 flex-shrink-0 @error('confirmed') border-red-500 @enderror">
                        <span class="text-[11px] text-gray-400 leading-relaxed">
                            I confirm I have paid or will pay Income Tax and/or Capital Gains Tax at least equal to the tax CityLife International will reclaim on my gifts.
                        </span>
                    </label>
                    @error('confirmed')<p class="text-red-400 text-[10px] mt-0.5">{{ $message }}</p>@enderror
                </div>

                <button type="submit"
                        class="w-full bg-[#e85d26] hover:bg-[#cf4f1e] text-white font-bold py-3 rounded-xl text-sm transition-colors">
                    Submit Declaration →
                </button>
            </form>
        </div>
    </div>
</section>

{{-- ============================================================
     WHY WE GIVE
============================================================ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Left image --}}
            <div class="relative">
                <div class="rounded-2xl overflow-hidden shadow-xl">
                    <img src="{{ asset('images/slide-1.png') }}" alt="Worship" class="w-full h-80 object-cover">
                </div>
                <div class="absolute bottom-4 left-4 right-4 bg-white/90 backdrop-blur rounded-xl px-5 py-4 shadow-lg">
                    <p class="text-[13px] italic text-gray-600 leading-relaxed">
                        "Each of you should give what you have decided in your heart to give, not reluctantly or under compulsion, for God loves a cheerful giver."
                    </p>
                    <p class="mt-2 text-xs font-bold text-[#e85d26] uppercase tracking-widest">2 Corinthians 9:7</p>
                </div>
            </div>

            {{-- Right content --}}
            <div>
                <p class="text-[#e85d26] text-xs font-bold uppercase tracking-widest mb-3">Why We Give</p>
                <h2 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight mb-6">
                    Giving Is an Act<br>of Worship
                </h2>
                <p class="text-gray-500 leading-relaxed mb-6">
                    At City Life, we believe that generosity is more than a financial transaction. It is an act of faith, trust and worship. When we give, we declare that God is our source, our provider and the owner of everything we have.
                </p>
                <p class="text-gray-500 leading-relaxed mb-8">
                    Your tithes and offerings are the foundation of everything this church does, from the morning service to the missions field and from the food bank to the Bible School. Nothing we do as a church is possible without the faithful generosity of this community.
                </p>

                <div class="grid grid-cols-2 gap-4">
                    @php
                        $ways = [
                            ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => '#e85d26', 'title' => 'Tithe (10%)', 'desc' => 'A faithful return to God of what is already His'],
                            ['icon' => 'M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7', 'color' => '#3b82f6', 'title' => 'Offering', 'desc' => 'A gift above your tithe, given freely out of love'],

                            ['icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064', 'color' => '#10b981', 'title' => 'Missions', 'desc' => 'Funding gospel advance across 14 nations worldwide'],
                            ['icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'color' => '#8b5cf6', 'title' => 'Building Fund', 'desc' => 'Investing in spaces for the next generation'],
                        ];
                    @endphp
                    @foreach($ways as $way)
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50 border border-gray-100">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $way['color'] }}1a">
                            <svg class="w-5 h-5" style="color: {{ $way['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $way['icon'] }}"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">{{ $way['title'] }}</p>
                            <p class="text-xs text-gray-500 mt-0.5 leading-relaxed">{{ $way['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     OTHER WAYS TO GIVE
============================================================ --}}
<section class="py-20 bg-[#111111]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <p class="text-[#e85d26] text-xs font-bold uppercase tracking-widest mb-3">Other Methods</p>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white">Other Ways to Give</h2>
            <p class="mt-3 text-gray-400 max-w-lg mx-auto text-sm">Can't give online? We make it easy to give in whichever way works best for you.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Give Online (SumUp) --}}
            <div class="bg-[#e85d26]/10 border border-[#e85d26]/30 rounded-2xl p-7 text-white flex flex-col">
                <div class="w-12 h-12 bg-[#e85d26]/20 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-[#e85d26]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Give Online</h3>
                <p class="text-sm text-gray-400 mb-6 flex-1">The fastest way to give. Secure card payments processed instantly via SumUp.</p>
                <a href="https://pay.sumup.com/b2c/Q5WMU9IP"
                   target="_blank" rel="noopener noreferrer"
                   class="w-full bg-[#e85d26] hover:bg-[#cf4f1e] text-white font-bold py-2.5 rounded-xl text-sm transition-colors text-center">
                    Give via Card →
                </a>
            </div>

            {{-- PayPal --}}
            <div class="bg-white/5 border border-white/10 rounded-2xl p-7 text-white flex flex-col">
                <div class="w-12 h-12 bg-[#003087]/30 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-[#009cde]" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7.076 21.337H2.47a.641.641 0 01-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 00-.607-.541c-.013.076-.026.175-.041.254-.93 4.778-4.005 7.201-9.138 7.201h-2.19a.563.563 0 00-.556.479l-1.187 7.527h-.506l-.24 1.516a.56.56 0 00.554.647h3.882c.46 0 .85-.334.922-.788.06-.26.76-4.852.816-5.09a.932.932 0 01.923-.788h.58c3.76 0 6.705-1.528 7.565-5.946.36-1.847.174-3.388-.777-4.471z"/></svg>
                </div>
                <h3 class="text-lg font-bold mb-2">PayPal</h3>
                <p class="text-sm text-gray-400 mb-6 flex-1">Prefer PayPal? Give securely using your PayPal account or any debit or credit card.</p>
                <a href="https://www.paypal.com/donate/?hosted_button_id=4KEE89F86PPQG"
                   target="_blank" rel="noopener noreferrer"
                   class="w-full bg-[#003087] hover:bg-[#00266a] text-white font-bold py-2.5 rounded-xl text-sm transition-colors text-center">
                    Donate via PayPal →
                </a>
            </div>

            {{-- Bank Transfer --}}
            <div class="bg-white/5 border border-white/10 rounded-2xl p-7 text-white">
                <div class="w-12 h-12 bg-[#e85d26]/20 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-[#e85d26]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                </div>
                <h3 class="text-lg font-bold mb-4">Bank Transfer</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between border-b border-white/10 pb-2">
                        <span class="text-gray-400">Bank</span>
                        <span class="font-semibold">Virgin Money</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-2">
                        <span class="text-gray-400">Account Name</span>
                        <span class="font-semibold text-right">City Life International Church</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-2">
                        <span class="text-gray-400">Sort Code</span>
                        <span class="font-semibold">05-08-48</span>
                    </div>
                    <div class="flex justify-between border-b border-white/10 pb-2">
                        <span class="text-gray-400">Account No.</span>
                        <span class="font-semibold">20057965</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Reference</span>
                        <span class="font-semibold">Your Name + Fund</span>
                    </div>
                </div>
            </div>

            {{-- In-Person --}}
            <div class="bg-white/5 border border-white/10 rounded-2xl p-7 text-white">
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold mb-4">In-Person</h3>
                <p class="text-sm text-gray-400 mb-4">Giving envelopes and card payment terminals are available at every Sunday Service. Our team is always on hand to help.</p>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-sm">
                        <span class="w-2 h-2 rounded-full bg-[#e85d26] flex-shrink-0"></span>
                        <div>
                            <p class="font-semibold">Morning Service</p>
                            <p class="text-gray-400 text-xs">Sunday, 11:00 AM</p>
                        </div>
                    </div>
                    {{-- <div class="flex items-center gap-3 text-sm">
                        <span class="w-2 h-2 rounded-full bg-yellow-400 flex-shrink-0"></span>
                        <div>
                            <p class="font-semibold">Midday Service</p>
                            <p class="text-gray-400 text-xs">Sunday, 1:00 PM</p>
                        </div>
                    </div> --}}
                    <div class="border-t border-white/10 pt-3 space-y-1 text-xs text-gray-400">
                        <p>📞 0114 272 8243</p>
                        <p>✉ admin1@citylifecc.com</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     YOUR IMPACT
============================================================ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <p class="text-[#e85d26] text-xs font-bold uppercase tracking-widest mb-3">Your Impact</p>
                <h2 class="text-4xl font-extrabold text-gray-900 leading-tight mb-5">
                    Real Lives Changed<br>by Your Generosity
                </h2>
                <p class="text-gray-500 leading-relaxed mb-5">
                    Last year alone, your giving helped us feed over 10,000 people through our food bank, send teams to 6 nations, equip 200 Bible School students, and plant 3 new churches. This is what generosity looks like when a community pulls together.
                </p>
                <p class="text-gray-500 leading-relaxed mb-8">
                    Every £10 given provides a family with a week's worth of food parcels. Every £50 sponsors a Bible School student for a month. Every £200 funds a short-term missions team member. Your giving matters more than you know.
                </p>


            </div>

            <div class="relative rounded-2xl overflow-hidden shadow-xl h-80 lg:h-[420px]">
                <img src="{{ asset('images/slide-1.png') }}" alt="Impact" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     FAQ
============================================================ --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-[#e85d26] text-xs font-bold uppercase tracking-widest mb-3">FAQs</p>
            <h2 class="text-3xl font-extrabold text-gray-900">Giving Questions</h2>
        </div>

        @php
            $faqs = [
                ['q' => 'Is my giving tax-efficient?', 'a' => 'Yes! If you are a UK taxpayer, we can claim Gift Aid on your donation, boosting it by 25% at no extra cost to you. Simply tick the Gift Aid option when giving online or complete a Gift Aid declaration form at our welcome desk.'],
                ['q' => 'Can I set up a recurring gift?', 'a' => 'Absolutely. When giving online, select "Monthly" or "Weekly" frequency. You can also set up a standing order directly from your bank using our bank details above.'],
                ['q' => 'Is my payment information secure?', 'a' => 'All online transactions are processed through secure, PCI-compliant payment gateways. We never store your full card details on our servers.'],
                ['q' => 'Can I give to a specific fund?', 'a' => 'Yes. When giving online, select your preferred fund (Tithe, Offering, Missions, or Building Fund) from the dropdown. For bank transfers, simply include the fund name in your reference.'],
                ['q' => 'How do I give by bank transfer?', 'a' => 'Use the bank details listed above. Bank: Virgin Money, Sort Code: 05-08-48, Account No: 20057965, Account Name: City Life International Church. Please use your name and the fund as the reference.'],
                ['q' => 'How do I give by cheque?', 'a' => 'Make your cheque payable to "City Life International Church" and post it to 1 South Parade Shalesmoor, Sheffield, S3 8SS. Please include a note with your name and the fund you\'re giving to.'],
            ];
        @endphp

        <div class="space-y-3" x-data="{ open: null }">
            @foreach($faqs as $i => $faq)
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <button @click="open = open === {{ $i }} ? null : {{ $i }}"
                        class="w-full flex items-center justify-between px-6 py-4 text-left text-sm font-semibold text-gray-900 hover:bg-gray-50 transition-colors">
                    <span>{{ $faq['q'] }}</span>
                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0 transition-transform duration-200"
                         :class="open === {{ $i }} ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open === {{ $i }}"
                     x-transition:enter="transition-all ease-out duration-200"
                     x-transition:enter-start="opacity-0 max-h-0"
                     x-transition:enter-end="opacity-100 max-h-96"
                     x-transition:leave="transition-all ease-in duration-150"
                     x-transition:leave-start="opacity-100 max-h-96"
                     x-transition:leave-end="opacity-0 max-h-0"
                     class="px-6 pb-4 text-sm text-gray-500 leading-relaxed">
                    {{ $faq['a'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================
     CTA BANNER
============================================================ --}}
<section class="bg-[#e85d26] py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">Ready to Make a Difference?</h2>
        <p class="text-white/80 mb-8 max-w-xl mx-auto">Every gift, no matter the size, joins a movement of generosity that is changing lives locally and globally.</p>
        <a href="#" onclick="window.scrollTo({top:0,behavior:'smooth'})" class="inline-flex items-center gap-2 bg-white text-[#e85d26] font-bold px-8 py-3.5 rounded-full text-sm hover:bg-gray-100 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
            Give Now
        </a>
    </div>
</section>

@endsection
