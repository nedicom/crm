<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\User;

class BotController extends Controller
{
    public function index() {
        dd('test');
        

$token = "5941198915:AAFpQD_AvVJfiXjH6gaD3oBZgxbe06sTvyc";
$chat_id = 922556670;

//get
$textMessage = "Привет Мир";
$textMessage = urlencode($textMessage);

$urlQuery = "https://api.telegram.org/bot". $token ."/sendMessage?chat_id=". $chat_id ."&text=" . $textMessage;

$result = file_get_contents($urlQuery);

/* //post
$getQuery = array(
     "chat_id" 	=> 922556670,
     "text"  	=> "Новое сообщение из формы",
     "parse_mode" => "html",
);
$ch = curl_init("https://api.telegram.org/bot". $token ."/sendMessage?" . http_build_query($getQuery));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);

$resultQuery = curl_exec($ch);
curl_close($ch);

echo $resultQuery;*/

    }
}
