@extends('layouts.app')

@section('title', 'Our Ministries — City Life International')
@section('meta_description', 'Explore the ministries at City Life International Church. Find your place to belong and grow.')

@php
    $fallbackMinistries = collect([
        (object) [
            'name'             => 'Youth Ministry',
            'subtitle'         => 'Ages 13 – 25',
            'description'      => 'Youth Ministry at City Life is a dynamic, Spirit-filled community where young people aged 13–25 can encounter God, find genuine friendships, and grow in their faith through worship, the Word, and real-life mentoring.',
            'image_path'       => 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=600&h=400&q=80',
            'icon_svg_path'    => 'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z',
            'icon_bg_class'    => 'bg-yellow-400',
            'icon_text_class'  => 'text-white',
            'category_label'   => 'Youth',
            'category_color'   => 'bg-red-500',
            'meeting_schedule' => 'Fridays · 7:00 PM',
            'leader_name'      => 'Ps. Daniel Wright',
            'button_gradient'  => 'from-red-500 to-orange-400',
            'link_url'         => '#',
        ],
        (object) [
            'name'             => 'Kids Church',
            'subtitle'         => 'Ages 0 – 12',
            'description'      => 'Kids Church is a fun, safe and faith-filled environment where children aged 0–12 encounter God\'s love every Sunday. Our fully trained team uses creative lessons, worship, games and crafts to teach biblical truths.',
            'image_path'       => 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?auto=format&fit=crop&w=600&h=400&q=80',
            'icon_svg_path'    => 'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z',
            'icon_bg_class'    => 'bg-rose-500',
            'icon_text_class'  => 'text-white',
            'category_label'   => 'Kids',
            'category_color'   => 'bg-pink-500',
            'meeting_schedule' => 'Sundays · During Both Services',
            'leader_name'      => 'Mrs. Grace Thompson',
            'button_gradient'  => 'from-pink-500 to-rose-400',
            'link_url'         => '#',
        ],
        (object) [
            'name'             => 'Women of Destiny',
            'subtitle'         => "Women's Ministry",
            'description'      => 'Women of Destiny is a vibrant community of women of all ages and backgrounds who gather monthly to pray, worship, hear the Word, and encourage one another to walk boldly in their God-given purpose.',
            'image_path'       => 'https://images.unsplash.com/photo-1529070538774-1843cb3265df?auto=format&fit=crop&w=600&h=400&q=80',
            'icon_svg_path'    => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z',
            'icon_bg_class'    => 'bg-purple-500',
            'icon_text_class'  => 'text-white',
            'category_label'   => 'Women',
            'category_color'   => 'bg-purple-500',
            'meeting_schedule' => 'Saturdays · 10:00 AM (Monthly)',
            'leader_name'      => 'Pastor Mrs. Okafor',
            'button_gradient'  => 'from-purple-500 to-violet-400',
            'link_url'         => '#',
        ],
        (object) [
            'name'             => 'Men of Valour',
            'subtitle'         => "Men's Ministry",
            'description'      => "Men of Valour is a brotherhood built on the foundation of God's Word, genuine friendship and a commitment to becoming the men God has called us to be — in our homes, workplaces and communities.",
            'image_path'       => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=600&h=400&q=80',
            'icon_svg_path'    => 'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25',
            'icon_bg_class'    => 'bg-blue-600',
            'icon_text_class'  => 'text-white',
            'category_label'   => 'Men',
            'category_color'   => 'bg-blue-600',
            'meeting_schedule' => 'Saturdays · 8:00 AM (Monthly)',
            'leader_name'      => 'Ps. Michael Adisa',
            'button_gradient'  => 'from-blue-600 to-blue-400',
            'link_url'         => '#',
        ],
        (object) [
            'name'             => 'Worship & Arts',
            'subtitle'         => 'Creative Ministry',
            'description'      => 'Worship & Arts is the creative heartbeat of City Life International Church. Our team of over 60 musicians, singers, dancers, graphic designers and creatives use their gifts to glorify God and enhance every service.',
            'image_path'       => 'https://images.unsplash.com/photo-1507838153414-b4b713384a76?auto=format&fit=crop&w=600&h=400&q=80',
            'icon_svg_path'    => 'M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z',
            'icon_bg_class'    => 'bg-pink-500',
            'icon_text_class'  => 'text-white',
            'category_label'   => 'Arts',
            'category_color'   => 'bg-pink-500',
            'meeting_schedule' => 'Thursdays · 7:00 PM (Rehearsals)',
            'leader_name'      => 'Samuel Akin',
            'button_gradient'  => 'from-pink-500 to-red-400',
            'link_url'         => '#',
        ],
        (object) [
            'name'             => 'Community Outreach',
            'subtitle'         => 'Serve the City',
            'description'      => "Community Outreach is how City Life demonstrates the love of Christ in tangible ways across Sheffield. Our programmes include food drives, clothing donations, hospital visits, prison ministry and more.",
            'image_path'       => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?auto=format&fit=crop&w=600&h=400&q=80',
            'icon_svg_path'    => 'M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 003 12c0-1.605.42-3.113 1.157-4.418',
            'icon_bg_class'    => 'bg-teal-500',
            'icon_text_class'  => 'text-white',
            'category_label'   => 'Outreach',
            'category_color'   => 'bg-teal-500',
            'meeting_schedule' => 'Various Days — Sign Up to Serve',
            'leader_name'      => 'Ps. James Okafor',
            'button_gradient'  => 'from-teal-500 to-emerald-400',
            'link_url'         => '#',
        ],
    ]);

    $items = $ministries->isEmpty() ? $fallbackMinistries : $ministries;
