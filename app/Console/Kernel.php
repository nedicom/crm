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
        })->everyMinute();
        //->dailyAt('22:00');

       /* $schedule->call(function () {
            $users = DB::table('users')
            ->where('email', '=', 'm6132@yandex.ru')
            ->get();
                foreach ($users as $user) {
    
                        $to = "m6132@yandex.ru";
                        $topic = "Задачи";
                        $msg = "First line of text\nSecond line of text";
                        $msg = wordwrap($msg,70);
                        $headers = "From: crm@nedicom.ru";
    
                        // send email
                        mail($to, $topic,$msg,$headers);
                }
        })->everyMinute();*/

    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
