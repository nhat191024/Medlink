<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule the appointment status check command to run every minute
Schedule::command('appointments:check-status')
    ->everyMinute()
    ->withoutOverlapping()
    ->onOneServer();
