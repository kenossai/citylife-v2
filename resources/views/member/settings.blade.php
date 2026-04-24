@extends('layouts.member')

@section('title', 'Settings')

@section('content')

{{-- ── Page heading ── --}}
<div class="mb-8">
    <p class="text-[#e85d26] text-xs font-semibold uppercase tracking-widest mb-2">Bible School</p>
    <h1 class="text-2xl font-extrabold text-gray-900">Settings</h1>
    <p class="text-gray-500 text-sm mt-1">Manage your profile, notifications and account preferences.</p>
</div>

{{-- ════════════════════════════════════════════
     2. CHANGE PASSWORD
═════════════════════════════════════════════ --}}
{{-- ════════════════════════════════════════════
     CHANGE PASSWORD
═════════════════════════════════════════════ --}}
<div class="mb-6 rounded-2xl bg-white border border-gray-200 shadow-sm overflow-hidden">
    <div class="px-6 pt-5 pb-4 border-b border-gray-100">
        <div class="flex items-center gap-2">
            <span class="text-base">🔑</span>
            <h2 class="text-sm font-bold text-gray-900">Change Password</h2>
        </div>
        <p class="text-xs text-gray-400 mt-0.5 ml-6">Keep your account secure with a strong password</p>
    </div>

    <div class="px-6 py-5">
        @if(session('password_status'))
        <div class="mb-4 flex items-center gap-2 rounded-lg bg-emerald-50 border border-emerald-200 px-4 py-2.5 text-sm text-emerald-700">
            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('password_status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('member.settings.password') }}" x-data="{ show: false }">
            @csrf
            @method('PATCH')

            <div class="space-y-4">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Current Password</label>
                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                            <svg class="h-3.5 w-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input :type="show ? 'text' : 'password'" name="current_password"
                               placeholder="Enter current password"
                               class="w-full rounded-lg border @error('current_password') border-red-300 @else border-gray-200 @enderror bg-gray-50 pl-9 pr-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                    </div>
                    @error('current_password')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">New Password</label>
                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                            <svg class="h-3.5 w-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input :type="show ? 'text' : 'password'" name="password"
                               placeholder="At least 8 characters"
                               class="w-full rounded-lg border @error('password') border-red-300 @else border-gray-200 @enderror bg-gray-50 pl-9 pr-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                    </div>
                    @error('password')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Confirm New Password</label>
                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                            <svg class="h-3.5 w-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input :type="show ? 'text' : 'password'" name="password_confirmation"
                               placeholder="Repeat new password"
                               class="w-full rounded-lg border border-gray-200 bg-gray-50 pl-9 pr-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                    </div>
                </div>
            </div>

            <div class="mt-5 flex items-center justify-between">
                <label class="flex cursor-pointer items-center gap-2 text-xs text-gray-500 select-none">
                    <input type="checkbox" @change="show = $event.target.checked" class="h-3.5 w-3.5 rounded border-gray-300 text-[#e85d26] focus:ring-[#e85d26]">
                    Show passwords
                </label>
                <button type="submit"
                        class="inline-flex items-center rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-6 py-2.5 text-sm font-semibold text-white transition-colors shadow-sm">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ════════════════════════════════════════════
     3. NOTIFICATIONS
═════════════════════════════════════════════ --}}
<div class="mb-6 rounded-2xl bg-white border border-gray-200 shadow-sm overflow-hidden">
    <div class="px-6 pt-5 pb-4 border-b border-gray-100">
        <div class="flex items-center gap-2">
            <span class="text-base">🔔</span>
            <h2 class="text-sm font-bold text-gray-900">Notifications</h2>
        </div>
        <p class="text-xs text-gray-400 mt-0.5 ml-6">Control how and when we contact you</p>
    </div>

    <div class="px-6 py-2">
        @if(session('notifications_status'))
        <div class="mt-3 flex items-center gap-2 rounded-lg bg-emerald-50 border border-emerald-200 px-4 py-2.5 text-sm text-emerald-700">
            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('notifications_status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('member.settings.notifications') }}" x-data id="notif-form">
            @csrf
            @method('PATCH')

            @php
                $toggleItems = [
                    ['key' => 'notify_study_reminders', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => 'Email study reminders', 'desc' => "Get reminded when you haven't studied in a while"],
                    ['key' => 'notify_quiz_results', 'icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9', 'label' => 'Quiz result notifications', 'desc' => 'Be notified when quiz results are available'],
                    ['key' => 'notify_weekly_digest', 'icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9', 'label' => 'Weekly progress digest', 'desc' => 'Receive a summary of your weekly learning activity'],
                ];
            @endphp

            @foreach($toggleItems as $item)
            <div class="flex items-center justify-between py-4 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gray-100">
                        <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ $item['label'] }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $item['desc'] }}</p>
                    </div>
                </div>

                {{-- Toggle switch --}}
                <label class="relative ml-4 inline-flex cursor-pointer items-center shrink-0">
                    <input type="checkbox" name="{{ $item['key'] }}" value="1"
                           @checked((bool) $member->{$item['key']})
                           class="peer sr-only"
                           onchange="document.getElementById('notif-form').requestSubmit()">
                    <div class="h-6 w-11 rounded-full bg-gray-200 peer-focus:ring-2 peer-focus:ring-[#e85d26]/30 peer-checked:bg-[#e85d26] transition-colors after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:bg-white after:shadow after:transition-all peer-checked:after:translate-x-5"></div>
                </label>
            </div>
            @endforeach
        </form>
    </div>
