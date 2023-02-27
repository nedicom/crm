<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TestController extends Controller
{
   
    public function test(){
        $tgid = 0;
        //$test = DB::table('clients_models')->where('id', 1)->get();
        $test = [];
        if(count($test)){
            $test = 0;
        }
        else{
            $test = 1;
        }
        
        return view ('test', ['data' => $test]);
    }
}
