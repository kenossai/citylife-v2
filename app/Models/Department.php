<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Department extends Model
{
    protected $fillable = [
        'head_type',
        'head_id',
        'name',
        'slug',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    public function head(): MorphTo
    {
        return $this->morphTo();
    }

    public function getHeadNameAttribute(): ?string
    {
        if (! $this->head) {
            return null;
        }

        return $this->head instanceof Member
            ? trim("{$this->head->first_name} {$this->head->last_name}")
            : $this->head->name;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
