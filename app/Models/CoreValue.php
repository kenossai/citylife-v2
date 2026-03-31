<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoreValue extends Model
{
    protected $fillable = [
        'tag',
        'image_path',
        'heading',
        'body_1',
        'body_2',
        'quote',
        'scripture',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order'  => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
