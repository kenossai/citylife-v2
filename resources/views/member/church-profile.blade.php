@extends('layouts.member')

@section('title', 'My Profile')

@section('content')

<div class="mb-8">
    <p class="text-[#e85d26] text-xs font-semibold uppercase tracking-widest mb-2">Church Information</p>
    <h1 class="text-2xl font-extrabold text-gray-900">Current Member Update</h1>
    <p class="text-gray-500 text-sm mt-1">Keep your details up to date — this information is synced with our church records.</p>
</div>

@if(session('church_profile_status'))
<div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 flex items-center gap-3">
    <svg class="h-5 w-5 shrink-0 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
    </svg>
    <p class="text-sm font-medium text-emerald-700">{{ session('church_profile_status') }}</p>
</div>
@endif

{{-- ── Avatar ── --}}
<div class="mb-6 rounded-2xl bg-white border border-gray-200 shadow-sm px-6 py-5"
     x-data="{ preview: '{{ $member->avatar_url ?? '' }}' }">
    <div class="flex items-center gap-5">
        <div class="relative shrink-0">
            <template x-if="preview">
                <img :src="preview" alt="Avatar"
                     class="h-20 w-20 rounded-2xl object-cover ring-2 ring-[#e85d26]/30">
            </template>
            <template x-if="!preview">
                <div class="h-20 w-20 rounded-2xl bg-[#e85d26] flex items-center justify-center text-white font-extrabold text-2xl uppercase select-none">
                    {{ substr($member->first_name, 0, 1) }}{{ substr($member->last_name, 0, 1) }}
                </div>
            </template>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-900">{{ $member->full_name }}</p>
            <p class="text-xs text-gray-400 mt-0.5">{{ $member->email }}</p>
            <form method="POST" action="{{ route('member.settings.avatar') }}"
                  enctype="multipart/form-data" id="cp-avatar-form" class="mt-2">
                @csrf
                <label class="cursor-pointer inline-flex items-center gap-1.5 text-xs font-semibold text-[#e85d26] hover:text-[#cf4f1e] transition-colors">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Change Avatar
                    <input type="file" name="avatar" accept="image/*" class="sr-only"
                           @change="
                               const file = $event.target.files[0];
                               if (file) {
                                   preview = URL.createObjectURL(file);
                                   $nextTick(() => document.getElementById('cp-avatar-form').submit());
                               }
                           ">
                </label>
            </form>
            @error('avatar')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
        </div>
    </div>
</div>

