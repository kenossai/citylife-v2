<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseLesson extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'slug',
        'lesson_number',
        'week_group',
        'description',
        'content',
        'quiz_questions',
        'is_published',
        'available_date',
        'reschedule_reason',
    ];

    protected $casts = [
        'lesson_number'  => 'integer',
        'quiz_questions' => 'array',
        'is_published'   => 'boolean',
        'available_date' => 'date',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(LessonProgress::class, 'lesson_id');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(LessonAttendance::class, 'lesson_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('lesson_number');
    }
}
