<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionCountry extends Model
{
    protected $table = 'mission_countries';

    protected $fillable = [
        'flag',
        'name',
        'region',
        'type',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