<form method="POST" action="{{ route('member.church-profile.update') }}">
    @csrf
    @method('PATCH')

    {{-- ── Personal Details ── --}}
    <div class="mb-6 rounded-2xl bg-white border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 pt-5 pb-4 border-b border-gray-100">
            <div class="flex items-center gap-2">
                <span class="text-base">👤</span>
                <h2 class="text-sm font-bold text-gray-900">Personal Details</h2>
            </div>
        </div>
        <div class="px-6 py-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                {{-- First Name --}}
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">First Name <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                            <svg class="h-3.5 w-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <input type="text" name="first_name" value="{{ old('first_name', $member->first_name) }}"
                               placeholder="First name"
                               class="w-full rounded-lg border @error('first_name') border-red-300 @else border-gray-200 @enderror bg-gray-50 pl-9 pr-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                    </div>
                    @error('first_name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                {{-- Last Name --}}
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" name="last_name" value="{{ old('last_name', $member->last_name) }}"
                           placeholder="Last name"
                           class="w-full rounded-lg border @error('last_name') border-red-300 @else border-gray-200 @enderror bg-gray-50 px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                    @error('last_name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                {{-- Sex --}}
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Sex</label>
                    <select name="gender"
                            class="w-full rounded-lg border @error('gender') border-red-300 @else border-gray-200 @enderror bg-gray-50 px-4 py-2.5 text-sm text-gray-800 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                        <option value="">–</option>
                        <option value="male"   {{ old('gender', $member->gender) === 'male'   ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $member->gender) === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other"  {{ old('gender', $member->gender) === 'other'  ? 'selected' : '' }}>Prefer not to say</option>
                    </select>
                    @error('gender')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                {{-- Marital Status --}}
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Marital Status <span class="text-red-500">*</span></label>
                    <select name="marital_status"
                            class="w-full rounded-lg border @error('marital_status') border-red-300 @else border-gray-200 @enderror bg-gray-50 px-4 py-2.5 text-sm text-gray-800 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                        <option value="">–</option>
                        @foreach(['single' => 'Single', 'married' => 'Married', 'divorced' => 'Divorced', 'widowed' => 'Widowed', 'separated' => 'Separated', 'prefer_not_to_say' => 'Prefer not to say'] as $val => $lbl)
                        <option value="{{ $val }}" {{ old('marital_status', $member->marital_status) === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                    @error('marital_status')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                {{-- Date of Birth --}}
                <div class="sm:col-span-2">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">
                        Date of Birth <span class="text-red-500">*</span>
                        <span class="normal-case font-normal tracking-normal text-gray-300 ml-1">(e.g {{ now()->format('d-m-Y') }})</span>
                    </label>
                    @php
                        $dob = old('date_of_birth')
                            ? \Carbon\Carbon::parse(old('date_of_birth'))
                            : $member->date_of_birth;
                    @endphp
                    <div class="flex gap-2">
                        <input type="number" name="dob_day" value="{{ $dob?->format('d') }}" placeholder="Day" min="1" max="31"
                               class="w-24 rounded-lg border @error('date_of_birth') border-red-300 @else border-gray-200 @enderror bg-gray-50 px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                        <input type="number" name="dob_month" value="{{ $dob?->format('m') }}" placeholder="Month" min="1" max="12"
                               class="w-24 rounded-lg border @error('date_of_birth') border-red-300 @else border-gray-200 @enderror bg-gray-50 px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                        <input type="number" name="dob_year" value="{{ $dob?->format('Y') }}" placeholder="Year" min="1900" max="{{ now()->year }}"
                               class="w-28 rounded-lg border @error('date_of_birth') border-red-300 @else border-gray-200 @enderror bg-gray-50 px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                    </div>
                    {{-- date_of_birth is assembled server-side from dob_day/month/year --}}
                    @error('date_of_birth')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Email Address <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                            <svg class="h-3.5 w-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input type="email" name="email" value="{{ old('email', $member->email) }}"
                               placeholder="your@email.com"
                               class="w-full rounded-lg border @error('email') border-red-300 @else border-gray-200 @enderror bg-gray-50 pl-9 pr-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                    </div>
                    @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                {{-- Mobile --}}
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Mobile <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                            <svg class="h-3.5 w-3.5 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </span>
                        <input type="tel" name="phone" value="{{ old('phone', $member->phone) }}"
                               placeholder="+44 7911 000000"
                               class="w-full rounded-lg border @error('phone') border-red-300 @else border-gray-200 @enderror bg-gray-50 pl-9 pr-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                    </div>
                    @error('phone')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

            </div>
        </div>
    </div>

    {{-- ── Communication Preferences ── --}}
    <div class="mb-6 rounded-2xl bg-white border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 pt-5 pb-4 border-b border-gray-100">
            <div class="flex items-center gap-2">
                <span class="text-base">📬</span>
                <h2 class="text-sm font-bold text-gray-900">Communication</h2>
            </div>
            <p class="text-xs text-gray-400 mt-0.5 ml-6">
                Select "Receive general email" for church email updates, or "Receive general SMS" for text updates.
                Please IGNORE the rota options.
            </p>
        </div>
        <div class="px-6 py-5 space-y-3">
            @foreach([
                ['field' => 'receive_general_email', 'label' => 'Receive general email'],
                ['field' => 'receive_general_sms',   'label' => 'Receive general SMS'],
                ['field' => 'receive_rota_email',    'label' => 'Receive rota reminder emails'],
                ['field' => 'receive_rota_sms',      'label' => 'Receive rota reminder SMS'],
            ] as $pref)
            <label class="flex items-center gap-3 cursor-pointer select-none">
                <input type="checkbox" name="{{ $pref['field'] }}" value="1"
                       {{ old($pref['field'], $member->{$pref['field']}) ? 'checked' : '' }}
                       class="h-4 w-4 rounded border-gray-300 text-[#e85d26] focus:ring-[#e85d26]">
                <span class="text-sm text-gray-700">{{ $pref['label'] }}</span>
            </label>
            @endforeach
        </div>
    </div>

    {{-- ── Address ── --}}
    <div class="mb-6 rounded-2xl bg-white border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 pt-5 pb-4 border-b border-gray-100">
            <div class="flex items-center gap-2">
                <span class="text-base">🏠</span>
                <h2 class="text-sm font-bold text-gray-900">Address <span class="text-red-500">*</span></h2>
            </div>
        </div>
        <div class="px-6 py-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div class="sm:col-span-2">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Line 1 <span class="text-red-500">*</span></label>
                    <input type="text" name="address" value="{{ old('address', $member->address) }}"
                           placeholder="Street address"
                           class="w-full rounded-lg border @error('address') border-red-300 @else border-gray-200 @enderror bg-gray-50 px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                    @error('address')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Line 2</label>
                    <input type="text" name="address_line_2" value="{{ old('address_line_2', $member->address_line_2) }}"
                           placeholder="Apartment, suite, etc. (optional)"
                           class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">City <span class="text-red-500">*</span></label>
                    <input type="text" name="city" value="{{ old('city', $member->city) }}"
                           placeholder="City"
                           class="w-full rounded-lg border @error('city') border-red-300 @else border-gray-200 @enderror bg-gray-50 px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                    @error('city')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">County</label>
                    <input type="text" name="county" value="{{ old('county', $member->county) }}"
                           placeholder="County"
                           class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Postcode <span class="text-red-500">*</span></label>
                    <input type="text" name="postcode" value="{{ old('postcode', $member->postcode) }}"
                           placeholder="Postcode"
                           class="w-full rounded-lg border @error('postcode') border-red-300 @else border-gray-200 @enderror bg-gray-50 px-4 py-2.5 text-sm text-gray-800 placeholder-gray-300 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                    @error('postcode')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Country <span class="text-red-500">*</span></label>
                    <select name="country"
                            class="w-full rounded-lg border @error('country') border-red-300 @else border-gray-200 @enderror bg-gray-50 px-4 py-2.5 text-sm text-gray-800 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition">
                        <option value="">– Please select –</option>
                        @foreach(['United Kingdom','United States','Canada','Australia','New Zealand','Ireland','Nigeria','Ghana','Kenya','South Africa','Jamaica','Trinidad and Tobago','India','Germany','France','Other'] as $c)
                        <option value="{{ $c }}" {{ old('country', $member->country ?? 'United Kingdom') === $c ? 'selected' : '' }}>{{ $c }}</option>
                        @endforeach
                    </select>
                    @error('country')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

            </div>
        </div>
    </div>

    {{-- ── Data Protection ── --}}
    <div class="mb-8 rounded-2xl bg-white border border-gray-200 shadow-sm px-6 py-5">
        <label class="flex items-start gap-3 cursor-pointer">
            <input type="checkbox" name="data_protection_accepted" value="1"
                   {{ old('data_protection_accepted', $member->data_protection_accepted) ? 'checked' : '' }}
                   class="mt-0.5 h-4 w-4 shrink-0 rounded border-gray-300 text-[#e85d26] focus:ring-[#e85d26] @error('data_protection_accepted') border-red-400 @enderror">
            <span class="text-sm text-gray-700">
                I accept your
                <a href="{{ route('privacy-policy') }}" target="_blank" class="font-semibold text-[#e85d26] underline hover:text-[#cf4f1e]">Data protection policy</a>
                <span class="text-red-500"> *</span>
            </span>
        </label>
        @error('data_protection_accepted')
        <p class="mt-2 ml-7 text-xs text-red-500">{{ $message }}</p>
        @enderror
        @if($member->data_protection_accepted_at)
        <p class="mt-2 ml-7 text-xs text-gray-400">Accepted on {{ $member->data_protection_accepted_at->format('j M Y') }}</p>
        @endif
    </div>

    {{-- Submit --}}
    <div class="flex justify-end">
        <button type="submit"
                class="inline-flex items-center rounded-full bg-[#e85d26] hover:bg-[#cf4f1e] px-8 py-2.5 text-sm font-semibold text-white transition-colors shadow-sm">
            Save Changes
        </button>
    </div>

</form>



@endsection

