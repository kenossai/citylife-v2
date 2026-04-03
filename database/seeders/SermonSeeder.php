<?php

namespace Database\Seeders;

use App\Models\Sermon;
use Illuminate\Database\Seeder;

class SermonSeeder extends Seeder
{
    public function run(): void
    {
        $sermons = [
            [
                'title'             => 'The Foundation of Faith',
                'slug'              => 'the-foundation-of-faith',
                'guest_speaker_name'=> 'Pastor David Mensah',
                'scripture'         => 'Hebrews 11:1-6',
                'description'       => 'An exploration of what true, biblical faith looks like and how it anchors us in every season of life.',
                'preached_at'       => '2026-03-29',
                'service_label'     => 'Sunday Morning',
                'video_url'         => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_featured'       => true,
                'is_active'         => true,
            ],
            [
                'title'             => 'Walking in the Spirit',
                'slug'              => 'walking-in-the-spirit',
                'guest_speaker_name'=> 'Pastor David Mensah',
                'scripture'         => 'Galatians 5:16-25',
                'description'       => 'Discovering what it means to be led by the Holy Spirit in every area of our daily lives.',
                'preached_at'       => '2026-03-22',
                'service_label'     => 'Sunday Morning',
                'video_url'         => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_featured'       => false,
                'is_active'         => true,
            ],
            [
                'title'             => 'The Power of Prayer',
                'slug'              => 'the-power-of-prayer',
                'guest_speaker_name'=> 'Pastor Sarah Williams',
                'scripture'         => 'Matthew 6:5-15',
                'description'       => 'Jesus teaches us how to pray — not as a religious duty, but as a living conversation with our Father.',
                'preached_at'       => '2026-03-15',
                'service_label'     => 'Sunday Morning',
                'video_url'         => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_featured'       => false,
                'is_active'         => true,
            ],
            [
                'title'             => 'Grace Greater Than Our Sin',
                'slug'              => 'grace-greater-than-our-sin',
                'guest_speaker_name'=> 'Elder James Osei',
                'scripture'         => 'Romans 5:20-21',
                'description'       => 'A message on the overwhelming, relentless grace of God that covers every past, present, and future failure.',
                'preached_at'       => '2026-03-08',
                'service_label'     => 'Sunday Evening',
                'video_url'         => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_featured'       => false,
                'is_active'         => true,
            ],
            [
                'title'             => 'Bearing Good Fruit',
                'slug'              => 'bearing-good-fruit',
                'guest_speaker_name'=> 'Pastor David Mensah',
                'scripture'         => 'John 15:1-17',
                'description'       => 'Jesus calls us to abide in Him so that our lives bear lasting, kingdom fruit for His glory.',
                'preached_at'       => '2026-03-01',
                'service_label'     => 'Sunday Morning',
                'video_url'         => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_featured'       => false,
                'is_active'         => true,
            ],
            [
                'title'             => 'Wholeness in Christ',
                'slug'              => 'wholeness-in-christ',
                'guest_speaker_name'=> 'Pastor Sarah Williams',
                'scripture'         => 'Colossians 2:9-10',
                'description'       => 'You are complete in Christ — nothing needs to be added. A message on identity, wholeness, and freedom.',
                'preached_at'       => '2026-02-22',
                'service_label'     => 'Sunday Morning',
                'video_url'         => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_featured'       => false,
                'is_active'         => true,
            ],
            [
                'title'             => 'The Armour of God',
                'slug'              => 'the-armour-of-god',
                'guest_speaker_name'=> 'Deacon Thomas Adeyemi',
                'scripture'         => 'Ephesians 6:10-18',
                'description'       => 'Understanding the spiritual battle we are in and equipping ourselves with every piece of armour God has provided.',
                'preached_at'       => '2026-02-15',
                'service_label'     => 'Sunday Morning',
                'video_url'         => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_featured'       => false,
                'is_active'         => true,
            ],
            [
                'title'             => 'A Heart of Worship',
                'slug'              => 'a-heart-of-worship',
                'guest_speaker_name'=> 'Minister Grace Okonkwo',
                'scripture'         => 'Psalm 95:1-7',
                'description'       => 'Worship is not just singing — it is a lifestyle of surrender and adoration towards the living God.',
                'preached_at'       => '2026-02-08',
                'service_label'     => 'Sunday Morning',
                'video_url'         => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_featured'       => false,
                'is_active'         => true,
            ],
            [
                'title'             => 'Renewed Mind, Transformed Life',
                'slug'              => 'renewed-mind-transformed-life',
                'guest_speaker_name'=> 'Pastor David Mensah',
                'scripture'         => 'Romans 12:1-2',
                'description'       => 'Real transformation begins in the mind. How do we present ourselves as living sacrifices and be genuinely renewed?',
                'preached_at'       => '2026-02-01',
                'service_label'     => 'Sunday Morning',
                'video_url'         => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_featured'       => false,
                'is_active'         => true,
            ],
            [
                'title'             => 'Hope That Does Not Disappoint',
                'slug'              => 'hope-that-does-not-disappoint',
                'guest_speaker_name'=> 'Elder James Osei',
                'scripture'         => 'Romans 5:1-5',
                'description'       => 'Suffering produces perseverance, character, and hope. A message to encourage those walking through difficult seasons.',
                'preached_at'       => '2026-01-25',
                'service_label'     => 'Sunday Evening',
                'video_url'         => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_featured'       => false,
                'is_active'         => true,
            ],
            [
                'title'             => 'Seek First the Kingdom',
                'slug'              => 'seek-first-the-kingdom',
                'guest_speaker_name'=> 'Pastor David Mensah',
                'scripture'         => 'Matthew 6:25-34',
                'description'       => 'What does it look like to prioritise the Kingdom when daily anxieties press in? Jesus gives us a radical answer.',
                'preached_at'       => '2026-01-18',
                'service_label'     => 'Sunday Morning',
                'video_url'         => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_featured'       => false,
                'is_active'         => true,
            ],
            [
                'title'             => 'New Year, New Covenant Vision',
                'slug'              => 'new-year-new-covenant-vision',
                'guest_speaker_name'=> 'Pastor David Mensah',
                'scripture'         => 'Isaiah 43:18-19',
                'description'       => 'As we step into a new year, God declares: forget the former things, for I am doing a new thing. A prophetic word for the season.',
                'preached_at'       => '2026-01-04',
                'service_label'     => 'Sunday Morning',
                'video_url'         => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_featured'       => false,
                'is_active'         => true,
            ],
        ];

        foreach ($sermons as $data) {
            Sermon::updateOrCreate(
                ['title' => $data['title'], 'preached_at' => $data['preached_at']],
                $data
            );
        }
    }
}
