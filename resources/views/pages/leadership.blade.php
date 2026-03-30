@extends('layouts.app')

@section('title', 'Our Leadership — City Life International')
@section('meta_description', 'Meet the leadership team of City Life International Church.')

@php
    // ──────────────────────────────────────────────────────────────
    //  Lead Pastors (featured with full bios)
    // ──────────────────────────────────────────────────────────────
    $leadPastors = [
        [
            'name'    => 'Bishop Robert Clarke',
            'role'    => 'Lead Pastor',
            'image'   => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&h=700&q=80',
            'bio'     => [
                'Bishop Robert Clarke is the founding Lead Pastor of City Life International Church. With over 30 years of ministry experience, he has planted churches across the UK, Europe and West Africa. A man of deep faith and conviction, he preaches the truth in God\'s Word with boldness and without any reservations.',
                'With a vision to "raise a victorious people," he has been on a mission to equip and train people through the word of faith into a life of 100% victory 100% of the time for 25 years and still counting.',
                'Bishop Clarke is not a man who just teaches, he lays emphasis on doing because that\'s the only way to get results. He is a man of faith with numerous results to show for it and he constantly and consistently, with joy, teaches Bible-based principles so that people can live victoriously.',
                'He plays tennis and football as a form of body exercise, watches movies when he can, rides a power bike because he loves to and travels round the world while still preaching the gospel on his trips.',
            ],
            'socials' => [
                'instagram' => '#',
                'twitter'   => '#',
                'youtube'   => '#',
                'facebook'  => '#',
            ],
        ],
        [
            'name'    => 'Pastor Grace Clarke',
            'role'    => 'Associate Lead Pastor',
            'image'   => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=600&h=700&q=80',
            'bio'     => [
                'Pastor Grace Clarke is fondly called \'Mama\' and the name is rightly placed as she is a mother to all, always seeking the best for her children (members of City Life and even beyond). Called to serve beside Bishop Clarke, her best friend, mentor, Pastor and husband, Pastor Grace gives a heart that understands, ears that listen and a mind that offers guidance and counsel to all.',
                'A deep and true lover of God which is one of the many qualities that attracted Bishop Clarke to her. Pastor Grace joyfully serves, giving her all to the ministry she\'s been called to.',
                'She is also the founder and convener of the Women of Purpose Conference which has attracted women in their thousands. It is a ministry centred on helping women maximise their full potentials and get them to a point where they can stand out in their various fields.',
                'She has an immense love for drama and appreciates dance but what she truly enjoys is writing. This has birthed a popular blog where she shares her thoughts and feelings on various issues but above all, inspires.',
            ],
            'socials' => [
                'instagram' => '#',
                'twitter'   => '#',
                'youtube'   => '#',
                'facebook'  => '#',
            ],
        ],
    ];

    // ──────────────────────────────────────────────────────────────
    //  Other Leaders (grid cards)
    // ──────────────────────────────────────────────────────────────
    $otherLeaders = [
        [
            'name'  => 'Pastor James Okafor',
            'role'  => 'Senior Pastor & Evangelist',
            'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=400&h=400&q=80',
        ],
        [
            'name'  => 'Pastor Michael Adisa',
            'role'  => 'Evangelism Director',
            'image' => 'https://images.unsplash.com/photo-1506277886164-e25aa3f4ef7f?auto=format&fit=crop&w=400&h=400&q=80',
        ],
        [
            'name'  => 'Pastor Wole Fayomi',
            'role'  => 'Resident Pastor Mainland Centre',
            'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&h=400&q=80',
        ],
        [
            'name'  => 'Pastor Eyewumi Ghereje',
            'role'  => 'Resident Pastor Island Centre',
            'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&h=400&q=80',
        ],
        [
            'name'  => 'Pastor Chikezie Oke',
            'role'  => 'Associate Resident Pastor Island Centre',
            'image' => 'https://images.unsplash.com/photo-1531384441138-2736e62e0919?auto=format&fit=crop&w=400&h=400&q=80',
        ],
        [
            'name'  => 'Pastor Shade Fayomi',
            'role'  => 'Preserved Generation',
            'image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=400&h=400&q=80',
        ],
        [
            'name'  => 'General Oluwamayowa Joseph Oji',
            'role'  => "David's Army",
            'image' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&h=400&q=80',
        ],
        [
            'name'  => 'Pastor Mark Akpaibor',
            'role'  => 'Transformed Nation',
            'image' => 'https://images.unsplash.com/photo-1463453091185-61582044d556?auto=format&fit=crop&w=400&h=400&q=80',
        ],
        [
            'name'  => 'Pastor Supo Arogundade',
            'role'  => 'Caleb Church',
            'image' => 'https://images.unsplash.com/photo-1548372290-8d01b6c8e78c?auto=format&fit=crop&w=400&h=400&q=80',
        ],
        [
            'name'  => 'Minister Femi Adelite',
            'role'  => 'Online Church',
            'image' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=400&h=400&q=80',
        ],
        [
            'name'  => 'Minister Wale',
            'role'  => 'Head of Workforce Island Centre',
            'image' => 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=400&h=400&q=80',
        ],
        [
            'name'  => 'Minister Kingsley Igboakolam',
            'role'  => 'Head of Workforce Mainland Centre',
            'image' => 'https://images.unsplash.com/photo-1507591064344-4c6ce005b128?auto=format&fit=crop&w=400&h=400&q=80',
        ],
        [
            'name'  => 'Pastor Ovie Agbani',
            'role'  => 'Music Director',
            'image' => 'https://images.unsplash.com/photo-1542178243-bc20204b769f?auto=format&fit=crop&w=400&h=400&q=80',
        ],
        [
            'name'  => 'Minister Blessing Jude-Okere',
            'role'  => 'Chief Operating Officer',
            'image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=400&h=400&q=80',
        ],
        [
            'name'  => 'Minister Abosede Samuel-Udene',
            'role'  => 'Ministry Manager',
            'image' => 'https://images.unsplash.com/photo-1589156280159-27698a70f29e?auto=format&fit=crop&w=400&h=400&q=80',
        ],
    ];
