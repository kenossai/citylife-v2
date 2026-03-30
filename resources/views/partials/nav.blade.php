@php
    $desktopLinkClass = function (bool $active): string {
        return $active
            ? 'text-[#e85d26]'
            : 'text-gray-300 hover:text-white transition-colors';
    };

    $mobileLinkClass = function (bool $active): string {
        return $active
            ? 'block py-1 text-[#e85d26]'
            : 'block py-1 text-gray-300 hover:text-white';
    };
@endphp

<nav class="fixed top-0 left-0 right-0 z-50 bg-[#111111] text-white" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-[#e85d26] rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-xs">CL</span>
                </div>
                <span class="font-semibold text-sm tracking-wide">City Life <span class="text-gray-400 font-light">International</span></span>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden lg:flex items-center gap-6 text-sm">
                <a href="{{ url('/') }}" class="{{ $desktopLinkClass(request()->routeIs('home')) }}">Home</a>
                <a href="{{ url('/about-citylife') }}" class="{{ $desktopLinkClass(request()->routeIs('about')) }}">About Us</a>
                <a href="{{ url('/missions') }}" class="{{ $desktopLinkClass(request()->routeIs('missions')) }}">Missions</a>
                <a href="{{ url('/our-ministries') }}" class="{{ $desktopLinkClass(request()->routeIs('ministries')) }}">Ministries</a>
                <a href="{{ route('media') }}" class="{{ $desktopLinkClass(request()->routeIs('media') || request()->routeIs('sermons')) }}">Media</a>

                {{-- Resources Dropdown --}}
                <div class="relative" x-data="{ resOpen: false }" @mouseenter="resOpen = true" @mouseleave="resOpen = false">
                    <button class="text-gray-300 hover:text-white transition-colors flex items-center gap-1">
                        Resources
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="resOpen" x-transition class="absolute top-full left-0 mt-1 w-44 bg-white text-gray-800 rounded shadow-lg py-2 text-sm">
                        <a href="{{ url('/courses') }}" class="block px-4 py-2 hover:bg-gray-50">Courses</a>
                        <a href="{{ url('/giving') }}" class="block px-4 py-2 hover:bg-gray-50">Giving</a>
                        <a href="{{ url('/news') }}" class="block px-4 py-2 hover:bg-gray-50">News</a>
                    </div>
                </div>

                <a href="{{ url('/events') }}" class="text-gray-300 hover:text-white transition-colors">Events</a>
                <a href="{{ url('/contact') }}" class="text-gray-300 hover:text-white transition-colors">Contact Us</a>
            </div>

            {{-- Give Button --}}
            <div class="hidden lg:flex items-center gap-3">
                <a href="{{ url('/giving') }}"
                   class="bg-[#e85d26] hover:bg-[#cf4f1e] text-white text-sm font-semibold px-5 py-2 rounded-full transition-colors">
                    Give Online
                </a>
            </div>

            {{-- Mobile hamburger --}}
            <button @click="open = !open" class="lg:hidden text-gray-300 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open" x-transition class="lg:hidden bg-[#1a1a1a] border-t border-gray-800 px-4 py-4 space-y-3 text-sm">
        <a href="{{ url('/') }}" class="{{ $mobileLinkClass(request()->routeIs('home')) }}">Home</a>
        <a href="{{ url('/about-citylife') }}" class="{{ $mobileLinkClass(request()->routeIs('about')) }}">About Us</a>
        <a href="{{ url('/missions') }}" class="{{ $mobileLinkClass(request()->routeIs('missions')) }}">Missions</a>
        <a href="{{ url('/our-ministry') }}" class="block text-gray-300 hover:text-white py-1">Ministries</a>
        <a href="{{ route('media') }}" class="{{ $mobileLinkClass(request()->routeIs('media') || request()->routeIs('sermons')) }}">Media</a>
        <a href="{{ url('/courses') }}" class="block text-gray-300 hover:text-white py-1">Courses</a>
        <a href="{{ url('/books') }}" class="block text-gray-300 hover:text-white py-1">Books</a>
        <a href="{{ url('/events') }}" class="block text-gray-300 hover:text-white py-1">Events</a>
        <a href="{{ url('/news') }}" class="block text-gray-300 hover:text-white py-1">News</a>
        <a href="{{ url('/contact') }}" class="block text-gray-300 hover:text-white py-1">Contact Us</a>
        <a href="{{ url('/giving') }}" class="inline-block mt-2 bg-[#e85d26] text-white font-semibold px-5 py-2 rounded-full">Give Online</a>
    </div>
</nav>

{{-- Alpine.js --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
