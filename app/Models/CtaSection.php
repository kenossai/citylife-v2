<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtaSection extends Model
{
    protected $table = 'cta_section';

    protected $fillable = [
        'eyebrow',
        'heading',
        'description',
        'btn_text',
        'btn_url',
        'background_image',
        'side_images',
    ];

    protected $casts = [
        'side_images' => 'array',
    ];

    /** Always returns the single row, creating defaults if it doesn't exist yet. */
    public static function instance(): self
    {
        return static::firstOrCreate([], [
            'eyebrow'     => 'Volunteer / Outreach',
            'heading'     => 'Serving People. Sharing Hope. Transforming Lives.',
            'description' => 'At City Life International Church, we are committed to serving people and communities through faith-filled, compassion-driven support.',
            'btn_text'    => 'Get Involved',
            'btn_url'     => '/contact',
            'side_images' => [],
        ]);
    }
}
