@extends('layouts.app')

@section('title', ($ministry->name ?? 'Worship & Arts') . ' Ministry — City Life International')
@section('meta_description', \Illuminate\Support\Str::limit($ministry->description ?? '', 150))

@php
    // ── Fallback Ministries (keyed by slug) ────────────────────────
    $fallbackMinistries = [
        'youth-ministry' => (object) [
            'name'             => 'Youth Ministry',
            'slug'             => 'youth-ministry',
            'subtitle'         => 'Ages 13 – 25',
            'description'      => 'Youth Ministry at City Life is a dynamic, Spirit-filled community where young people aged 13–25 can encounter God, find genuine friendships, and grow in their faith through worship, the Word, and real-life mentoring.',
            'about_text'       => "Youth Ministry at City Life International is a dynamic, Spirit-filled community where young people aged 13–25 can encounter God, find genuine friendships, and grow in their faith.\n\nOur weekly gatherings are designed to be relevant, engaging and Christ-centred. Through powerful worship, interactive Bible teaching, small group discussions and social events, we create an environment where young people can ask real questions, discover their identity in Christ and develop as future leaders.\n\nWhether you've grown up in church or you're exploring faith for the first time, Youth Ministry is a place where you can belong, be yourself and be inspired to live boldly for God.",
            'vision_quote'     => 'To raise up a generation of young people who are passionately in love with Jesus and equipped to impact their world.',
            'image_path'       => 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=1800&q=80',
            'gallery_images'   => [
                'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1506869640319-fe1a24fd76cb?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1529070538774-1843cb3265df?auto=format&fit=crop&w=600&h=400&q=80',
            ],
            'tags'             => ['Youth', 'Teens', 'Young Adults', 'Fellowship'],
            'category_label'   => 'Youth',
            'category_color'   => 'bg-red-500',
            'meeting_schedule' => 'Fridays · 7:00 PM',
            'location'         => 'Youth Hall, City Life Centre',
            'leader_name'      => 'Ps. Daniel Wright',
            'leader_role'      => 'Youth Pastor',
            'leader_image'     => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&h=200&q=80',
            'button_gradient'  => 'from-red-500 to-orange-400',
        ],
        'kids-church' => (object) [
            'name'             => 'Kids Church',
            'slug'             => 'kids-church',
            'subtitle'         => 'Ages 0 – 12',
            'description'      => 'Kids Church is a fun, safe and faith-filled environment where children aged 0–12 encounter God\'s love every Sunday. Our fully trained team uses creative lessons, worship, games and crafts to teach biblical truths.',
            'about_text'       => "Kids Church at City Life International is a vibrant, fun and faith-filled environment designed to help children aged 0–12 encounter the love of God and grow in their understanding of His Word.\n\nEvery Sunday, our fully trained and DBS-checked team delivers age-appropriate lessons through creative storytelling, worship, games, crafts and interactive activities. We believe that every child matters to God, and we're passionate about creating a safe space where they can learn, laugh and discover the biblical foundations that will shape their lives.\n\nFrom toddlers to pre-teens, every age group has a specially tailored experience that makes church the highlight of their week.",
            'vision_quote'     => 'To plant the seeds of faith in every child and raise a generation that knows, loves and follows Jesus from an early age.',
            'image_path'       => 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?auto=format&fit=crop&w=1800&q=80',
            'gallery_images'   => [
                'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1544776193-352d25ca82cd?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1587654780339-e0c6cce4c227?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1472162072942-cd5147eb3902?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1516627145497-ae6968895b40?auto=format&fit=crop&w=600&h=400&q=80',
            ],
            'tags'             => ['Kids', 'Sunday School', 'Family', 'Children'],
            'category_label'   => 'Kids',
            'category_color'   => 'bg-pink-500',
            'meeting_schedule' => 'Sundays · During Both Services',
            'location'         => 'Kids Hall, City Life Centre',
            'leader_name'      => 'Mrs. Grace Thompson',
            'leader_role'      => 'Children\'s Pastor',
            'leader_image'     => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=200&h=200&q=80',
            'button_gradient'  => 'from-pink-500 to-rose-400',
        ],
        'women-of-destiny' => (object) [
            'name'             => 'Women of Destiny',
            'slug'             => 'women-of-destiny',
            'subtitle'         => "Women's Ministry",
            'description'      => 'Women of Destiny is a vibrant community of women of all ages and backgrounds who gather monthly to pray, worship, hear the Word, and encourage one another to walk boldly in their God-given purpose.',
            'about_text'       => "Women of Destiny is a vibrant community of women of all ages and backgrounds who gather monthly to pray, worship, hear the Word and encourage one another to walk boldly in their God-given purpose.\n\nOur gatherings are designed to be a refreshing space where women can be real, be vulnerable and be empowered. Through powerful teaching, mentoring relationships, prayer and fellowship, we help women discover their identity in Christ, develop their gifts and step into the destiny God has prepared for them.\n\nFrom monthly meetings to annual retreats and special events, Women of Destiny is a sisterhood where every woman is valued, supported and championed.",
            'vision_quote'     => 'To empower women to discover their God-given identity and walk boldly in the destiny He has prepared for them.',
            'image_path'       => 'https://images.unsplash.com/photo-1529070538774-1843cb3265df?auto=format&fit=crop&w=1800&q=80',
            'gallery_images'   => [
                'https://images.unsplash.com/photo-1529070538774-1843cb3265df?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1524250502761-1ac6f2e30d43?auto=format&fit=crop&w=600&h=400&q=80',
            ],
            'tags'             => ['Women', 'Sisterhood', 'Prayer', 'Empowerment'],
            'category_label'   => 'Women',
            'category_color'   => 'bg-purple-500',
            'meeting_schedule' => 'Saturdays · 10:00 AM (Monthly)',
            'location'         => 'Main Auditorium, City Life Centre',
            'leader_name'      => 'Pastor Mrs. Okafor',
            'leader_role'      => 'Women\'s Ministry Leader',
            'leader_image'     => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=200&h=200&q=80',
            'button_gradient'  => 'from-purple-500 to-violet-400',
        ],
        'men-of-valour' => (object) [
            'name'             => 'Men of Valour',
            'slug'             => 'men-of-valour',
            'subtitle'         => "Men's Ministry",
            'description'      => "Men of Valour is a brotherhood built on the foundation of God's Word, genuine friendship and a commitment to becoming the men God has called us to be — in our homes, workplaces and communities.",
            'about_text'       => "Men of Valour is a brotherhood built on the foundation of God's Word, genuine friendship and a commitment to becoming the men God has called us to be.\n\nOur monthly gatherings feature powerful worship, relevant biblical teaching and honest conversation about the real challenges men face — from leadership in the home to integrity in the workplace. We also run mentoring programmes, outreach projects and annual retreats that build lasting bonds and strengthen character.\n\nWhether you're a new believer or a seasoned man of faith, Men of Valour is a place where iron sharpens iron and every man is equipped to lead with courage, humility and purpose.",
            'vision_quote'     => 'To raise godly men who lead with courage, serve with humility and live with integrity in every area of life.',
            'image_path'       => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1800&q=80',
            'gallery_images'   => [
                'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1506869640319-fe1a24fd76cb?auto=format&fit=crop&w=600&h=400&q=80',
            ],
            'tags'             => ['Men', 'Brotherhood', 'Leadership', 'Mentoring'],
            'category_label'   => 'Men',
            'category_color'   => 'bg-blue-600',
            'meeting_schedule' => 'Saturdays · 8:00 AM (Monthly)',
            'location'         => 'Fellowship Hall, City Life Centre',
            'leader_name'      => 'Ps. Michael Adisa',
            'leader_role'      => 'Men\'s Ministry Leader',
            'leader_image'     => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=200&h=200&q=80',
            'button_gradient'  => 'from-blue-600 to-blue-400',
        ],
        'worship-and-arts' => (object) [
            'name'             => 'Worship & Arts',
            'slug'             => 'worship-and-arts',
            'subtitle'         => 'Creative Ministry',
            'description'      => 'Worship & Arts is the creative heartbeat of City Life International Church. Our team of over 60 musicians, singers, dancers, graphic designers and creatives use their gifts to glorify God and enhance every service.',
            'about_text'       => "Worship & Arts is the creative heartbeat of City Life International Church. Our ministry brings together over 60 gifted musicians, singers, dancers, graphic designers, media technicians and creatives who use their God-given talents to glorify God and create powerful worship experiences every Sunday and throughout the week.\n\nWe believe worship is more than music — it's a lifestyle. Whether through a soaring vocal, an intricate dance piece, a stunning graphic or a perfectly mixed sound, every expression of creativity is an offering to God. Our team is committed to excellence, spiritual growth and unity as we serve the body of Christ together.\n\nFrom weekly rehearsals to special productions, conferences and outreach events, Worship & Arts provides a platform for creatives at every level to develop their skills, grow in their faith and make an eternal impact through the arts.",
            'vision_quote'     => 'We exist to create an atmosphere where people can encounter the presence of God through authentic, Spirit-led worship and creative arts that glorify Him.',
            'image_path'       => 'https://images.unsplash.com/photo-1507838153414-b4b713384a76?auto=format&fit=crop&w=1800&q=80',
            'gallery_images'   => [
                'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1507838153414-b4b713384a76?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?auto=format&fit=crop&w=600&h=400&q=80',
            ],
            'tags'             => ['Arts', 'Live Worship', 'Dance', 'Music'],
            'category_label'   => 'Arts',
            'category_color'   => 'bg-pink-500',
            'meeting_schedule' => 'Thursdays · 7:00 PM (Rehearsals)',
            'location'         => 'Main Auditorium, City Life Centre',
            'leader_name'      => 'Samuel Akin',
            'leader_role'      => 'Worship Director',
            'leader_image'     => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&h=200&q=80',
            'button_gradient'  => 'from-pink-500 to-red-400',
        ],
        'community-outreach' => (object) [
            'name'             => 'Community Outreach',
            'slug'             => 'community-outreach',
            'subtitle'         => 'Serve the City',
            'description'      => 'Community Outreach is how City Life demonstrates the love of Christ in tangible ways across Sheffield. Our programmes include food drives, clothing donations, hospital visits, prison ministry and more.',
            'about_text'       => "Community Outreach is how City Life International demonstrates the love of Christ in tangible ways across Sheffield and beyond. We believe that faith without works is dead, and our outreach team is committed to being the hands and feet of Jesus in our city.\n\nOur programmes include regular food drives, clothing donations, hospital visits, prison ministry, street evangelism and partnership with local charities. Whether it's feeding the hungry, visiting the sick or comforting the broken-hearted, we're passionate about showing God's love through practical action.\n\nEvery member of City Life is encouraged to get involved. There's a place for you — whether you have an hour a week or a whole Saturday to give. Together, we're making a difference one life at a time.",
            'vision_quote'     => 'To be the hands and feet of Jesus in our city, demonstrating the love of God through practical action and compassionate service.',
            'image_path'       => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?auto=format&fit=crop&w=1800&q=80',
            'gallery_images'   => [
                'https://images.unsplash.com/photo-1559027615-cd4628902d4a?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=600&h=400&q=80',
                'https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&w=600&h=400&q=80',
            ],
            'tags'             => ['Outreach', 'Serving', 'Community', 'Missions'],
            'category_label'   => 'Outreach',
            'category_color'   => 'bg-teal-500',
            'meeting_schedule' => 'Various Days — Sign Up to Serve',
            'location'         => 'City Life Centre & Community',
            'leader_name'      => 'Ps. James Okafor',
            'leader_role'      => 'Outreach Director',
            'leader_image'     => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=200&h=200&q=80',
            'button_gradient'  => 'from-teal-500 to-emerald-400',
        ],
    ];

    // Resolve the current slug
    $currentSlug = $ministry->slug ?? ($slug ?? '');

    // Pick the right fallback, or default to Worship & Arts
    $fallback = $fallbackMinistries[$currentSlug] ?? $fallbackMinistries['worship-and-arts'];

    // Use DB ministry or fallback
    $m = $ministry ?? $fallback;
    $name             = $m->name ?? $fallback->name;
    $subtitle         = $m->subtitle ?? $fallback->subtitle;
    $description      = $m->description ?? $fallback->description;
    $aboutText        = $m->about_text ?? $fallback->about_text;
    $visionQuote      = $m->vision_quote ?? $fallback->vision_quote;
    $heroImage        = $m->image_path ?? $fallback->image_path;
    $galleryImages    = $m->gallery_images ?? $fallback->gallery_images;
    $tags             = $m->tags ?? $fallback->tags;
    $meetingSchedule  = $m->meeting_schedule ?? $fallback->meeting_schedule;
    $location         = $m->location ?? $fallback->location;
    $leaderName       = $m->leader_name ?? $fallback->leader_name;
    $leaderRole       = $m->leader_role ?? $fallback->leader_role;
    $leaderImage      = $m->leader_image ?? $fallback->leader_image;
    $gradient         = $m->button_gradient ?? $fallback->button_gradient;

    $aboutParagraphs  = array_filter(explode("\n\n", $aboutText));

    // ── Fallback Other Ministries (exclude current) ──────────────
    $fallbackOthers = collect($fallbackMinistries)
        ->filter(fn($item) => $item->slug !== $currentSlug)
        ->take(3)
        ->values();

    $others = isset($otherMinistries) && $otherMinistries->isNotEmpty() ? $otherMinistries : $fallbackOthers;

    // ── Fallback Upcoming Events ───────────────────────────────────
    $upcomingEvents = [
        [
            'title'    => 'Worship Night of Praise',
            'date'     => 'Friday, February 14, 2025',
            'time'     => '7:00 PM – 9:30 PM',
            'location' => 'Main Auditorium',
            'icon'     => 'M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z',
        ],
        [
            'title'    => 'Dance & Arts Workshop',
            'date'     => 'Saturday, February 22, 2025',
            'time'     => '10:00 AM – 2:00 PM',
            'location' => 'Fellowship Hall',
            'icon'     => 'M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z',
        ],
        [
            'title'    => 'Creative Team Retreat',
            'date'     => 'March 7 – 8, 2025',
            'time'     => 'All Day',
            'location' => 'Off-site Venue',
            'icon'     => 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5',
        ],
    ];

    // ── Fallback Leaders ───────────────────────────────────────────
    $ministryLeaders = [
        [
            'name'  => 'Samuel Akin',
            'role'  => 'Worship Director',
            'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&h=200&q=80',
            'bio'   => 'Samuel has been leading worship for over a decade, passionate about creating spaces where people encounter God.',
        ],
        [
            'name'  => 'Grace Okonkwo',
            'role'  => 'Dance Coordinator',
            'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=200&h=200&q=80',
            'bio'   => 'Grace leads the dance ministry with excellence, training dancers to express worship through movement.',
        ],
        [
            'name'  => 'David Emmanuel',
            'role'  => 'Music Director',
            'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=200&h=200&q=80',
            'bio'   => 'David oversees all musical arrangements and instrumentalists, ensuring every note serves the worship experience.',
        ],
    ];
