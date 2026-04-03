<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Leader;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $leader = Leader::firstOrCreate(
            ['name' => 'Bishop Robert Clarke'],
            [
                'role'       => 'Senior Bishop, City Life International Church',
                'bio'        => "Bishop Robert Clarke has served in full-time ministry for over 30 years. Originally from Lagos, Nigeria, he founded City Life International Church in Sheffield in 1998 with a congregation of 12 people. Today, the church serves over 2,000 members across two campuses. Bishop Clarke is a sought-after conference speaker, author of six books, and holds a doctorate in Biblical Theology from Durham University. He is married to Dr. Angela Clarke and together they have four children.",
                'is_featured' => true,
                'is_active'  => true,
                'sort_order' => 1,
            ]
        );

        Book::updateOrCreate(
            ['slug' => 'the-spirit-filled-life'],
            [
                'leader_id'       => $leader->id,
                'title'           => 'The Spirit-Filled Life',
                'author'          => 'Bishop Robert Clarke',
                'subtitle'        => 'Living in the power and presence of the Holy Spirit every day',
                'description'     => "Discover what it truly means to live a Spirit-filled life in today's world.\n\nIn this powerful and practical book, Bishop Robert Clarke draws from over three decades of ministry experience to show you how to cultivate a deep, daily walk with the Holy Spirit. Whether you are new to faith or a seasoned believer, this book will challenge and inspire you to move beyond mere religion into a vibrant, living relationship with God.\n\nYou will learn how to:\n• Recognise and yield to the Holy Spirit's leading\n• Experience consistent spiritual growth and renewal\n• Walk in the gifts of the Spirit with confidence\n• Maintain spiritual power in the pressures of everyday life\n\nThis is not a book about theory — it is a roadmap for transformation.",
                'categories'      => ['Spiritual Growth', 'Holy Spirit'],
                'publisher'       => 'City Life Press',
                'published_month' => 'March 2025',
                'page_count'      => 214,
                'isbn'            => '978-1-234567-89-0',
                'language'        => 'English',
                'format'          => 'Paperback + eBook',
                'amazon_url'      => 'https://www.amazon.co.uk',
                'kindle_url'      => 'https://www.amazon.co.uk/kindle-store',
                'is_published'    => true,
            ]
        );

        Book::updateOrCreate(
            ['slug' => 'praying-through-the-psalms'],
            [
                'leader_id'       => $leader->id,
                'title'           => 'Praying Through the Psalms',
                'author'          => 'Bishop Robert Clarke',
                'subtitle'        => 'A 30-day devotional journey through the heart of Scripture',
                'description'     => "The Psalms have been the prayer book of God's people for thousands of years — and they are just as relevant today.\n\nIn this 30-day devotional, Bishop Robert Clarke guides you verse by verse through some of the most beloved Psalms, showing you how to use their words as your own prayers. Each day includes a passage, reflection, and prayer prompt to help you build a deeper, more consistent prayer life.\n\nIdeal for personal quiet times, small groups, or church-wide devotionals.",
                'categories'      => ['Prayer', 'Devotional'],
                'publisher'       => 'City Life Press',
                'published_month' => 'January 2024',
                'page_count'      => 132,
                'isbn'            => '978-1-234567-90-6',
                'language'        => 'English',
                'format'          => 'Paperback + eBook',
                'amazon_url'      => 'https://www.amazon.co.uk',
                'kindle_url'      => 'https://www.amazon.co.uk/kindle-store',
                'is_published'    => true,
            ]
        );
    }
}
