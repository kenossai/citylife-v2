<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseLesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Course 1: Christian Development Course (CDC) ──
        $cdc = Course::create([
            'title'                => 'Christian Development Course (CDC)',
            'slug'                 => 'christian-development-course',
            'category'             => 'Bible Study',
            'description'          => 'A comprehensive course on Christian development by Rev Dr Jim Master. This course covers the foundational principles of growing in faith, understanding scripture, and developing a mature Christian walk.',
            'start_date'           => now()->addWeeks(2)->toDateString(),
            'end_date'             => now()->addWeeks(14)->toDateString(),
            'has_certificate'      => true,
            'is_registration_open' => true,
            'is_active'            => true,
        ]);

        $cdcLessons = [
            [
                'title'       => 'Introduction to Christian Development',
                'description' => 'An overview of the Christian development journey, exploring what it means to grow spiritually and the key stages of maturity in Christ.',
                'content'     => '<h2>Welcome to the Christian Development Course</h2><p>This course is designed to help you build a strong foundation for your Christian faith. Whether you are a new believer or have been walking with Christ for years, these lessons will equip you with biblical knowledge and practical tools for spiritual growth.</p><h3>What is Christian Development?</h3><p>Christian development is the ongoing process of becoming more like Jesus Christ in our thoughts, attitudes, and actions. It involves a commitment to learning God\'s Word, developing a consistent prayer life, and living out our faith in everyday situations.</p><h3>Course Objectives</h3><ul><li>Understand the foundational truths of the Christian faith</li><li>Develop spiritual disciplines for daily living</li><li>Build confidence in sharing your faith with others</li><li>Grow in your relationship with God and fellow believers</li></ul>',
            ],
            [
                'title'       => 'Salvation and New Birth',
                'description' => 'Understanding what salvation means, the significance of being born again, and how to receive and walk in the assurance of salvation.',
                'content'     => '<h2>The Gift of Salvation</h2><p>Salvation is the cornerstone of the Christian faith. It is God\'s gracious gift to humanity, made possible through the death and resurrection of Jesus Christ.</p><h3>What is Salvation?</h3><p>Salvation is deliverance from sin and its consequences, brought about by faith in Jesus Christ. The Bible teaches in Ephesians 2:8-9, <em>"For it is by grace you have been saved, through faith — and this is not from yourselves, it is the gift of God — not by works, so that no one can boast."</em></p><h3>The New Birth</h3><p>In John 3:3, Jesus said, <em>"Very truly I tell you, no one can see the kingdom of God unless they are born again."</em> The new birth is a spiritual transformation that happens when we accept Christ as Lord and Saviour. It marks the beginning of a new life in Him.</p><h3>Key Scriptures</h3><ul><li>Romans 10:9-10 — Confession and belief</li><li>John 3:16 — God\'s love and gift of eternal life</li><li>2 Corinthians 5:17 — A new creation in Christ</li><li>Romans 6:23 — The wages of sin and the gift of God</li></ul>',
            ],
            [
                'title'       => 'Water Baptism',
                'description' => 'The biblical significance of water baptism, its symbolism, and why it is an important step of obedience for every believer.',
                'content'     => '<h2>The Significance of Water Baptism</h2><p>Water baptism is one of the first acts of obedience for a new believer. It is a public declaration of your faith in Jesus Christ and your identification with His death, burial, and resurrection.</p><h3>Why Be Baptised?</h3><p>Jesus Himself was baptised (Matthew 3:13-17) and commanded His followers to be baptised. In Matthew 28:19, He said, <em>"Go therefore and make disciples of all nations, baptising them in the name of the Father and of the Son and of the Holy Spirit."</em></p><h3>The Symbolism of Baptism</h3><p>Romans 6:4 explains: <em>"We were therefore buried with him through baptism into death in order that, just as Christ was raised from the dead through the glory of the Father, we too may live a new life."</em></p><ul><li>Going under the water — dying to your old self</li><li>Coming up out of the water — rising to new life in Christ</li></ul>',
            ],
            [
                'title'       => 'The Holy Spirit',
                'description' => 'Who the Holy Spirit is, His role in the life of a believer, and how to be filled with and led by the Spirit daily.',
                'content'     => '<h2>The Person and Work of the Holy Spirit</h2><p>The Holy Spirit is the third person of the Trinity — God the Father, God the Son, and God the Holy Spirit. He is not merely a force or influence; He is a person who dwells within every believer.</p><h3>The Role of the Holy Spirit</h3><ul><li><strong>Comforter and Counsellor</strong> — John 14:26</li><li><strong>Guide into all truth</strong> — John 16:13</li><li><strong>Empowerment for service</strong> — Acts 1:8</li><li><strong>Conviction of sin</strong> — John 16:8</li><li><strong>Producing spiritual fruit</strong> — Galatians 5:22-23</li></ul><h3>Being Filled with the Spirit</h3><p>Ephesians 5:18 instructs us to <em>"be filled with the Spirit."</em> This is not a one-time event but a continual experience. As we yield to the Holy Spirit daily through prayer, worship, and obedience to God\'s Word, we experience His power and presence in our lives.</p>',
            ],
            [
                'title'       => 'Prayer and Devotion',
                'description' => 'Developing a consistent and effective prayer life, understanding different types of prayer, and building a daily devotional habit.',
                'content'     => '<h2>The Power of Prayer</h2><p>Prayer is our direct line of communication with God. It is not merely a religious ritual but a vital relationship-building activity that draws us closer to our Heavenly Father.</p><h3>Types of Prayer</h3><ul><li><strong>Adoration</strong> — Praising God for who He is</li><li><strong>Confession</strong> — Acknowledging our sins and seeking forgiveness</li><li><strong>Thanksgiving</strong> — Expressing gratitude for God\'s blessings</li><li><strong>Supplication</strong> — Presenting our requests and needs to God</li><li><strong>Intercession</strong> — Praying on behalf of others</li></ul><h3>Building a Devotional Life</h3><p>A daily devotional time is essential for spiritual growth. This includes reading Scripture, meditating on God\'s Word, and spending time in prayer. Jesus modelled this by often withdrawing to quiet places to pray (Luke 5:16).</p><h3>Practical Tips</h3><ul><li>Set a specific time and place for daily devotion</li><li>Use a Bible reading plan to stay consistent</li><li>Keep a prayer journal to track requests and answers</li><li>Start with short periods and gradually increase</li></ul>',
            ],
            [
                'title'       => 'The Word of God',
                'description' => 'The authority, power, and relevance of the Bible in the believer\'s life, and practical approaches to studying Scripture.',
                'content'     => '<h2>The Authority of Scripture</h2><p>The Bible is the inspired, infallible Word of God. 2 Timothy 3:16-17 declares, <em>"All Scripture is God-breathed and is useful for teaching, rebuking, correcting and training in righteousness, so that the servant of God may be thoroughly equipped for every good work."</em></p><h3>Why Study the Bible?</h3><ul><li>It reveals God\'s character and plan for our lives</li><li>It provides guidance for daily decisions — Psalm 119:105</li><li>It strengthens our faith — Romans 10:17</li><li>It equips us for spiritual warfare — Ephesians 6:17</li></ul><h3>How to Study the Bible</h3><p>Effective Bible study involves more than casual reading. Consider these methods:</p><ul><li><strong>Observation</strong> — What does the text say?</li><li><strong>Interpretation</strong> — What does the text mean?</li><li><strong>Application</strong> — How does it apply to my life?</li></ul><p>Approach Scripture with a humble heart, asking the Holy Spirit to illuminate its truths to you.</p>',
            ],
            [
                'title'       => 'Faith and Trust in God',
                'description' => 'Understanding biblical faith, learning to trust God in all circumstances, and strengthening your faith through trials.',
                'content'     => '<h2>Living by Faith</h2><p>Hebrews 11:1 defines faith: <em>"Now faith is confidence in what we hope for and assurance about what we do not see."</em> Faith is the foundation of our relationship with God.</p><h3>The Nature of Faith</h3><p>Faith is not blind belief — it is trust rooted in the character and promises of God. Hebrews 11:6 tells us that <em>"without faith it is impossible to please God, because anyone who comes to him must believe that he exists and that he rewards those who earnestly seek him."</em></p><h3>Growing in Faith</h3><ul><li><strong>Through the Word</strong> — Romans 10:17: "Faith comes from hearing the message"</li><li><strong>Through prayer</strong> — Communicating with God builds trust</li><li><strong>Through trials</strong> — James 1:2-4: Testing produces perseverance</li><li><strong>Through obedience</strong> — Acting on what God says strengthens faith</li></ul><h3>Trusting God in Difficult Times</h3><p>Proverbs 3:5-6 instructs, <em>"Trust in the Lord with all your heart and lean not on your own understanding; in all your ways submit to him, and he will make your paths straight."</em></p>',
            ],
            [
                'title'       => 'The Church and Fellowship',
                'description' => 'The purpose and importance of the local church, the value of Christian fellowship, and how to be an active member of the body of Christ.',
                'content'     => '<h2>The Body of Christ</h2><p>The church is not a building — it is the people of God gathered together in the name of Jesus. Hebrews 10:25 urges us, <em>"Let us not give up meeting together, as some are in the habit of doing, but let us encourage one another."</em></p><h3>Why the Church Matters</h3><ul><li><strong>Worship</strong> — Corporate worship draws us into God\'s presence</li><li><strong>Teaching</strong> — We grow through sound biblical instruction</li><li><strong>Fellowship</strong> — We encourage and support one another</li><li><strong>Service</strong> — We use our gifts to build up the body</li><li><strong>Mission</strong> — Together we reach the world with the Gospel</li></ul><h3>Being an Active Member</h3><p>1 Corinthians 12:27 says, <em>"Now you are the body of Christ, and each one of you is a part of it."</em> Every member has a role to play. God has uniquely gifted and positioned you within His church for a purpose.</p><h3>The Value of Fellowship</h3><p>Christian fellowship goes beyond socialising. It is sharing life together — bearing one another\'s burdens (Galatians 6:2), praying for each other (James 5:16), and spurring one another on towards love and good deeds (Hebrews 10:24).</p>',
            ],
            [
                'title'       => 'Christian Character and Conduct',
                'description' => 'Developing Christ-like character, understanding biblical standards of conduct, and living a life that honours God.',
                'content'     => '<h2>Becoming Like Christ</h2><p>As Christians, we are called to reflect the character of Jesus in every area of our lives. Romans 8:29 tells us that God predestined us <em>"to be conformed to the image of his Son."</em></p><h3>The Fruit of the Spirit</h3><p>Galatians 5:22-23 lists the qualities that the Holy Spirit produces in us:</p><ul><li>Love, Joy, Peace</li><li>Patience, Kindness, Goodness</li><li>Faithfulness, Gentleness, Self-control</li></ul><h3>Practical Christian Conduct</h3><ul><li><strong>Integrity</strong> — Being honest and consistent in word and deed</li><li><strong>Humility</strong> — Putting others before ourselves (Philippians 2:3)</li><li><strong>Forgiveness</strong> — Forgiving as Christ forgave us (Colossians 3:13)</li><li><strong>Purity</strong> — Guarding our hearts and minds (Philippians 4:8)</li><li><strong>Love</strong> — The defining mark of a Christian (John 13:35)</li></ul><p>Our conduct should be a testimony that points others to Christ.</p>',
            ],
            [
                'title'       => 'Worship and Praise',
                'description' => 'The biblical foundations of worship, different expressions of praise, and cultivating a lifestyle of worship.',
                'content'     => '<h2>A Life of Worship</h2><p>Worship is more than singing — it is a lifestyle of honouring God in everything we do. Romans 12:1 calls us to <em>"offer your bodies as a living sacrifice, holy and pleasing to God — this is your true and proper worship."</em></p><h3>What is Worship?</h3><p>Worship is our response to who God is and what He has done. It is acknowledging His worth, His majesty, and His love. John 4:24 teaches that <em>"God is spirit, and his worshippers must worship in the Spirit and in truth."</em></p><h3>Expressions of Praise</h3><ul><li><strong>Singing</strong> — Psalm 100:2: "Come before him with joyful songs"</li><li><strong>Lifting hands</strong> — Psalm 134:2</li><li><strong>Clapping</strong> — Psalm 47:1</li><li><strong>Dancing</strong> — Psalm 149:3</li><li><strong>Silence and meditation</strong> — Psalm 46:10</li><li><strong>Giving</strong> — An act of worship (2 Corinthians 9:7)</li></ul><h3>Cultivating Daily Worship</h3><p>Worship should not be confined to Sunday services. Make it a daily practice — play worship music, meditate on Scripture, give thanks throughout the day, and live with an awareness of God\'s presence.</p>',
            ],
            [
                'title'       => 'Spiritual Gifts',
                'description' => 'Discovering and understanding spiritual gifts, their purpose in the body of Christ, and how to operate in your gifting.',
                'content'     => '<h2>Gifts for the Body</h2><p>Every believer has been given spiritual gifts by the Holy Spirit for the building up of the church. 1 Corinthians 12:7 says, <em>"Now to each one the manifestation of the Spirit is given for the common good."</em></p><h3>Categories of Spiritual Gifts</h3><p><strong>Motivational Gifts (Romans 12:6-8):</strong></p><ul><li>Prophecy, Serving, Teaching, Encouraging, Giving, Leadership, Mercy</li></ul><p><strong>Ministry Gifts (Ephesians 4:11):</strong></p><ul><li>Apostles, Prophets, Evangelists, Pastors, Teachers</li></ul><p><strong>Manifestation Gifts (1 Corinthians 12:8-10):</strong></p><ul><li>Word of Wisdom, Word of Knowledge, Faith, Healing, Miracles, Prophecy, Discerning of Spirits, Tongues, Interpretation of Tongues</li></ul><h3>Discovering Your Gifts</h3><ul><li>Pray and ask God to reveal your gifts</li><li>Serve in different areas and see where you are most effective</li><li>Seek feedback from mature believers</li><li>Study Scripture on spiritual gifts</li></ul><p>Remember: gifts are given to serve others, not to promote ourselves.</p>',
            ],
            [
                'title'       => 'Evangelism and Outreach',
                'description' => 'Sharing the Gospel effectively, overcoming fear in witnessing, and practical strategies for reaching your community.',
                'content'     => '<h2>The Great Commission</h2><p>In Matthew 28:19-20, Jesus commands, <em>"Therefore go and make disciples of all nations, baptising them in the name of the Father and of the Son and of the Holy Spirit, and teaching them to obey everything I have commanded you."</em></p><h3>Why Evangelism Matters</h3><p>Every person needs to hear the Good News of Jesus Christ. Romans 10:14 asks, <em>"How, then, can they call on the one they have not believed in? And how can they believe in the one of whom they have not heard?"</em> We are God\'s ambassadors (2 Corinthians 5:20).</p><h3>Overcoming Fear</h3><ul><li>Remember that the Holy Spirit empowers you (Acts 1:8)</li><li>You are sharing truth, not debating — let God handle the results</li><li>Your personal testimony is powerful (Revelation 12:11)</li><li>Start with people who already know and trust you</li></ul><h3>Practical Outreach</h3><ul><li>Build genuine relationships with non-believers</li><li>Invite people to church events and services</li><li>Share your testimony openly when opportunities arise</li><li>Serve your community through acts of love and kindness</li><li>Use social media to share encouraging and faith-based content</li></ul>',
            ],
        ];

        foreach ($cdcLessons as $i => $lesson) {
            CourseLesson::create([
                'course_id'     => $cdc->id,
                'title'         => $lesson['title'],
                'slug'          => Str::slug($lesson['title']),
                'lesson_number' => $i + 1,
                'description'   => $lesson['description'],
                'content'       => $lesson['content'],
                'is_published'  => true,
            ]);
        }

        // ── Course 2: Living a Christian Life with Significance ──
        $lcls = Course::create([
            'title'                => 'Living a Christian Life with Significance',
            'slug'                 => 'living-a-christian-life-with-significance',
            'category'             => 'Christian Living',
            'description'          => 'A transformative course by Rev Dr Jim Master exploring how to live a purposeful and significant Christian life. Covers topics on identity in Christ, purpose, service, and eternal impact.',
            'start_date'           => now()->addWeeks(4)->toDateString(),
            'end_date'             => now()->addWeeks(16)->toDateString(),
            'has_certificate'      => true,
            'is_registration_open' => true,
            'is_active'            => true,
        ]);

        $lclsLessons = [
            [
                'title'       => 'Understanding Your Identity in Christ',
                'description' => 'Discovering who you are in Christ, understanding your value and worth as a child of God, and living from a place of identity rather than insecurity.',
                'content'     => '<h2>Who You Are in Christ</h2><p>One of the most transformative truths a Christian can grasp is their identity in Christ. 2 Corinthians 5:17 declares, <em>"Therefore, if anyone is in Christ, the new creation has come: The old has gone, the new is here!"</em></p><h3>Your Identity Statements</h3><ul><li>You are <strong>chosen</strong> — 1 Peter 2:9</li><li>You are <strong>loved</strong> — Romans 8:38-39</li><li>You are <strong>forgiven</strong> — Ephesians 1:7</li><li>You are <strong>God\'s workmanship</strong> — Ephesians 2:10</li><li>You are <strong>more than a conqueror</strong> — Romans 8:37</li><li>You are a <strong>child of God</strong> — John 1:12</li></ul><h3>Living from Identity, Not for Identity</h3><p>Many people live trying to prove their worth through achievements, appearances, or approval from others. But in Christ, your worth is already established. You don\'t need to earn God\'s love — you simply receive it and live from it.</p><p>When you truly understand who you are in Christ, it transforms how you see yourself, how you relate to others, and how you face challenges.</p>',
            ],
            [
                'title'       => 'Discovering Your Purpose',
                'description' => 'Understanding God\'s unique purpose for your life, aligning your gifts and passions with His plan, and taking practical steps towards your calling.',
                'content'     => '<h2>Created with Purpose</h2><p>You are not an accident. Jeremiah 29:11 confirms, <em>"For I know the plans I have for you, declares the Lord, plans to prosper you and not to harm you, plans to give you hope and a future."</em></p><h3>Purpose vs. Occupation</h3><p>Your purpose is not the same as your job. Your purpose is the reason God created you — the unique contribution you are meant to make in this world. Your occupation may be a vehicle for your purpose, but purpose runs deeper than career.</p><h3>Discovering Your Purpose</h3><ul><li><strong>Examine your passions</strong> — What burdens your heart? What excites you?</li><li><strong>Identify your gifts</strong> — What are you naturally good at?</li><li><strong>Consider your experiences</strong> — How has God shaped you through life?</li><li><strong>Seek God in prayer</strong> — Ask Him to reveal His plan for you</li><li><strong>Serve others</strong> — Purpose is often discovered in serving</li></ul><p>Ephesians 2:10 reminds us: <em>"For we are God\'s handiwork, created in Christ Jesus to do good works, which God prepared in advance for us to do."</em></p>',
            ],
            [
                'title'       => 'Living with Intentionality',
                'description' => 'Moving from passive living to intentional Christ-centred decision making, setting godly goals, and making the most of every opportunity.',
                'content'     => '<h2>Be Intentional</h2><p>Ephesians 5:15-16 instructs, <em>"Be very careful, then, how you live — not as unwise but as wise, making the most of every opportunity."</em> Living with intentionality means being purposeful in how you spend your time, energy, and resources.</p><h3>Areas of Intentional Living</h3><ul><li><strong>Spiritual life</strong> — Schedule time for prayer, Bible study, and worship</li><li><strong>Relationships</strong> — Invest in meaningful, God-honouring relationships</li><li><strong>Health</strong> — Steward your body as a temple of the Holy Spirit</li><li><strong>Finances</strong> — Manage money wisely and give generously</li><li><strong>Service</strong> — Look for opportunities to serve and bless others</li></ul><h3>Setting Godly Goals</h3><p>Proverbs 16:3 says, <em>"Commit to the Lord whatever you do, and he will establish your plans."</em> Set goals that align with God\'s Word and purpose for your life. Write them down, pray over them, and take consistent action.</p><p>An intentional life is a significant life. Don\'t drift through your days — live on purpose, for a purpose.</p>',
            ],
            [
                'title'       => 'The Power of a Renewed Mind',
                'description' => 'Transforming your thinking through Scripture, breaking negative thought patterns, and developing a mindset aligned with God\'s truth.',
                'content'     => '<h2>Renewing Your Mind</h2><p>Romans 12:2 commands, <em>"Do not conform to the pattern of this world, but be transformed by the renewing of your mind. Then you will be able to test and approve what God\'s will is — his good, pleasing and perfect will."</em></p><h3>Why the Mind Matters</h3><p>Proverbs 23:7 says, <em>"As a man thinks in his heart, so is he."</em> Your thoughts shape your beliefs, your beliefs shape your actions, and your actions shape your life. Transformation begins in the mind.</p><h3>Practical Steps to Renew Your Mind</h3><ul><li><strong>Meditate on Scripture</strong> — Joshua 1:8: Meditate on it day and night</li><li><strong>Take thoughts captive</strong> — 2 Corinthians 10:5: Demolish arguments and take every thought captive to Christ</li><li><strong>Guard your inputs</strong> — Be mindful of what you watch, read, and listen to</li><li><strong>Speak truth over yourself</strong> — Replace lies with God\'s promises</li><li><strong>Surround yourself with positive influences</strong> — Proverbs 13:20</li></ul><p>A renewed mind is the key to living a victorious, significant Christian life.</p>',
            ],
            [
                'title'       => 'Building Meaningful Relationships',
                'description' => 'The importance of godly relationships, principles for building strong connections, and navigating relational challenges with grace.',
                'content'     => '<h2>Relationships That Matter</h2><p>God created us for relationship — with Him and with one another. Ecclesiastes 4:9-10 says, <em>"Two are better than one, because they have a good return for their labour: If either of them falls down, one can help the other up."</em></p><h3>Principles for Godly Relationships</h3><ul><li><strong>Love unconditionally</strong> — 1 Corinthians 13:4-7</li><li><strong>Be a faithful friend</strong> — Proverbs 17:17</li><li><strong>Speak truth in love</strong> — Ephesians 4:15</li><li><strong>Forgive freely</strong> — Colossians 3:13</li><li><strong>Serve one another</strong> — Galatians 5:13</li></ul><h3>Choosing Your Circle</h3><p>1 Corinthians 15:33 warns, <em>"Do not be misled: Bad company corrupts good character."</em> Be intentional about who you allow to influence your life. Seek relationships with people who challenge you to grow, hold you accountable, and point you towards Christ.</p><h3>Navigating Conflict</h3><p>Conflict is inevitable, but it need not be destructive. Matthew 18:15 provides a framework: go directly to the person, speak honestly, and seek reconciliation. Always approach conflict with humility, a willingness to listen, and a desire for peace.</p>',
            ],
            [
                'title'       => 'Serving with Excellence',
                'description' => 'Embracing a servant heart, understanding that greatness in God\'s Kingdom comes through serving, and giving your best in every area.',
                'content'     => '<h2>The Heart of a Servant</h2><p>Jesus, the greatest leader who ever lived, defined greatness through service. Mark 10:45 records, <em>"For even the Son of Man did not come to be served, but to serve, and to give his life as a ransom for many."</em></p><h3>Why Excellence Matters</h3><p>Colossians 3:23-24 instructs, <em>"Whatever you do, work at it with all your heart, as working for the Lord, not for human masters."</em> When we serve, we serve God — and He deserves our very best.</p><h3>Areas of Service</h3><ul><li><strong>In the church</strong> — Use your gifts to serve the body of Christ</li><li><strong>In the community</strong> — Be a light through acts of kindness and generosity</li><li><strong>At work</strong> — Demonstrate Christ through your work ethic and attitude</li><li><strong>At home</strong> — Serve your family with love and selflessness</li></ul><h3>Overcoming Serving Pitfalls</h3><ul><li>Avoid serving for recognition — Matthew 6:1</li><li>Don\'t burn out — maintain balance and rest</li><li>Serve with joy, not obligation — 2 Corinthians 9:7</li></ul>',
            ],
            [
                'title'       => 'Stewardship and Generosity',
                'description' => 'Biblical principles of stewardship over time, talents, and treasure, and the transformative power of generous living.',
                'content'     => '<h2>Managing What God Has Given</h2><p>Everything we have belongs to God. Psalm 24:1 declares, <em>"The earth is the Lord\'s, and everything in it."</em> Stewardship is faithfully managing what God has entrusted to us.</p><h3>Three Areas of Stewardship</h3><p><strong>Time:</strong> Ephesians 5:16 urges us to make the most of our time. How we spend our hours reflects our priorities.</p><p><strong>Talents:</strong> 1 Peter 4:10 says, <em>"Each of you should use whatever gift you have received to serve others."</em> Don\'t bury your talents — invest them.</p><p><strong>Treasure:</strong> Malachi 3:10 invites us to bring the whole tithe and test God\'s faithfulness. Biblical giving includes tithing, offerings, and generous giving to those in need.</p><h3>The Joy of Generosity</h3><p>2 Corinthians 9:6-7 teaches, <em>"Whoever sows sparingly will also reap sparingly, and whoever sows generously will also reap generously. God loves a cheerful giver."</em></p><p>Generosity is not about how much you give — it\'s about the posture of your heart. When you give freely, you reflect the generous heart of God.</p>',
            ],
            [
                'title'       => 'Overcoming Obstacles',
                'description' => 'Facing challenges with faith, understanding God\'s purpose in trials, and developing resilience through Christ.',
                'content'     => '<h2>More Than Conquerors</h2><p>Romans 8:37 declares, <em>"In all these things we are more than conquerors through him who loved us."</em> Obstacles are not roadblocks — they are opportunities for God to demonstrate His power in your life.</p><h3>Common Obstacles</h3><ul><li><strong>Fear and doubt</strong> — 2 Timothy 1:7: God has not given us a spirit of fear</li><li><strong>Past failures</strong> — Philippians 3:13: Forgetting what is behind</li><li><strong>Discouragement</strong> — Isaiah 41:10: Do not be dismayed</li><li><strong>Opposition</strong> — Romans 8:31: If God is for us, who can be against us?</li><li><strong>Temptation</strong> — 1 Corinthians 10:13: God provides a way of escape</li></ul><h3>God\'s Purpose in Trials</h3><p>James 1:2-4 says, <em>"Consider it pure joy, my brothers and sisters, whenever you face trials of many kinds, because you know that the testing of your faith produces perseverance."</em></p><p>Trials develop character, deepen faith, and prepare you for greater things. Don\'t waste your pain — let God use it for your growth and His glory.</p>',
            ],
            [
                'title'       => 'Leadership and Influence',
                'description' => 'Understanding godly leadership, leading by example, and using your influence to make a positive Kingdom impact.',
                'content'     => '<h2>Leading Like Jesus</h2><p>Every Christian is called to lead in some capacity — whether in the church, family, workplace, or community. Jesus modelled servant leadership and calls us to do the same.</p><h3>Qualities of a Godly Leader</h3><ul><li><strong>Humility</strong> — Philippians 2:3-4: Consider others above yourself</li><li><strong>Integrity</strong> — Proverbs 11:3: The integrity of the upright guides them</li><li><strong>Courage</strong> — Joshua 1:9: Be strong and courageous</li><li><strong>Wisdom</strong> — James 1:5: If anyone lacks wisdom, let him ask God</li><li><strong>Compassion</strong> — Matthew 9:36: Jesus had compassion on the crowds</li></ul><h3>Your Sphere of Influence</h3><p>Matthew 5:14-16 calls us the <em>"light of the world."</em> You may not stand on a platform, but you influence people every day — your family, colleagues, neighbours, and friends. Lead well in the spaces God has placed you.</p><h3>Developing Others</h3><p>Great leaders multiply themselves by investing in others. 2 Timothy 2:2 instructs, <em>"And the things you have heard me say in the presence of many witnesses entrust to reliable people who will also be qualified to teach others."</em></p>',
            ],
            [
                'title'       => 'Leaving a Lasting Legacy',
                'description' => 'Living with an eternal perspective, making decisions that outlast your lifetime, and finishing strong in faith.',
                'content'     => '<h2>Your Legacy Matters</h2><p>A life of significance is a life that leaves a lasting impact. Proverbs 13:22 says, <em>"A good person leaves an inheritance for their children\'s children."</em> Legacy is not just about money — it\'s about faith, values, and influence that outlive you.</p><h3>Building a Legacy</h3><ul><li><strong>Live for eternity, not just today</strong> — Matthew 6:19-20: Store up treasures in heaven</li><li><strong>Invest in people</strong> — The relationships you build and lives you touch are your greatest legacy</li><li><strong>Pass on your faith</strong> — Deuteronomy 6:6-7: Teach your children diligently</li><li><strong>Be faithful in the small things</strong> — Luke 16:10: Faithful in little, faithful in much</li><li><strong>Live with no regrets</strong> — Make decisions today that your future self will thank you for</li></ul><h3>Finishing Strong</h3><p>Paul wrote in 2 Timothy 4:7, <em>"I have fought the good fight, I have finished the race, I have kept the faith."</em> The goal is not just to start well but to finish well. Stay faithful, keep pressing forward, and trust God with the outcome.</p><p>Your life has significance because God created you for a purpose. Live it fully, live it boldly, and leave a legacy that points others to Christ.</p>',
            ],
        ];

        foreach ($lclsLessons as $i => $lesson) {
            CourseLesson::create([
                'course_id'     => $lcls->id,
                'title'         => $lesson['title'],
                'slug'          => Str::slug($lesson['title']),
                'lesson_number' => $i + 1,
                'description'   => $lesson['description'],
                'content'       => $lesson['content'],
                'is_published'  => true,
            ]);
        }
    }
}
