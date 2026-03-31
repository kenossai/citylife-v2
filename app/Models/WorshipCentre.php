<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorshipCentre extends Model
{
    protected $fillable = [
        'label',
        'name',
        'address',
        'landmark',
        'times',
        'phone',
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
