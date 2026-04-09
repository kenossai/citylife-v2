<?php

namespace App\Providers;

use App\Listeners\LogAuthActivity;
use App\Models\CourseEnrollment;
use App\Models\LessonAttendance;
use App\Observers\CourseEnrollmentObserver;
use App\Observers\LessonAttendanceObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Relation::morphMap([
            'leader' => \App\Models\Leader::class,
            'member' => \App\Models\Member::class,
        ]);

        CourseEnrollment::observe(CourseEnrollmentObserver::class);
        LessonAttendance::observe(LessonAttendanceObserver::class);

        Event::listen(Login::class, [LogAuthActivity::class, 'handleLogin']);
        Event::listen(Logout::class, [LogAuthActivity::class, 'handleLogout']);
    }
}
