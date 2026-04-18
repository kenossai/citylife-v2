<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Create Your Password — City Life International</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="h-full min-h-screen bg-white font-sans antialiased flex flex-col">

    {{-- Nav --}}
    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo_small_black.png') }}" alt="City Life International" class="h-14 w-auto object-contain">
            </a>
        </div>
    </nav>

    {{-- Main --}}
    <div class="flex flex-1 items-center justify-center px-4 py-16">
        <div class="w-full max-w-sm">

            {{-- Heading --}}
            <div class="text-center mb-8">
                <p class="text-[#e85d26] text-xs font-semibold uppercase tracking-widest mb-3">Member Portal</p>
                <h1 class="text-3xl font-extrabold text-gray-900 leading-tight">Create your password</h1>
                <p class="text-gray-500 text-sm mt-2">
                    Hi {{ $member->first_name }}, set a password to access your course dashboard.
                </p>
            </div>

            {{-- Card --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">

                <form method="POST" action="{{ route('member.setup-password.store', $token) }}" class="space-y-5" x-data="{ show: false }">
                    @csrf

                    {{-- Email (read-only, for context) --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1.5">Email address</label>
                        <div class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-500 select-none">
                            {{ $member->email }}
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">New password</label>
                        <div class="relative">
                            <input
                                :type="show ? 'text' : 'password'"
                                id="password"
                                name="password"
                                required autocomplete="new-password"
                                class="w-full rounded-xl border @error('password') border-red-400 bg-red-50 @else border-gray-200 bg-white @enderror px-4 py-3 pr-11 text-sm text-gray-900 placeholder-gray-400 focus:border-[#e85d26] focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition-colors"
                                placeholder="Min. 8 characters"
                            />
                            <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg x-show="!show" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="show" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Confirm password</label>
                        <input
                            :type="show ? 'text' : 'password'"
                            id="password_confirmation"
                            name="password_confirmation"
                            required autocomplete="new-password"
                            class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-[#e85d26] focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition-colors"
                            placeholder="Repeat your password"
                        />
                    </div>

                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-4 py-3 text-sm font-semibold text-white transition-colors focus:outline-none focus:ring-2 focus:ring-[#e85d26]/40"
                    >
                        Create Password &amp; Go to Dashboard
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <footer class="py-6 text-center">
        <p class="text-xs text-gray-400">© {{ date('Y') }} City Life International. All rights reserved.</p>
    </footer>

</body>
</html>
