<?php

namespace Database\Seeders;

use App\Models\CoreValue;
use Illuminate\Database\Seeder;

class CoreValueSeeder extends Seeder
{
    public function run(): void
    {
        $values = [
            [
                'tag'        => 'Care',
                'heading'    => 'Care',
                'scripture'  => 'Hebrews 6:10-12',
                'quote'      => 'For God is not unjust. He will not forget how hard you have worked for him and how you have shown your love to him by caring for other believers, as you still do. Our great desire is that you will keep on loving others as long as life lasts, in order to make certain that what you hope for will come true.',
                'body_1'     => 'As Christians we are to be a reflection of God on earth and we are to care for others and seek different ways to serve others. We are a family of Christians who should care for our sheep, by helping whenever possible and directing people in the right direction of expertise.',
                'body_2'     => 'We can support and pray for every member and direct them to areas where there is special need. Also, area leaders to be aware of contacting certain members.',
                'sort_order' => 1,
                'is_active'  => true,
            ],
            [
                'tag'        => 'Communication',
                'heading'    => 'Communication',
                'scripture'  => 'Ephesians 4:15',
                'quote'      => 'Rather, speaking the truth in love, we are to grow up in every way into him who is the head, into Christ.',
                'body_1'     => 'Communicating God\'s love is a vital role. We are a praying church that must continue to seek God for direction, holding special praying meetings throughout the week.',
                'body_2'     => 'Practically we communicate to all members of our church via email, texting and fellowship.',
                'sort_order' => 2,
                'is_active'  => true,
            ],
            [
                'tag'        => 'Culture',
                'heading'    => 'Culture',
                'scripture'  => 'Philippians 2:3-5',
                'quote'      => 'Do nothing out of selfish ambition or vain conceit. Rather, in humility value others above yourselves, not looking to your own interests but each of you to the interests of the others. In your relationships with one another, have the same mindset as Christ Jesus.',
                'body_1'     => 'Building a \'Christian Culture\' is recognising servanthood within the church. Our first job as leaders is to serve the people. Allow them to go before us.',
                'body_2'     => 'Developing a culture that is humble, kind, understanding, loving, flexible, ready to change, knowing we have a picture to fulfil other than own ambition that will enable us to build better people around us.',
                'sort_order' => 3,
                'is_active'  => true,
            ],
            [
                'tag'        => 'Coaching',
                'heading'    => 'Coaching',
                'scripture'  => '1 Peter 4:10',
                'quote'      => 'Each of you should use whatever gift you have received to serve others, as faithful stewards of God\'s grace in its various forms.',
                'body_1'     => 'We are here to develop newly born Christians and existing members to the highest standard with the word of God. To give everyone a chance to understand scriptures. To make "disciples" and develop members into "leaders" and empower them in their gifting.',
                'body_2'     => 'We are to be the reflection of Christ to those we are coaching. We develop new converts by running courses, such as our Bible School, Christian Development Course and Living as a Christian Course.',
                'sort_order' => 4,
                'is_active'  => true,
            ],
            [
                'tag'        => 'Community',
                'heading'    => 'Community',
                'scripture'  => 'Matthew 25:39-40',
                'quote'      => 'And the King will answer them, \'Truly, I say to you, as you did it to one of the least of these my brothers, you did it to me.\'',
                'body_1'     => 'The idea of community comes from the sense of responsibility we have for each other. In the Bible, God encourages us to take care of our brethren while following the word of the Lord.',
                'body_2'     => 'To establish evangelistic tools to reach the community with outreach programs suited to everyone. Under the banner of \'Friends\' we can reach many people in a variety of ways such as our campus, events like international night, flower arranging, collecting clothes and other types of social events that are all designed to help reach our goals.',
                'sort_order' => 5,
                'is_active'  => true,
            ],
            [
                'tag'        => 'Commission',
                'heading'    => 'Commission (Abroad)',
                'scripture'  => 'Isaiah 6:8',
                'quote'      => 'Also I heard the voice of the Lord, saying, Whom shall I send, and who will go for us? Then said I, Here am I; send me.',
                'body_1'     => 'To be missional minded and promote every type of nation to our church. Using our existing involvement with India and Kenya, taking members with us on mission, support teaching, helping to run a school and reaching villages and tribes.',
                'body_2'     => 'Our heart is to send help to those in need.',
                'sort_order' => 6,
                'is_active'  => true,
            ],
            [
                'tag'        => 'Consistent & Committed',
                'heading'    => 'Consistent & Committed',
                'scripture'  => 'Acts 2:42',
                'quote'      => 'And they devoted themselves to the apostles\' teaching and the fellowship, to the breaking of bread and the prayers.',
                'body_1'     => 'We believe for every member and leader to be consistent and committed. This involves time keeping, being diligent in their work, honouring others they lead, being respectful in what you say, being teachable, having no personal agenda and walking strongly with the Lord.',
                'body_2'     => 'Every ministry is to be built on consistency and commitment towards one another.',
                'sort_order' => 7,
                'is_active'  => true,
            ],
        ];

        foreach ($values as $value) {
            CoreValue::updateOrCreate(
                ['tag' => $value['tag']],
                $value
            );
        }
    }
}
