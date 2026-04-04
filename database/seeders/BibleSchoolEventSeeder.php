<?php

namespace Database\Seeders;

use App\Models\BibleSchoolEvent;
use App\Models\Speaker;
use Illuminate\Database\Seeder;

class BibleSchoolEventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title'       => 'Bible School 2026',
                'slug'        => 'bible-school-2026',
                'description' => 'Our annual Bible School for 2026, equipping believers with sound doctrine, practical ministry skills, and a deeper understanding of Scripture. This year\'s theme is "Rooted and Built Up in Him" — exploring identity, purpose, and kingdom principles.',
                'year'        => 2026,
                'start_date'  => '2026-03-10',
                'end_date'    => '2026-03-14',
                'location'    => 'City Life International Church, Main Auditorium',
                'status'      => 'ongoing',
                'sort_order'  => 1,
                'speakers'    => ['bishop-robert-clarke', 'pastor-james-okafor', 'pastor-grace-mensah', 'pastor-michael-adisa'],
            ],
            [
                'title'       => 'Bible School 2025',
                'slug'        => 'bible-school-2025',
                'description' => 'The 2025 edition of our annual Bible School. Theme: "Walking in the Spirit" — five days of intensive teaching on the Holy Spirit, spiritual gifts, prayer, and living a Spirit-led life.',
                'year'        => 2025,
                'start_date'  => '2025-03-03',
                'end_date'    => '2025-03-07',
                'location'    => 'City Life International Church, Main Auditorium',
                'status'      => 'past',
                'sort_order'  => 2,
                'speakers'    => ['bishop-robert-clarke', 'pastor-james-okafor', 'pastor-grace-mensah'],
            ],
            [
                'title'       => 'Bible School 2024',
                'slug'        => 'bible-school-2024',
                'description' => 'Theme: "Faith That Works" — exploring the foundations of biblical faith, the evidence of faith in action, and how faith transforms every area of life.',
                'year'        => 2024,
                'start_date'  => '2024-02-26',
                'end_date'    => '2024-03-01',
                'location'    => 'City Life International Church, Main Auditorium',
                'status'      => 'past',
                'sort_order'  => 3,
                'speakers'    => ['bishop-robert-clarke', 'pastor-james-okafor', 'pastor-michael-adisa'],
            ],
            [
                'title'       => 'Bible School 2023',
                'slug'        => 'bible-school-2023',
                'description' => 'Theme: "The Kingdom of God" — a deep dive into kingdom principles, kingdom culture, and what it means to advance God\'s kingdom in everyday life.',
                'year'        => 2023,
                'start_date'  => '2023-03-06',
                'end_date'    => '2023-03-10',
                'location'    => 'City Life International Church, Main Auditorium',
                'status'      => 'past',
                'sort_order'  => 4,
                'speakers'    => ['bishop-robert-clarke', 'pastor-grace-mensah', 'pastor-michael-adisa'],
            ],
        ];

        foreach ($events as $data) {
            $speakerSlugs = $data['speakers'];
            unset($data['speakers']);

            $event = BibleSchoolEvent::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );

            $speakerIds = Speaker::whereIn('slug', $speakerSlugs)->pluck('id');
            $event->speakers()->sync($speakerIds);
        }
    }
}
