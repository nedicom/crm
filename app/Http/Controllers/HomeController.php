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
use App\Models\Services;
use App\Models\User;

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
              -> sum('SallerSalary'),
            'paymentsmodifyseller' => Payments::where('nameOfSeller', (Auth::user()->id))
              -> sum('modifySeller'),
            'paymentsattr' => Payments::where('nameOfAttractioner', (Auth::user()->id))
              -> sum('AttaractionerSalary'),
            'paymentsmodifyattr' => Payments::where('nameOfAttractioner', (Auth::user()->id))
              -> sum('modifyAttraction'),
            'paymentsdev' => Payments::where('directionDevelopment', (Auth::user()->id))
              -> sum('DeveloperSalary'),
            ]]);

    }

  }
