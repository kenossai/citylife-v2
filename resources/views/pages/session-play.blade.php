@extends('layouts.app')

@php
    // ──────────────────────────────────────────────────────────────
    //  All speakers data (shared with speaker-session page)
    // ──────────────────────────────────────────────────────────────
    $allSpeakers = [
        'bishop-robert-clarke' => [
            'name'      => 'Bishop Robert Clarke',
            'firstName' => 'Robert',
            'role'      => 'Senior Bishop & Principal',
            'church'    => 'City Life International Church',
            'image'     => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&h=700&q=80',
            'cover'     => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?auto=format&fit=crop&w=1800&q=80',
            'sessions'  => 5,
            'sessionList' => [
                [
                    'slug'      => 'the-foundations-of-faith',
                    'title'     => 'The Foundations of Faith',
                    'type'      => 'video',
                    'duration'  => '48:32',
                    'year'      => 2025,
                    'youtube'   => 'dQw4w9WgXcQ',
                    'scripture' => 'Hebrews 11:1-6',
                    'keyVerse'  => '"Now faith is the substance of things hoped for, the evidence of things not seen." — Hebrews 11:1 (KJV)',
                    'about'     => 'In this foundational session, Bishop Robert Clarke unpacks the core meaning of faith as described in Hebrews 11. He explores how faith is not just a concept but a living, active force that shapes our daily walk with God. Drawing from decades of pastoral experience, Bishop Clarke shows how the heroes of faith overcame impossible odds through their unwavering trust in God\'s promises.',
                ],
                [
                    'slug'      => 'walking-in-the-spirit',
                    'title'     => 'Walking in the Spirit',
                    'type'      => 'video',
                    'duration'  => '52:10',
                    'year'      => 2025,
                    'youtube'   => 'dQw4w9WgXcQ',
                    'scripture' => 'Galatians 5:16-25',
                    'keyVerse'  => '"But the fruit of the Spirit is love, joy, peace, longsuffering, gentleness, goodness, faith." — Galatians 5:22 (KJV)',
                    'about'     => 'Bishop Clarke takes us on a journey through Galatians 5, explaining what it truly means to walk in the Spirit. He contrasts the works of the flesh with the fruit of the Spirit, providing practical steps for cultivating a Spirit-led life in today\'s world. This session is a powerful call to surrender and deeper intimacy with the Holy Spirit.',
                ],
                [
                    'slug'      => 'the-power-of-covenant',
                    'title'     => 'The Power of Covenant',
                    'type'      => 'video',
                    'duration'  => '44:18',
                    'year'      => 2024,
                    'youtube'   => 'dQw4w9WgXcQ',
                    'scripture' => 'Genesis 17:1-8',
                    'keyVerse'  => '"And I will establish my covenant between me and thee and thy seed after thee in their generations for an everlasting covenant." — Genesis 17:7 (KJV)',
                    'about'     => 'This powerful teaching explores the nature of covenant in Scripture, from God\'s promise to Abraham through to the New Covenant in Christ. Bishop Clarke reveals how understanding covenant changes our approach to prayer, worship and everyday living. Discover the power that comes from knowing you are in an unbreakable covenant relationship with God.',
                ],
                [
                    'slug'      => 'understanding-grace',
                    'title'     => 'Understanding Grace',
                    'type'      => 'audio',
                    'duration'  => '38:45',
                    'year'      => 2024,
                    'youtube'   => 'dQw4w9WgXcQ',
                    'scripture' => 'Ephesians 2:8-10',
                    'keyVerse'  => '"For by grace are ye saved through faith; and that not of yourselves: it is the gift of God." — Ephesians 2:8 (KJV)',
                    'about'     => 'What is grace? How does it work in the life of the believer? Bishop Clarke dives deep into one of the most essential yet misunderstood doctrines of the Christian faith. He explains how grace is not a licence to sin but an empowerment to live above sin, bringing clarity and freedom through this transformative teaching.',
                ],
                [
                    'slug'      => 'leadership-in-the-kingdom',
                    'title'     => 'Leadership in the Kingdom',
                    'type'      => 'audio',
                    'duration'  => '41:20',
                    'year'      => 2024,
                    'youtube'   => 'dQw4w9WgXcQ',
                    'scripture' => 'Mark 10:42-45',
                    'keyVerse'  => '"But whosoever will be great among you, shall be your minister: And whosoever of you will be the chiefest, shall be servant of all." — Mark 10:43-44 (KJV)',
                    'about'     => 'Bishop Clarke challenges conventional leadership paradigms with the model Jesus set forth — servant leadership. This session examines how Kingdom leadership differs from the world\'s approach and equips emerging leaders with the mindset needed to lead with humility, integrity and spiritual authority.',
                ],
            ],
        ],
        'pastor-james-okafor' => [
            'name'      => 'Pastor James Okafor',
            'firstName' => 'James',
            'role'      => 'Senior Pastor & Evangelist',
            'church'    => 'City Life International Church',
            'image'     => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=600&h=700&q=80',
            'cover'     => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1800&q=80',
            'sessions'  => 4,
            'sessionList' => [
                [
                    'slug'      => 'bold-evangelism-in-the-21st-century',
                    'title'     => 'Bold Evangelism in the 21st Century',
                    'type'      => 'video',
                    'duration'  => '45:15',
                    'year'      => 2026,
                    'youtube'   => 'dQw4w9WgXcQ',
                    'scripture' => 'Romans 1:16-17',
                    'keyVerse'  => '"For I am not ashamed of the gospel of Christ: for it is the power of God unto salvation to every one that believeth." — Romans 1:16 (KJV)',
                    'about'     => 'Pastor James Okafor delivers a stirring call to courage in evangelism. In an age of political correctness and cultural sensitivity, he makes the case that the Gospel must be preached boldly and without compromise. This session provides practical strategies for sharing your faith effectively in modern contexts while maintaining the power and truth of the message.',
                ],
                [
                    'slug'      => 'the-heart-of-a-leader',
                    'title'     => 'The Heart of a Leader',
                    'type'      => 'video',
                    'duration'  => '50:30',
                    'year'      => 2026,
                    'youtube'   => 'dQw4w9WgXcQ',
                    'scripture' => '1 Samuel 16:7',
                    'keyVerse'  => '"For the Lord seeth not as man seeth; for man looketh on the outward appearance, but the Lord looketh on the heart." — 1 Samuel 16:7 (KJV)',
                    'about'     => 'What makes a great leader in God\'s Kingdom? Pastor James explores the inner life of leadership, focusing on character, integrity and the condition of the heart. Drawing from the life of David and other biblical leaders, he shows that God is more interested in who you are than what you do.',
                ],
                [
                    'slug'      => 'preaching-with-power',
                    'title'     => 'Preaching with Power',
                    'type'      => 'video',
                    'duration'  => '42:48',
                    'year'      => 2025,
                    'youtube'   => 'dQw4w9WgXcQ',
                    'scripture' => '1 Corinthians 2:1-5',
                    'keyVerse'  => '"And my speech and my preaching was not with enticing words of man\'s wisdom, but in demonstration of the Spirit and of power." — 1 Corinthians 2:4 (KJV)',
                    'about'     => 'Pastor James teaches on the art and anointing of preaching. He emphasises that true preaching goes beyond eloquence and rhetorical skill — it requires the power of the Holy Spirit. This session equips ministers and aspiring preachers with both practical homiletics and spiritual principles for impactful preaching.',
                ],
                [
                    'slug'      => 'revival-and-reformation',
                    'title'     => 'Revival and Reformation',
                    'type'      => 'audio',
                    'duration'  => '39:22',
                    'year'      => 2025,
                    'youtube'   => 'dQw4w9WgXcQ',
                    'scripture' => '2 Chronicles 7:14',
                    'keyVerse'  => '"If my people, which are called by my name, shall humble themselves, and pray, and seek my face, and turn from their wicked ways; then will I hear from heaven." — 2 Chronicles 7:14 (KJV)',
                    'about'     => 'This audio session explores the conditions and characteristics of genuine revival. Pastor James examines historical revivals and draws parallels to what God wants to do in our generation. He challenges believers to pursue personal and corporate revival through prayer, repentance and wholehearted devotion.',
                ],
            ],
        ],
        'pastor-michael-adisa' => [
            'name'      => 'Pastor Michael Adisa',
            'firstName' => 'Michael',
            'role'      => 'Evangelism Director',
            'church'    => 'City Life International Church',
            'image'     => 'https://images.unsplash.com/photo-1506277886164-e25aa3f4ef7f?auto=format&fit=crop&w=600&h=700&q=80',
            'cover'     => 'https://images.unsplash.com/photo-1461378810796-1bd3f1ce3c73?auto=format&fit=crop&w=1800&q=80',
            'sessions'  => 3,
            'sessionList' => [
                [
                    'slug'      => 'soul-winning-strategies',
                    'title'     => 'Soul Winning Strategies',
                    'type'      => 'video',
                    'duration'  => '46:10',
                    'year'      => 2026,
                    'youtube'   => 'dQw4w9WgXcQ',
                    'scripture' => 'Proverbs 11:30',
                    'keyVerse'  => '"The fruit of the righteous is a tree of life; and he that winneth souls is wise." — Proverbs 11:30 (KJV)',
                    'about'     => 'Pastor Michael Adisa shares proven strategies for effective soul winning in today\'s multicultural society. From one-on-one conversations to large-scale outreach events, this session covers the full spectrum of evangelistic methods while keeping the Gospel at the centre of every approach.',
                ],
                [
                    'slug'      => 'community-outreach-masterclass',
                    'title'     => 'Community Outreach Masterclass',
                    'type'      => 'video',
                    'duration'  => '43:55',
                    'year'      => 2025,
                    'youtube'   => 'dQw4w9WgXcQ',
                    'scripture' => 'Matthew 5:13-16',
                    'keyVerse'  => '"Let your light so shine before men, that they may see your good works, and glorify your Father which is in heaven." — Matthew 5:16 (KJV)',
                    'about'     => 'This masterclass equips churches and ministry teams with practical frameworks for impactful community outreach. Pastor Michael draws from years of hands-on experience organising community events, food drives and neighbourhood programmes that open doors for the Gospel and transform communities.',
                ],
                [
                    'slug'      => 'the-great-commission-today',
                    'title'     => 'The Great Commission Today',
                    'type'      => 'audio',
                    'duration'  => '37:40',
                    'year'      => 2025,
                    'youtube'   => 'dQw4w9WgXcQ',
                    'scripture' => 'Matthew 28:18-20',
                    'keyVerse'  => '"Go ye therefore, and teach all nations, baptizing them in the name of the Father, and of the Son, and of the Holy Ghost." — Matthew 28:19 (KJV)',
                    'about'     => 'What does the Great Commission look like in the 21st century? Pastor Michael addresses this vital question, exploring how technology, migration and globalisation have created unprecedented opportunities for fulfilling Jesus\' command to make disciples of all nations.',
                ],
            ],
        ],
        'pastor-grace-mensah' => [
            'name'      => 'Pastor Grace Mensah',
            'firstName' => 'Grace',
            'role'      => "Women's Ministry Leader",
            'church'    => 'City Life International Church',
            'image'     => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=600&h=700&q=80',
            'cover'     => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1800&q=80',
            'sessions'  => 3,
            'sessionList' => [
                [
                    'slug'      => 'women-of-purpose-identity-in-christ',
                    'title'     => 'Women of Purpose: Identity in Christ',
                    'type'      => 'video',
                    'duration'  => '44:28',
                    'year'      => 2026,
                    'youtube'   => 'dQw4w9WgXcQ',
                    'scripture' => '1 Peter 2:9',
                    'keyVerse'  => '"But ye are a chosen generation, a royal priesthood, an holy nation, a peculiar people; that ye should shew forth the praises of him who hath called you." — 1 Peter 2:9 (KJV)',
                    'about'     => 'Pastor Grace Mensah delivers a powerful message on the identity of the Christian woman. In a world filled with competing voices telling women who they should be, this session returns to Scripture to reveal who God says you are. Pastor Grace weaves together deep theological truth with personal testimony and practical application.',
                ],
                [
                    'slug'      => 'breaking-barriers-by-faith',
                    'title'     => 'Breaking Barriers by Faith',
                    'type'      => 'video',
                    'duration'  => '41:15',
                    'year'      => 2024,
                    'youtube'   => 'dQw4w9WgXcQ',
                    'scripture' => 'Hebrews 11:30-33',
                    'keyVerse'  => '"By faith the walls of Jericho fell down, after they were compassed about seven days." — Hebrews 11:30 (KJV)',
                    'about'     => 'What barriers are standing between you and your God-given destiny? In this session, Pastor Grace examines biblical accounts of men and women who broke through impossible barriers by faith. She provides a practical framework for identifying and overcoming spiritual, emotional and practical obstacles that hold believers back.',
                ],
                [
                    'slug'      => 'the-proverbs-31-woman-today',
                    'title'     => 'The Proverbs 31 Woman Today',
                    'type'      => 'audio',
                    'duration'  => '36:50',
                    'year'      => 2024,
                    'youtube'   => 'dQw4w9WgXcQ',
                    'scripture' => 'Proverbs 31:25-31',
                    'keyVerse'  => '"She is clothed with strength and dignity; she can laugh at the days to come. She speaks with wisdom, and faithful instruction is on her tongue." — Proverbs 31:25-26 (NIV)',
                    'about'     => 'Pastor Grace brings a fresh and empowering perspective to the beloved Proverbs 31 passage. Rather than presenting it as an impossible standard, she reveals it as a portrait of a woman operating in the fullness of her God-given gifts and calling. This session encourages women to embrace their multifaceted roles with grace, strength and purpose.',
                ],
            ],
        ],
    ];

    $speakerData = $allSpeakers[$speakerSlug] ?? abort(404);
    $sessionList = $speakerData['sessionList'];

    // Find current session by slug
    $currentIndex = null;
    $session = null;
    foreach ($sessionList as $i => $s) {
        if ($s['slug'] === $sessionSlug) {
            $currentIndex = $i;
            $session = $s;
            break;
        }
    }
    if (!$session) abort(404);

    $prevSession = $currentIndex > 0 ? $sessionList[$currentIndex - 1] : null;
    $nextSession = $currentIndex < count($sessionList) - 1 ? $sessionList[$currentIndex + 1] : null;
