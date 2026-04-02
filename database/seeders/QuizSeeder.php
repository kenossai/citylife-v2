<?php

namespace Database\Seeders;

use App\Models\CourseLesson;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $quizzes = [

            // CDC — Salvation and New Birth (lesson 2)
            'salvation-and-new-birth' => [
                [
                    'question' => 'According to Ephesians 2:8-9, salvation is received through which of the following?',
                    'options'  => ['Good works and moral living', 'Faith, as a gift from God', 'Church attendance and baptism', 'Keeping the Ten Commandments'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'What did Jesus mean in John 3:3 when He said a person must be "born again"?',
                    'options'  => ['A person must be physically reborn', 'A person must undergo a spiritual transformation to enter God\'s kingdom', 'A person must re-enrol in Bible classes', 'A person must change their name'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'Which scripture declares that those who confess with their mouth and believe in their heart will be saved?',
                    'options'  => ['John 3:16', 'Romans 10:9-10', '2 Corinthians 5:17', 'Ephesians 2:8'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'What does 2 Corinthians 5:17 say about someone who is in Christ?',
                    'options'  => ['They are under the law', 'They are a new creation — the old has gone, the new has come', 'They no longer need to pray', 'They will never face trials'],
                    'answer'   => 1,
                ],
            ],

            // CDC — The Holy Spirit (lesson 4)
            'the-holy-spirit' => [
                [
                    'question' => 'What title does Jesus give the Holy Spirit in John 14:26?',
                    'options'  => ['The Watcher', 'The Comforter and Counsellor', 'The Judge', 'The Lawgiver'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'According to Acts 1:8, what does the Holy Spirit give believers?',
                    'options'  => ['Wealth and prosperity', 'Power to be witnesses', 'Freedom from all temptation', 'Authority over governments'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'What does Ephesians 5:18 instruct believers to do?',
                    'options'  => ['Avoid all worldly entertainment', 'Be filled with the Spirit', 'Speak only in tongues', 'Seek visions and dreams daily'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'Which of the following is listed as a fruit of the Spirit in Galatians 5:22-23?',
                    'options'  => ['Ambition', 'Self-sufficiency', 'Love, joy, and peace', 'Wealth and success'],
                    'answer'   => 2,
                ],
            ],

            // CDC — Prayer and Devotion (lesson 5)
            'prayer-and-devotion' => [
                [
                    'question' => 'Which acronym is used in this lesson to describe the four main types of prayer?',
                    'options'  => ['FAITH', 'ACTS', 'PRAY', 'WORD'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'What does "Intercession" mean in the context of prayer?',
                    'options'  => ['Praying for yourself only', 'Confessing your sins', 'Praying on behalf of others', 'Praising God for His creation'],
                    'answer'   => 2,
                ],
                [
                    'question' => 'In Luke 5:16, Jesus modelled a key spiritual discipline. What did He do?',
                    'options'  => ['He preached in the temple every morning', 'He often withdrew to quiet places to pray', 'He fasted for 40 days each month', 'He memorised scripture publicly'],
                    'answer'   => 1,
                ],
            ],

            // CDC — The Word of God (lesson 6)
            'the-word-of-god' => [
                [
                    'question' => 'According to 2 Timothy 3:16-17, what is Scripture described as?',
                    'options'  => ['A collection of human wisdom', 'God-breathed and useful for teaching, rebuking, correcting and training', 'An ancient historical record only', 'A guide for religious leaders alone'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'What does Psalm 119:105 say about God\'s Word?',
                    'options'  => ['It will make you wealthy', 'It is a lamp to my feet and a light to my path', 'It replaces the need for prayer', 'It is hard to understand without a degree'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'What are the three steps of effective Bible study described in this lesson?',
                    'options'  => ['Read, Memorise, Recite', 'Observe, Interpret, Apply', 'Pray, Copy, Share', 'Skim, Highlight, Discuss'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'According to Romans 10:17, how does faith come?',
                    'options'  => ['Through dreams and visions', 'By hearing the message through the Word of Christ', 'Through fasting and prayer alone', 'By attending church regularly'],
                    'answer'   => 1,
                ],
            ],

            // Living a Christian Life — Understanding Your Identity in Christ (lesson 1)
            'understanding-your-identity-in-christ' => [
                [
                    'question' => 'According to this lesson, what is the foundation of a significant Christian life?',
                    'options'  => ['Being active in church programmes', 'Understanding your identity in Christ', 'Having a large social following', 'Earning a theological degree'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'What does Ephesians 2:10 say about believers?',
                    'options'  => ['They are saved by their own effort', 'They are God\'s handiwork, created in Christ Jesus to do good works', 'They must work to earn God\'s favour', 'They are saved but have no special purpose'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'Which of the following best describes a "child of God" according to this lesson?',
                    'options'  => ['Someone who attends church regularly', 'Someone born into a Christian family', 'Someone who has received Christ and been born of God', 'Someone who has been water baptised'],
                    'answer'   => 2,
                ],
            ],

            // Living a Christian Life — The Power of a Renewed Mind (lesson 4)
            'the-power-of-a-renewed-mind' => [
                [
                    'question' => 'What does Romans 12:2 instruct believers not to do?',
                    'options'  => ['Pray in public', 'Conform to the pattern of this world', 'Read secular books', 'Associate with non-believers'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'What happens when the mind is renewed, according to this lesson?',
                    'options'  => ['You gain academic intelligence', 'You can test and approve what God\'s good, pleasing and perfect will is', 'You automatically become prosperous', 'You never experience negative thoughts again'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'According to Philippians 4:8, believers should "think about" things that are:',
                    'options'  => ['Entertaining and popular', 'True, noble, right, pure and lovely', 'Profitable and successful', 'Easy and comfortable'],
                    'answer'   => 1,
                ],
            ],

            // Living a Christian Life — Overcoming Obstacles (lesson 8)
            'overcoming-obstacles' => [
                [
                    'question' => 'What does James 1:2-3 say about trials?',
                    'options'  => ['Avoid all trials at all costs', 'Consider it pure joy, because the testing of faith develops perseverance', 'Trials prove God has abandoned you', 'Only weak Christians face trials'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'According to Romans 8:28, God works for the good of those who:',
                    'options'  => ['Attend church every Sunday', 'Love Him and are called according to His purpose', 'Never make mistakes', 'Perform the most good deeds'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'What does Philippians 4:13 declare?',
                    'options'  => ['I can do all things through wealth', 'I can do all things through Christ who gives me strength', 'I can overcome obstacles through willpower alone', 'Nothing is truly impossible with enough effort'],
                    'answer'   => 1,
                ],
                [
                    'question' => 'According to this lesson, what is a key attitude for overcoming obstacles?',
                    'options'  => ['Self-reliance and independence', 'Trusting God\'s sovereignty and maintaining a perspective of faith', 'Avoiding all challenges', 'Only praying when things get difficult'],
                    'answer'   => 1,
                ],
            ],
        ];

        foreach ($quizzes as $slug => $questions) {
            $updated = CourseLesson::where('slug', $slug)->update(['quiz_questions' => json_encode($questions)]);
            $this->command->info($updated ? "✓ Quiz seeded: {$slug}" : "⚠ Lesson not found: {$slug}");
        }
    }
}
