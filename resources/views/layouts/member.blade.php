<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'My Portal') — City Life International</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="h-full min-h-screen bg-gray-50 font-sans antialiased" x-data="{ sidebarOpen: false }">

<div class="flex h-full min-h-screen">

    {{-- ── Mobile overlay ── --}}
    <div
        x-show="sidebarOpen"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-20 bg-black/60 lg:hidden"
    ></div>

    {{-- ── Sidebar ── --}}
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-30 flex w-64 flex-col bg-white border-r border-gray-200 text-gray-900 transition-transform duration-300 lg:static lg:translate-x-0"
    >
        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-200">
            <img src="{{ asset('images/logo_small_black.png') }}" alt="City Life International" class="h-10 w-50 object-contain shrink-0">

        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">
            @php $routeName = request()->route()?->getName() ?? ''; @endphp

            <a href="{{ route('member.dashboard') }}"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors
                      {{ str_starts_with($routeName, 'member.dashboard') ? 'bg-[#e85d26]/10 text-[#e85d26]' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('member.courses') }}"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors
                      {{ str_starts_with($routeName, 'member.courses') ? 'bg-[#e85d26]/10 text-[#e85d26]' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                My Courses
            </a>

            <a href="{{ route('member.progress') }}"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors
                      {{ str_starts_with($routeName, 'member.progress') ? 'bg-[#e85d26]/10 text-[#e85d26]' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Progress
            </a>

            <a href="{{ route('member.certificates') }}"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors
                      {{ str_starts_with($routeName, 'member.certificates') ? 'bg-[#e85d26]/10 text-[#e85d26]' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
                Certificates
            </a>

            <a href="{{ route('member.settings') }}"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors
                      {{ str_starts_with($routeName, 'member.settings') ? 'bg-[#e85d26]/10 text-[#e85d26]' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Settings
            </a>
        </nav>

        {{-- User profile + back link --}}
        <div class="border-t border-gray-200 px-4 py-4 space-y-3">
            <div class="flex items-center gap-3">
                @php $sidebarMember = Auth::guard('member')->user(); @endphp
                @if($sidebarMember->avatar_url)
                <img src="{{ $sidebarMember->avatar_url }}" alt=""
                     class="h-8 w-8 rounded-full object-cover shrink-0 ring-2 ring-[#e85d26]/30">
                @else
                <div class="h-8 w-8 rounded-full bg-[#e85d26] flex items-center justify-center shrink-0 text-white font-bold text-xs uppercase">
                    {{ substr($sidebarMember->first_name ?? 'M', 0, 1) }}
                </div>
                @endif
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                        {{ $sidebarMember->full_name }}
                    </p>
                    <p class="text-xs text-gray-500 truncate">
                        {{ $sidebarMember->email }}
                    </p>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-1.5 text-xs text-gray-500 hover:text-gray-900 transition-colors">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Website
                </a>
                <form method="POST" action="{{ route('member.logout') }}">
                    @csrf
                    <button type="submit" class="text-xs text-gray-600 hover:text-red-400 transition-colors">Sign out</button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ── Main content ── --}}
    <div class="flex flex-1 flex-col min-w-0">

        {{-- Mobile header --}}
        <header class="flex items-center gap-4 bg-white border-b border-gray-200 px-4 py-3 lg:hidden">
            <button @click="sidebarOpen = true" class="p-1 text-gray-500 hover:text-gray-900 transition-colors">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo_small_black.png') }}" alt="City Life International" class="h-6 w-6 object-contain">
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-6 lg:p-8">
            @yield('content')
        </main>
    </div>

</div>

</body>
</html>