@endphp

@section('content')
<div class="bg-white text-[#101828]">

    {{-- ============================================================
         HERO
    ============================================================ --}}
    <section class="relative overflow-hidden pt-16">
        <div class="absolute inset-0">
            <img
                src="https://images.unsplash.com/photo-1438232992991-995b7058bbb3?auto=format&fit=crop&w=1800&q=80"
                alt=""
                class="h-full w-full object-cover"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-[#101828]/80 to-[#101828]/60"></div>
        </div>
        <div class="relative flex min-h-[220px] flex-col items-center justify-center text-center">
            {{-- Badge --}}
            <div class="mb-3 inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 backdrop-blur-sm">
                <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-15.75 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                </svg>
                <span class="text-[12px] font-bold uppercase tracking-[0.15em] text-[#e85d26]">Our Ministries</span>
            </div>

            <h1 class="text-[40px] font-extrabold leading-tight text-white sm:text-[52px]">Ministries</h1>

            {{-- Breadcrumb --}}
            <div class="mt-3 flex items-center gap-2 text-[13px] text-white/60">
                <a href="{{ route('home') }}" class="flex items-center gap-1 transition-colors hover:text-white">
                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z"/></svg>
                    Home
                </a>
                <span>&gt;</span>
                <span class="text-white">Ministries</span>
            </div>
        </div>
    </section>

    {{-- ============================================================
         INTRO
    ============================================================ --}}
    <section class="py-14 lg:py-20">
        <div class="mx-auto max-w-3xl px-4 text-center sm:px-6 lg:px-8">
            {{-- Decorative line + label --}}
            <div class="mb-4 flex items-center justify-center gap-3">
                <span class="h-px w-8 bg-[#e85d26]"></span>
                <span class="text-[12px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">A Place For Everyone</span>
                <span class="h-px w-8 bg-[#e85d26]"></span>
            </div>
            <h2 class="text-[30px] font-extrabold leading-tight text-[#101828] sm:text-[40px]">
                Find Your Place To Belong &amp; Grow
            </h2>
            <p class="mt-5 text-[15px] leading-relaxed text-[#667085]">
                At City Life International Church, we believe every person has a gift, a calling and a place to belong. Our
                ministries exist to help you discover who you are in Christ, connect with others, and make a difference
                in your community and the world.
            </p>
        </div>
    </section>

    {{-- ============================================================
         MINISTRY CARDS GRID
    ============================================================ --}}
    <section class="pb-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

                @foreach ($items as $ministry)
                    <div class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-md transition-shadow hover:shadow-lg">

                        {{-- Card Image --}}
                        <div class="relative h-[200px] overflow-hidden">
                            <img
                                src="{{ $ministry->image_path }}"
                                alt="{{ $ministry->name }}"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                            {{-- Icon badge (top-left) --}}
                            <div class="absolute left-3 top-3 flex h-10 w-10 items-center justify-center rounded-full {{ $ministry->icon_bg_class }}">
                                <svg class="h-5 w-5 {{ $ministry->icon_text_class }}" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $ministry->icon_svg_path }}"/>
                                </svg>
                            </div>

                            {{-- Category tag (top-right) --}}
                            @if ($ministry->category_label)
                                <span class="absolute right-3 top-3 rounded-full {{ $ministry->category_color }} px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-white">
                                    {{ $ministry->category_label }}
                                </span>
                            @endif

                            {{-- Title overlay --}}
                            <div class="absolute bottom-3 left-4 right-4">
                                <h3 class="text-[18px] font-extrabold leading-tight text-white">{{ $ministry->name }}</h3>
                                @if ($ministry->subtitle)
                                    <p class="mt-0.5 text-[12px] font-medium text-white/70">{{ $ministry->subtitle }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- Card Body --}}
                        <div class="flex flex-1 flex-col px-5 pb-5 pt-4">
                            <p class="text-[13px] leading-relaxed text-[#667085] line-clamp-3">
                                {{ $ministry->description }}
                            </p>

                            {{-- Meets & Leader --}}
                            <div class="mt-4 space-y-1.5 border-t border-[#f3f4f6] pt-4 text-[12px]">
                                @if ($ministry->meeting_schedule)
                                    <div class="flex items-start gap-2">
                                        <span class="font-bold text-[#101828]">Meets:</span>
                                        <span class="text-[#667085]">{{ $ministry->meeting_schedule }}</span>
                                    </div>
                                @endif
                                @if ($ministry->leader_name)
                                    <div class="flex items-start gap-2">
                                        <span class="font-bold text-[#101828]">Leader:</span>
                                        <span class="text-[#667085]">{{ $ministry->leader_name }}</span>
                                    </div>
                                @endif
                            </div>

                            {{-- CTA Button --}}
                            <div class="mt-5">
                                <a
                                    href="{{ $ministry->link_url ?: '#' }}"
                                    class="flex w-full items-center justify-center gap-2 rounded-lg bg-gradient-to-r {{ $ministry->button_gradient ?? 'from-[#e85d26] to-[#ff8904]' }} px-5 py-2.5 text-[13px] font-bold text-white transition-opacity hover:opacity-90"
                                >
                                    Learn More
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </section>

</div>
@endsection
