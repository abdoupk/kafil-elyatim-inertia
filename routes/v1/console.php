<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function (): void {
    ray(Inspiring::quote());
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')
    ->everyMinute();

Schedule::command('calculate:families-income-rate')
    ->name('Calculate families income rate')
    ->yearlyOn(9, 1, '00:00');

Schedule::command('calculate:families-income-rate')
    ->name('Calculate families income rate')
    ->yearlyOn(6, 1, '00:00');

Schedule::command('unSearch:orphans-older-than-two-years')
    ->name('UnSearch orphans older than two years')
    ->dailyAt('00:00');
