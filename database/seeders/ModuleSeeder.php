<?php

namespace Database\Seeders;

use App\Models\CourseLesson;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        // ── CDC — Christian Development Course (12 lessons / 4 modules) ──
        $cdcModules = [
            'Module 1 — Foundation of Faith' => [
                'introduction-to-christian-development',
                'salvation-and-new-birth',
                'water-baptism',
            ],
            'Module 2 — Holy Spirit & Devotion' => [
                'the-holy-spirit',
                'prayer-and-devotion',
                'the-word-of-god',
            ],
            'Module 3 — Faith & Community' => [
                'faith-and-trust-in-god',
                'the-church-and-fellowship',
                'christian-character-and-conduct',
            ],
            'Module 4 — Christian Living' => [
                'worship-and-praise',
                'spiritual-gifts',
                'evangelism-and-outreach',
            ],
        ];

        // ── LCLS — Living a Christian Life with Significance (10 lessons / 4 modules) ──
        $lclsModules = [
            'Module 1 — Identity & Purpose' => [
                'understanding-your-identity-in-christ',
                'discovering-your-purpose',
                'living-with-intentionality',
            ],
            'Module 2 — Mind & Relationships' => [
                'the-power-of-a-renewed-mind',
                'building-meaningful-relationships',
                'serving-with-excellence',
            ],
            'Module 3 — Stewardship & Resilience' => [
                'stewardship-and-generosity',
                'overcoming-obstacles',
            ],
            'Module 4 — Leadership & Legacy' => [
                'leadership-and-influence',
                'leaving-a-lasting-legacy',
            ],
        ];

        foreach ($cdcModules as $moduleName => $slugs) {
            CourseLesson::whereIn('slug', $slugs)->update(['week_group' => $moduleName]);
        }

        foreach ($lclsModules as $moduleName => $slugs) {
            CourseLesson::whereIn('slug', $slugs)->update(['week_group' => $moduleName]);
        }

        $this->command->info('Module groups assigned successfully.');
    }
}
