@extends('layouts.member')

@section('title', 'Rate ' . $course->title)

@section('content')

<div class="mx-auto max-w-xl py-8 px-4">

    {{-- Header --}}
    <div class="mb-8 text-center">
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-100 border border-emerald-200">
            <svg class="h-8 w-8 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h1 class="text-2xl font-extrabold text-gray-900">You've completed the course!</h1>
        <p class="mt-2 text-sm text-gray-500">
            How was <span class="font-semibold text-gray-700">{{ $course->title }}</span>? Take a moment to share your experience.
        </p>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">

        <form method="POST" action="{{ route('member.course.review.store', ['courseSlug' => $course->slug]) }}" x-data="{ rating: 0, hovered: 0 }">
            @csrf

            {{-- Star Rating --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-3">Your Rating <span class="text-red-500">*</span></label>

                <div class="flex items-center gap-2">
                    @for ($i = 1; $i <= 5; $i++)
                    <button
                        type="button"
                        @click="rating = {{ $i }}"
                        @mouseenter="hovered = {{ $i }}"
                        @mouseleave="hovered = 0"
                        class="focus:outline-none transition-transform hover:scale-110"
                        :title="'{{ $i }} star' + ({{ $i }} > 1 ? 's' : '')"
                    >
                        <svg
                            class="h-9 w-9 transition-colors"
                            :class="(hovered || rating) >= {{ $i }} ? 'text-amber-400' : 'text-gray-200'"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </button>
                    @endfor
                </div>

                <input type="hidden" name="rating" :value="rating">

                <p
                    class="mt-2 text-sm font-medium"
                    :class="{
                        'text-red-500': rating === 1,
                        'text-orange-400': rating === 2,
                        'text-amber-400': rating === 3,
                        'text-lime-500': rating === 4,
                        'text-emerald-600': rating === 5,
                        'text-gray-400': rating === 0,
                    }"
                    x-text="['Select a rating', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'][rating]"
                ></p>

                @error('rating')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Written Review --}}
            <div class="mb-6">
                <label for="body" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Your Review <span class="text-gray-400 font-normal">(optional)</span>
                </label>
                <textarea
                    id="body"
                    name="body"
                    rows="4"
                    maxlength="2000"
                    placeholder="What did you find most valuable? What could be improved?"
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-800 placeholder-gray-400 focus:border-[#e85d26] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#e85d26]/20 transition resize-none"
                >{{ old('body') }}</textarea>
                @error('body')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-between">
                <a
                    href="{{ route('member.courses') }}"
                    class="flex items-center justify-center rounded-full border border-gray-200 px-6 py-2.5 text-sm font-semibold text-gray-500 hover:bg-gray-50 transition-colors"
                >
                    Skip for now
                </a>
                <button
                    type="submit"
                    :disabled="rating === 0"
                    class="flex items-center justify-center gap-2 rounded-full bg-[#e85d26] px-6 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-[#cf4f1e] disabled:opacity-40 disabled:cursor-not-allowed"
                >
                    Submit Review
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </form>

    </div>

    <p class="mt-4 text-center text-xs text-gray-400">Reviews are reviewed by our team before being published.</p>

</div>

@endsection