</div>

{{-- ════════════════════════════════════════════
     4. PRIVACY & ACCOUNT
═════════════════════════════════════════════ --}}
<div class="mb-6 rounded-2xl bg-white border border-gray-200 shadow-sm overflow-hidden">
    <div class="px-6 pt-5 pb-4 border-b border-gray-100">
        <div class="flex items-center gap-2">
            <span class="text-base">🔒</span>
            <h2 class="text-sm font-bold text-gray-900">Privacy &amp; Account</h2>
        </div>
        <p class="text-xs text-gray-400 mt-0.5 ml-6">Data and account management</p>
    </div>

    <div class="divide-y divide-gray-100">
        <a href="#" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition-colors group">
            <div class="flex items-center gap-3">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gray-100">
                    <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Privacy Policy</p>
                    <p class="text-xs text-gray-400">Read our data privacy policy</p>
                </div>
            </div>
            <svg class="h-4 w-4 text-gray-300 group-hover:text-gray-500 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        <a href="#" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition-colors group">
            <div class="flex items-center gap-3">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gray-100">
                    <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Terms of Service</p>
                    <p class="text-xs text-gray-400">Review terms and conditions</p>
                </div>
            </div>
            <svg class="h-4 w-4 text-gray-300 group-hover:text-gray-500 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        <a href="#" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition-colors group">
            <div class="flex items-center gap-3">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gray-100">
                    <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">Download My Data</p>
                    <p class="text-xs text-gray-400">Export all your course data and notes</p>
                </div>
            </div>
            <svg class="h-4 w-4 text-gray-300 group-hover:text-gray-500 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        {{-- Danger zone --}}
        <div class="px-6 py-5">
            <p class="text-xs font-bold uppercase tracking-widest text-red-500 mb-3">Danger Zone</p>

            <div x-data="{ open: false }">
                <button @click="open = true" type="button"
                        class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-100 transition-colors">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Delete My Account
                </button>
                <p class="mt-2 text-xs text-gray-400">This action is permanent and cannot be undone.</p>

                {{-- Confirmation modal --}}
                <div x-show="open" x-cloak
                     class="fixed inset-0 z-50 flex items-center justify-center p-4"
                     @keydown.escape.window="open = false">
                    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="open = false"></div>
                    <div class="relative w-full max-w-md rounded-2xl bg-white shadow-2xl p-6" @click.stop>
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-red-100 mb-4">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-900 mb-1">Delete your account?</h3>
                        <p class="text-sm text-gray-500 mb-4">This will permanently delete your account, course progress, and all data. This cannot be undone.</p>

                        <form method="POST" action="{{ route('member.settings.delete-account') }}">
                            @csrf
                            @method('DELETE')
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                                Type <span class="font-mono font-bold text-red-600">DELETE</span> to confirm
                            </label>
                            <input type="text" name="confirm_delete" autocomplete="off"
                                   placeholder="DELETE"
                                   class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm placeholder-gray-300 focus:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-200 transition mb-4">
                            @error('confirm_delete')
                            <p class="mb-3 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                            <div class="flex gap-3 justify-end">
                                <button type="button" @click="open = false"
                                        class="rounded-full border border-gray-200 bg-white px-5 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                                    Cancel
                                </button>
                                <button type="submit"
                                        class="rounded-full bg-red-600 hover:bg-red-700 px-5 py-2 text-sm font-semibold text-white transition-colors">
                                    Yes, delete my account
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
