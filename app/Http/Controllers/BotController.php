<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\User;

class BotController extends Controller
{
    public function index() {
    
    $token = "5941198915:AAFpQD_AvVJfiXjH6gaD3oBZgxbe06sTvyc";
    
   $urldata = "https://api.telegram.org/bot". $token ."/getUpdates";
    //$delwh = "https://api.telegram.org/bot". $token ."/setwebhook?url=''.";
     
    $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, $urldata);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        //$jsonData = json_decode(curl_exec($curlSession));
        $jsonData = curl_exec($curlSession);
        curl_close($curlSession);

    $chat_id = 922556670;
    
    $textMessage = $jsonData;

        /*
    $tasks = Tasks::where('lawyer', 2)-> get();
    $textMessage = "";
    foreach($tasks as $el){
        $textMessage .= $el -> name;
    }
    //$textMessage = urlencode($textMessage);   
    */

$urlQuery = "https://api.telegram.org/bot". $token ."/sendMessage?chat_id=". $chat_id ."&text=" . $textMessage;

file_get_contents($urlQuery);

        //post
        /*
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

        //echo $resultQuery;
        */

    }
}
