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
        $quotes = [
            'Mahatma Gandhi' => 'Live as if you were to die tomorrow. Learn as if you were to live forever.',
            'Friedrich Nietzsche' => 'That which does not kill us makes us stronger.',
            'Theodore Roosevelt' => 'Do what you can, with what you have, where you are.',
            'Oscar Wilde' => 'Be yourself; everyone else is already taken.',
            'William Shakespeare' => 'This above all: to thine own self be true.',
            'Napoleon Hill' => 'If you cannot do great things, do small things in a great way.',
            'Milton Berle' => 'If opportunity doesn’t knock, build a door.'
        ];
         
        // Setting up a random word
        $key = array_rand($quotes);
        $data = $quotes[$key];
         
        $users = DB::table('users')
        ->where('email', '=', 'm6132@yandex.ru')
        ->get();
            foreach ($users as $user) {
                // the message
                    $msg = "First line of text\nSecond line of text";

                    // use wordwrap() if lines are longer than 70 characters
                    $msg = wordwrap($msg,70);

                    // send email
                    mail("m6132@yandex.ru","My subject",$msg);
            }
         
        $this->info('Successfully sent daily quote to everyone.');
    }
}
