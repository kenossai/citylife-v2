@extends('layouts.app')

@section('title', 'Safeguarding Policy — City Life Int\'l Church')
@section('meta_description', 'Read the safeguarding policy of City Life International Church. We are committed to the safety and protection of all children and young people in our care.')

@section('content')
<div class="bg-[#f6f3ee]">

    {{-- Hero --}}
    <section class="relative overflow-hidden bg-[#141117] pt-16">
        <div class="absolute inset-0">
            <img
                src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1800&q=80"
                alt="Safeguarding"
                class="h-full w-full object-cover object-center opacity-25"
            >
            <div class="absolute inset-0 bg-gradient-to-b from-[#141117]/80 via-[#141117]/70 to-[#141117]"></div>
        </div>

        <div class="relative mx-auto flex min-h-[260px] max-w-7xl flex-col items-center justify-center px-4 py-16 text-center sm:min-h-[300px] sm:px-6 lg:px-8">
            <p class="mb-3 text-[11px] font-semibold uppercase tracking-[0.35em] text-[#e85d26]">City Life Int'l Church</p>
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl">Safeguarding Policy</h1>
            <nav class="mt-4 flex items-center gap-2 text-xs uppercase tracking-[0.24em] text-white/65">
                <a href="{{ url('/') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white">Safeguarding</span>
            </nav>
        </div>
    </section>

    {{-- Intro statement --}}
    <section class="bg-white py-14 sm:py-16">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="mb-5 flex items-center gap-3">
                <span class="h-px w-9 bg-[#e85d26]"></span>
                <p class="text-[11px] font-bold uppercase tracking-[0.28em] text-[#e85d26]">Our Commitment</p>
            </div>
            <h2 class="text-2xl font-extrabold leading-snug text-[#1f1b22] sm:text-3xl">
                The Safety of Every Child Is Our Priority
            </h2>
            <p class="mt-4 text-[15px] leading-7 text-[#6a645e]">
                At City Life International Church (CLIC), we are committed to the safety, protection, and well-being of all children and young people in our care. This policy sets out the procedures we follow to safeguard every person who participates in our activities.
            </p>
        </div>
    </section>

    {{-- Main content --}}
    <section class="bg-[#f6f3ee] py-14 sm:py-16 lg:py-20">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 space-y-12">

            {{-- Designated Persons --}}
            <div id="designated-persons" class="scroll-mt-20 rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">Designated Persons</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    The Church Trustee(s) have designated the following Life Group leads to receive any report, suspicion, or allegation of abuse. They will assess information and pass all reports to the Designated Safeguarding Lead and/or Senior Minister — they will not investigate independently.
                </p>

                <div class="mt-6 overflow-hidden rounded-xl border border-[#ede5da]">
                    <table class="w-full text-sm">
                        <thead class="bg-[#f7f3ee]">
                            <tr>
                                <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-[0.2em] text-[#9e9a93]">Life Group</th>
                                <th class="px-5 py-3 text-left text-[11px] font-bold uppercase tracking-[0.2em] text-[#9e9a93]">Lead(s)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#f0ebe3]">
                            <tr class="bg-white">
                                <td class="px-5 py-3.5 font-semibold text-[#1f1b22]">Sunday School</td>
                                <td class="px-5 py-3.5 text-[#6a645e]">Abbi Pinnock &amp; Donna Pinnock</td>
                            </tr>
                            <tr class="bg-white">
                                <td class="px-5 py-3.5 font-semibold text-[#1f1b22]">Creche</td>
                                <td class="px-5 py-3.5 text-[#6a645e]">Rebecca Cartledge</td>
                            </tr>
                            <tr class="bg-white">
                                <td class="px-5 py-3.5 font-semibold text-[#1f1b22]">Youth</td>
                                <td class="px-5 py-3.5 text-[#6a645e]">Zoe &amp; Steve Hardy</td>
                            </tr>
                            <tr class="bg-white">
                                <td class="px-5 py-3.5 font-semibold text-[#1f1b22]">Make Lunch / Pre-Loved Uniform</td>
                                <td class="px-5 py-3.5 text-[#6a645e]">Ps Terence &amp; Vivienne Williams</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 rounded-xl bg-[#fff8f4] px-5 py-4 text-[13px] leading-6 text-[#6a645e] ring-1 ring-[#f5d9c8]">
                    <p><span class="font-bold text-[#1f1b22]">Senior Minister:</span> Ps Jim Master. In his absence, all matters are passed to Chris Thompson.</p>
                    <p class="mt-2">If an allegation involves the Designated Safeguarding Lead, it must be reported directly to the Senior Minister. If the allegation is against a minister, Assemblies of God procedures must be followed and head office informed. Where necessary, consultation with the Sheffield Children's Safeguarding team and a formal referral to Social Services or the Police will be made.</p>
                </div>
            </div>

            {{-- Responding to Concerns --}}
            <div id="responding" class="scroll-mt-20 rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">Responding to Concerns</h2>
                <ul class="mt-4 space-y-3">
                    @foreach ([
                        'The individual raising a concern speaks to the Life Group Lead, who passes all written concerns or allegations to the Designated Safeguarding Lead.',
                        'Parents should normally be contacted and their agreement sought before Social Services is contacted.',
                        'Parents need not be contacted if doing so would put a child at increased risk of harm, interfere with criminal enquiries, or place a team member at risk — the Designated Safeguarding Lead must agree.',
                        'All notes must be signed and dated. Original notes must never be destroyed, even if a subsequent write-up is made. All notes and referral information must be kept securely in the church office.',
                    ] as $point)
                        <li class="flex items-start gap-3">
                            <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#fff1ea] text-[#e85d26]">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                            <p class="text-[14px] leading-6 text-[#6a645e]">{{ $point }}</p>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-5 rounded-xl border-l-4 border-[#e85d26] bg-[#fff8f4] px-5 py-4">
                    <p class="text-[13px] font-bold text-[#1f1b22]">Important</p>
                    <p class="mt-1 text-[13px] leading-6 text-[#6a645e]">Report concerns <strong>as soon as possible</strong> to the Safeguarding Lead. The Senior Minister must be contacted <strong>before</strong> any outside agencies are involved. Suspicions must <strong>not</strong> be discussed with anyone other than those nominated above.</p>
                </div>
            </div>

            {{-- Recognising Abuse --}}
            <div id="recognising-abuse" class="scroll-mt-20 rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">Recognising Signs of Abuse</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    Some signs may not indicate abuse in isolation, but linked to a sequence of other incidents could give serious cause for concern. Consider whether there is a pattern of unexplained injury, inconsistent explanations, spontaneous disclosures, or a sudden change in behaviour.
                </p>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    @php
                    $abuseTypes = [
                        [
                            'title' => 'Physical Abuse',
                            'signs' => [
                                'Bruises to eyes, mouth, or ears; fingertip or outline bruising',
                                'Bruises of different ages in the same place',
                                'Bruising on non-mobile babies',
                                'Burns or scalds with clear outlines; small round burns (cigarettes)',
                                'Clear tooth impressions or bite marks',
                                'Fractures in children under 1 year',
                                'Signs of shaking; facial petechiae (small blood spots)',
                            ],
                        ],
                        [
                            'title' => 'Neglect',
                            'signs' => [
                                'Not receiving adequate food',
                                'Exposed to injury through lack of supervision',
                                'Exposed to inadequate, dirty, or cold environments',
                                'Abandoned or left without appropriate adult supervision',
                                'Prevented from receiving medical advice or treatment',
                            ],
                        ],
                        [
                            'title' => 'Sexual Abuse',
                            'signs' => [
                                'Sexually transmitted diseases',
                                'Recurrent urinary infections',
                                'Genital and rectal itching and soreness',
                                'Bruising in the genital region',
                                'Sexually explicit behaviour or language inappropriate to the child\'s age',
                                'Young children with an inappropriate level of sexual knowledge',
                            ],
                        ],
                        [
                            'title' => 'Emotional Abuse',
                            'signs' => [
                                'Abnormally passive, lethargic, or attention-seeking behaviour',
                                'Severely delayed social and speech development',
                                'Excessively nervous behaviour such as rocking',
                                'Low self-esteem or unusual aggression',
                                'Specific habit disorders (e.g., faecal smearing)',
                            ],
                        ],
                    ];
                    @endphp

                    @foreach ($abuseTypes as $type)
                        <div class="rounded-xl border border-[#ede5da] bg-[#faf8f5] px-5 py-5">
                            <h3 class="text-[13px] font-extrabold uppercase tracking-[0.16em] text-[#1f1b22]">{{ $type['title'] }}</h3>
                            <ul class="mt-3 space-y-1.5">
                                @foreach ($type['signs'] as $sign)
                                    <li class="flex items-start gap-2 text-[13px] leading-5 text-[#6a645e]">
                                        <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-[#e85d26]"></span>
                                        {{ $sign }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 rounded-xl border border-[#ede5da] bg-[#faf8f5] px-5 py-5">
                    <h3 class="text-[13px] font-extrabold uppercase tracking-[0.16em] text-[#1f1b22]">General Indicators</h3>
                    <p class="mt-2 text-[13px] leading-6 text-[#6a645e]">
                        These may occur in any form of abuse and are especially important in sexual and emotional abuse where outward signs may not be present:
                        onset of enuresis (day or night), sleeping and eating disturbance, recurrent abdominal pains, social withdrawal, restlessness, poor trust or secretiveness, running away, self-harm, hysterical fits or faints, and a child confiding in a trusted adult.
                    </p>
                </div>
            </div>

            {{-- Dealing with Incidents --}}
            <div id="incidents" class="scroll-mt-20 rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">Dealing with Incidents &amp; Allegations</h2>

                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    Each Life Group Leader is responsible for keeping a mental note of anything significant — a confrontation, sensitive concern, or unusual remark — and reporting it to the designated persons. All incidents should be recorded and discussed with the designated persons who will decide whether to inform parents.
                </p>

                <h3 class="mt-6 text-[15px] font-bold text-[#1f1b22]">If the incident or allegation is against a worker:</h3>
                <ol class="mt-3 space-y-2.5 list-none">
                    @foreach ([
                        'Report to the Life Group Lead as soon as possible, away from the children.',
                        'The Life Group Lead makes a written, dated record including the time.',
                        'The Senior Pastor listens to the allegation and decides whether it is a Code of Conduct issue or a safeguarding matter.',
                        'A written record of any discussion and action is made.',
                    ] as $i => $step)
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-[#17141a] text-[11px] font-extrabold text-white">{{ $i + 1 }}</span>
                            <p class="text-[14px] leading-6 text-[#6a645e]">{{ $step }}</p>
                        </li>
                    @endforeach
                </ol>

                <h3 class="mt-7 text-[15px] font-bold text-[#1f1b22]">If a child discloses to you:</h3>
                <ul class="mt-3 space-y-2.5">
                    @foreach ([
                        'Stay calm and listen carefully — do not overreact.',
                        'Do not promise to keep secrets. Explain the information will need to be shared, but reassure the child they have done the right thing.',
                        'Allow the child to continue at their own pace.',
                        'Ask questions only for clarification. Avoid questions that suggest a particular answer.',
                        'Tell the child what you are going to do next and who you will share the information with.',
                        'Record in writing, as soon as possible, what was said using the child\'s words. Note time, date, and any names mentioned. Sign and date the record.',
                        'The Life Group Lead then informs the Designated Safeguarding Lead and/or Senior Minister, who decides on the relevant action.',
                    ] as $point)
                        <li class="flex items-start gap-3">
                            <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#fff1ea] text-[#e85d26]">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                            <p class="text-[14px] leading-6 text-[#6a645e]">{{ $point }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- How to Safeguard --}}
            <div id="best-practice" class="scroll-mt-20 rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">Keeping Children Safe — Best Practice</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    Always ensure there is more than one adult present during activities with children and young people, or that you are at least within sight or hearing of other adults. The following practices are <strong>strongly discouraged</strong>:
                </p>
                <ul class="mt-4 space-y-2.5">
                    @foreach ([
                        'Spending excessive time with individual children away from their peers and other leaders.',
                        'One-to-one meetings with an individual child or young person.',
                        'Taking a child alone on a car journey, even a short one, unless express parental permission has been given.',
                        'Meeting with children outside of organised activity or session times.',
                        'Horseplay or unnecessary physical contact that may be misunderstood.',
                    ] as $point)
                        <li class="flex items-start gap-3">
                            <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#fef3f2] text-[#e04141]">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </span>
                            <p class="text-[14px] leading-6 text-[#6a645e]">{{ $point }}</p>
                        </li>
                    @endforeach
                </ul>
                <p class="mt-4 text-[13px] leading-6 text-[#6a645e]">
                    Should any of these situations arise unavoidably, inform the leader in charge and/or the child's parents. Any one-to-one contact must take place in an environment open to being observed.
                </p>
            </div>

            {{-- Recruitment --}}
            <div id="recruitment" class="scroll-mt-20 rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">Safe Recruitment</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    At CLIC, we are committed to recruiting safely. A minimum of six months' attendance at City Life is required before any involvement with children will be considered.
                    All workers with direct access to children must submit a Self-Declaration form. Where appropriate, references are taken up. All workers are checked through the Disclosure &amp; Barring Service (DBS), including existing workers.
                </p>

                <h3 class="mt-6 text-[15px] font-bold text-[#1f1b22]">Enhanced DBS Checks apply to:</h3>
                <ul class="mt-3 space-y-2 text-[14px] leading-6 text-[#6a645e]">
                    @foreach (['Senior Pastor', 'Church Council / Trustee(s)', 'Children\'s Leaders, Workers &amp; Volunteers'] as $role)
                        <li class="flex items-center gap-2">
                            <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-[#e85d26]"></span>
                            {!! $role !!}
                        </li>
                    @endforeach
                </ul>

                <div class="mt-5 rounded-xl bg-[#fff8f4] px-5 py-4 text-[13px] leading-6 text-[#6a645e] ring-1 ring-[#f5d9c8]">
                    <p class="font-bold text-[#1f1b22]">Working with offenders / ex-offenders</p>
                    <p class="mt-1">Anyone with a previous offence against children will <strong>not</strong> be accepted as a member of a children's team. Where a conviction does exist, the Senior Pastor and Life Group Lead will review circumstances, relevance, and dates before any decision is made. There will be an agreed probationary period, supervision, and clear boundaries.</p>
                </div>
            </div>

            {{-- Personal Care --}}
            <div id="personal-care" class="scroll-mt-20 rounded-[18px] bg-white px-7 py-8 shadow-[0_10px_28px_rgba(18,12,15,0.07)] ring-1 ring-[#efe8de] sm:px-9 sm:py-9">
                <h2 class="text-xl font-extrabold text-[#1f1b22] sm:text-2xl">Children &amp; Personal Care Needs</h2>
                <p class="mt-3 text-[14px] leading-7 text-[#6a645e]">
                    Some younger children may need help with personal matters. It is important to consider which adults on the team are most appropriate to assist, and to consult with parents. Adults should <strong>never</strong> assist with personal care if the child can do it themselves.
                    Parents should always be informed if their child required help with personal care on a particular day. Please speak to the Designated Person if there is any concern.
                </p>
            </div>

        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-[#1a1b24] py-14 sm:py-16">
        <div class="mx-auto max-w-3xl px-4 text-center sm:px-6 lg:px-8">
            <p class="text-[11px] font-bold uppercase tracking-[0.3em] text-[#ff8d63]">Get In Touch</p>
            <h2 class="mt-3 text-2xl font-extrabold text-white sm:text-3xl">Have a Concern or Question?</h2>
            <p class="mx-auto mt-4 max-w-xl text-[14px] leading-7 text-white/65">
                If you have a safeguarding concern, please speak to one of the designated persons or contact the church office. We take every concern seriously and will respond with care and confidentiality.
            </p>
            <div class="mt-7">
                <a
                    href="{{ url('/contact') }}"
                    class="inline-flex items-center gap-2 rounded-full bg-[#e85d26] px-6 py-3 text-[13px] font-semibold text-white transition-colors hover:bg-[#cf4f1e]"
                >
                    Contact Us
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
