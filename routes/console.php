<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Modules\HotelMgnt\Commands\Room\StoreConsumedItemCommand;
use Modules\Reports\Commands\Inventory\CreateDailyStockSheetCommand;
use Modules\Reports\Commands\Revenue\CreateDailyRevenueCommand;
use Modules\Reports\Commands\Rooms\RoomsDailyStatusCommand;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule the activity log clean command daily
//Schedule::command('activitylog:clean')->daily();

Schedule::call(function () {
    StoreConsumedItemCommand::handle();
})->dailyAt('23:55');

Schedule::call(function () {
    CreateDailyRevenueCommand::handle();
})->dailyAt('00:10');

Schedule::call(function () {
    CreateDailyStockSheetCommand::handle();
})->dailyAt('00:30');

Schedule::call(function () {
    RoomsDailyStatusCommand::handle();
})->dailyAt('02:00');


//Schedule::call(function () {
//    Log::info("Something Good");
//})->everyMinute();
