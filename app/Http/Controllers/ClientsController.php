<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClientsRequest;
use App\Http\Requests\FilterRequest;
use App\Models\ClientsModel;
use App\Models\User;
use App\Models\Tasks;
use App\Models\Source;
use App\Models\Services;
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

    public function AllClients(Request $req){
      $checkedlawyer = $findclient = $statusclient = null;

      if (!empty($req->status)){$statusclient='status';}
      if (!empty($req->findclient)){$findclient='findclient';}
      if (!empty($req->checkedlawyer)){$checkedlawyer='lawyer';}

          return view ('clients', ['data' => ClientsModel::with('userFunc', 'tasksFunc')
          -> where('name', 'like', '%'.$req->findclient.'%')
          -> where($checkedlawyer, $req->checkedlawyer)
          -> where($statusclient, $req->status)
          -> paginate(12)], ['datalawyers' =>  User::all(),
          'dataservices' =>  Services::all(), 'datatasks' => Tasks::all(),
          'datasource' => Source::all()
          ]);
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
