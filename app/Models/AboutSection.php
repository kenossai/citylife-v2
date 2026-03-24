<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $table = 'about_section';

    protected $fillable = [
        'image_path',
        'heading',
        'established_text',
        'body_1',
        'body_2',
        'btn_text',
        'btn_url',
    ];

    /** Always returns the single row, creating defaults if it doesn't exist yet. */
    public static function instance(): self
    {
        return static::firstOrCreate([], [
            'heading'          => 'City Life A Vibrant Christian Community',
            'established_text' => '10th of February 2004',
            'body_1'           => 'City Life is a vibrant Christian church in the heart of Sheffield with the purpose to make disciples of Jesus Christ for the transformation of the city.',
            'body_2'           => 'We believe in the heritage of our faith and the vision God has called us towards, helping people encounter God\'s love every day.',
            'btn_text'         => 'More About Us',
            'btn_url'          => '/about-citylife',
        ]);
    }
}
