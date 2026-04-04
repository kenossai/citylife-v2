<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageMusic extends Model
{
    protected $table = 'homepage_music';

    protected $fillable = [
        'title',
        'artist',
        'url',
        'is_active',
        'autoplay',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'autoplay'  => 'boolean',
    ];

    /** Always returns the single row, creating defaults if it doesn't exist yet. */
    public static function instance(): self
    {
        return static::firstOrCreate([], [
            'title'     => '',
            'artist'    => '',
            'url'       => '',
            'is_active' => false,
            'autoplay'  => true,
        ]);
    }
}
