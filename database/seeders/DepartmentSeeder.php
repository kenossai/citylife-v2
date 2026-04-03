<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'name'        => 'Worship & Arts',
                'slug'        => 'worship-arts',
                'description' => 'Serving God and the congregation through music, creative arts, and technical production.',
                'sort_order'  => 0,
                'is_active'   => true,
            ],
            [
                'name'        => 'Children\'s Ministry',
                'slug'        => 'childrens-ministry',
                'description' => 'Nurturing the faith of children from infancy through primary school age in a safe and vibrant environment.',
                'sort_order'  => 1,
                'is_active'   => true,
            ],
            [
                'name'        => 'Youth Ministry',
                'slug'        => 'youth-ministry',
                'description' => 'Empowering teenagers and young adults to grow in faith, community, and purpose.',
                'sort_order'  => 2,
                'is_active'   => true,
            ],
            [
                'name'        => 'Ushering & Protocol',
                'slug'        => 'ushering-protocol',
                'description' => 'Creating a warm, orderly, and welcoming atmosphere for every service and event.',
                'sort_order'  => 3,
                'is_active'   => true,
            ],
            [
                'name'        => 'Media & Communications',
                'slug'        => 'media-communications',
                'description' => 'Managing the church\'s online presence, livestreams, social media, and publications.',
                'sort_order'  => 4,
                'is_active'   => true,
            ],
            [
                'name'        => 'Welfare & Pastoral Care',
                'slug'        => 'welfare-pastoral-care',
                'description' => 'Supporting members through practical assistance, counselling, and pastoral visits.',
                'sort_order'  => 5,
                'is_active'   => true,
            ],
            [
                'name'        => 'Prayer & Intercession',
                'slug'        => 'prayer-intercession',
                'description' => 'Covering the church, its members, and the city in sustained, corporate prayer.',
                'sort_order'  => 6,
                'is_active'   => true,
            ],
            [
                'name'        => 'Evangelism & Outreach',
                'slug'        => 'evangelism-outreach',
                'description' => 'Taking the Gospel beyond the walls of the church through street evangelism and community programmes.',
                'sort_order'  => 7,
                'is_active'   => true,
            ],
        ];

        foreach ($departments as $data) {
            Department::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