@endphp

@section('content')
<div class="bg-white text-[#101828]">

    {{-- ================================================================
         HERO
    ================================================================ --}}
    <section class="relative isolate overflow-hidden bg-[#16131c] pt-16">
        <div class="absolute inset-0">
            <img
                src="{{ $heroImage }}"
                alt="{{ $name }}"
                class="h-full w-full object-cover object-center opacity-30"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-[#16131c]/80 via-[#16131c]/75 to-[#16131c]"></div>
        </div>

        <div class="relative mx-auto max-w-6xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-[11px] uppercase tracking-[0.24em] text-white/58">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <a href="{{ route('ministries') }}" class="transition-colors hover:text-white">Ministries</a>
                <span>/</span>
                <span class="text-white">{{ $name }}</span>
            </nav>

            <div class="mt-8 grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-end">
                <div>
                    {{-- Tags --}}
                    @if (!empty($tags))
                        <div class="flex flex-wrap gap-2">
                            @foreach ($tags as $tag)
                                <span class="rounded-full border border-white/14 bg-white/8 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.24em] text-white">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    {{-- Title & Subtitle --}}
                    <h1 class="mt-5 text-4xl font-extrabold tracking-tight text-white sm:text-5xl">{{ $name }}</h1>
                    @if ($subtitle)
                        <p class="mt-2 text-base font-medium text-[#e85d26]">{{ $subtitle }}</p>
                    @endif

                    <p class="mt-4 max-w-2xl text-sm leading-7 text-white/72 sm:text-[15px]">
                        {{ $description }}
                    </p>

                    {{-- Quick Info Pills --}}
                    <div class="mt-7 flex flex-wrap gap-3 text-sm text-white/84">
                        @if ($meetingSchedule)
                            <span class="inline-flex items-center gap-2 rounded-full border border-white/12 bg-white/8 px-4 py-2">
                                <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $meetingSchedule }}
                            </span>
                        @endif
                        @if ($location)
                            <span class="inline-flex items-center gap-2 rounded-full border border-white/12 bg-white/8 px-4 py-2">
                                <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                {{ $location }}
                            </span>
                        @endif
                        @if ($leaderName)
                            <span class="inline-flex items-center gap-2 rounded-full border border-white/12 bg-white/8 px-4 py-2">
                                <svg class="h-4 w-4 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                {{ $leaderName }}
                            </span>
                        @endif
                    </div>

                    {{-- CTA Button --}}
                    <div class="mt-8">
                        <a
                            href="#connect"
                            class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r {{ $gradient }} px-7 py-3.5 text-sm font-bold text-white shadow-lg transition-opacity hover:opacity-90"
                        >
                            Connect Now
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Hero Image Card --}}
                <div class="overflow-hidden rounded-[28px] border border-white/10 bg-white/6 shadow-[0_24px_70px_rgba(0,0,0,0.22)]">
                    <img
                        src="{{ $heroImage }}"
                        alt="{{ $name }}"
                        class="h-[280px] w-full object-cover sm:h-[320px]"
                    >
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================================
         WHO WE ARE — About Section
    ================================================================ --}}
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-start">
                {{-- Left: Text --}}
                <div>
                    <div class="mb-4 flex items-center gap-3">
                        <span class="h-px w-8 bg-[#e85d26]"></span>
                        <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">Who We Are</span>
                    </div>
                    <h2 class="text-[30px] font-extrabold leading-tight text-[#101828] sm:text-[38px]">
                        About {{ $name }}
                    </h2>

                    <div class="mt-6 space-y-4 text-[15px] leading-relaxed text-[#667085]">
                        @foreach ($aboutParagraphs as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>

                {{-- Right: Vision Quote Card --}}
                @if ($visionQuote)
                    <div class="rounded-2xl border-l-4 border-[#e85d26] bg-gradient-to-br from-[#fff7f3] to-[#fff1eb] p-8 shadow-sm">
                        <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-full bg-[#e85d26]/10">
                            <svg class="h-5 w-5 text-[#e85d26]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151C7.563 6.068 6 8.789 6 11h4.017v10H0z"/>
                            </svg>
                        </div>
                        <p class="text-[16px] font-semibold leading-relaxed text-[#101828]">
                            "{{ $visionQuote }}"
                        </p>
                        <div class="mt-5 flex items-center gap-3">
                            <span class="h-px w-6 bg-[#e85d26]"></span>
                            <span class="text-[12px] font-bold uppercase tracking-[0.12em] text-[#e85d26]">Our Vision</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ================================================================
         GALLERY — Life In Worship
    ================================================================ --}}
    @if (!empty($galleryImages))
        <section class="bg-[#f9fafb] py-16 lg:py-24">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="mb-10 text-center">
                    <div class="mb-4 flex items-center justify-center gap-3">
                        <span class="h-px w-8 bg-[#e85d26]"></span>
                        <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">Gallery</span>
                        <span class="h-px w-8 bg-[#e85d26]"></span>
                    </div>
                    <h2 class="text-[30px] font-extrabold leading-tight text-[#101828] sm:text-[38px]">
                        Life In {{ $name }}
                    </h2>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($galleryImages as $image)
                        <div class="group overflow-hidden rounded-2xl">
                            <img
                                src="{{ $image }}"
                                alt="{{ $name }} gallery"
                                class="h-[220px] w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ================================================================
         UPCOMING EVENTS
    ================================================================ --}}
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center">
                <div class="mb-4 flex items-center justify-center gap-3">
                    <span class="h-px w-8 bg-[#e85d26]"></span>
                    <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">Stay Connected</span>
                    <span class="h-px w-8 bg-[#e85d26]"></span>
                </div>
                <h2 class="text-[30px] font-extrabold leading-tight text-[#101828] sm:text-[38px]">
                    Upcoming Events
                </h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($upcomingEvents as $event)
                    <div class="rounded-2xl border border-[#f3f4f6] bg-white p-6 shadow-sm transition-shadow hover:shadow-md">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-[#e85d26]/10">
                            <svg class="h-5 w-5 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $event['icon'] }}"/>
                            </svg>
                        </div>
                        <h3 class="text-[16px] font-bold text-[#101828]">{{ $event['title'] }}</h3>
                        <div class="mt-3 space-y-1.5 text-[13px] text-[#667085]">
                            <div class="flex items-center gap-2">
                                <svg class="h-3.5 w-3.5 text-[#98a2b3]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                {{ $event['date'] }}
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="h-3.5 w-3.5 text-[#98a2b3]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $event['time'] }}
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="h-3.5 w-3.5 text-[#98a2b3]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                {{ $event['location'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================================================================
         MEET THE LEADERS
    ================================================================ --}}
    <section class="bg-[#f9fafb] py-16 lg:py-24">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center">
                <div class="mb-4 flex items-center justify-center gap-3">
                    <span class="h-px w-8 bg-[#e85d26]"></span>
                    <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">Our Team</span>
                    <span class="h-px w-8 bg-[#e85d26]"></span>
                </div>
                <h2 class="text-[30px] font-extrabold leading-tight text-[#101828] sm:text-[38px]">
                    Meet The Leaders
                </h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($ministryLeaders as $leader)
                    <div class="rounded-2xl border border-[#f3f4f6] bg-white p-6 text-center shadow-sm">
                        <img
                            src="{{ $leader['image'] }}"
                            alt="{{ $leader['name'] }}"
                            class="mx-auto h-24 w-24 rounded-full object-cover ring-4 ring-[#e85d26]/10"
                        >
                        <h3 class="mt-4 text-[16px] font-bold text-[#101828]">{{ $leader['name'] }}</h3>
                        <p class="mt-1 text-[13px] font-medium text-[#e85d26]">{{ $leader['role'] }}</p>
                        <p class="mt-3 text-[13px] leading-relaxed text-[#667085]">{{ $leader['bio'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================================================================
         READY TO JOIN — Connect Form
    ================================================================ --}}
    <section id="connect" class="relative overflow-hidden bg-[#16131c] py-16 lg:py-24">
        <div class="absolute inset-0 opacity-10">
            <img src="{{ $heroImage }}" alt="" class="h-full w-full object-cover">
        </div>
        <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                {{-- Left: Info --}}
                <div>
                    <div class="mb-4 flex items-center gap-3">
                        <span class="h-px w-8 bg-[#e85d26]"></span>
                        <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">Get Involved</span>
                    </div>
                    <h2 class="text-[30px] font-extrabold leading-tight text-white sm:text-[40px]">
                        Ready To Join {{ $name }}?
                    </h2>
                    <p class="mt-4 text-[15px] leading-relaxed text-white/60">
                        We'd love to have you on the team! Fill in the form and one of our leaders will get in touch with you to help you get started.
                    </p>

                    <div class="mt-8 space-y-4">
                        @if ($meetingSchedule)
                            <div class="flex items-center gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/8">
                                    <svg class="h-5 w-5 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[12px] font-bold uppercase tracking-wider text-white/40">Schedule</p>
                                    <p class="text-sm text-white/80">{{ $meetingSchedule }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($location)
                            <div class="flex items-center gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/8">
                                    <svg class="h-5 w-5 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[12px] font-bold uppercase tracking-wider text-white/40">Location</p>
                                    <p class="text-sm text-white/80">{{ $location }}</p>
                                </div>
                            </div>
                        @endif
                        @if ($leaderName)
                            <div class="flex items-center gap-4">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/8">
                                    <svg class="h-5 w-5 text-[#e85d26]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[12px] font-bold uppercase tracking-wider text-white/40">Leader</p>
                                    <p class="text-sm text-white/80">{{ $leaderName }}@if ($leaderRole) · {{ $leaderRole }}@endif</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Right: Form Card --}}
                <div class="rounded-2xl border border-white/10 bg-white/5 p-8 backdrop-blur-sm">
                    <h3 class="text-xl font-bold text-white">Connect With Us</h3>
                    <p class="mt-1 text-[13px] text-white/50">Fill in your details and we'll reach out to you.</p>

                    <form class="mt-6 space-y-4" onsubmit="return false;">
                        <div>
                            <label class="mb-1.5 block text-[12px] font-semibold uppercase tracking-wider text-white/60">Full Name</label>
                            <input
                                type="text"
                                placeholder="Your full name"
                                class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-white/30 outline-none transition focus:border-[#e85d26] focus:ring-1 focus:ring-[#e85d26]"
                            >
                        </div>
                        <div>
                            <label class="mb-1.5 block text-[12px] font-semibold uppercase tracking-wider text-white/60">Email Address</label>
                            <input
                                type="email"
                                placeholder="your@email.com"
                                class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-white/30 outline-none transition focus:border-[#e85d26] focus:ring-1 focus:ring-[#e85d26]"
                            >
                        </div>
                        <div>
                            <label class="mb-1.5 block text-[12px] font-semibold uppercase tracking-wider text-white/60">Phone Number</label>
                            <input
                                type="tel"
                                placeholder="+44 7000 000 000"
                                class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-white/30 outline-none transition focus:border-[#e85d26] focus:ring-1 focus:ring-[#e85d26]"
                            >
                        </div>
                        <div>
                            <label class="mb-1.5 block text-[12px] font-semibold uppercase tracking-wider text-white/60">Message</label>
                            <textarea
                                rows="3"
                                placeholder="Tell us a bit about yourself…"
                                class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-white/30 outline-none transition focus:border-[#e85d26] focus:ring-1 focus:ring-[#e85d26]"
                            ></textarea>
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

    {{-- ================================================================
         OTHER MINISTRIES
    ================================================================ --}}
    <section class="py-16 lg:py-24">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center">
                <div class="mb-4 flex items-center justify-center gap-3">
                    <span class="h-px w-8 bg-[#e85d26]"></span>
                    <span class="text-[11px] font-bold uppercase tracking-[0.18em] text-[#e85d26]">Explore More</span>
                    <span class="h-px w-8 bg-[#e85d26]"></span>
                </div>
                <h2 class="text-[30px] font-extrabold leading-tight text-[#101828] sm:text-[38px]">
                    Other Ministries
                </h2>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($others as $other)
                    <a
                        href="{{ route('ministries.show', $other->slug ?? '#') }}"
                        class="group overflow-hidden rounded-2xl bg-white shadow-md transition-shadow hover:shadow-lg"
                    >
                        <div class="relative h-[180px] overflow-hidden">
                            <img
                                src="{{ $other->image_path }}"
                                alt="{{ $other->name }}"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                            @if ($other->category_label ?? null)
                                <span class="absolute right-3 top-3 rounded-full {{ $other->category_color }} px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-white">
                                    {{ $other->category_label }}
                                </span>
                            @endif

                            <div class="absolute bottom-3 left-4 right-4">
                                <h3 class="text-[18px] font-extrabold leading-tight text-white">{{ $other->name }}</h3>
                                @if ($other->subtitle ?? null)
                                    <p class="mt-0.5 text-[12px] font-medium text-white/70">{{ $other->subtitle }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="px-5 py-4">
                            <span class="inline-flex items-center gap-2 text-[13px] font-bold text-[#e85d26] transition-colors group-hover:text-[#ff8904]">
                                Learn More
                                <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- View All Button --}}
            <div class="mt-10 text-center">
                <a
                    href="{{ route('ministries') }}"
                    class="inline-flex items-center gap-2 rounded-full border-2 border-[#e85d26] px-7 py-3 text-sm font-bold text-[#e85d26] transition-colors hover:bg-[#e85d26] hover:text-white"
                >
                    View All Ministries
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
