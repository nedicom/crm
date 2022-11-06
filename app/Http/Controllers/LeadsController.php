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
          $lead -> service = $req -> input('service');

          $lead -> save();

          return redirect() -> route('leads') -> with('success', 'Все в порядке, лид добавлен');
      }


      public function showleads(){
          return view ('leads', ['data' => Leads::all()], ['datalawyers' =>  User::all(), 'dataservices' =>  Services::all()]);
      }

      public function showLeadById($id){
        return view ('showLeadById', ['data' => Leads::with('userFunc', 'responsibleFunc' , 'servicesFunc')->find($id)], ['datalawyers' =>  User::all(), 'dataservices' =>  Services::all()]);
      }

      public function LeadUpdateSubmit($id, LeadsRequest $req){
          $lead = Leads::find($id);
          $lead -> name = $req -> input('name');
          $lead -> source = $req -> input('source');
          $lead -> description = $req -> input('description');
          $lead -> phone = $req -> input('phone');
          $lead -> lawyer = $req -> input('lawyer');
          $lead -> responsible = $req -> input('responsible');
          $lead -> service = $req -> input('service');
          
          $lead -> save();

          return redirect() -> route('showLeadById', $id) -> with('success', 'Все в порядке, лид обновлен');

      }

      public function LeadDelete($id){
          ClientsModel::find($id)->delete();
          return redirect() -> route('leads') -> with('success', 'Все в порядке, лид удален');

      }

}
