<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Auto-fetch YouTube live stream every 5 minutes on Sunday mornings (10 AM – 12:15 PM)
// The command turns is_live ON when a stream is found, and OFF when it ends.
Schedule::command('sermons:fetch-live-stream')
    ->everyFiveMinutes()
    ->sundays()
    ->between('10:00', '12:15')
    ->withoutOverlapping()
    ->runInBackground();
