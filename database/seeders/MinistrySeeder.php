<?php

namespace Database\Seeders;

use App\Models\Ministry;
use Illuminate\Database\Seeder;

class MinistrySeeder extends Seeder
{
    public function run(): void
    {
        $ministries = [
            [
                'name' => 'Worship & Arts',
                'slug' => 'worship',
                'subtitle' => 'Music · Creative Arts',
                'description' => 'Experience the presence of God through Spirit-filled praise and worship every Sunday.',
                'about_text' => "Our Worship & Arts ministry exists to create an atmosphere where people can encounter God through music, song, and creative expression.\n\nWhether you sing, play an instrument, or serve behind the scenes with sound and visuals, there is a place for you to use your gifts for God's glory.",
                'vision_quote' => 'Let everything that has breath praise the Lord.',
                'image_path' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=900&q=80',
                'category_label' => 'Music',
                'meeting_schedule' => 'Sundays · 8:30 AM (Rehearsal)',
                'location' => 'Main Auditorium',
                'leader_name' => 'Minister Grace Okonkwo',
                'leader_role' => 'Worship Director',
                'sort_order' => 0,
            ],
            [
                'name' => 'Community Groups',
                'slug' => 'community-groups',
                'subtitle' => 'Life Together',
                'description' => 'Connect with others in small groups designed to grow together in faith.',
                'about_text' => "Community Groups are the heartbeat of our church family. These weekly gatherings are where real life happens — sharing meals, studying the Word, praying for one another, and building lasting friendships.\n\nGroups meet across Sheffield in homes and community spaces. Whether you're new to faith or have walked with Jesus for years, there's a group for you.",
                'vision_quote' => 'They broke bread in their homes and ate together with glad and sincere hearts.',
                'image_path' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=900&q=80',
                'category_label' => 'Fellowship',
                'meeting_schedule' => 'Wednesdays · 7:00 PM',
                'location' => 'Various Locations',
                'leader_name' => 'Pastor James & Sarah Mitchell',
                'leader_role' => 'Groups Coordinators',
                'sort_order' => 1,
            ],
            [
                'name' => 'Missions & Outreach',
                'slug' => 'missions',
                'subtitle' => 'Local & Global',
                'description' => 'We partner with missionaries globally to spread the Gospel to the ends of the earth.',
                'about_text' => "Our Missions & Outreach ministry is committed to taking the love of Christ beyond our walls. We support mission partners across multiple countries and run local initiatives that serve the most vulnerable in our city.\n\nFrom food banks and clothing drives to overseas mission trips, we believe every believer is called to be a witness wherever they are.",
                'vision_quote' => 'Go and make disciples of all nations.',
                'image_path' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=900&q=80',
                'category_label' => 'Outreach',
                'meeting_schedule' => '1st Saturday · 10:00 AM',
                'location' => 'Community Hall',
                'leader_name' => 'Deacon Thomas Adeyemi',
                'leader_role' => 'Missions Lead',
                'sort_order' => 2,
            ],
            [
                'name' => 'Community Outreach',
                'slug' => 'outreach',
                'subtitle' => 'Serving Sheffield',
                'description' => 'Serving our city with love and compassion through local outreach initiatives.',
                'about_text' => "Community Outreach is how we put our faith into action right here in Sheffield. We run regular programmes including a food pantry, after-school mentoring, and support for the elderly and isolated.\n\nWe believe the local church should be the best news in every neighbourhood. Join us as we serve with compassion and share the hope of Jesus.",
                'vision_quote' => 'Faith without works is dead.',
                'image_path' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=900&q=80',
                'category_label' => 'Service',
                'meeting_schedule' => 'Saturdays · 9:00 AM',
                'location' => 'City Centre Campus',
                'leader_name' => 'Sister Ruth Kamau',
                'leader_role' => 'Outreach Coordinator',
                'sort_order' => 3,
            ],
            [
                'name' => 'Bible Study',
                'slug' => 'bible-study',
                'subtitle' => 'Digging Deeper',
                'description' => 'Deepen your understanding of Scripture through our weekly study sessions.',
                'about_text' => "Our Bible Study ministry provides a space to dig deeper into God's Word. Each week we explore Scripture together through verse-by-verse teaching, discussion, and practical application.\n\nWhether you are just beginning to read the Bible or have been studying for decades, these sessions will strengthen your faith and equip you for everyday life.",
                'vision_quote' => 'Your word is a lamp to my feet and a light to my path.',
                'image_path' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=900&q=80',
                'category_label' => 'Education',
                'meeting_schedule' => 'Tuesdays · 7:00 PM',
                'location' => 'Room 3, City Centre Campus',
                'leader_name' => 'Elder Michael Osei',
                'leader_role' => 'Teaching Elder',
                'sort_order' => 4,
            ],
            [
                'name' => 'Youth & Kids',
                'slug' => 'youth-and-kids',
                'subtitle' => 'Ages 3 – 18',
                'description' => 'A safe and fun environment for children and teens to discover their faith.',
                'about_text' => "Youth & Kids is a vibrant ministry dedicated to helping the next generation know and follow Jesus. Our programmes are age-appropriate, fun, and rooted in Scripture.\n\nFrom Sunday kids church to Friday night youth sessions, we create safe spaces where young people can ask questions, build friendships, and grow in their walk with God.",
                'vision_quote' => 'Train up a child in the way he should go; even when he is old he will not depart from it.',
                'image_path' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=900&q=80',
                'category_label' => 'Youth',
                'meeting_schedule' => 'Sundays · 10:00 AM & Fridays · 6:30 PM',
                'location' => 'Youth Hall',
                'leader_name' => 'Pastor Daniel & Joy Wright',
                'leader_role' => 'Youth & Children\'s Pastors',
                'sort_order' => 5,
            ],
        ];

        foreach ($ministries as $data) {
            Ministry::updateOrCreate(
                ['slug' => $data['slug']],
                $data + ['is_active' => true],
            );
        }
    }
}
