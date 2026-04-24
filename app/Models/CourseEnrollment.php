<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CourseEnrollment extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('enrollments');
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
        'course_id',
        'member_id',
        'guest_name',
        'guest_email',
        'status',
        'attendance_count',
        'certificate_issued',
        'enrolled_at',
        'completed_at',
    ];

    protected $casts = [
        'attendance_count'   => 'integer',
        'certificate_issued' => 'boolean',
        'enrolled_at'        => 'datetime',
        'completed_at'       => 'datetime',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function getEnrolleeLabelAttribute(): string
    {
        if ($this->member) {
            return "{$this->member->first_name} {$this->member->last_name}";
        }
        return $this->guest_name ?? 'Unknown';
    }

    public function progress(): HasMany
    {
        return $this->hasMany(LessonProgress::class, 'enrollment_id');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(LessonAttendance::class, 'enrollment_id');
    }

    public function review(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CourseReview::class, 'enrollment_id');
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function hasCertificate(): bool
    {
        return $this->certificate_issued;
    }

    public function getLessonsDoneCountAttribute(): int
    {
        return $this->progress()->whereNotNull('completed_at')->count();
    }

    public function getTotalLessonsAttribute(): int
    {
        return $this->course?->lessons()->count() ?? 0;
    }

    public function getProgressPercentageAttribute(): float
    {
        $total = $this->total_lessons;
        if ($total === 0) {
            return 0;
        }
        return round(($this->lessons_done_count / $total) * 100, 2);
    }

    public function getAverageGradeAttribute(): ?float
    {
        $avg = $this->progress()->whereNotNull('quiz_score')->avg('quiz_score');
        return $avg !== null ? round($avg, 2) : null;
    }
}
