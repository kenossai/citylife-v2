<?php

namespace Database\Seeders;

use App\Models\BibleSchoolSession;
use App\Models\Speaker;
use Illuminate\Database\Seeder;

class BibleSchoolSessionSeeder extends Seeder
{
    public function run(): void
    {
        $sessions = [
            'bishop-robert-clarke' => [
                [
                    'title'      => 'The Foundations of Faith',
                    'slug'       => 'the-foundations-of-faith',
                    'type'       => 'video',
                    'year'       => 2025,
                    'duration'   => '48:32',
                    'youtube_id' => 'dQw4w9WgXcQ',
                    'scripture'  => 'Hebrews 11:1-6',
                    'key_verse'  => '"Now faith is the substance of things hoped for, the evidence of things not seen." — Hebrews 11:1 (KJV)',
                    'about'      => 'In this foundational session, Bishop Robert Clarke unpacks the core meaning of faith as described in Hebrews 11. He explores how faith is not just a concept but a living, active force that shapes our daily walk with God. Drawing from decades of pastoral experience, Bishop Clarke shows how the heroes of faith overcame impossible odds through their unwavering trust in God\'s promises.',
                    'is_locked'  => false,
                    'is_active'  => true,
                    'sort_order' => 1,
                ],
                [
                    'title'      => 'Walking in the Spirit',
                    'slug'       => 'walking-in-the-spirit',
                    'type'       => 'video',
                    'year'       => 2025,
                    'duration'   => '52:10',
                    'youtube_id' => 'dQw4w9WgXcQ',
                    'scripture'  => 'Galatians 5:16-25',
                    'key_verse'  => '"But the fruit of the Spirit is love, joy, peace, longsuffering, gentleness, goodness, faith." — Galatians 5:22 (KJV)',
                    'about'      => 'Bishop Clarke takes us on a journey through Galatians 5, explaining what it truly means to walk in the Spirit. He contrasts the works of the flesh with the fruit of the Spirit, providing practical steps for cultivating a Spirit-led life in today\'s world. This session is a powerful call to surrender and deeper intimacy with the Holy Spirit.',
                    'is_locked'  => false,
                    'is_active'  => true,
                    'sort_order' => 2,
                ],
                [
                    'title'      => 'The Power of Covenant',
                    'slug'       => 'the-power-of-covenant',
                    'type'       => 'video',
                    'year'       => 2024,
                    'duration'   => '44:18',
                    'youtube_id' => 'dQw4w9WgXcQ',
                    'scripture'  => 'Genesis 17:1-8',
                    'key_verse'  => '"And I will establish my covenant between me and thee and thy seed after thee in their generations for an everlasting covenant." — Genesis 17:7 (KJV)',
                    'about'      => 'This powerful teaching explores the nature of covenant in Scripture, from God\'s promise to Abraham through to the New Covenant in Christ. Bishop Clarke reveals how understanding covenant changes our approach to prayer, worship and everyday living. Discover the power that comes from knowing you are in an unbreakable covenant relationship with God.',
                    'is_locked'  => true,
                    'is_active'  => true,
                    'sort_order' => 3,
                ],
                [
                    'title'      => 'Understanding Grace',
                    'slug'       => 'understanding-grace',
                    'type'       => 'audio',
                    'year'       => 2024,
                    'duration'   => '38:45',
                    'youtube_id' => null,
                    'audio_file' => null,
                    'scripture'  => 'Ephesians 2:8-10',
                    'key_verse'  => '"For by grace are ye saved through faith; and that not of yourselves: it is the gift of God." — Ephesians 2:8 (KJV)',
                    'about'      => 'What is grace? How does it work in the life of the believer? Bishop Clarke dives deep into one of the most essential yet misunderstood doctrines of the Christian faith. He explains how grace is not a licence to sin but an empowerment to live above sin, bringing clarity and freedom through this transformative teaching.',
                    'is_locked'  => true,
                    'is_active'  => true,
                    'sort_order' => 4,
                ],
                [
                    'title'      => 'Leadership in the Kingdom',
                    'slug'       => 'leadership-in-the-kingdom',
                    'type'       => 'audio',
                    'year'       => 2024,
                    'duration'   => '41:20',
                    'youtube_id' => null,
                    'audio_file' => null,
                    'scripture'  => 'Mark 10:42-45',
                    'key_verse'  => '"But whosoever will be great among you, shall be your minister: And whosoever of you will be the chiefest, shall be servant of all." — Mark 10:43-44 (KJV)',
                    'about'      => 'Bishop Clarke challenges conventional leadership paradigms with the model Jesus set forth — servant leadership. This session examines how Kingdom leadership differs from the world\'s approach and equips emerging leaders with the mindset needed to lead with humility, integrity and spiritual authority.',
                    'is_locked'  => true,
                    'is_active'  => true,
                    'sort_order' => 5,
                ],
            ],

            'pastor-james-okafor' => [
                [
                    'title'      => 'Bold Evangelism in the 21st Century',
                    'slug'       => 'bold-evangelism-in-the-21st-century',
                    'type'       => 'video',
                    'year'       => 2026,
                    'duration'   => '45:15',
                    'youtube_id' => 'dQw4w9WgXcQ',
                    'scripture'  => 'Romans 1:16-17',
                    'key_verse'  => '"For I am not ashamed of the gospel of Christ: for it is the power of God unto salvation to every one that believeth." — Romans 1:16 (KJV)',
                    'about'      => 'Pastor James Okafor delivers a stirring call to courage in evangelism. In an age of political correctness and cultural sensitivity, he makes the case that the Gospel must be preached boldly and without compromise. This session provides practical strategies for sharing your faith effectively in modern contexts while maintaining the power and truth of the message.',
                    'is_locked'  => false,
                    'is_active'  => true,
                    'sort_order' => 1,
                ],
                [
                    'title'      => 'The Heart of a Leader',
                    'slug'       => 'the-heart-of-a-leader',
                    'type'       => 'video',
                    'year'       => 2026,
                    'duration'   => '50:30',
                    'youtube_id' => 'dQw4w9WgXcQ',
                    'scripture'  => '1 Samuel 16:7',
                    'key_verse'  => '"For the Lord seeth not as man seeth; for man looketh on the outward appearance, but the Lord looketh on the heart." — 1 Samuel 16:7 (KJV)',
                    'about'      => 'What makes a great leader in God\'s Kingdom? Pastor James explores the inner life of leadership, focusing on character, integrity and the condition of the heart. Drawing from the life of David and other biblical leaders, he shows that God is more interested in who you are than what you do.',
                    'is_locked'  => false,
                    'is_active'  => true,
                    'sort_order' => 2,
                ],
                [
                    'title'      => 'Preaching with Power',
                    'slug'       => 'preaching-with-power',
                    'type'       => 'video',
                    'year'       => 2025,
                    'duration'   => '42:48',
                    'youtube_id' => 'dQw4w9WgXcQ',
                    'scripture'  => '1 Corinthians 2:1-5',
                    'key_verse'  => '"And my speech and my preaching was not with enticing words of man\'s wisdom, but in demonstration of the Spirit and of power." — 1 Corinthians 2:4 (KJV)',
                    'about'      => 'Pastor James teaches on the art and anointing of preaching. He emphasises that true preaching goes beyond eloquence and rhetorical skill — it requires the power of the Holy Spirit. This session equips ministers and aspiring preachers with both practical homiletics and spiritual principles for impactful preaching.',
                    'is_locked'  => true,
                    'is_active'  => true,
                    'sort_order' => 3,
                ],
                [
                    'title'      => 'Revival and Reformation',
                    'slug'       => 'revival-and-reformation',
                    'type'       => 'audio',
                    'year'       => 2025,
                    'duration'   => '39:22',
                    'youtube_id' => null,
                    'audio_file' => null,
                    'scripture'  => '2 Chronicles 7:14',
                    'key_verse'  => '"If my people, which are called by my name, shall humble themselves, and pray, and seek my face, and turn from their wicked ways; then will I hear from heaven." — 2 Chronicles 7:14 (KJV)',
                    'about'      => 'This audio session explores the conditions and characteristics of genuine revival. Pastor James examines historical revivals and draws parallels to what God wants to do in our generation. He challenges believers to pursue personal and corporate revival through prayer, repentance and wholehearted devotion.',
                    'is_locked'  => true,
                    'is_active'  => true,
                    'sort_order' => 4,
                ],
            ],

            'pastor-grace-mensah' => [
                [
                    'title'      => 'Women of Purpose: Identity in Christ',
                    'slug'       => 'women-of-purpose-identity-in-christ',
                    'type'       => 'video',
                    'year'       => 2026,
                    'duration'   => '44:28',
                    'youtube_id' => 'dQw4w9WgXcQ',
                    'scripture'  => '1 Peter 2:9',
                    'key_verse'  => '"But ye are a chosen generation, a royal priesthood, an holy nation, a peculiar people; that ye should shew forth the praises of him who hath called you." — 1 Peter 2:9 (KJV)',
                    'about'      => 'Pastor Grace Mensah delivers a powerful message on the identity of the Christian woman. In a world filled with competing voices telling women who they should be, this session returns to Scripture to reveal who God says you are. Pastor Grace weaves together deep theological truth with personal testimony and practical application.',
                    'is_locked'  => false,
                    'is_active'  => true,
                    'sort_order' => 1,
                ],
                [
                    'title'      => 'Breaking Barriers by Faith',
                    'slug'       => 'breaking-barriers-by-faith',
                    'type'       => 'video',
                    'year'       => 2024,
                    'duration'   => '41:15',
                    'youtube_id' => 'dQw4w9WgXcQ',
                    'scripture'  => 'Hebrews 11:30-33',
                    'key_verse'  => '"By faith the walls of Jericho fell down, after they were compassed about seven days." — Hebrews 11:30 (KJV)',
                    'about'      => 'What barriers are standing between you and your God-given destiny? In this session, Pastor Grace examines biblical accounts of men and women who broke through impossible barriers by faith. She provides a practical framework for identifying and overcoming spiritual, emotional and practical obstacles that hold believers back.',
                    'is_locked'  => true,
                    'is_active'  => true,
                    'sort_order' => 2,
                ],
                [
                    'title'      => 'The Proverbs 31 Woman Today',
                    'slug'       => 'the-proverbs-31-woman-today',
                    'type'       => 'audio',
                    'year'       => 2024,
                    'duration'   => '36:50',
                    'youtube_id' => null,
                    'audio_file' => null,
                    'scripture'  => 'Proverbs 31:25-31',
                    'key_verse'  => '"She is clothed with strength and dignity; she can laugh at the days to come." — Proverbs 31:25 (NIV)',
                    'about'      => 'Pastor Grace brings a fresh and empowering perspective to the beloved Proverbs 31 passage. Rather than presenting it as an impossible standard, she reveals it as a portrait of a woman operating in the fullness of her God-given gifts and calling. This session encourages women to embrace their multifaceted roles with grace, strength and purpose.',
                    'is_locked'  => true,
                    'is_active'  => true,
                    'sort_order' => 3,
                ],
            ],

            'pastor-michael-adisa' => [
                [
                    'title'      => 'Soul Winning Strategies',
                    'slug'       => 'soul-winning-strategies',
                    'type'       => 'video',
                    'year'       => 2026,
                    'duration'   => '46:10',
                    'youtube_id' => 'dQw4w9WgXcQ',
                    'scripture'  => 'Proverbs 11:30',
                    'key_verse'  => '"The fruit of the righteous is a tree of life; and he that winneth souls is wise." — Proverbs 11:30 (KJV)',
                    'about'      => 'Pastor Michael Adisa shares proven strategies for effective soul winning in today\'s multicultural society. From one-on-one conversations to large-scale outreach events, this session covers the full spectrum of evangelistic methods while keeping the Gospel at the centre of every approach.',
                    'is_locked'  => false,
                    'is_active'  => true,
                    'sort_order' => 1,
                ],
                [
                    'title'      => 'Community Outreach Masterclass',
                    'slug'       => 'community-outreach-masterclass',
                    'type'       => 'video',
                    'year'       => 2025,
                    'duration'   => '43:55',
                    'youtube_id' => 'dQw4w9WgXcQ',
                    'scripture'  => 'Matthew 5:13-16',
                    'key_verse'  => '"Let your light so shine before men, that they may see your good works, and glorify your Father which is in heaven." — Matthew 5:16 (KJV)',
                    'about'      => 'This masterclass equips churches and ministry teams with practical frameworks for impactful community outreach. Pastor Michael draws from years of hands-on experience organising community events, food drives and neighbourhood programmes that open doors for the Gospel and transform communities.',
                    'is_locked'  => true,
                    'is_active'  => true,
                    'sort_order' => 2,
                ],
                [
                    'title'      => 'The Great Commission Today',
                    'slug'       => 'the-great-commission-today',
                    'type'       => 'audio',
                    'year'       => 2025,
                    'duration'   => '37:40',
                    'youtube_id' => null,
                    'audio_file' => null,
                    'scripture'  => 'Matthew 28:18-20',
                    'key_verse'  => '"Go ye therefore, and teach all nations, baptizing them in the name of the Father, and of the Son, and of the Holy Ghost." — Matthew 28:19 (KJV)',
                    'about'      => 'What does the Great Commission look like in the 21st century? Pastor Michael addresses this vital question, exploring how technology, migration and globalisation have created unprecedented opportunities for fulfilling Jesus\' command to make disciples of all nations.',
                    'is_locked'  => true,
                    'is_active'  => true,
                    'sort_order' => 3,
                ],
            ],
        ];

        foreach ($sessions as $speakerSlug => $speakerSessions) {
            $speaker = Speaker::where('slug', $speakerSlug)->first();
            if (! $speaker) {
                continue;
            }

            foreach ($speakerSessions as $data) {
                BibleSchoolSession::updateOrCreate(
                    ['speaker_id' => $speaker->id, 'slug' => $data['slug']],
                    array_merge($data, ['speaker_id' => $speaker->id])
                );
            }
        }
    }
}