@endphp

@section('content')
<div class="bg-white text-[#101828]">

    {{-- ============================================================
         HERO
    ============================================================ --}}
    <section class="relative overflow-hidden pt-16">
        <div class="absolute inset-0">
            <img
                src="https://images.unsplash.com/photo-1504052434569-70ad5836ab65?auto=format&fit=crop&w=1800&q=80"
                alt=""
                class="h-full w-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-[#101828]/80 to-[#101828]/60"></div>
        </div>
        <div class="relative flex min-h-[220px] items-center justify-center text-center">
            <div>
                <p class="text-[13px] font-bold uppercase tracking-[0.15em] text-white/60">City Life International</p>
                <h1 class="mt-2 text-[40px] font-extrabold leading-tight text-white sm:text-[52px]">
                    Our <span class="italic text-[#e85d26]">Leadership</span>
                </h1>
            </div>
        </div>
    </section>

    {{-- ============================================================
         LEAD PASTORS — Featured sections
    ============================================================ --}}
    <section class="py-16 lg:py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 space-y-20">

            @foreach ($leadPastors as $index => $pastor)
                <div class="flex flex-col items-center gap-10 {{ $index % 2 === 0 ? 'lg:flex-row' : 'lg:flex-row-reverse' }}">

                    {{-- Photo --}}
                    <div class="w-full shrink-0 lg:w-[380px]">
                        <div class="overflow-hidden rounded-2xl bg-[#f3f4f6]">
                            <img
                                src="{{ $pastor['image'] }}"
                                alt="{{ $pastor['name'] }}"
                                class="h-[420px] w-full object-cover object-top"
                            >
                        </div>
                        {{-- Social Icons --}}
                        <div class="mt-4 flex items-center justify-center gap-3">
                            @if (!empty($pastor['socials']['instagram']))
                                <a href="{{ $pastor['socials']['instagram'] }}" class="flex h-9 w-9 items-center justify-center rounded-full border border-[#e5e7eb] text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]" aria-label="Instagram">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                </a>
                            @endif
                            @if (!empty($pastor['socials']['twitter']))
                                <a href="{{ $pastor['socials']['twitter'] }}" class="flex h-9 w-9 items-center justify-center rounded-full border border-[#e5e7eb] text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]" aria-label="X / Twitter">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                </a>
                            @endif
                            @if (!empty($pastor['socials']['youtube']))
                                <a href="{{ $pastor['socials']['youtube'] }}" class="flex h-9 w-9 items-center justify-center rounded-full border border-[#e5e7eb] text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]" aria-label="YouTube">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                </a>
                            @endif
                            @if (!empty($pastor['socials']['facebook']))
                                <a href="{{ $pastor['socials']['facebook'] }}" class="flex h-9 w-9 items-center justify-center rounded-full border border-[#e5e7eb] text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]" aria-label="Facebook">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Bio --}}
                    <div class="flex-1">
                        <h2 class="text-[28px] font-extrabold text-[#101828] sm:text-[32px]">{{ $pastor['name'] }}</h2>
                        <p class="mt-1 text-[13px] font-bold uppercase tracking-[0.1em] text-[#98a2b3]">{{ $pastor['role'] }}</p>

                        <div class="mt-6 space-y-4">
                            @foreach ($pastor['bio'] as $paragraph)
                                <p class="text-[14px] leading-[1.8] text-[#667085]">{{ $paragraph }}</p>
                            @endforeach
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </section>

    {{-- ============================================================
         OTHER LEADERS — Grid
    ============================================================ --}}
    <section class="border-t border-[#f3f4f6] bg-[#f9fafb] py-16 lg:py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-3 lg:grid-cols-4">
                @foreach ($otherLeaders as $leader)
                    <div class="text-center">
                        <div class="mx-auto h-[160px] w-[160px] overflow-hidden rounded-2xl bg-[#e5e7eb]">
                            <img
                                src="{{ $leader['image'] }}"
                                alt="{{ $leader['name'] }}"
                                class="h-full w-full object-cover object-center"
                            >
                        </div>
                        <h3 class="mt-4 text-[14px] font-bold text-[#101828]">{{ $leader['name'] }}</h3>
                        <p class="mt-0.5 text-[12px] font-semibold uppercase tracking-[0.04em] text-[#98a2b3]">{{ $leader['role'] }}</p>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

</div>
@endsection
