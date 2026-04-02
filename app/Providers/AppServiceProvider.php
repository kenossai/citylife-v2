<?php

namespace App\Providers;

use App\Models\CourseEnrollment;
use App\Models\LessonAttendance;
use App\Observers\CourseEnrollmentObserver;
use App\Observers\LessonAttendanceObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        CourseEnrollment::observe(CourseEnrollmentObserver::class);
        LessonAttendance::observe(LessonAttendanceObserver::class);
    }
}
