<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MissionPillar extends Model
{
    protected $table = 'mission_pillars';

    protected $fillable = [
        'title',
        'description',
        'image_path',
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

    public function leaders(): BelongsToMany
    {
        return $this->belongsToMany(Leader::class, 'leader_mission_pillar')
            ->withPivot('sort_order')
            ->orderBy('leader_mission_pillar.sort_order');
    }
}
