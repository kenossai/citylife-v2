<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseEnrollment extends Model
{
    protected $fillable = [
        'course_id',
        'member_id',
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

    public function progress(): HasMany
    {
        return $this->hasMany(LessonProgress::class, 'enrollment_id');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(LessonAttendance::class, 'enrollment_id');
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function hasCertificate(): bool
    {
        return $this->certificate_issued;
    }
}
