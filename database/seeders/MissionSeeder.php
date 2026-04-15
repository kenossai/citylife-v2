<?php

namespace Database\Seeders;

use App\Models\MissionCountry;
use App\Models\MissionPillar;
use Illuminate\Database\Seeder;

class MissionSeeder extends Seeder
{
    public function run(): void
    {
        // ── Mission Pillars ────────────────────────────────────────────────────
        MissionPillar::firstOrCreate(
            ['slug' => 'kids-and-family-foundation'],
            [
                'title'       => 'Kids & Family Foundation',
                'subtitle'    => 'Bringing hope to those in need',
                'description' => 'A welcoming community initiative for families — running kids clubs with lunch, sewing and English classes for parents, and ongoing guidance and support.',
                'about_text'  => "Join us for a welcoming community event for families, designed to support, connect and uplift those in need. The Kids & Family Foundation is reaching out to the local community, while also supporting families as far as India and Africa.\n\nOur aim is simple — to bring hope, practical help and a sense of belonging. During the half-term, we'll be running a kids & family club, including lunch and fun activities for children.\n\nFor parents, there will also be sewing and English classes, as well as ongoing guidance and support. Whether you're looking for support, new skills, or just a friendly community space, you're very welcome to join us.",
                'vision_quote' => '"Whether you\'re looking for support, new skills, or just a friendly community space — you\'re very welcome."',
                'type'        => 'home',
                'sort_order'  => 1,
                'is_active'   => true,
            ]
        );

        MissionPillar::firstOrCreate(
            ['slug' => 'church-planting-india-africa'],
            [
                'title'       => 'Church Planting — India & Africa',
                'subtitle'    => 'Planting seeds of faith across nations',
                'description' => 'Partnering with local leaders across India and Sub-Saharan Africa to plant new churches, train pastors, and establish gospel-centred communities in unreached areas.',
                'about_text'  => "We believe the Great Commission is an active calling — and church planting is at the heart of it. Through deep partnerships with trusted local leaders, we are seeing new congregations established across rural India and Sub-Saharan Africa.\n\nOur approach is long-term and relationship-driven. We invest in pastoral training, provide resources for early-stage church communities, and travel to serve alongside our partners on the ground.\n\nEvery church planted represents lives transformed, communities strengthened, and the Kingdom advancing where it is needed most.",
                'vision_quote' => '"We are not just sending resources — we are sending ourselves."',
                'type'        => 'abroad',
                'sort_order'  => 2,
                'is_active'   => true,
            ]
        );

        // ── Mission Countries ─────────────────────────────────────────────────
        MissionCountry::firstOrCreate(
            ['name' => 'United Kingdom'],
            [
                'flag'       => '🇬🇧',
                'region'     => 'England, Scotland, Wales & Northern Ireland',
                'type'       => 'home',
                'sort_order' => 1,
                'is_active'  => true,
            ]
        );

        MissionCountry::firstOrCreate(
            ['name' => 'India'],
            [
                'flag'       => '🇮🇳',
                'region'     => 'South Asia',
                'type'       => 'abroad',
                'sort_order' => 2,
                'is_active'  => true,
            ]
        );
    }
}
