<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Department extends Model
{
    protected $fillable = [
        'leader_id',
        'name',
        'slug',
        'description',
        'image_path',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    public function leader(): BelongsTo
    {
        return $this->belongsTo(Leader::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
