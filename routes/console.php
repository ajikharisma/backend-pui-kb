<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule untuk Laravel 11
Schedule::command('analisis:otomatis')
        ->weeklyOn(6, '20:00')
        ->withoutOverlapping();