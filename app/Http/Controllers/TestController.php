<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TestController extends Controller
{
   
    public function test(){
        $message = 18;
        $name = DB::table('clients_models')->where('tgid', $message)->value('name');
        
        return view ('test', ['data' => $name]);
    }
}
