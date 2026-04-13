@extends('layouts.app')

@section('title', 'Cookie Policy — City Life Int\'l Church')
@section('meta_description', 'Read the cookie policy of City Life International Church. Find out what cookies we use on our website and how to manage your preferences.')

@section('content')
<div class="bg-[#f6f3ee]">

    {{-- Hero --}}
    <section class="relative overflow-hidden bg-[#141117] pt-16">
        <div class="absolute inset-0 bg-gradient-to-b from-[#141117]/90 via-[#141117]/80 to-[#141117]"></div>
        <div class="relative mx-auto flex min-h-[240px] max-w-7xl flex-col items-center justify-center px-4 py-16 text-center sm:min-h-[280px] sm:px-6 lg:px-8">
            <p class="mb-3 text-[11px] font-semibold uppercase tracking-[0.35em] text-[#e85d26]">City Life Int'l Church</p>
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl">Cookie Policy</h1>
            <nav class="mt-4 flex items-center gap-2 text-xs uppercase tracking-[0.24em] text-white/65">
                <a href="{{ url('/') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white">Cookie Policy</span>
            </nav>
            <p class="mt-4 text-[12px] text-white/45">Last updated: April 2026</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-14 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- What are cookies --}}
            <div class="rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <div class="mb-5 flex items-center gap-3">
                    <span class="h-px w-9 bg-[#e85d26]"></span>
                    <p class="text-[11px] font-bold uppercase tracking-[0.28em] text-[#e85d26]">Introduction</p>
                </div>
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">What Are Cookies?</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    Cookies are small text files placed on your device when you visit a website. They are widely used to make websites work efficiently, remember your preferences, and provide information to website owners.
                </p>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    This policy explains what cookies we use on the City Life International Church website (<strong class="text-[#1f1b22]">citylifecc.com</strong>), why we use them, and how you can control them. It should be read alongside our <a href="{{ url('/privacy-policy') }}" class="font-semibold text-[#e85d26] hover:underline">Privacy Policy</a>.
                </p>
            </div>

            {{-- Cookie types table --}}
            <div class="rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">Cookies We Use</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">We use the following categories of cookies:</p>

                <div class="mt-6 space-y-5">

                    {{-- Strictly Necessary --}}
                    <div class="overflow-hidden rounded-xl border border-[#ede5da]">
                        <div class="flex items-center gap-3 border-b border-[#ede5da] bg-[#f7f4ef] px-5 py-3.5">
                            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#17141a] text-[10px] font-extrabold text-white">1</span>
                            <h3 class="text-[13px] font-extrabold uppercase tracking-[0.16em] text-[#1f1b22]">Strictly Necessary Cookies</h3>
                            <span class="ml-auto rounded-full bg-[#e6f4ea] px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-[#2e7d32]">Always Active</span>
                        </div>
                        <div class="px-5 py-4">
                            <p class="text-[13px] leading-6 text-[#6a645e]">
                                These cookies are essential for the website to function. They enable core features such as page navigation, secure areas, and session management. The website cannot function properly without them.
                            </p>
                            <div class="mt-4 overflow-x-auto">
                                <table class="w-full min-w-[480px] text-[12px]">
                                    <thead>
                                        <tr class="border-b border-[#f0ebe3]">
                                            <th class="pb-2 pr-4 text-left font-bold text-[#9e9a93] uppercase tracking-wider">Cookie Name</th>
                                            <th class="pb-2 pr-4 text-left font-bold text-[#9e9a93] uppercase tracking-wider">Purpose</th>
                                            <th class="pb-2 text-left font-bold text-[#9e9a93] uppercase tracking-wider">Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-[#f7f4ef]">
                                        <tr>
                                            <td class="py-2 pr-4 font-mono text-[#1f1b22]">citylifecc_session</td>
                                            <td class="py-2 pr-4 text-[#6a645e]">Maintains your user session across pages</td>
                                            <td class="py-2 text-[#6a645e]">Session</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pr-4 font-mono text-[#1f1b22]">XSRF-TOKEN</td>
                                            <td class="py-2 pr-4 text-[#6a645e]">Protects against cross-site request forgery (CSRF) attacks</td>
                                            <td class="py-2 text-[#6a645e]">Session</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pr-4 font-mono text-[#1f1b22]">remember_web_*</td>
                                            <td class="py-2 pr-4 text-[#6a645e]">Keeps you logged in to your member account if you choose "remember me"</td>
                                            <td class="py-2 text-[#6a645e]">400 days</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pr-4 font-mono text-[#1f1b22]">member_session</td>
                                            <td class="py-2 pr-4 text-[#6a645e]">Manages your member portal session</td>
                                            <td class="py-2 text-[#6a645e]">Session</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Functional --}}
                    <div class="overflow-hidden rounded-xl border border-[#ede5da]">
                        <div class="flex items-center gap-3 border-b border-[#ede5da] bg-[#f7f4ef] px-5 py-3.5">
                            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#17141a] text-[10px] font-extrabold text-white">2</span>
                            <h3 class="text-[13px] font-extrabold uppercase tracking-[0.16em] text-[#1f1b22]">Functional Cookies</h3>
                            <span class="ml-auto rounded-full bg-[#fff8e1] px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-[#f57f17]">Optional</span>
                        </div>
                        <div class="px-5 py-4">
                            <p class="text-[13px] leading-6 text-[#6a645e]">
                                These cookies enable enhanced functionality and personalisation. They may be set by us or by third-party providers whose services we use on our pages.
                            </p>
                            <div class="mt-4 overflow-x-auto">
                                <table class="w-full min-w-[480px] text-[12px]">
                                    <thead>
                                        <tr class="border-b border-[#f0ebe3]">
                                            <th class="pb-2 pr-4 text-left font-bold text-[#9e9a93] uppercase tracking-wider">Cookie Name</th>
                                            <th class="pb-2 pr-4 text-left font-bold text-[#9e9a93] uppercase tracking-wider">Purpose</th>
                                            <th class="pb-2 text-left font-bold text-[#9e9a93] uppercase tracking-wider">Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-[#f7f4ef]">
                                        <tr>
                                            <td class="py-2 pr-4 font-mono text-[#1f1b22]">flash_message</td>
                                            <td class="py-2 pr-4 text-[#6a645e]">Stores one-time notification messages after form submissions</td>
                                            <td class="py-2 text-[#6a645e]">Session</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pr-4 font-mono text-[#1f1b22]">session_access_*</td>
                                            <td class="py-2 pr-4 text-[#6a645e]">Manages temporary access codes for Bible school sessions</td>
                                            <td class="py-2 text-[#6a645e]">Session</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Analytics --}}
                    <div class="overflow-hidden rounded-xl border border-[#ede5da]">
                        <div class="flex items-center gap-3 border-b border-[#ede5da] bg-[#f7f4ef] px-5 py-3.5">
                            <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#17141a] text-[10px] font-extrabold text-white">3</span>
                            <h3 class="text-[13px] font-extrabold uppercase tracking-[0.16em] text-[#1f1b22]">Analytics Cookies</h3>
                            <span class="ml-auto rounded-full bg-[#fff8e1] px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-[#f57f17]">Optional</span>
                        </div>
                        <div class="px-5 py-4">
                            <p class="text-[13px] leading-6 text-[#6a645e]">
                                These cookies help us understand how visitors interact with our website by collecting and reporting information anonymously. This helps us improve the content and experience we offer.
                            </p>
                            <p class="mt-3 text-[13px] leading-6 text-[#6a645e]">
                                We may use Google Analytics or a similar service. If enabled, these cookies are set by the analytics provider and information may be transferred to their servers. You can opt out via your browser settings or the analytics provider's opt-out tool.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Managing cookies --}}
            <div class="rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">Managing Your Cookie Preferences</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    You can control and manage cookies in several ways. Please be aware that removing or blocking cookies may impact your experience on our website, particularly features that require being logged in.
                </p>

                <div class="mt-5 grid gap-4 sm:grid-cols-2">
                    @php
                    $browsers = [
                        ['name' => 'Google Chrome',  'url' => 'https://support.google.com/chrome/answer/95647'],
                        ['name' => 'Mozilla Firefox', 'url' => 'https://support.mozilla.org/en-US/kb/enable-and-disable-cookies-website-preferences'],
                        ['name' => 'Safari',          'url' => 'https://support.apple.com/en-gb/guide/safari/sfri11471/mac'],
                        ['name' => 'Microsoft Edge',  'url' => 'https://support.microsoft.com/en-us/windows/manage-cookies-in-microsoft-edge-view-allow-block-delete-and-use-168dab11-0753-043d-7c16-ede5947fc64d'],
                    ];
                    @endphp
                    @foreach ($browsers as $browser)
                        <a
                            href="{{ $browser['url'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex items-center justify-between rounded-xl border border-[#ede5da] bg-[#f7f4ef] px-4 py-3.5 text-[13px] font-semibold text-[#1f1b22] transition-colors hover:border-[#e85d26] hover:text-[#e85d26]"
                        >
                            {{ $browser['name'] }}
                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    @endforeach
                </div>

                <p class="mt-5 text-[13px] leading-6 text-[#6a645e]">
                    You can also visit <a href="https://www.allaboutcookies.org" target="_blank" rel="noopener noreferrer" class="font-semibold text-[#e85d26] hover:underline">allaboutcookies.org</a> for comprehensive guidance on managing cookies across all browsers and devices.
                </p>
            </div>

            {{-- Third party --}}
            <div class="rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">Third-Party Content</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    Our website may include embedded content from third-party services such as YouTube (for sermon videos), Google Maps, or social media platforms. These services may set their own cookies when you interact with embedded content. We have no control over third-party cookies — please refer to each provider's own privacy and cookie policy for details.
                </p>
            </div>

            {{-- Updates --}}
            <div class="rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">Changes to This Policy</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    We may update this Cookie Policy from time to time to reflect changes in technology or legislation. The date at the top of this page shows when it was last revised. Continued use of our website after any changes constitutes your acceptance of the updated policy.
                </p>
            </div>

        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-[#1a1b24] py-14 sm:py-16">
        <div class="mx-auto max-w-3xl px-4 text-center sm:px-6 lg:px-8">
            <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#ff8d63]">Questions?</p>
            <h2 class="mt-3 text-2xl font-extrabold text-white sm:text-3xl">Still Not Sure?</h2>
            <p class="mx-auto mt-4 max-w-xl text-[14px] leading-7 text-white/65">
                If you have any questions about how we use cookies or your personal data, please don't hesitate to contact us.
            </p>
            <div class="mt-7 flex flex-wrap items-center justify-center gap-3">
                <a href="{{ url('/contact') }}" class="inline-flex items-center gap-2 rounded-full bg-[#e85d26] px-6 py-3 text-[13px] font-semibold text-white transition-colors hover:bg-[#cf4f1e]">
                    Contact Us
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="{{ url('/privacy-policy') }}" class="inline-flex items-center gap-2 rounded-full border border-white/20 px-6 py-3 text-[13px] font-semibold text-white transition-colors hover:border-white hover:bg-white/8">
                    Privacy Policy
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