@endphp

@section('title', $session['title'] . ' — ' . $speakerData['name'])

@section('content')

<div class="bg-[#f9fafb] text-[#101828]">

    {{-- ============================================================
         BREADCRUMB BAR
    ============================================================ --}}
    <section class="border-b border-[#e5e7eb] bg-white pt-16">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-1.5 text-[13px] text-[#98a2b3]">
                <a href="{{ route('bible-school') }}" class="transition-colors hover:text-[#e85d26]">City Life Bible School</a>
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('bible-school.resources') }}" class="transition-colors hover:text-[#e85d26]">Resources</a>
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('bible-school.resources.show', $speakerSlug) }}" class="transition-colors hover:text-[#e85d26]">{{ $speakerData['name'] }}</a>
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="max-w-[200px] truncate text-[#101828]">{{ $session['title'] }}</span>
            </nav>

            {{-- Actions --}}
            <div class="hidden items-center gap-2 sm:flex">
                <button class="flex h-9 items-center gap-1.5 rounded-lg border border-[#e5e7eb] bg-white px-3.5 text-[12px] font-semibold text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                    Save
                </button>
                <a href="{{ route('bible-school.resources.show', $speakerSlug) }}" class="flex h-9 items-center gap-1.5 rounded-lg border border-[#e5e7eb] bg-white px-3.5 text-[12px] font-semibold text-[#667085] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================================
         VIDEO PLAYER
    ============================================================ --}}
    <section class="bg-black">
        <div class="mx-auto max-w-7xl">
            <div class="relative aspect-video w-full overflow-hidden">
                <iframe
                    src="https://www.youtube.com/embed/{{ $session['youtube'] }}?rel=0&modestbranding=1"
                    title="{{ $session['title'] }}"
                    class="absolute inset-0 h-full w-full"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </section>

    {{-- ============================================================
         MAIN CONTENT
    ============================================================ --}}
    <section class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-8 lg:flex-row">

                {{-- LEFT — Session details --}}
                <div class="flex-1">

                    {{-- Meta badges --}}
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="inline-flex h-[26px] items-center rounded-md px-2.5 text-[11px] font-bold uppercase tracking-[0.06em] {{ $session['type'] === 'video' ? 'bg-[#fff7ed] text-[#e85d26]' : 'bg-[#f0f9ff] text-[#2563eb]' }}">
                            {{ strtoupper($session['type']) }}
                        </span>
                        <span class="text-[13px] text-[#98a2b3]">{{ $session['duration'] }}</span>
                        <span class="text-[13px] text-[#98a2b3]">·</span>
                        <span class="text-[13px] text-[#98a2b3]">{{ $session['year'] }}</span>
                    </div>

                    {{-- Title --}}
                    <h1 class="mt-4 text-[26px] font-extrabold leading-tight text-[#101828] sm:text-[30px]">
                        {{ $session['title'] }}
                    </h1>

                    {{-- Scripture reference --}}
                    <div class="mt-3 flex items-center gap-2 text-[14px] text-[#e85d26]">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/></svg>
                        <span class="font-semibold">{{ $session['scripture'] }}</span>
                    </div>

                    {{-- About --}}
                    <div class="mt-8">
                        <div class="flex items-center gap-2">
                            <span class="h-[2px] w-5 bg-[#e85d26]"></span>
                            <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">About This Session</h2>
                        </div>
                        <p class="mt-4 text-[14px] leading-[1.8] text-[#667085]">
                            {{ $session['about'] }}
                        </p>
                    </div>

                    {{-- Key Scripture --}}
                    <div class="mt-8">
                        <div class="flex items-center gap-2">
                            <span class="h-[2px] w-5 bg-[#e85d26]"></span>
                            <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">Key Scripture</h2>
                        </div>
                        <div class="mt-4 rounded-2xl border border-[#fde68a]/40 bg-gradient-to-br from-[#fffbeb] to-[#fef3c7]/50 p-6">
                            <div class="flex gap-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-[#d97706]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                                <p class="text-[15px] font-medium italic leading-relaxed text-[#92400e]">
                                    {{ $session['keyVerse'] }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- RIGHT — Sidebar --}}
                <div class="w-full shrink-0 space-y-5 lg:w-[300px]">

                    {{-- Speaker Card --}}
                    <div class="overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm">
                        {{-- Cover --}}
                        <div class="relative h-[100px] overflow-hidden">
                            <img src="{{ $speakerData['cover'] }}" alt="" class="h-full w-full object-cover">
                            <div class="absolute inset-0 bg-black/20"></div>
                        </div>
                        {{-- Avatar --}}
                        <div class="-mt-10 px-5">
                            <div class="relative inline-block">
                                <div class="h-[72px] w-[72px] overflow-hidden rounded-xl border-[3px] border-white shadow-md">
                                    <img src="{{ $speakerData['image'] }}" alt="{{ $speakerData['name'] }}" class="h-full w-full object-cover object-center">
                                </div>
                            </div>
                        </div>
                        {{-- Info --}}
                        <div class="px-5 pb-5 pt-3">
                            <span class="inline-flex h-[22px] items-center rounded-md bg-[#e85d26] px-2 text-[9px] font-bold uppercase tracking-[0.08em] text-white">
                                {{ $speakerData['role'] }}
                            </span>
                            <h3 class="mt-2 text-[16px] font-bold text-[#101828]">{{ $speakerData['name'] }}</h3>
                            <p class="mt-0.5 text-[12px] text-[#98a2b3]">{{ $speakerData['church'] }}</p>
                            <a href="{{ route('bible-school.resources.show', $speakerSlug) }}" class="mt-4 flex h-9 items-center justify-center gap-1.5 rounded-lg bg-[#e85d26] text-[12px] font-semibold text-white transition-colors hover:bg-[#d14f1e]">
                                <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.84A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.27l9.344-5.891a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                                View All Sessions
                            </a>
                        </div>
                    </div>

                    {{-- Navigate Sessions --}}
                    <div class="overflow-hidden rounded-2xl border border-[#f3f4f6] bg-white shadow-sm">
                        <div class="border-b border-[#f3f4f6] px-5 py-4">
                            <h3 class="text-[13px] font-bold uppercase tracking-[0.06em] text-[#101828]">Navigate Sessions</h3>
                        </div>
                        <div class="divide-y divide-[#f3f4f6]">
                            @if ($prevSession)
                                <a href="{{ route('bible-school.resources.play', [$speakerSlug, $prevSession['slug']]) }}" class="flex items-center gap-3 px-5 py-3.5 transition-colors hover:bg-[#f9fafb]">
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-[#f3f4f6] text-[#667085]">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#98a2b3]">Previous</p>
                                        <p class="mt-0.5 truncate text-[13px] font-semibold text-[#101828]">{{ $prevSession['title'] }}</p>
                                    </div>
                                </a>
                            @else
                                <div class="flex items-center gap-3 px-5 py-3.5 opacity-40">
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-[#f3f4f6] text-[#667085]">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#98a2b3]">Previous</p>
                                        <p class="mt-0.5 text-[13px] text-[#98a2b3]">No previous session</p>
                                    </div>
                                </div>
                            @endif

                            @if ($nextSession)
                                <a href="{{ route('bible-school.resources.play', [$speakerSlug, $nextSession['slug']]) }}" class="flex items-center gap-3 px-5 py-3.5 transition-colors hover:bg-[#f9fafb]">
                                    <div class="min-w-0 flex-1 text-right">
                                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#98a2b3]">Next</p>
                                        <p class="mt-0.5 truncate text-[13px] font-semibold text-[#101828]">{{ $nextSession['title'] }}</p>
                                    </div>
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-[#f3f4f6] text-[#667085]">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </div>
                                </a>
                            @else
                                <div class="flex items-center gap-3 px-5 py-3.5 opacity-40">
                                    <div class="min-w-0 flex-1 text-right">
                                        <p class="text-[10px] font-bold uppercase tracking-[0.08em] text-[#98a2b3]">Next</p>
                                        <p class="mt-0.5 text-[13px] text-[#98a2b3]">No next session</p>
                                    </div>
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-[#f3f4f6] text-[#667085]">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- All Speakers --}}
                    <a href="{{ route('bible-school.resources') }}" class="flex items-center justify-center gap-2 rounded-2xl border border-[#f3f4f6] bg-white px-5 py-3.5 text-[13px] font-semibold text-[#667085] shadow-sm transition-colors hover:text-[#e85d26]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        All Speakers
                    </a>

                    {{-- Bible School Home --}}
                    <a href="{{ route('bible-school') }}" class="flex items-center justify-center gap-2 rounded-2xl border border-[#f3f4f6] bg-white px-5 py-3.5 text-[13px] font-semibold text-[#667085] shadow-sm transition-colors hover:text-[#e85d26]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z"/></svg>
                        Bible School Home
                    </a>

                </div>

            </div>
        </div>
    </section>

</div>
@endsection
