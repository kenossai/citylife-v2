<?php

namespace Database\Seeders;

use App\Models\BibleSchoolEvent;
use App\Models\BibleSchoolSession;
use Illuminate\Database\Seeder;

class BibleSchoolSessionSeeder extends Seeder
{
    public function run(): void
    {
        $sessions = [
            // ── BIBLE SCHOOL 2026 ──────────────────────────────────────────
            [
                'event_slug'  => 'bible-school-2026',
                'title'       => 'Rooted in Christ: Understanding Your Identity',
                'slug'        => 'rooted-in-christ-understanding-your-identity',
                'type'        => 'video',
                'year'        => 2026,
                'duration'    => '52:18',
                'youtube_id'  => 'dQw4w9WgXcQ',
                'scripture'   => 'Colossians 2:6-7',
                'key_verse'   => '"So then, just as you received Christ Jesus as Lord, continue to live your lives in him, rooted and built up in him, strengthened in the faith as you were taught." — Colossians 2:6-7',
                'about'       => 'An opening session establishing the foundation of Christian identity. Bishop Clarke unpacks what it means to be truly rooted in Christ and why identity determines destiny.',
                'is_locked'   => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'event_slug'  => 'bible-school-2026',
                'title'       => 'The Word as Your Foundation',
                'slug'        => 'the-word-as-your-foundation',
                'type'        => 'video',
                'year'        => 2026,
                'duration'    => '48:44',
                'youtube_id'  => 'dQw4w9WgXcQ',
                'scripture'   => 'Matthew 7:24-25',
                'key_verse'   => '"Everyone who hears these words of mine and puts them into practice is like a wise man who built his house on the rock." — Matthew 7:24',
                'about'       => 'Pastor James Okafor teaches on building your life on the unshakeable foundation of God\'s Word — covering Bible study principles, meditation, and practical application.',
                'is_locked'   => true,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'event_slug'  => 'bible-school-2026',
                'title'       => 'Women of Purpose: Embracing Your Calling',
                'slug'        => 'women-of-purpose-embracing-your-calling',
                'type'        => 'video',
                'year'        => 2026,
                'duration'    => '55:30',
                'youtube_id'  => 'dQw4w9WgXcQ',
                'scripture'   => 'Proverbs 31:25-26',
                'key_verse'   => '"She is clothed with strength and dignity; she can laugh at the days to come." — Proverbs 31:25',
                'about'       => 'Pastor Grace Mensah delivers a powerful message to women about walking boldly in their God-given purpose, breaking limitations, and leading with grace and authority.',
                'is_locked'   => true,
                'is_active'   => true,
                'sort_order'  => 3,
            ],
            [
                'event_slug'  => 'bible-school-2026',
                'title'       => 'Evangelism in the 21st Century',
                'slug'        => 'evangelism-in-the-21st-century',
                'type'        => 'audio',
                'year'        => 2026,
                'duration'    => '44:10',
                'scripture'   => 'Mark 16:15',
                'key_verse'   => '"Go into all the world and preach the gospel to all creation." — Mark 16:15',
                'about'       => 'Pastor Michael Adisa shares practical and innovative strategies for sharing the Gospel effectively in a digital, post-modern world — covering social media, personal witness, and community engagement.',
                'is_locked'   => true,
                'is_active'   => true,
                'sort_order'  => 4,
            ],
            [
                'event_slug'  => 'bible-school-2026',
                'title'       => 'Prayer: Connecting Heaven and Earth',
                'slug'        => 'prayer-connecting-heaven-and-earth',
                'type'        => 'audio',
                'year'        => 2026,
                'duration'    => '49:55',
                'scripture'   => 'Matthew 6:9-13',
                'key_verse'   => '"Your kingdom come, your will be done, on earth as it is in heaven." — Matthew 6:10',
                'about'       => 'Bishop Clarke leads a session on the theology and practice of prayer — the Lord\'s Prayer as a model, warfare prayer, intercession, and developing a consistent prayer life.',
                'is_locked'   => true,
                'is_active'   => true,
                'sort_order'  => 5,
            ],

            // ── BIBLE SCHOOL 2025 ──────────────────────────────────────────
            [
                'event_slug'  => 'bible-school-2025',
                'title'       => 'Who is the Holy Spirit?',
                'slug'        => 'who-is-the-holy-spirit',
                'type'        => 'video',
                'year'        => 2025,
                'duration'    => '58:02',
                'youtube_id'  => 'dQw4w9WgXcQ',
                'scripture'   => 'John 14:16-17',
                'key_verse'   => '"And I will ask the Father, and he will give you another advocate to help you and be with you forever — the Spirit of truth." — John 14:16-17',
                'about'       => 'An introductory session on the person and nature of the Holy Spirit, clearing common misconceptions and establishing the biblical foundation for understanding God\'s Spirit.',
                'is_locked'   => false,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'event_slug'  => 'bible-school-2025',
                'title'       => 'Gifts of the Spirit: Operating in the Supernatural',
                'slug'        => 'gifts-of-the-spirit-operating-in-the-supernatural',
                'type'        => 'video',
                'year'        => 2025,
                'duration'    => '61:15',
                'youtube_id'  => 'dQw4w9WgXcQ',
                'scripture'   => '1 Corinthians 12:1-11',
                'key_verse'   => '"Now to each one the manifestation of the Spirit is given for the common good." — 1 Corinthians 12:7',
                'about'       => 'Pastor James Okafor walks through the nine gifts of the Spirit — what they are, how they operate, and how every believer can move in the supernatural gifts of God.',
                'is_locked'   => false,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'event_slug'  => 'bible-school-2025',
                'title'       => 'Living by the Spirit Daily',
                'slug'        => 'living-by-the-spirit-daily',
                'type'        => 'audio',
                'year'        => 2025,
                'duration'    => '46:33',
                'scripture'   => 'Galatians 5:16',
                'key_verse'   => '"So I say, walk by the Spirit, and you will not gratify the desires of the flesh." — Galatians 5:16',
                'about'       => 'Pastor Grace Mensah teaches on the practical daily experience of Spirit-led living — how to hear God\'s voice, follow His promptings, and cultivate a sensitive heart toward the Spirit.',
                'is_locked'   => false,
                'is_active'   => true,
                'sort_order'  => 3,
            ],
            [
                'event_slug'  => 'bible-school-2025',
                'title'       => 'The Fruit of the Spirit',
                'slug'        => 'the-fruit-of-the-spirit',
                'type'        => 'audio',
                'year'        => 2025,
                'duration'    => '50:20',
                'scripture'   => 'Galatians 5:22-23',
                'key_verse'   => '"But the fruit of the Spirit is love, joy, peace, forbearance, kindness, goodness, faithfulness, gentleness and self-control." — Galatians 5:22-23',
                'about'       => 'Bishop Clarke closes the 2025 school with a session on character formation — what the fruit of the Spirit looks like in practice and how to cultivate it through yielding to God.',
                'is_locked'   => false,
                'is_active'   => true,
                'sort_order'  => 4,
            ],

            // ── BIBLE SCHOOL 2024 ──────────────────────────────────────────
            [
                'event_slug'  => 'bible-school-2024',
                'title'       => 'What is Faith? A Biblical Definition',
                'slug'        => 'what-is-faith-a-biblical-definition',
                'type'        => 'video',
                'year'        => 2024,
                'duration'    => '53:47',
                'youtube_id'  => 'dQw4w9WgXcQ',
                'scripture'   => 'Hebrews 11:1-6',
                'key_verse'   => '"Now faith is confidence in what we hope for and assurance about what we do not see." — Hebrews 11:1',
                'about'       => 'Bishop Clarke opens Bible School 2024 with a thorough exploration of what faith truly is — dismantling myths, establishing the biblical definition, and showing how faith is the currency of the Kingdom.',
                'is_locked'   => false,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'event_slug'  => 'bible-school-2024',
                'title'       => 'Faith and Works: Two Sides of One Coin',
                'slug'        => 'faith-and-works-two-sides-of-one-coin',
                'type'        => 'video',
                'year'        => 2024,
                'duration'    => '47:09',
                'youtube_id'  => 'dQw4w9WgXcQ',
                'scripture'   => 'James 2:14-26',
                'key_verse'   => '"Faith by itself, if it is not accompanied by action, is dead." — James 2:17',
                'about'       => 'Pastor James Okafor tackles the classic tension between faith and works — unpacking James chapter 2 to show that genuine saving faith always produces visible fruit and action.',
                'is_locked'   => false,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'event_slug'  => 'bible-school-2024',
                'title'       => 'Faith in the Face of Trials',
                'slug'        => 'faith-in-the-face-of-trials',
                'type'        => 'audio',
                'year'        => 2024,
                'duration'    => '51:38',
                'scripture'   => 'James 1:2-4',
                'key_verse'   => '"Consider it pure joy, my brothers and sisters, whenever you face trials of many kinds, because you know that the testing of your faith produces perseverance." — James 1:2-3',
                'about'       => 'Pastor Michael Adisa delivers a faith-building message on holding fast to God\'s promises in seasons of trial, persecution, and uncertainty.',
                'is_locked'   => false,
                'is_active'   => true,
                'sort_order'  => 3,
            ],

            // ── BIBLE SCHOOL 2023 ──────────────────────────────────────────
            [
                'event_slug'  => 'bible-school-2023',
                'title'       => 'Understanding the Kingdom of God',
                'slug'        => 'understanding-the-kingdom-of-god',
                'type'        => 'video',
                'year'        => 2023,
                'duration'    => '56:22',
                'youtube_id'  => 'dQw4w9WgXcQ',
                'scripture'   => 'Matthew 6:33',
                'key_verse'   => '"But seek first his kingdom and his righteousness, and all these things will be given to you as well." — Matthew 6:33',
                'about'       => 'Bishop Clarke opens the 2023 school by laying the groundwork for kingdom theology — what the Kingdom is, who it belongs to, how it operates, and our role within it.',
                'is_locked'   => false,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'event_slug'  => 'bible-school-2023',
                'title'       => 'Kingdom Culture vs World Culture',
                'slug'        => 'kingdom-culture-vs-world-culture',
                'type'        => 'audio',
                'year'        => 2023,
                'duration'    => '43:55',
                'scripture'   => 'Romans 12:2',
                'key_verse'   => '"Do not conform to the pattern of this world, but be transformed by the renewing of your mind." — Romans 12:2',
                'about'       => 'Pastor Grace Mensah challenges believers to examine the cultural values they have absorbed and to embrace the counter-cultural kingdom lifestyle Jesus modelled and commanded.',
                'is_locked'   => false,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'event_slug'  => 'bible-school-2023',
                'title'       => 'Advancing the Kingdom Through Service',
                'slug'        => 'advancing-the-kingdom-through-service',
                'type'        => 'audio',
                'year'        => 2023,
                'duration'    => '40:17',
                'scripture'   => 'Matthew 20:26-28',
                'key_verse'   => '"Whoever wants to become great among you must be your servant." — Matthew 20:26',
                'about'       => 'Pastor Michael Adisa closes the 2023 school with a call to servant leadership — showing how the kingdom advances through sacrifice, service, and a heart that puts others first.',
                'is_locked'   => false,
                'is_active'   => true,
                'sort_order'  => 3,
            ],
        ];

        foreach ($sessions as $data) {
            $eventSlug = $data['event_slug'];
            unset($data['event_slug']);

            $event = BibleSchoolEvent::where('slug', $eventSlug)->first();

            if (! $event) {
                continue;
            }

            BibleSchoolSession::updateOrCreate(
                [
                    'bible_school_event_id' => $event->id,
                    'slug'                  => $data['slug'],
                ],
                array_merge($data, ['bible_school_event_id' => $event->id])
            );
        }
    }
}
