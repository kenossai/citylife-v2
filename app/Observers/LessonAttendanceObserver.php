<?php

namespace App\Observers;

use App\Models\LessonAttendance;

class LessonAttendanceObserver
{
    public function created(LessonAttendance $attendance): void
    {
        $enrollment = $attendance->enrollment;

        if (! $enrollment) {
            return;
        }

        // Only increment when actually present
        if ($attendance->present) {
            $enrollment->increment('attendance_count');
            $enrollment->refresh();

            $course = $enrollment->course;
            $member = $enrollment->member;

            if (! $course || ! $member) {
                return;
            }

            // Determine the minimum sessions required
            $required = $course->min_attendance_for_certificate
                ?? $course->lessons()->count();

            // Auto-convert to active member when threshold is met (e.g. CDC)
            if (
                $course->is_membership_course
                && $required > 0
                && $enrollment->attendance_count >= $required
                && $member->membership_status !== 'active'
            ) {
                $member->update(['membership_status' => 'active']);
            }
        }
    }

    public function deleted(LessonAttendance $attendance): void
    {
        $enrollment = $attendance->enrollment;

        if ($enrollment && $attendance->present && $enrollment->attendance_count > 0) {
            $enrollment->decrement('attendance_count');
        }
    }
}
