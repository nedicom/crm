<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\User;

class BotController extends Controller
{
    public function index() {

        //setting webhok
        //https://api.telegram.org/bot5941198915:AAFpQD_AvVJfiXjH6gaD3oBZgxbe06sTvyc/setWebhook?url=https://crm.nedicom.ru/bot

        $token = "5941198915:AAFpQD_AvVJfiXjH6gaD3oBZgxbe06sTvyc";
        
                

        /*
        $tasks = Tasks::where('lawyer', 2)-> get();
        $textMessage = "";
        foreach($tasks as $el){
            $textMessage .= $el -> name;
        }
        */

            //post

            $data = file_get_contents('php://input');            
            $data = json_decode($data, true);
            //file_put_contents(__DIR__ . '/message.txt', print_r($data, true));
            $message = $data['message']['text'];

            $keyboard['keyboard'][0] = ['в начало'];
            $userkeyboard = [];
            $taskkeyboard['keyboard'][0] = ['в начало']; $taskkeyboard['keyboard'][1] = ['просроченные'];
            $taskkeyboard['keyboard'][2] = ['новые']; $taskkeyboard['keyboard'][3] = ['на сегодня'];
            $k = 1;

            foreach (User::all() as $lawyer) {
                $userkeyboard[] = $lawyer->name;
                $keyboard['keyboard'][$k] = [$lawyer->name];
                $k++;
            }

            $getQuery = array(
                "chat_id" 	=> $data['message']['chat']['id'],
                "parse_mode" => "html",
            );

            if(!empty($message) && $message == '/start') {
                $text = 'Давайте выберем юриста.';                
                $getQuery['text'] =  $text;
                $getQuery['reply_markup'] = json_encode($keyboard);                
                }

            elseif(!empty($message) && in_array($message, $userkeyboard)){
                $text = 'Вы выбрали  - '.$message;
                $getQuery['text'] =  $text;               
                $getQuery['reply_markup'] = json_encode($taskkeyboard);
                }

            else{
                $text = 'Вы выбрали  - '.$message;
            }

                /*
            $keyboard = [
                'keyboard'=>[
                    [['text'=>'Кнопка 1'],['text'=>'Кнопка 2']] // Первый ряд кнопок
                    ,['Простая кнопка',['text'=>'Кнопка 4']] // Второй ряд кнопок
                    ]
                ];*/


            $ch = curl_init("https://api.telegram.org/bot". $token ."/sendMessage?" . http_build_query($getQuery));
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);

            $resultQuery = curl_exec($ch);
            curl_close($ch);

            echo $resultQuery;          

    }
}
