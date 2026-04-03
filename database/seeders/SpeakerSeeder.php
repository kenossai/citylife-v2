<?php

namespace Database\Seeders;

use App\Models\Speaker;
use Illuminate\Database\Seeder;

class SpeakerSeeder extends Seeder
{
    public function run(): void
    {
        $speakers = [
            [
                'name'       => 'Bishop Robert Clarke',
                'slug'       => 'bishop-robert-clarke',
                'role'       => 'Senior Bishop & Principal',
                'church'     => 'City Life International Church',
                'bio'        => 'Bishop Robert Clarke is the founder and Senior Bishop of City Life International Church. With over 30 years of ministry experience, he has dedicated his life to building strong foundations of faith in believers across the globe. His biblical teaching is both doctrinally sound and practically applicable, drawing from decades of pastoral wisdom and spiritual authority.',
                'is_active'  => true,
                'sort_order' => 1,
            ],
            [
                'name'       => 'Pastor James Okafor',
                'slug'       => 'pastor-james-okafor',
                'role'       => 'Senior Pastor & Evangelist',
                'church'     => 'City Life International Church',
                'bio'        => 'Pastor James Okafor serves as Senior Pastor and leads the evangelism ministry at City Life International Church. A passionate Bible teacher and evangelist, he has a unique ability to connect the timeless truths of Scripture with the challenges of modern life. His sessions on leadership and outreach have equipped hundreds of ministers across the nation.',
                'is_active'  => true,
                'sort_order' => 2,
            ],
            [
                'name'       => 'Pastor Grace Mensah',
                'slug'       => 'pastor-grace-mensah',
                'role'       => "Women's Ministry Leader",
                'church'     => 'City Life International Church',
                'bio'        => "Pastor Grace Mensah leads the Women's Ministry at City Life International Church and is a sought-after speaker at conferences and retreats. Known for her warmth, depth of insight, and powerful personal testimony, she brings the Word of God alive for women of all ages and backgrounds. Her sessions are a blend of sound theology, practical wisdom, and prophetic encouragement.",
                'is_active'  => true,
                'sort_order' => 3,
            ],
            [
                'name'       => 'Pastor Michael Adisa',
                'slug'       => 'pastor-michael-adisa',
                'role'       => 'Evangelism Director',
                'church'     => 'City Life International Church',
                'bio'        => 'Pastor Michael Adisa oversees community outreach and evangelism for City Life International Church. With a heart for the lost and a strategic mind for effective ministry, he has developed outreach programmes that have touched thousands of lives. His teaching on soul winning and community engagement equips believers with practical tools for sharing the Gospel confidently.',
                'is_active'  => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($speakers as $data) {
            Speaker::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
