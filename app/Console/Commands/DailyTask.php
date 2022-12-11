<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DailyTask extends Command
{

    protected $signature = 'Tasktoday:daily';

    protected $description = 'makes the task late';

    public function handle()
    {

         
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
         
        $this->info('Successfully sent daily quote to everyone.');
    }
}
