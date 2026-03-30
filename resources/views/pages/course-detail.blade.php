@extends('layouts.app')

@php
    $allCourses = [
        'foundations-of-faith' => [
            'category'    => 'Theology',
            'catColor'    => 'bg-[#7c3aed]',
            'level'       => 'Beginner',
            'levelColor'  => 'bg-[#16a34a]',
            'certificate' => true,
            'title'       => 'Foundations of Faith',
            'subtitle'    => 'A complete introduction to biblical Christianity',
            'description' => 'Whether you are a new believer or someone who has grown up in church but never had deep biblical grounding, this course is designed for you. Over 8 weeks, Bishop Robert Clarke walks you through the core doctrines of Christianity — who God is, who you are in Christ, what the Bible is, how salvation works, and what the Church is for. Each week includes video teaching, group discussion questions and practical devotional exercises.',
            'instructor'  => [
                'name'    => 'Bishop Robert Clarke',
                'role'    => 'Senior Bishop · City Life International Church',
                'bio'     => 'An experienced minister, teacher and leader with decades of service at City Life Church, committed to helping every student grow in faith and knowledge of the Word.',
                'initial' => 'B',
                'color'   => 'bg-[#2563eb]',
            ],
            'stars'       => 5.0,
            'weeks'       => 8,
            'lessons'     => 16,
            'students'    => 248,
            'price'       => 'Free',
            'image'       => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?auto=format&fit=crop&w=1800&q=80',
            'learnings'   => [
                'Understand the core doctrines of the Christian faith',
                'Develop a daily habit of Bible reading and prayer',
                'Know how to share your faith with clarity and confidence',
                'Understand the role of the Church in God\'s plan',
                'Have a strong biblical identity and sense of purpose',
            ],
            'curriculum'  => [
                [
                    'title'   => 'Week 1 — Who Is God?',
                    'count'   => 3,
                    'minutes' => 65,
                    'lessons' => [
                        ['type' => 'video', 'title' => 'The Trinity: Father, Son & Spirit', 'duration' => '28 min', 'preview' => true],
                        ['type' => 'video', 'title' => 'God\'s Character & Attributes', 'duration' => '22 min', 'preview' => true],
                        ['type' => 'discussion', 'title' => 'Discussion: What Does God Mean To You?', 'duration' => '15 min', 'preview' => false],
                    ],
                ],
                [
                    'title'   => 'Week 2 — The Bible',
                    'count'   => 3,
                    'minutes' => 90,
                    'lessons' => [
                        ['type' => 'video', 'title' => 'How We Got the Bible', 'duration' => '30 min', 'preview' => false],
                        ['type' => 'video', 'title' => 'How to Read & Study Scripture', 'duration' => '35 min', 'preview' => false],
                        ['type' => 'discussion', 'title' => 'Discussion: Applying the Word Daily', 'duration' => '25 min', 'preview' => false],
                    ],
                ],
                [
                    'title'   => 'Week 3 — Salvation & Grace',
                    'count'   => 3,
                    'minutes' => 80,
                    'lessons' => [
                        ['type' => 'video', 'title' => 'The Gospel Message', 'duration' => '28 min', 'preview' => false],
                        ['type' => 'video', 'title' => 'Grace, Faith & Repentance', 'duration' => '30 min', 'preview' => false],
                        ['type' => 'discussion', 'title' => 'Discussion: My Testimony', 'duration' => '22 min', 'preview' => false],
                    ],
                ],
                [
                    'title'   => 'Week 4 — The Holy Spirit',
                    'count'   => 3,
                    'minutes' => 77,
                    'lessons' => [
                        ['type' => 'video', 'title' => 'Who Is the Holy Spirit?', 'duration' => '25 min', 'preview' => false],
                        ['type' => 'video', 'title' => 'The Gifts & Fruit of the Spirit', 'duration' => '30 min', 'preview' => false],
                        ['type' => 'discussion', 'title' => 'Discussion: Walking in the Spirit', 'duration' => '22 min', 'preview' => false],
                    ],
                ],
                [
                    'title'   => 'Week 5-8 — Prayer, Church, Mission & Identity',
                    'count'   => 4,
                    'minutes' => 103,
                    'lessons' => [
                        ['type' => 'video', 'title' => 'The Power of Prayer', 'duration' => '25 min', 'preview' => false],
                        ['type' => 'video', 'title' => 'The Church — God\'s Family', 'duration' => '28 min', 'preview' => false],
                        ['type' => 'video', 'title' => 'Your Mission & Identity in Christ', 'duration' => '30 min', 'preview' => false],
                        ['type' => 'discussion', 'title' => 'Discussion: My Next Steps', 'duration' => '20 min', 'preview' => false],
                    ],
                ],
            ],
            'requirements' => [
                'No prior theological knowledge required',
                'Open Bible (any translation)',
                'A notebook',
            ],
            'includes' => [
                '16 on-demand video lessons',
                '8 weeks of structured learning',
                'Downloadable teaching notes',
                'Certificate of completion',
                'Community discussion forum',
                'Lifetime access to materials',
            ],
        ],
        'leadership-school' => [
            'category'    => 'Leadership',
            'catColor'    => 'bg-[#16a34a]',
            'level'       => 'Intermediate',
            'levelColor'  => 'bg-[#f97316]',
            'certificate' => true,
            'title'       => 'Leadership School',
            'subtitle'    => 'Lead with character, courage and clarity',
            'description' => 'This 12-week intensive programme is designed for emerging and existing leaders within the church and marketplace. Pastor James Okafor draws from biblical principles and practical leadership frameworks to equip you with the tools, character and vision needed to lead effectively in every season.',
            'instructor'  => [
                'name'    => 'Pastor James Okafor',
                'role'    => 'Lead Pastor · City Life International Church',
                'bio'     => 'A dynamic leader and teacher with a passion for raising the next generation of leaders. Pastor James has mentored hundreds of leaders across multiple nations.',
                'initial' => 'J',
                'color'   => 'bg-[#16a34a]',
            ],
            'stars'       => 5.0,
            'weeks'       => 12,
            'lessons'     => 48,
            'students'    => 124,
            'price'       => '£60',
            'image'       => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1800&q=80',
            'learnings'   => [
                'Develop a biblical leadership philosophy',
                'Build and lead effective ministry teams',
                'Navigate conflict and difficult conversations',
                'Cast vision and execute strategic plans',
                'Grow in personal character and integrity',
            ],
            'curriculum'  => [
                ['title' => 'Week 1-3 — Foundations of Leadership', 'count' => 12, 'minutes' => 180, 'lessons' => [
                    ['type' => 'video', 'title' => 'What the Bible Says About Leadership', 'duration' => '30 min', 'preview' => true],
                    ['type' => 'video', 'title' => 'Character Before Competence', 'duration' => '28 min', 'preview' => false],
                    ['type' => 'discussion', 'title' => 'Discussion: Your Leadership Journey', 'duration' => '20 min', 'preview' => false],
                ]],
                ['title' => 'Week 4-6 — Team Building', 'count' => 12, 'minutes' => 180, 'lessons' => []],
                ['title' => 'Week 7-9 — Vision & Strategy', 'count' => 12, 'minutes' => 180, 'lessons' => []],
                ['title' => 'Week 10-12 — Leading Through Seasons', 'count' => 12, 'minutes' => 180, 'lessons' => []],
            ],
            'requirements' => [
                'Currently serving in a ministry or leadership role (recommended)',
                'Open Bible (any translation)',
                'A notebook and journal',
            ],
            'includes' => [
                '48 on-demand video lessons',
                '12 weeks of structured learning',
                'Downloadable leadership workbook',
                'Certificate of completion',
                'Community discussion forum',
                'Lifetime access to materials',
            ],
        ],
        'school-of-prayer' => [
            'category'    => 'Prayer',
            'catColor'    => 'bg-[#dc2626]',
            'level'       => 'All Levels',
            'levelColor'  => 'bg-[#7c3aed]',
            'certificate' => false,
            'title'       => 'School of Prayer',
            'subtitle'    => 'Build a powerful and consistent prayer life',
            'description' => 'Discover the transformative power of prayer and build a consistent, powerful prayer life through this 6-week school. Bishop Robert Clarke teaches from decades of prayer experience, showing you how to pray with faith, authority and persistence.',
            'instructor'  => [
                'name'    => 'Bishop Robert Clarke',
                'role'    => 'Senior Bishop · City Life International Church',
                'bio'     => 'An experienced minister, teacher and leader with decades of service at City Life Church, committed to helping every student grow in faith and knowledge of the Word.',
                'initial' => 'B',
                'color'   => 'bg-[#2563eb]',
            ],
            'stars'       => 5.0,
            'weeks'       => 6,
            'lessons'     => 24,
            'students'    => 312,
            'price'       => 'Free',
            'image'       => 'https://images.unsplash.com/photo-1461378810796-1bd3f1ce3c73?auto=format&fit=crop&w=1800&q=80',
            'learnings'   => [
                'Understand different types of prayer in the Bible',
                'Build a daily prayer habit that sticks',
                'Pray with confidence and authority',
                'Intercede effectively for others',
                'Experience deeper intimacy with God',
            ],
            'curriculum'  => [
                ['title' => 'Week 1-2 — Foundations of Prayer', 'count' => 8, 'minutes' => 120, 'lessons' => [
                    ['type' => 'video', 'title' => 'Why Prayer Matters', 'duration' => '25 min', 'preview' => true],
                    ['type' => 'video', 'title' => 'The Lord\'s Prayer — A Model', 'duration' => '30 min', 'preview' => false],
                ]],
                ['title' => 'Week 3-4 — Deepening Your Prayer Life', 'count' => 8, 'minutes' => 120, 'lessons' => []],
                ['title' => 'Week 5-6 — Intercession & Spiritual Warfare', 'count' => 8, 'minutes' => 120, 'lessons' => []],
            ],
            'requirements' => [
                'No prior experience required',
                'Open Bible (any translation)',
                'A prayer journal',
            ],
            'includes' => [
                '24 on-demand video lessons',
                '6 weeks of structured learning',
                'Downloadable prayer guides',
                'Community discussion forum',
                'Lifetime access to materials',
            ],
        ],
        'evangelism-training' => [
            'category'    => 'Evangelism',
            'catColor'    => 'bg-[#f97316]',
            'level'       => 'All Levels',
            'levelColor'  => 'bg-[#7c3aed]',
            'certificate' => false,
            'title'       => 'Evangelism Training',
            'subtitle'    => 'Share your faith naturally and boldly',
            'description' => 'Get equipped to share your faith naturally and boldly. This 4-week course will give you the tools, confidence and strategy you need to reach your friends, family and community with the gospel.',
            'instructor'  => [
                'name'    => 'Pastor Michael Adisa',
                'role'    => 'Outreach Pastor · City Life International Church',
                'bio'     => 'Pastor Michael has led evangelism initiatives across the UK and Africa, with a heart for equipping believers to share their faith in everyday life.',
                'initial' => 'M',
                'color'   => 'bg-[#f97316]',
            ],
            'stars'       => 4.0,
            'weeks'       => 4,
            'lessons'     => 16,
            'students'    => 189,
            'price'       => 'Free',
            'image'       => 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?auto=format&fit=crop&w=1800&q=80',
            'learnings'   => [
                'Articulate the gospel clearly and simply',
                'Share your personal testimony effectively',
                'Start spiritual conversations naturally',
                'Respond to common questions and objections',
                'Build genuine relationships for gospel impact',
            ],
            'curriculum'  => [
                ['title' => 'Week 1 — The Heart of Evangelism', 'count' => 4, 'minutes' => 60, 'lessons' => [
                    ['type' => 'video', 'title' => 'Why Every Believer Is Called', 'duration' => '25 min', 'preview' => true],
                ]],
                ['title' => 'Week 2 — Your Story Matters', 'count' => 4, 'minutes' => 60, 'lessons' => []],
                ['title' => 'Week 3 — Starting Conversations', 'count' => 4, 'minutes' => 60, 'lessons' => []],
                ['title' => 'Week 4 — Answering Questions', 'count' => 4, 'minutes' => 60, 'lessons' => []],
            ],
            'requirements' => [
                'No prior experience required',
                'Open Bible (any translation)',
                'A notebook',
            ],
            'includes' => [
                '16 on-demand video lessons',
                '4 weeks of structured learning',
                'Downloadable conversation guides',
                'Community discussion forum',
                'Lifetime access to materials',
            ],
        ],
        'marriage-and-family' => [
            'category'    => 'Family Life',
            'catColor'    => 'bg-[#ec4899]',
            'level'       => 'Couples',
            'levelColor'  => 'bg-[#ec4899]',
            'certificate' => false,
            'title'       => 'Marriage & Family',
            'subtitle'    => 'Build your marriage on God\'s design',
            'description' => 'A transformative 6-week course for married couples and those preparing for marriage, built on God\'s design for the family. Pastor James and Mrs. Okafor share practical wisdom for communication, conflict resolution, intimacy and parenting.',
            'instructor'  => [
                'name'    => 'Pastor James & Mrs. Okafor',
                'role'    => 'Marriage Ministry · City Life International Church',
                'bio'     => 'Married for over 20 years, Pastor James and Mrs. Okafor have counselled hundreds of couples and are passionate about seeing families thrive in God\'s purpose.',
                'initial' => 'J',
                'color'   => 'bg-[#ec4899]',
            ],
            'stars'       => 5.0,
            'weeks'       => 6,
            'lessons'     => 24,
            'students'    => 97,
            'price'       => '£30 per couple',
            'image'       => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1800&q=80',
            'learnings'   => [
                'Understand God\'s design for marriage',
                'Improve communication and resolve conflict',
                'Build deeper emotional and spiritual intimacy',
                'Raise children with biblical values',
                'Strengthen your family\'s spiritual foundation',
            ],
            'curriculum'  => [
                ['title' => 'Week 1-2 — God\'s Design for Marriage', 'count' => 8, 'minutes' => 120, 'lessons' => [
                    ['type' => 'video', 'title' => 'Marriage as a Covenant', 'duration' => '30 min', 'preview' => true],
                ]],
                ['title' => 'Week 3-4 — Communication & Conflict', 'count' => 8, 'minutes' => 120, 'lessons' => []],
                ['title' => 'Week 5-6 — Family, Parenting & Legacy', 'count' => 8, 'minutes' => 120, 'lessons' => []],
            ],
            'requirements' => [
                'Open to married couples and engaged couples',
                'Open Bible (any translation)',
                'A shared journal for couples',
            ],
            'includes' => [
                '24 on-demand video lessons',
                '6 weeks of structured learning',
                'Couple devotional guides',
                'Community discussion forum',
                'Lifetime access to materials',
            ],
        ],
        'worship-and-arts-school' => [
            'category'    => 'Worship',
            'catColor'    => 'bg-[#a855f7]',
            'level'       => 'All Levels',
            'levelColor'  => 'bg-[#7c3aed]',
            'certificate' => true,
            'title'       => 'Worship & Arts School',
            'subtitle'    => 'Develop your gifts and lead others into worship',
            'description' => 'Develop your gifts as a musician, singer, dancer, or creative and discover how to lead others into God\'s presence. Samuel Akin draws from years of worship ministry to equip you with both spiritual understanding and practical skill.',
            'instructor'  => [
                'name'    => 'Samuel Akin',
                'role'    => 'Worship Director · City Life International Church',
                'bio'     => 'Samuel has led worship for over 15 years and trained worship teams across the UK. He is passionate about raising a generation of worshippers who lead from a place of intimacy with God.',
                'initial' => 'S',
                'color'   => 'bg-[#a855f7]',
            ],
            'stars'       => 4.0,
            'weeks'       => 8,
            'lessons'     => 32,
            'students'    => 76,
            'price'       => '£40',
            'image'       => 'https://images.unsplash.com/photo-1507676184212-d03ab07a01bf?auto=format&fit=crop&w=1800&q=80',
            'learnings'   => [
                'Understand the biblical foundations of worship',
                'Develop your musical or creative skills',
                'Lead worship with confidence and anointing',
                'Build and train a worship team',
                'Create an atmosphere for God\'s presence',
            ],
            'curriculum'  => [
                ['title' => 'Week 1-2 — The Heart of Worship', 'count' => 8, 'minutes' => 120, 'lessons' => [
                    ['type' => 'video', 'title' => 'What Is True Worship?', 'duration' => '28 min', 'preview' => true],
                ]],
                ['title' => 'Week 3-4 — Developing Your Gift', 'count' => 8, 'minutes' => 120, 'lessons' => []],
                ['title' => 'Week 5-6 — Leading Worship', 'count' => 8, 'minutes' => 120, 'lessons' => []],
                ['title' => 'Week 7-8 — Team Building & Culture', 'count' => 8, 'minutes' => 120, 'lessons' => []],
            ],
            'requirements' => [
                'Some musical or creative experience (recommended)',
                'Access to your instrument or gear',
                'A notebook',
            ],
            'includes' => [
                '32 on-demand video lessons',
                '8 weeks of structured learning',
                'Downloadable chord charts & resources',
                'Certificate of completion',
                'Community discussion forum',
                'Lifetime access to materials',
            ],
        ],
    ];

    $course = $allCourses[$slug] ?? null;
    if (!$course) { abort(404); }
