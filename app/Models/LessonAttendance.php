<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonAttendance extends Model
{
    protected $fillable = [
        'enrollment_id',
        'lesson_id',
        'attended_at',
        'present',
    ];

    protected $casts = [
        'attended_at' => 'datetime',
        'present'     => 'boolean',
    ];

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(CourseEnrollment::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(CourseLesson::class);
    }
}
