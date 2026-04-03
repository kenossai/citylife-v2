<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title'                 => 'Good Friday Evening Service',
                'slug'                  => 'good-friday-evening-service',
                'description'           => 'Join us for a moving Good Friday evening service of reflection, communion, and worship as we remember the sacrifice of Jesus.',
                'event_at'              => Carbon::parse('2026-03-28 19:00:00'),
                'image_path'            => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?auto=format&fit=crop&w=1200&q=80',
                'location'              => 'Main Sanctuary, Sheffield',
                'category'              => 'Worship',
                'badge'                 => 'Open To All',
                'is_featured'           => true,
                'requires_registration' => false,
                'sort_order'            => 1,
                'is_active'             => true,
            ],
            [
                'title'                 => 'Easter Sunday Celebration',
                'slug'                  => 'easter-sunday-celebration',
                'description'           => 'Celebrate the resurrection of Jesus. Bring your family and invite your friends to this powerful Easter Sunday celebration.',
                'event_at'              => Carbon::parse('2026-04-05 09:00:00'),
                'image_path'            => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=1200&q=80',
                'location'              => 'Main Sanctuary, Sheffield',
                'category'              => 'Special',
                'badge'                 => 'All Ages',
                'is_featured'           => true,
                'requires_registration' => false,
                'sort_order'            => 2,
                'is_active'             => true,
            ],
            [
                'title'                 => 'Youth & Kids Easter Bash',
                'slug'                  => 'youth-and-kids-easter-bash',
                'description'           => 'A fun-packed afternoon for children and young people with games, worship, food, and an Easter message they will remember.',
                'event_at'              => Carbon::parse('2026-04-05 13:00:00'),
                'image_path'            => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1200&q=80',
                'location'              => 'Youth Hall, Sheffield',
                'category'              => 'Youth',
                'badge'                 => 'Family Friendly',
                'is_featured'           => false,
                'requires_registration' => false,
                'sort_order'            => 3,
                'is_active'             => true,
            ],
            [
                'title'                 => 'Community Outreach Day',
                'slug'                  => 'community-outreach-day',
                'description'           => 'Join our city outreach team as we serve the homeless, distribute food, and share the love of Jesus across Sheffield.',
                'event_at'              => Carbon::parse('2026-04-12 10:00:00'),
                'image_path'            => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=1200&q=80',
                'location'              => 'City Park, Sheffield',
                'category'              => 'Outreach',
                'badge'                 => 'Serve Together',
                'is_featured'           => false,
                'requires_registration' => true,
                'sort_order'            => 4,
                'is_active'             => true,
            ],
            [
                'title'                 => 'Bible School: Module 3 Launch',
                'slug'                  => 'bible-school-module-3-launch',
                'description'           => 'Our spring intensive programme returns with Module 3, equipping believers in doctrine, practice, and Spirit-led ministry.',
                'event_at'              => Carbon::parse('2026-04-19 19:00:00'),
                'image_path'            => 'https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?auto=format&fit=crop&w=1200&q=80',
                'location'              => 'Bible School Hall, Sheffield',
                'category'              => 'Training',
                'badge'                 => 'Enrolment Open',
                'is_featured'           => false,
                'requires_registration' => true,
                'sort_order'            => 5,
                'is_active'             => true,
            ],
            [
                'title'                 => 'Men of Valour Breakfast Meeting',
                'slug'                  => 'men-of-valour-breakfast-meeting',
                'description'           => 'Men, come out for breakfast, fellowship, and practical encouragement as we build one another up in faith and purpose.',
                'event_at'              => Carbon::parse('2026-04-26 08:30:00'),
                'image_path'            => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=1200&q=80',
                'location'              => 'Atrium Cafe, Sheffield',
                'category'              => 'Men',
                'badge'                 => 'Men Only',
                'is_featured'           => false,
                'requires_registration' => true,
                'sort_order'            => 6,
                'is_active'             => true,
            ],
            [
                'title'                 => 'Days of Fire Conference 2026',
                'slug'                  => 'days-of-fire-conference-2026',
                'description'           => 'Four spirit-filled days of powerful worship, prophetic ministry, and teaching to ignite fresh hunger for God.',
                'event_at'              => Carbon::parse('2026-05-10 18:00:00'),
                'image_path'            => 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?auto=format&fit=crop&w=1200&q=80',
                'location'              => 'Main Sanctuary, Sheffield',
                'category'              => 'Conference',
                'badge'                 => 'Featured',
                'is_featured'           => true,
                'requires_registration' => true,
                'sort_order'            => 7,
                'is_active'             => true,
            ],
            [
                'title'                 => 'Night of Worship',
                'slug'                  => 'night-of-worship',
                'description'           => 'A special evening dedicated entirely to worship, prayer, and encountering God in a fresh way as a church family.',
                'event_at'              => Carbon::parse('2026-05-17 18:00:00'),
                'image_path'            => null,
                'location'              => 'Main Sanctuary, Sheffield',
                'category'              => 'Worship',
                'badge'                 => 'Open To All',
                'is_featured'           => false,
                'requires_registration' => false,
                'sort_order'            => 8,
                'is_active'             => true,
            ],
        ];

        foreach ($events as $data) {
            Event::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
