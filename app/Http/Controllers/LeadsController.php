<?php

namespace App\Http\Controllers;
use App\Models\Leads;
use App\Models\User;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Requests\LeadsRequest;

class LeadsController extends Controller{

    public function addlead(LeadsRequest $req){
        $lead = new Leads();
        $lead -> name = $req -> input('name');
        $lead -> source = $req -> input('source');
        $lead -> description = $req -> input('description');
        $lead -> phone = $req -> input('phone');
        $lead -> lawyer = $req -> input('lawyer');
        $lead -> responsible = $req -> input('responsible');

        $lead -> save();

        return redirect() -> route('leads') -> with('success', 'Все в порядке, лид добавлен');
    }


    public function showleads(){
          return view ('leads', ['data' => Leads::all()], ['datalawyers' =>  User::all(), 'dataservices' =>  Services::all()]);
      }

}
