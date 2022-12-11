<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Console\Commands\DailyTask;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\DailyTask::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            DB::table('tasks')->where('date', '<', Carbon::now())
            ->update(['status' => 'просрочена']);
        })->dailyAt('22:00');

        $schedule->command(DailyTask::class)
        ->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
