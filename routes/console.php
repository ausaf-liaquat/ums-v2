<?php

use App\Models\Shifts\Shift;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    $shifts = Shift::whereDoesntHave('shift_clinicians')
        ->where('date', '<=', now()->subHours(3))  // 3 hours after the shift's start date/time
        ->where('status', 1) // Assuming status 1 means active or not processed
        ->get();

        foreach ($shifts ?? [] as $shift) {
            $user = $shift->user;

            $user->wallet->refund($shift);

            $shift->update([
                'status'=>2
            ]);
        }
})->everySecond();
