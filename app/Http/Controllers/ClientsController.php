<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClientsRequest;
use App\Http\Requests\FilterRequest;
use App\Models\ClientsModel;
use App\Models\User;
use App\Models\Tasks;
use App\Models\Source;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;


class ClientsController extends Controller{

    public function submit(ClientsRequest $req){
        $client = new ClientsModel();
        $client -> name = $req -> input('name');
        $client -> phone = $req -> input('phone');
        if(!is_null($req -> input('email'))) {$client -> email = $req -> input('email');}
        $client -> source = $req -> input('source');
        $client -> status = $req -> input('status');
        $client -> lawyer = $req -> input('lawyer');

        $client -> save();

        return redirect() -> route('clients') -> with('success', 'Все в порядке, клиент добавлен');

    }

    public function AllClients(Request $request){

    $client = new ClientsModel();

      $findclient = $request->input('findclient');
      $statusclient = $request->input('status');
      $checkedlawyer  = $request->input('checkedlawyer');

      if(($statusclient=='1') || ($findclient !== NULL) || ($checkedlawyer !== NULL)){

          if(($statusclient=='1') && ($findclient !== NULL) && ($checkedlawyer !== NULL)){
            return view ('clients', ['data' => ClientsModel::with('userFunc')
            -> where('name', 'like', '%'.$findclient.'%')
            -> where('lawyer', $checkedlawyer)
            -> where('status', 1)
            -> paginate(10)],
            ['datalawyers' =>  User::all()]);
        }

          elseif(($statusclient=='1') && ($checkedlawyer !== NULL)){
              return view ('clients', ['data' => ClientsModel::with('userFunc')
              -> where('lawyer', $checkedlawyer)
              -> where('status', 1)
              -> paginate(10)],
              ['datalawyers' =>  User::all()]);
          }

          elseif(($findclient !== NULL) && ($checkedlawyer !== NULL)){
              return view ('clients', ['data' => ClientsModel::with('userFunc')
              -> where('lawyer', $checkedlawyer)
              -> where('name', 'like', '%'.$findclient.'%')
              -> paginate(10)],
              ['datalawyers' =>  User::all()]);
          }

        elseif($statusclient=='1'){
            return view ('clients', ['data' => ClientsModel::with('userFunc')
            -> where('status', 1)
            -> paginate(10)],
            ['datalawyers' =>  User::all()]);
          }

        elseif($findclient !== NULL){
            return view ('clients', ['data' => ClientsModel::with('userFunc')
            -> where('name', 'like', '%'.$findclient.'%')
            -> paginate(10)],
            ['datalawyers' =>  User::all()]);
          }

        elseif($checkedlawyer !== NULL){
            return view ('clients', ['data' => ClientsModel::with('userFunc')
            -> where('name', 'like', '%'.$findclient.'%')
            -> where('lawyer', $checkedlawyer)
            -> paginate(10)],
            ['datalawyers' =>  User::all()]);
          }

      }

        else{
          return view ('clients', ['data' => ClientsModel::with('userFunc')-> paginate(10)],
          ['datalawyers' =>  User::all(), 'datatasks' => Tasks::all(), 'datasource' => Source::all()]);
        }
          return $client->get();

    }

    public function showClientById($id){
      $client = new ClientsModel();
      return view ('clientbyid', ['data' => ClientsModel::with('userFunc')->find($id)],
      ['datalawyers' =>  User::all(), 'datasource' => Source::all()]);
    }

    public function updateClient($id){
      $client = new ClientsModel();
      return view ('updateClient', ['data' => $client->find($id)], ['datalawyers' =>  User::all()]);
    }

    public function updateClientSubmit($id, ClientsRequest $req){
        $client = ClientsModel::find($id);
        $client -> name = $req -> input('name');
        $client -> phone = $req -> input('phone');
        if(!is_null($req -> input('email'))) {$client -> email = $req -> input('email');}
        $client -> source = $req -> input('source');
        $client -> status = $req -> input('status');
        $client -> lawyer = $req -> input('lawyer');

        $client -> save();

        return redirect() -> route('showClientById', $id) -> with('success', 'Все в порядке, клиент обновлен');

    }

    public function ClientDelete($id){
        ClientsModel::find($id)->delete();
        return redirect() -> route('clients') -> with('success', 'Все в порядке, клиент удален');

    }

}
