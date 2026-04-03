<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Auto-fetch YouTube live stream every Sunday at 11:15 AM
Schedule::command('sermons:fetch-live-stream')
    ->weeklyOn(0, '11:15')   // 0 = Sunday
    ->withoutOverlapping()
    ->runInBackground();
