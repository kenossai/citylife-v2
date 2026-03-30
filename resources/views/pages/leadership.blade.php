@extends('layouts.app')

@section('title', 'Our Leadership — City Life International')
@section('meta_description', 'Meet the leadership team of City Life International Church.')

@php
    // ──────────────────────────────────────────────────────────────
    //  Fallback data when DB is empty
    // ──────────────────────────────────────────────────────────────
    $fallbackLeadPastors = [
        (object) [
            'name'    => 'Bishop Robert Clarke',
            'role'    => 'Lead Pastor',
            'image_path' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=600&h=700&q=80',
            'bio'     => "Bishop Robert Clarke is the founding Lead Pastor of City Life International Church. With over 30 years of ministry experience, he has planted churches across the UK, Europe and West Africa. A man of deep faith and conviction, he preaches the truth in God's Word with boldness and without any reservations.\n\nWith a vision to \"raise a victorious people,\" he has been on a mission to equip and train people through the word of faith into a life of 100% victory 100% of the time for 25 years and still counting.\n\nBishop Clarke is not a man who just teaches, he lays emphasis on doing because that's the only way to get results. He is a man of faith with numerous results to show for it and he constantly and consistently, with joy, teaches Bible-based principles so that people can live victoriously.\n\nHe plays tennis and football as a form of body exercise, watches movies when he can, rides a power bike because he loves to and travels round the world while still preaching the gospel on his trips.",
        ],
        (object) [
            'name'    => 'Pastor Grace Clarke',
            'role'    => 'Associate Lead Pastor',
            'image_path' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=600&h=700&q=80',
            'bio'     => "Pastor Grace Clarke is fondly called 'Mama' and the name is rightly placed as she is a mother to all, always seeking the best for her children (members of City Life and even beyond). Called to serve beside Bishop Clarke, her best friend, mentor, Pastor and husband, Pastor Grace gives a heart that understands, ears that listen and a mind that offers guidance and counsel to all.\n\nA deep and true lover of God which is one of the many qualities that attracted Bishop Clarke to her. Pastor Grace joyfully serves, giving her all to the ministry she's been called to.\n\nShe is also the founder and convener of the Women of Purpose Conference which has attracted women in their thousands. It is a ministry centred on helping women maximise their full potentials and get them to a point where they can stand out in their various fields.\n\nShe has an immense love for drama and appreciates dance but what she truly enjoys is writing. This has birthed a popular blog where she shares her thoughts and feelings on various issues but above all, inspires.",
        ],
    ];

    $fallbackOtherLeaders = collect([
        ['name' => 'Pastor James Okafor',           'role' => 'Senior Pastor & Evangelist',                'image_path' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=400&h=400&q=80'],
        ['name' => 'Pastor Michael Adisa',           'role' => 'Evangelism Director',                      'image_path' => 'https://images.unsplash.com/photo-1506277886164-e25aa3f4ef7f?auto=format&fit=crop&w=400&h=400&q=80'],
        ['name' => 'Pastor Wole Fayomi',             'role' => 'Resident Pastor Mainland Centre',          'image_path' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&h=400&q=80'],
        ['name' => 'Pastor Eyewumi Ghereje',         'role' => 'Resident Pastor Island Centre',            'image_path' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&h=400&q=80'],
        ['name' => 'Pastor Chikezie Oke',            'role' => 'Associate Resident Pastor Island Centre',  'image_path' => 'https://images.unsplash.com/photo-1531384441138-2736e62e0919?auto=format&fit=crop&w=400&h=400&q=80'],
        ['name' => 'Pastor Shade Fayomi',            'role' => 'Preserved Generation',                    'image_path' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=400&h=400&q=80'],
        ['name' => 'General Oluwamayowa Joseph Oji', 'role' => "David's Army",                            'image_path' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&h=400&q=80'],
        ['name' => 'Pastor Mark Akpaibor',           'role' => 'Transformed Nation',                      'image_path' => 'https://images.unsplash.com/photo-1463453091185-61582044d556?auto=format&fit=crop&w=400&h=400&q=80'],
        ['name' => 'Pastor Supo Arogundade',         'role' => 'Caleb Church',                            'image_path' => 'https://images.unsplash.com/photo-1548372290-8d01b6c8e78c?auto=format&fit=crop&w=400&h=400&q=80'],
        ['name' => 'Minister Femi Adelite',          'role' => 'Online Church',                           'image_path' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=400&h=400&q=80'],
        ['name' => 'Minister Wale',                  'role' => 'Head of Workforce Island Centre',         'image_path' => 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=400&h=400&q=80'],
        ['name' => 'Minister Kingsley Igboakolam',   'role' => 'Head of Workforce Mainland Centre',       'image_path' => 'https://images.unsplash.com/photo-1507591064344-4c6ce005b128?auto=format&fit=crop&w=400&h=400&q=80'],
        ['name' => 'Pastor Ovie Agbani',             'role' => 'Music Director',                          'image_path' => 'https://images.unsplash.com/photo-1542178243-bc20204b769f?auto=format&fit=crop&w=400&h=400&q=80'],
        ['name' => 'Minister Blessing Jude-Okere',   'role' => 'Chief Operating Officer',                 'image_path' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=400&h=400&q=80'],
        ['name' => 'Minister Abosede Samuel-Udene',  'role' => 'Ministry Manager',                        'image_path' => 'https://images.unsplash.com/photo-1589156280159-27698a70f29e?auto=format&fit=crop&w=400&h=400&q=80'],
    ])->map(fn ($l) => (object) $l);

    // Use DB data if available, otherwise fallback
    $leadPastors  = $leadPastors->isEmpty()  ? collect($fallbackLeadPastors)  : $leadPastors;
    $otherLeaders = $otherLeaders->isEmpty() ? $fallbackOtherLeaders          : $otherLeaders;

    // Helper: get bio paragraphs from a leader (model or fallback object)
    $bioParagraphs = function ($pastor) {
        if ($pastor instanceof \App\Models\Leader) {
            return $pastor->bio_paragraphs;
        }
        return array_filter(array_map('trim', preg_split('/\n{2,}/', $pastor->bio ?? '')));
    };
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
                                src="{{ $pastor->image_path }}"
                                alt="{{ $pastor->name }}"
                                class="h-[420px] w-full object-cover object-top"
                            >
                        </div>
                    </div>

                    {{-- Bio --}}
                    <div class="flex-1">
                        <h2 class="text-[28px] font-extrabold text-[#101828] sm:text-[32px]">{{ $pastor->name }}</h2>
                        <p class="mt-1 text-[13px] font-bold uppercase tracking-[0.1em] text-[#98a2b3]">{{ $pastor->role }}</p>

                        <div class="mt-6 space-y-4">
                            @foreach ($bioParagraphs($pastor) as $paragraph)
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
                                src="{{ $leader->image_path }}"
                                alt="{{ $leader->name }}"
                                class="h-full w-full object-cover object-center"
                            >
                        </div>
                        <h3 class="mt-4 text-[14px] font-bold text-[#101828]">{{ $leader->name }}</h3>
                        <p class="mt-0.5 text-[12px] font-semibold uppercase tracking-[0.04em] text-[#98a2b3]">{{ $leader->role }}</p>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

</div>
@endsection
