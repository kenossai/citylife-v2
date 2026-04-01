<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseLesson extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'slug',
        'lesson_number',
        'description',
        'content',
        'quiz_questions',
        'is_published',
        'available_date',
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

    public function scopeActive($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('lesson_number');
    }
}
