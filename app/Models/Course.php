<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Course extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('courses');
    }

    public function tapActivity(\Spatie\Activitylog\Models\Activity $activity, string $eventName): void
    {
        $activity->category     = 'Courses';
        $activity->severity     = match ($eventName) {
            'deleted' => 'high',
            'created' => 'low',
            default   => 'medium',
        };
        $activity->is_sensitive = false;
    }
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
        'is_membership_course',
        'min_attendance_for_certificate',
        'is_registration_open',
        'is_active',
    ];

    protected $casts = [
        'start_date'                     => 'date',
        'end_date'                       => 'date',
        'has_certificate'                => 'boolean',
        'is_membership_course'           => 'boolean',
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

    public function reviews(): HasMany
    {
        return $this->hasMany(CourseReview::class);
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
