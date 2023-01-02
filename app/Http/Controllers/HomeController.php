<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ClientsModel;
use App\Models\LawyersModel;
use App\Models\Leads;
use App\Models\Meetings;
use App\Models\Tasks;
use App\Models\Payments;
use App\Models\Dogovor;
use App\Models\Services;
use App\Models\User;
use Carbon\Carbon;

  class HomeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        return view('home', ['data' =>
          [
            'clients' => ClientsModel::with('userFunc')
              -> where('lawyer', (Auth::user()->id))
              -> count(),
            'leads' => Leads::with('userFunc')
              -> where('lawyer', (Auth::user()->id))
              -> count(),
            'meeting' => Meetings::with('userFunc')
              -> where('lawyer', (Auth::user()->id))
              -> count(),
            'tasks' => Tasks::with('userFunc')
              -> where('lawyer', (Auth::user()->id))
              -> count(),
            'paymentsseller' => Payments::where('nameOfSeller', (Auth::user()->id))
              -> whereMonth('created_at', (Carbon::today()))
              -> sum('SallerSalary'),
            'paymentsmodifyseller' => Payments::where('nameOfSeller', (Auth::user()->id))
            -> whereMonth('created_at', (Carbon::today()))
              -> sum('modifySeller'),
            'paymentsattr' => Payments::where('nameOfAttractioner', (Auth::user()->id))
            -> whereMonth('created_at', (Carbon::today()))
              -> sum('AttaractionerSalary'),
            'paymentsmodifyattr' => Payments::where('nameOfAttractioner', (Auth::user()->id))
            -> whereMonth('created_at', (Carbon::today()))
              -> sum('modifyAttraction'),
            'paymentsdev' => Payments::where('directionDevelopment', (Auth::user()->id))
            -> whereMonth('created_at', (Carbon::today()))
              -> sum('DeveloperSalary'),
          ]
          ],
          ['all' =>
            ['allclients' => ClientsModel:: where('lawyer', (Auth::user()->id))
              -> whereDate('created_at', (Carbon::today()))
              -> get(),
              'alltasks' => Tasks::where('lawyer', (Auth::user()->id))
              -> whereDate('created_at', (Carbon::today()))
              -> get(),
              'alltaskstoday' => Tasks::where('lawyer', (Auth::user()->id))
              -> whereDate('date', (Carbon::today()))
              -> get(),
              'alltaskstime' => Tasks::where('lawyer', (Auth::user()->id))
              -> where('status', 'просрочена')
              -> get(),
              'allpayments' => Payments::where('nameOfAttractioner', (Auth::user()->id))
              -> whereDate('created_at', (Carbon::today()))
              -> get(),
              'alldogovors' => Dogovor::where('lawyer_id', (Auth::user()->id))
              -> whereDate('created_at', (Carbon::today()))
              -> get(),
              'allleads' => Leads::where('lawyer', (Auth::user()->id))
              -> whereDate('created_at', (Carbon::today()))
              -> get(),
              'allleadsoverdue' => Leads::where('lawyer', (Auth::user()->id))
              -> whereDate('created_at', '<', (Carbon::today()))
              -> where('status', 'поступил')
              -> get(),
          ]
          ]
      );

    }

  }
