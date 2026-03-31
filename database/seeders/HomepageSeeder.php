<?php

namespace Database\Seeders;

use App\Models\AboutSection;
use App\Models\CtaSection;
use App\Models\Event;
use App\Models\HeroSlide;
use App\Models\Ministry;
use App\Models\MissionsSection;
use App\Models\Sermon;
use Illuminate\Database\Seeder;

class HomepageSeeder extends Seeder
{
    public function run(): void
    {
        // Hero Slides
        HeroSlide::updateOrCreate(['heading' => 'We Are A Spiritual Family Full Of His Spirit.'], [
            'eyebrow' => '— Pass It On',
            'heading' => 'We Are A Spiritual Family Full Of His Spirit.',
            'description' => 'Join us as we grow together in faith, love, and community. Everyone is welcome at City Life International.',
            'primary_btn_text' => 'Join With Us',
            'primary_btn_url' => '/about-citylife',
            'secondary_btn_text' => 'Watch Online',
            'secondary_btn_url' => '/media',
            'image_path' => 'hero-slides/slide-1.png',
            'sort_order' => 0,
            'is_active' => true,
        ]);

        HeroSlide::updateOrCreate(['heading' => 'Building A Community That Loves Like Family.'], [
            'eyebrow' => '— Connected in Christ',
            'heading' => 'Building A Community That Loves Like Family.',
            'description' => 'From small groups to Sunday gatherings, we\'re a church family rooted in love, prayer, and growing together in faith.',
            'primary_btn_text' => 'Our Ministries',
            'primary_btn_url' => '/our-ministries',
            'secondary_btn_text' => 'Watch Online',
            'secondary_btn_url' => '/media',
            'image_path' => 'hero-slides/slide-2.png',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        HeroSlide::updateOrCreate(['heading' => 'Reaching The Nations One Life At A Time.'], [
            'eyebrow' => '— Sent With Purpose',
            'heading' => 'Reaching The Nations One Life At A Time.',
            'description' => 'We believe in global impact through local faithfulness — partnering with missions worldwide to spread the love of Christ.',
            'primary_btn_text' => 'Our Missions',
            'primary_btn_url' => '/missions',
            'secondary_btn_text' => 'Watch Online',
            'secondary_btn_url' => '/media',
            'image_path' => 'hero-slides/slide-3.jpg',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        // About Section
        $about = AboutSection::instance();
        $about->update([
            'heading' => "City Life A Vibrant\nChristian Community",
            'established_text' => '10th of February 2004',
            'image_path' => 'https://images.unsplash.com/photo-1581056771107-24ca5f033842?w=900&q=80',
            'body_1' => 'City Life is a vibrant Christian church in the heart of Sheffield with the purpose to make disciples of Jesus Christ for the transformation of the city.',
            'body_2' => 'We believe in the heritage of our faith and the vision God has called us towards, helping people encounter God\'s love every day.',
            'btn_text' => 'More About Us',
            'btn_url' => '/about-citylife',
        ]);

        // Ministries
        $ministries = [
            ['name' => 'Worship', 'slug' => 'worship', 'description' => 'Experience the presence of God through Spirit-filled praise and worship every Sunday.', 'category_label' => 'Music', 'sort_order' => 0],
            ['name' => 'Community Groups', 'slug' => 'community-groups', 'description' => 'Connect with others in small groups designed to grow together in faith.', 'category_label' => 'Fellowship', 'sort_order' => 1],
            ['name' => 'Missions', 'slug' => 'missions', 'description' => 'We partner with missionaries globally to spread the Gospel to the ends of the earth.', 'category_label' => 'Outreach', 'sort_order' => 2],
            ['name' => 'Outreach', 'slug' => 'outreach', 'description' => 'Serving our city with love and compassion through local outreach initiatives.', 'category_label' => 'Service', 'sort_order' => 3],
            ['name' => 'Bible Study', 'slug' => 'bible-study', 'description' => 'Deepen your understanding of Scripture through our weekly study sessions.', 'category_label' => 'Education', 'sort_order' => 4],
            ['name' => 'Youth & Kids', 'slug' => 'youth-and-kids', 'description' => 'A safe and fun environment for children and teens to discover their faith.', 'category_label' => 'Youth', 'sort_order' => 5],
        ];

        foreach ($ministries as $data) {
            Ministry::updateOrCreate(['slug' => $data['slug']], $data + ['is_active' => true]);
        }

        // Featured Sermon
        Sermon::updateOrCreate(['title' => 'Walking in the Spirit'], [
            'title' => 'Walking in the Spirit',
            'speaker' => 'Pastor David Williams',
            'scripture' => 'Galatians 5',
            'description' => 'Explores what it means to truly live a Spirit-led life in today\'s world.',
            'preached_at' => '2026-03-22',
            'service_label' => 'Sunday Morning Service',
            'thumbnail_path' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&q=80',
            'is_featured' => true,
            'is_active' => true,
        ]);

        // Upcoming Events
        Event::updateOrCreate(['slug' => 'good-friday-service'], [
            'title' => 'Good Friday Service',
            'slug' => 'good-friday-service',
            'event_at' => '2026-03-28 19:00:00',
            'image_path' => 'https://images.unsplash.com/photo-1519406596751-0a3ccc4937fe?w=800&q=80',
            'description' => 'Join us for a special Good Friday service.',
            'sort_order' => 0,
            'is_active' => true,
        ]);

        Event::updateOrCreate(['slug' => 'easter-sunday-celebration'], [
            'title' => 'Easter Sunday Celebration',
            'slug' => 'easter-sunday-celebration',
            'event_at' => '2026-04-06 09:00:00',
            'image_path' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&q=80',
            'description' => 'Celebrate the resurrection of Jesus with us!',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        // Missions Section
        $missions = MissionsSection::instance();
        $missions->update([
            'eyebrow' => 'Serving Beyond Our Walls',
            'heading' => "Missions &\nOutreach",
            'description' => 'We are called to go beyond our four walls and share the love of Christ with our city and the world. From local food drives to international mission trips, we\'re actively making a difference.',
            'btn_text' => 'Get Involved',
            'btn_url' => '/missions',
            'images' => [
                ['url' => 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=600&q=80'],
                ['url' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=600&q=80'],
                ['url' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=600&q=80'],
            ],
        ]);

        // CTA / Volunteer Section
        $cta = CtaSection::instance();
        $cta->update([
            'eyebrow' => 'Volunteer / Outreach',
            'heading' => "Serving People.\nSharing Hope.\nTransforming Lives.",
            'description' => 'At City Life International Church, we are committed to serving people and communities through faith-filled, compassion-driven support. Through worship, outreach, and community initiatives, we enjoy and share the hope that transforms lives. Together, we make a lasting difference in lives, families, and our city.',
            'btn_text' => 'Get Involved',
            'btn_url' => '/contact',
            'background_image' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1600&q=80',
            'side_images' => [
                ['url' => 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?w=900&q=80'],
                ['url' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?w=900&q=80'],
            ],
        ]);
    }
}
