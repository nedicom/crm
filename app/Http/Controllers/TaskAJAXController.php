<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tasks;

class TaskAjaxController extends Controller{
    
    public function setstatustask(Request $request){
      if($request->get('id')){
        $id = $request->get('id');
        $status = $request->get('status');
        if($status == 'waiting'){$statuscard = 'ожидает';}
        elseif($status=='timeleft'){$statuscard='просрочена';}
        elseif($status=='inwork'){$statuscard='в работе';}
        elseif($status=='finished'){$statuscard='выполнена';}
        else{$statuscard='код не сработал';}
        $task = Tasks::find($id);
        $task -> status = $statuscard;
        $task -> save();
        return ($statuscard);
      }
    }
}