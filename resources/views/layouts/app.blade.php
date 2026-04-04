<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'City Life International')</title>
    <meta name="description" content="@yield('meta_description', 'City Life International — A vibrant Christian community in the heart of Sheffield.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>
<body class="bg-white text-gray-900 font-sans antialiased @yield('body_class')">

    {{-- Navigation --}}
    @unless (trim($__env->yieldContent('hide_nav')))
        @include('partials.nav')
    @endunless

    {{-- Page Content --}}
    <main class="@yield('main_class')">
        @yield('content')
    </main>
    <section class="py-10 sm:pb-12">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-[28px] bg-white px-4 py-4 shadow-[0_20px_60px_rgba(17,12,15,0.10)] sm:px-5 lg:rounded-full lg:px-6">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center">
                    <div class="flex items-center gap-3 lg:min-w-[210px]">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#e85d26] text-white">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-extrabold text-[#1c1820]">Subscribe Now</p>
                            <p class="text-xs uppercase tracking-[0.24em] text-[#9a9288]">Church updates and encouragement</p>
                        </div>
                    </div>

                    <form class="flex flex-1 flex-col gap-3 sm:flex-row" onsubmit="return false;">
                        <div class="flex flex-1 items-center gap-3 rounded-full border border-[#eee4d8] bg-[#faf6f1] px-4 py-3">
                            <svg class="h-4 w-4 shrink-0 text-[#9e9489]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <input
                                type="email"
                                placeholder="Enter Your Email"
                                class="min-w-0 flex-1 bg-transparent text-sm text-[#433d36] outline-none placeholder:text-[#a8a096]"
                            >
                        </div>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-full bg-[#18151a] px-6 py-3 text-sm font-semibold text-white transition-colors hover:bg-[#e85d26]"
                        >
                            Subscribe Now
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @unless (trim($__env->yieldContent('hide_footer')))
        @include('partials.footer')
    @endunless

    {{-- Homepage Music Player --}}
    @php $music = \App\Models\HomepageMusic::instance(); @endphp
    @if ($music->is_active && $music->url)
        @include('partials.music-player', ['music' => $music])
    @endif

    @stack('scripts')
</body>
</html>
