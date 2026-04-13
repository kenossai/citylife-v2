@extends('layouts.app')

@section('title', 'Privacy Policy — City Life Int\'l Church')
@section('meta_description', 'Read the privacy policy of City Life International Church. We are committed to protecting your personal data in accordance with UK GDPR and the Data Protection Act 2018.')

@section('content')
<div class="bg-[#f6f3ee]">

    {{-- Hero --}}
    <section class="relative overflow-hidden bg-[#141117] pt-16">
        <div class="absolute inset-0 bg-gradient-to-b from-[#141117]/90 via-[#141117]/80 to-[#141117]"></div>
        <div class="relative mx-auto flex min-h-[240px] max-w-7xl flex-col items-center justify-center px-4 py-16 text-center sm:min-h-[280px] sm:px-6 lg:px-8">
            <p class="mb-3 text-[11px] font-semibold uppercase tracking-[0.35em] text-[#e85d26]">City Life Int'l Church</p>
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl">Privacy Policy</h1>
            <nav class="mt-4 flex items-center gap-2 text-xs uppercase tracking-[0.24em] text-white/65">
                <a href="{{ url('/') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white">Privacy Policy</span>
            </nav>
            <p class="mt-4 text-[12px] text-white/45">Last updated: April 2026</p>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-14 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Intro --}}
            <div class="rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <div class="mb-5 flex items-center gap-3">
                    <span class="h-px w-9 bg-[#e85d26]"></span>
                    <p class="text-[11px] font-bold uppercase tracking-[0.28em] text-[#e85d26]">Introduction</p>
                </div>
                <p class="text-[14px] leading-7 text-[#6a645e]">
                    City Life International Church (<strong class="text-[#1f1b22]">"CLIC"</strong>, <strong class="text-[#1f1b22]">"we"</strong>, <strong class="text-[#1f1b22]">"us"</strong>, or <strong class="text-[#1f1b22]">"our"</strong>) is committed to protecting your personal data and respecting your privacy. This policy explains how we collect, use, store, and share information about you when you visit our website, attend our events, or engage with our services.
                </p>
                <p class="mt-4 text-[14px] leading-7 text-[#6a645e]">
                    We process personal data in accordance with the <strong class="text-[#1f1b22]">UK General Data Protection Regulation (UK GDPR)</strong> and the <strong class="text-[#1f1b22]">Data Protection Act 2018</strong>. City Life International Church is the data controller for the purposes of this policy.
                </p>
                <div class="mt-5 rounded-xl bg-[#f7f4ef] px-5 py-4 text-[13px] leading-6 text-[#6a645e]">
                    <p><span class="font-bold text-[#1f1b22]">Data Controller:</span> City Life International Church</p>
                    <p class="mt-1"><span class="font-bold text-[#1f1b22]">Address:</span> 1 South Parade Shalesmoor, Sheffield, S3 8SS</p>
                    <p class="mt-1"><span class="font-bold text-[#1f1b22]">Email:</span> admin1@citylifecc.com</p>
                    <p class="mt-1"><span class="font-bold text-[#1f1b22]">Phone:</span> 0114 272 8243</p>
                </div>
            </div>

            {{-- What we collect --}}
            <div class="rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">Information We Collect</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">We may collect and process the following categories of personal data:</p>

                <div class="mt-5 space-y-4">
                    @php
                    $categories = [
                        [
                            'title' => 'Contact & Identity Information',
                            'desc'  => 'Name, email address, phone number, and postal address — collected when you submit a contact form, sign up for events, or get in touch with us directly.',
                        ],
                        [
                            'title' => 'Member Account Data',
                            'desc'  => 'Name, email address, password (hashed), course progress, lesson attendance, and communication preferences — collected when you register as a member or enrol on a course.',
                        ],
                        [
                            'title' => 'Financial & Gift Aid Information',
                            'desc'  => 'Name, address, and Gift Aid declaration status — collected when you make a donation and opt in to Gift Aid as required by HMRC.',
                        ],
                        [
                            'title' => 'Course Enrolment Data',
                            'desc'  => 'Course choices, enrolment status, quiz results, and certificates — collected as part of your participation in our online Bible school and course programmes.',
                        ],
                        [
                            'title' => 'Technical & Usage Data',
                            'desc'  => 'IP address, browser type, pages visited, and session information — collected automatically when you visit our website via cookies and server logs.',
                        ],
                    ];
                    @endphp
                    @foreach ($categories as $cat)
                        <div class="flex items-start gap-3">
                            <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-[#e85d26]"></span>
                            <div>
                                <p class="text-[14px] font-bold text-[#1f1b22]">{{ $cat['title'] }}</p>
                                <p class="mt-0.5 text-[13px] leading-6 text-[#6a645e]">{{ $cat['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- How we use it --}}
            <div class="rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">How We Use Your Information</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">We use your personal data for the following purposes and legal bases:</p>

                <div class="mt-5 overflow-hidden rounded-xl border border-[#ede5da]">
                    <table class="w-full text-sm">
                        <thead class="bg-[#f7f3ee]">
                            <tr>
                                <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-[0.18em] text-[#9e9a93]">Purpose</th>
                                <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-[0.18em] text-[#9e9a93]">Legal Basis</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#f0ebe3]">
                            @php
                            $uses = [
                                ['purpose' => 'Responding to contact form enquiries and prayer requests', 'basis' => 'Legitimate interests'],
                                ['purpose' => 'Managing member accounts and course enrolments', 'basis' => 'Contract / Consent'],
                                ['purpose' => 'Processing Gift Aid declarations and sending to HMRC', 'basis' => 'Legal obligation'],
                                ['purpose' => 'Sending event information and church communications', 'basis' => 'Consent'],
                                ['purpose' => 'Sending course access codes and session materials', 'basis' => 'Contract'],
                                ['purpose' => 'Improving our website and services', 'basis' => 'Legitimate interests'],
                                ['purpose' => 'Safeguarding and protection of children', 'basis' => 'Legal obligation / Vital interests'],
                            ];
                            @endphp
                            @foreach ($uses as $use)
                                <tr class="bg-white">
                                    <td class="px-5 py-3.5 text-[13px] text-[#1f1b22]">{{ $use['purpose'] }}</td>
                                    <td class="px-5 py-3.5 text-[13px] text-[#6a645e]">{{ $use['basis'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- How we share --}}
            <div class="rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">How We Share Your Information</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    We do not sell, rent, or trade your personal data. We may share it only in the following limited circumstances:
                </p>
                <ul class="mt-4 space-y-3">
                    @foreach ([
                        'Service providers who assist us in operating our website and delivering services (e.g. email delivery, cloud hosting) — bound by data processing agreements.',
                        'HMRC, where you have completed a Gift Aid declaration, as required by law.',
                        'Assemblies of God (AoG) UK head office, where required under our affiliation obligations (e.g. safeguarding referrals).',
                        'Statutory authorities such as Social Services or the Police, where we have a legal obligation or where there is a risk to life.',
                        'No personal data is transferred outside the UK without appropriate safeguards in place.',
                    ] as $point)
                        <li class="flex items-start gap-3">
                            <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#fff1ea] text-[#e85d26]">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                            <p class="text-[13px] leading-6 text-[#6a645e]">{{ $point }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Retention --}}
            <div class="rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">How Long We Keep Your Data</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    We retain personal data only for as long as necessary for the purpose it was collected or as required by law.
                </p>
                <ul class="mt-4 space-y-2.5">
                    @foreach ([
                        'Contact form enquiries — up to 2 years from last contact.',
                        'Member accounts — for the duration of your membership plus 1 year after closure.',
                        'Course records and certificates — up to 5 years.',
                        'Gift Aid records — 6 years as required by HMRC.',
                        'Safeguarding records — retained in line with statutory guidance, typically until a child\'s 25th birthday or for a minimum of 10 years.',
                    ] as $point)
                        <li class="flex items-start gap-2 text-[13px] leading-6 text-[#6a645e]">
                            <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-[#e85d26]"></span>
                            {{ $point }}
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Your rights --}}
            <div class="rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">Your Rights</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">Under UK GDPR you have the following rights in relation to your personal data:</p>

                <div class="mt-5 grid gap-3 sm:grid-cols-2">
                    @php
                    $rights = [
                        ['title' => 'Right of Access', 'desc' => 'Request a copy of the personal data we hold about you.'],
                        ['title' => 'Right to Rectification', 'desc' => 'Ask us to correct inaccurate or incomplete data.'],
                        ['title' => 'Right to Erasure', 'desc' => 'Request deletion of your data in certain circumstances.'],
                        ['title' => 'Right to Restriction', 'desc' => 'Ask us to limit how we use your data.'],
                        ['title' => 'Right to Portability', 'desc' => 'Receive your data in a structured, machine-readable format.'],
                        ['title' => 'Right to Object', 'desc' => 'Object to processing based on legitimate interests or for direct marketing.'],
                        ['title' => 'Right to Withdraw Consent', 'desc' => 'Where processing is based on consent, withdraw it at any time.'],
                        ['title' => 'Right to Complain', 'desc' => 'Lodge a complaint with the ICO at ico.org.uk or call 0303 123 1113.'],
                    ];
                    @endphp
                    @foreach ($rights as $right)
                        <div class="rounded-xl bg-[#f7f4ef] px-4 py-4">
                            <p class="text-[13px] font-bold text-[#1f1b22]">{{ $right['title'] }}</p>
                            <p class="mt-1 text-[12px] leading-5 text-[#6a645e]">{{ $right['desc'] }}</p>
                        </div>
                    @endforeach
                </div>

                <p class="mt-5 text-[13px] leading-6 text-[#6a645e]">
                    To exercise any of these rights, please contact us at <a href="mailto:admin1@citylifecc.com" class="font-semibold text-[#e85d26] hover:underline">admin1@citylifecc.com</a>. We will respond within one month.
                </p>
            </div>

            {{-- Security & Cookies --}}
            <div class="rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">Security &amp; Cookies</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    We implement appropriate technical and organisational measures to protect your personal data against unauthorised access, loss, or misuse. Our website uses HTTPS encryption and access to personal data is restricted to authorised staff only.
                </p>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    Our website uses cookies. For full details of the cookies we use and how to manage them, please see our
                    <a href="{{ url('/cookie-policy') }}" class="font-semibold text-[#e85d26] hover:underline">Cookie Policy</a>.
                </p>
            </div>

            {{-- Updates --}}
            <div class="rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">Changes to This Policy</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    We may update this Privacy Policy from time to time. The date at the top of this page will reflect when it was last revised. We encourage you to review this policy periodically.
                </p>
            </div>

        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-[#1a1b24] py-14 sm:py-16">
        <div class="mx-auto max-w-3xl px-4 text-center sm:px-6 lg:px-8">
            <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#ff8d63]">Questions?</p>
            <h2 class="mt-3 text-2xl font-extrabold text-white sm:text-3xl">We're Here to Help</h2>
            <p class="mx-auto mt-4 max-w-xl text-[14px] leading-7 text-white/65">
                If you have any questions about this Privacy Policy or how we handle your data, please get in touch.
            </p>
            <div class="mt-7 flex flex-wrap items-center justify-center gap-3">
                <a href="{{ url('/contact') }}" class="inline-flex items-center gap-2 rounded-full bg-[#e85d26] px-6 py-3 text-[13px] font-semibold text-white transition-colors hover:bg-[#cf4f1e]">
                    Contact Us
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="{{ url('/cookie-policy') }}" class="inline-flex items-center gap-2 rounded-full border border-white/20 px-6 py-3 text-[13px] font-semibold text-white transition-colors hover:border-white hover:bg-white/8">
                    Cookie Policy
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
