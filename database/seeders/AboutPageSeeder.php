<?php

namespace Database\Seeders;

use App\Models\CoreValue;
use App\Models\WorshipCentre;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        // Core Values
        $coreValues = [
            [
                'tag' => 'Prayer',
                'image_path' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?auto=format&fit=crop&w=900&q=80',
                'heading' => "We Don't Just Believe In Prayer. We Believe In Answered Prayer.",
                'body_1' => "Prayer is the foundation of everything we do at City Life International Church. We believe prayer connects us to God's heart, aligns us with His will, and releases His power in every season.",
                'body_2' => "Through personal prayer, corporate gatherings, and intercession, we seek God's direction, strength, and guidance for our church, our city, and the nations.",
                'quote' => 'Devote yourselves to prayer, being watchful and thankful.',
                'scripture' => 'Colossians 4:2',
                'sort_order' => 0,
            ],
            [
                'tag' => 'The Word',
                'image_path' => 'https://images.unsplash.com/photo-1461378810796-1bd3f1ce3c73?auto=format&fit=crop&w=900&q=80',
                'heading' => "We Build Our Lives On The Foundation Of God's Word.",
                'body_1' => 'The Bible is our authority, our comfort, and our guide. We are committed to teaching Scripture clearly so people can know Jesus deeply and live out their faith with confidence.',
                'body_2' => 'From Sunday preaching to discipleship spaces, we want every generation to be rooted in truth and equipped to walk faithfully in everyday life.',
                'quote' => 'Your word is a lamp to my feet and a light to my path.',
                'scripture' => 'Psalm 119:105',
                'sort_order' => 1,
            ],
            [
                'tag' => 'Community',
                'image_path' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=900&q=80',
                'heading' => 'We Are Better Together. Family Is At The Heart Of Who We Are.',
                'body_1' => 'God designed us to follow Jesus in community, not in isolation. At City Life, we value authentic relationships marked by love, encouragement, accountability, and belonging.',
                'body_2' => 'Through small groups, shared meals, serving teams, and intentional care, we create a church family where people are known and supported.',
                'quote' => 'Let us consider how we may spur one another on toward love and good deeds.',
                'scripture' => 'Hebrews 10:24',
                'sort_order' => 2,
            ],
            [
                'tag' => 'Outreach',
                'image_path' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=900&q=80',
                'heading' => 'We Are Called To Go Beyond Our Walls And Serve Our City.',
                'body_1' => 'We believe the Church exists not only for itself, but for the world around it. Outreach is part of our DNA, from local care projects to partnerships that extend far beyond Sheffield.',
                'body_2' => 'We want to be a people who carry the compassion, hope, and truth of Jesus into every street, every neighbourhood, and every nation we can reach.',
                'quote' => 'Go and make disciples of all nations.',
                'scripture' => 'Matthew 28:19',
                'sort_order' => 3,
            ],
        ];

        foreach ($coreValues as $value) {
            CoreValue::updateOrCreate(
                ['tag' => $value['tag']],
                $value,
            );
        }

        // Worship Centres
        $centres = [
            [
                'label' => 'City Centre',
                'name' => 'Sheffield City Centre',
                'address' => '1 South Parade Shalesmoor, Sheffield, S3 8SS',
                'landmark' => 'Behind Sheffield City Hall',
                'times' => 'Sunday 9:00 AM and 11:00 AM',
                'phone' => '+44 114 134 8912',
                'sort_order' => 0,
            ],
        ];

        foreach ($centres as $centre) {
            WorshipCentre::updateOrCreate(
                ['label' => $centre['label']],
                $centre,
            );
        }
    }
}
