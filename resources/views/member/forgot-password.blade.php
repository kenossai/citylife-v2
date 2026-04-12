<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Forgot Password — City Life International</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full min-h-screen bg-white font-sans antialiased flex flex-col">

    {{-- ── Top nav bar ── --}}
    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo_small_black.png') }}" alt="City Life International" class="h-10 w-auto object-contain">
            </a>
            <a href="{{ route('member.login') }}" class="text-sm text-[#e85d26] hover:text-[#e85d26]/80 transition-colors flex items-center gap-1.5">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to sign in
            </a>
        </div>
    </nav>

    {{-- ── Main content ── --}}
    <div class="flex flex-1 items-center justify-center px-4 py-16">
        <div class="w-full max-w-sm">

            {{-- Heading --}}
            <div class="text-center mb-8">
                <p class="text-[#e85d26] text-xs font-semibold uppercase tracking-widest mb-3">City Life International</p>
                <h1 class="text-3xl font-extrabold text-[#101828] leading-tight">Forgot your password?</h1>
                <p class="text-gray-500 text-sm mt-2">Enter your email and we'll send you a reset link.</p>
            </div>

            {{-- Card --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">

                @if (session('status'))
                    <div class="mb-5 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('member.password.email') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required autofocus autocomplete="email"
                            class="w-full rounded-xl border @error('email') border-red-400 bg-red-50 @else border-gray-200 bg-white @enderror px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-[#e85d26] focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition-colors"
                            placeholder="you@example.com"
                        />
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-4 py-3 text-sm font-semibold text-white transition-colors focus:outline-none focus:ring-2 focus:ring-[#e85d26]/40"
                    >
                        Send reset link
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <footer class="py-6 text-center">
        <p class="text-xs text-gray-300">© {{ date('Y') }} City Life International. All rights reserved.</p>
    </footer>

</body>
</html>