@endphp

@section('title', $course['title'] . ' — City Life International')
@section('meta_description', $course['subtitle'] . '. ' . Str::limit($course['description'], 150))

@push('head')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush

@section('content')
<div class="bg-[#f9fafb] text-[#101828]" x-data="courseDetail()">

    {{-- ============================================================
         HERO
    ============================================================ --}}
    <section class="relative overflow-hidden pt-16">
        <div class="absolute inset-0">
            <img src="{{ $course['image'] }}" alt="{{ $course['title'] }}" class="h-full w-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/60 to-black/40"></div>
        </div>

        <div class="relative mx-auto flex min-h-[280px] max-w-7xl flex-col justify-end px-4 pb-8 sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <div class="mb-5 flex items-center gap-2 text-[13px] text-white/50">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">🏠 Home</a>
                <svg class="h-3.5 w-3.5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('courses') }}" class="transition-colors hover:text-white">Courses</a>
                <svg class="h-3.5 w-3.5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white/80">{{ $course['title'] }}</span>
            </div>

            {{-- Badges --}}
            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex h-[24px] items-center rounded-md px-2.5 text-[11px] font-bold text-white {{ $course['catColor'] }}">{{ $course['category'] }}</span>
                <span class="inline-flex h-[24px] items-center rounded-md px-2.5 text-[11px] font-bold text-white {{ $course['levelColor'] }}">{{ $course['level'] }}</span>
                @if ($course['certificate'])
                    <span class="inline-flex h-[24px] items-center gap-1 rounded-md bg-[#f97316] px-2.5 text-[11px] font-bold text-white">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        Certificate Awarded
                    </span>
                @endif
            </div>

            <h1 class="mt-3 text-[36px] font-extrabold leading-tight text-white sm:text-[44px]">{{ $course['title'] }}</h1>
            <p class="mt-1.5 text-[15px] text-white/60">{{ $course['subtitle'] }}</p>

            {{-- Meta row --}}
            <div class="mt-4 flex flex-wrap items-center gap-4 text-[13px] text-white/70">
                <span class="flex items-center gap-1.5">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    {{ $course['instructor']['name'] }}
                </span>
                <span class="flex items-center gap-1.5">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-width="2" d="M12 6v6l4 2"/></svg>
                    {{ $course['weeks'] }} weeks
                </span>
                <span class="flex items-center gap-1.5">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $course['lessons'] }} lessons
                </span>
                <span class="flex items-center gap-1.5">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ number_format($course['students']) }} students
                </span>
            </div>

        </div>
    </section>

    {{-- ============================================================
         BODY — 2-column layout
    ============================================================ --}}
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- Back link --}}
        <a href="{{ route('courses') }}" class="mb-8 inline-flex items-center gap-2 text-[13px] font-medium text-[#667085] transition-colors hover:text-[#101828]">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Courses
        </a>

        <div class="flex flex-col gap-10 lg:flex-row">

            {{-- ========== LEFT COLUMN ========== --}}
            <div class="flex-1 min-w-0">

                {{-- ABOUT THIS COURSE --}}
                <div class="rounded-2xl bg-white p-6 shadow-sm sm:p-8">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="h-[3px] w-6 rounded-full bg-[#e85d26]"></span>
                        <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">About This Course</h2>
                    </div>
                    <p class="text-[14px] leading-relaxed text-[#667085]">{{ $course['description'] }}</p>
                </div>

                {{-- WHAT YOU'LL LEARN --}}
                <div class="mt-6 rounded-2xl bg-white p-6 shadow-sm sm:p-8">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="h-[3px] w-6 rounded-full bg-[#e85d26]"></span>
                        <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">What You'll Learn</h2>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-2">
                        @foreach ($course['learnings'] as $item)
                            <div class="flex items-start gap-3 rounded-xl border border-[#f3f4f6] bg-[#fafafa] px-4 py-3">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-[#16a34a]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <span class="text-[13px] leading-snug text-[#374151]">{{ $item }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- COURSE CURRICULUM --}}
                <div class="mt-6 rounded-2xl bg-white p-6 shadow-sm sm:p-8">
                    <div class="mb-5 flex items-center gap-3">
                        <span class="h-[3px] w-6 rounded-full bg-[#e85d26]"></span>
                        <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">Course Curriculum</h2>
                    </div>

                    <div class="divide-y divide-[#f3f4f6]">
                        @foreach ($course['curriculum'] as $wi => $week)
                            <div x-data="{ open: {{ $wi === 0 ? 'true' : 'false' }} }">
                                {{-- Week header --}}
                                <button
                                    type="button"
                                    @click="open = !open"
                                    class="flex w-full items-center justify-between py-4 text-left"
                                >
                                    <div>
                                        <span class="text-[14px] font-bold text-[#101828]">{{ $week['title'] }}</span>
                                        <span class="ml-2 text-[12px] text-[#98a2b3]">{{ $week['count'] }} lessons · {{ $week['minutes'] }} min</span>
                                    </div>
                                    <svg :class="{ 'rotate-180': open }" class="h-5 w-5 shrink-0 text-[#98a2b3] transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>

                                {{-- Lessons --}}
                                @if (count($week['lessons']) > 0)
                                    <div x-show="open" x-cloak x-collapse class="pb-4">
                                        <div class="space-y-1">
                                            @foreach ($week['lessons'] as $lesson)
                                                <div class="flex items-center gap-3 rounded-lg px-3 py-2.5 hover:bg-[#f9fafb]">
                                                    @if ($lesson['type'] === 'video')
                                                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#fef2f2]">
                                                            <svg class="h-3.5 w-3.5 text-[#dc2626]" fill="currentColor" viewBox="0 0 20 20"><path d="M6.3 2.84A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.27l9.344-5.891a1.5 1.5 0 000-2.538L6.3 2.84z"/></svg>
                                                        </div>
                                                    @else
                                                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#f3f4f6]">
                                                            <svg class="h-3.5 w-3.5 text-[#98a2b3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                                        </div>
                                                    @endif

                                                    <span class="flex-1 text-[13px] text-[#374151]">{{ $lesson['title'] }}</span>

                                                    @if ($lesson['preview'])
                                                        <span class="inline-flex h-[20px] items-center rounded px-1.5 text-[10px] font-bold text-[#16a34a] bg-[#f0fdf4]">Preview</span>
                                                    @endif

                                                    <span class="text-[12px] text-[#98a2b3]">{{ $lesson['duration'] }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- REQUIREMENTS --}}
                <div class="mt-6 rounded-2xl bg-white p-6 shadow-sm sm:p-8">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="h-[3px] w-6 rounded-full bg-[#e85d26]"></span>
                        <h2 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">Requirements</h2>
                    </div>
                    <ul class="space-y-2">
                        @foreach ($course['requirements'] as $req)
                            <li class="flex items-start gap-2.5 text-[14px] text-[#374151]">
                                <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-[#e85d26]"></span>
                                {{ $req }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- YOUR INSTRUCTOR --}}
                <div class="mt-6 rounded-2xl bg-white p-6 shadow-sm sm:p-8">
                    <div class="flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl {{ $course['instructor']['color'] }} text-[18px] font-bold text-white">
                            {{ $course['instructor']['initial'] }}
                        </div>
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-[0.1em] text-[#e85d26]">Your Instructor</p>
                            <h3 class="mt-0.5 text-[16px] font-bold text-[#101828]">{{ $course['instructor']['name'] }}</h3>
                            <p class="text-[12px] text-[#98a2b3]">{{ $course['instructor']['role'] }}</p>
                            <p class="mt-2 text-[13px] leading-relaxed text-[#667085]">{{ $course['instructor']['bio'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- SHARE --}}
                <div class="mt-6 flex flex-wrap items-center gap-3 rounded-2xl bg-white px-6 py-4 shadow-sm">
                    <span class="flex items-center gap-2 text-[13px] font-medium text-[#667085]">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                        Share this course:
                    </span>
                    <a href="#" class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] px-3.5 text-[12px] font-medium text-[#374151] transition-colors hover:border-[#d0d5dd] hover:bg-[#f9fafb]">Facebook</a>
                    <a href="#" class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] px-3.5 text-[12px] font-medium text-[#374151] transition-colors hover:border-[#d0d5dd] hover:bg-[#f9fafb]">X / Twitter</a>
                    <a href="#" class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] px-3.5 text-[12px] font-medium text-[#374151] transition-colors hover:border-[#d0d5dd] hover:bg-[#f9fafb]">WhatsApp</a>
                    <button type="button" @click="copyLink()" class="inline-flex h-[30px] items-center rounded-full border border-[#e5e7eb] px-3.5 text-[12px] font-medium text-[#374151] transition-colors hover:border-[#d0d5dd] hover:bg-[#f9fafb]">
                        <span x-text="copied ? 'Copied!' : 'Copy Link'"></span>
                    </button>
                </div>

            </div>

            {{-- ========== RIGHT COLUMN (Sidebar) ========== --}}
            <div class="w-full lg:w-[340px] lg:shrink-0">
                <div class="sticky top-20 space-y-6">

                    {{-- ENROL CARD --}}
                    <div class="overflow-hidden rounded-2xl bg-white shadow-sm">
                        <div class="bg-gradient-to-br from-[#e85d26] to-[#f97316] px-6 py-5">
                            <p class="text-[11px] font-bold uppercase tracking-[0.1em] text-white/70">Enrol Now</p>
                            <p class="mt-1 text-[32px] font-extrabold leading-none text-white">{{ $course['price'] }}</p>
                            <p class="mt-1 text-[13px] text-white/60">{{ $course['weeks'] }} weeks · {{ $course['lessons'] }} lessons</p>
                        </div>

                        <div class="space-y-3 px-6 py-5">
                            <input
                                type="text"
                                placeholder="Full Name *"
                                class="h-[42px] w-full rounded-lg border border-[#e5e7eb] px-4 text-[13px] text-[#101828] outline-none placeholder:text-[#98a2b3] focus:border-[#d0d5dd] focus:ring-1 focus:ring-[#d0d5dd]"
                            >
                            <input
                                type="email"
                                placeholder="Email Address *"
                                class="h-[42px] w-full rounded-lg border border-[#e5e7eb] px-4 text-[13px] text-[#101828] outline-none placeholder:text-[#98a2b3] focus:border-[#d0d5dd] focus:ring-1 focus:ring-[#d0d5dd]"
                            >
                            <button
                                type="button"
                                class="h-[44px] w-full rounded-lg bg-[#e85d26] text-[14px] font-semibold text-white transition-colors hover:bg-[#d14f1e]"
                            >
                                Enrol {{ $course['price'] === 'Free' ? 'For Free' : 'Now' }}
                            </button>
                        </div>
                    </div>

                    {{-- THIS COURSE INCLUDES --}}
                    <div class="rounded-2xl bg-white p-6 shadow-sm">
                        <h3 class="text-[12px] font-bold uppercase tracking-[0.1em] text-[#667085]">This Course Includes</h3>
                        <ul class="mt-4 space-y-3">
                            @foreach ($course['includes'] as $item)
                                <li class="flex items-start gap-2.5 text-[13px] text-[#667085]">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#16a34a]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('courseDetail', () => ({
            copied: false,
            copyLink() {
                navigator.clipboard.writeText(window.location.href);
                this.copied = true;
                setTimeout(() => this.copied = false, 2000);
            },
        }));
    });
</script>
@endpush
