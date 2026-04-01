<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'leader_id',
        'guest_instructor_name',
        'description',
        'image_path',
        'start_date',
        'end_date',
        'has_certificate',
        'is_registration_open',
        'is_active',
    ];

    protected $casts = [
        'start_date'           => 'date',
        'end_date'             => 'date',
        'has_certificate'      => 'boolean',
        'is_registration_open' => 'boolean',
        'is_active'            => 'boolean',
    ];

    public function leader(): BelongsTo
    {
        return $this->belongsTo(Leader::class);
    }

    public function getInstructorNameAttribute(): string
    {
        return $this->guest_instructor_name ?? $this->leader?->name ?? '';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeRegistrationOpen($query)
    {
        return $query->where('is_registration_open', true);
    }
}
