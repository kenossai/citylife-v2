<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'min_attendance_for_certificate',
        'is_registration_open',
        'is_active',
    ];

    protected $casts = [
        'start_date'                     => 'date',
        'end_date'                       => 'date',
        'has_certificate'                => 'boolean',
        'min_attendance_for_certificate' => 'integer',
        'is_registration_open'           => 'boolean',
        'is_active'                      => 'boolean',
    ];

    public function leader(): BelongsTo
    {
        return $this->belongsTo(Leader::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(CourseLesson::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(CourseEnrollment::class);
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
