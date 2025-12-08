<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Modules\HotelMgnt\Commands\Room\StoreConsumedItemCommand;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule the activity log clean command daily
//Schedule::command('activitylog:clean')->daily();

Schedule::call(function () {
    StoreConsumedItemCommand::handle();
})->dailyAt('23:55');

//Schedule::call(function () {
//    Log::info("Something Good");
//})->everyMinute();
