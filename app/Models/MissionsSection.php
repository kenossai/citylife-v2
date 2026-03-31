<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionsSection extends Model
{
    protected $table = 'missions_section';

    protected $fillable = [
        'eyebrow',
        'heading',
        'description',
        'btn_text',
        'btn_url',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    /** Always returns the single row, creating defaults if it doesn't exist yet. */
    public static function instance(): self
    {
        return static::firstOrCreate([], [
            'eyebrow'     => 'Serving Beyond Our Walls',
            'heading'     => 'Missions & Outreach',
            'description' => 'We are called to go beyond our four walls and share the love of Christ with our city and the world.',
            'btn_text'    => 'Get Involved',
            'btn_url'     => '/missions',
            'images'      => [],
        ]);
    }
}
