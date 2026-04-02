<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Student Login — City Life International</title>

    <!-- Fonts (matches frontend theme) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full min-h-screen bg-[#0f0f0f] font-sans antialiased flex flex-col">

    {{-- ── Top nav bar (mirrors site nav) ── --}}
    <nav class="bg-[#111111] border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-[#e85d26] rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-xs">CL</span>
                </div>
                <span class="font-semibold text-sm tracking-wide text-white">City Life <span class="text-gray-400 font-light">International</span></span>
            </a>
            <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-white transition-colors flex items-center gap-1.5">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to website
            </a>
        </div>
    </nav>

    {{-- ── Main content ── --}}
    <div class="flex flex-1 items-center justify-center px-4 py-16">
        <div class="w-full max-w-sm">

            {{-- Heading --}}
            <div class="text-center mb-8">
                <p class="text-[#e85d26] text-xs font-semibold uppercase tracking-widest mb-3">Bible School Portal</p>
                <h1 class="text-3xl font-extrabold text-white leading-tight">Welcome back</h1>
                <p class="text-gray-400 text-sm mt-2">Sign in to continue your learning journey.</p>
            </div>

            {{-- Card --}}
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8">

                @if (session('status'))
                    <div class="mb-5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 px-4 py-3 text-sm text-emerald-400">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('member.login.post') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">Email address</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required autofocus autocomplete="email"
                            class="w-full rounded-xl border @error('email') border-red-500/60 bg-red-500/10 @else border-white/10 bg-white/5 @enderror px-4 py-3 text-sm text-white placeholder-gray-500 focus:border-[#e85d26] focus:outline-none focus:ring-2 focus:ring-[#e85d26]/30 transition-colors"
                            placeholder="you@example.com"
                        />
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-1.5">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required autocomplete="current-password"
                            class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-gray-500 focus:border-[#e85d26] focus:outline-none focus:ring-2 focus:ring-[#e85d26]/30 transition-colors"
                            placeholder="••••••••"
                        />
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 text-sm text-gray-400 select-none cursor-pointer">
                            <input type="checkbox" name="remember" class="rounded border-white/20 bg-white/5 text-[#e85d26] focus:ring-[#e85d26]/30" />
                            Remember me
                        </label>
                    </div>

                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-4 py-3 text-sm font-semibold text-white transition-colors focus:outline-none focus:ring-2 focus:ring-[#e85d26]/50"
                    >
                        Sign in
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </form>
            </div>

            <p class="mt-6 text-center text-xs text-gray-600">
                Not a student yet?
                <a href="{{ route('courses') }}" class="text-gray-400 hover:text-white transition-colors">Browse our courses →</a>
            </p>
        </div>
    </div>

    {{-- ── Subtle footer ── --}}
    <footer class="py-6 text-center">
        <p class="text-xs text-gray-700">© {{ date('Y') }} City Life International. All rights reserved.</p>
    </footer>

</body>
</html>
