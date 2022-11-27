<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Services;
use App\Models\ClientsModel;
use App\Models\Payments;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentsRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller{

    public function addpayment(PaymentsRequest $req){
        $payment = new Payments();

        if(strstr($req -> input('summ'), ',', true)){
          $summ = strstr($req -> input('summ'), ',', true);
          $payment -> summ = $summ;

        }
        else{
          $summ = $req -> input('summ');
          $payment -> summ = $summ;
        }

        $serviceid = $req -> input('service');//get id of service
        $payment -> service = $serviceid;
        $service = DB::table('services')->find($serviceid);//get service of payment's

        if(($service -> price)>($summ)){
          $payment -> SallerSalary = ($service -> price)/100*5;
          $payment -> AttaractionerSalary = ($service -> price)/100*10;
          $payment -> DeveloperSalary = ($service -> price)/100*10;

        }
        elseif(($service -> price)<($summ)){
          $payment -> SallerSalary = ($service -> price)/100*13;
          $payment -> AttaractionerSalary = ($service -> price)/100*20;
          $payment -> DeveloperSalary = ($service -> price)/100*17;
          $payment -> modifyAttraction = ($summ - ($service -> price))/100*33;
          $payment -> modifySeller = ($summ - ($service -> price))/100*17;
        }
        else{
          $payment -> SallerSalary = ($service -> price)/100*13;
          $payment -> AttaractionerSalary = ($service -> price)/100*20;
          $payment -> DeveloperSalary = ($service -> price)/100*17;
        }


        $payment -> calculation = $req -> input('calculation');
        $payment -> client = $req -> input('client');
        if($req -> input('clientidinput')){$payment -> clientid = $req -> input('clientidinput');};

        $payment -> nameOfAttractioner = $req -> input('nameOfAttractioner');
        $payment -> nameOfSeller = $req -> input('nameOfSeller');
        $payment -> directionDevelopment = $req -> input('directionDevelopment');

        $payment -> save();

        return redirect() -> route('payments') -> with('success', 'Все в порядке, платеж добавлен');
    }


    public function showpayments(Request $req){
          $currentuser = Auth::id();
          $nameOfAttractioner = null; 
          $nameOfSeller = null;
          $directionDevelopment = null;

          if((Auth::user()->role) == 'admin'){
            if (!empty($req->nameOfAttractioner)){$nameOfAttractioner='nameOfAttractioner';}
            if (!empty($req->nameOfSeller)){$nameOfSeller='nameOfSeller';}
            if (!empty($req->directionDevelopment)){$directionDevelopment='directionDevelopment';}

            return view ('payments', ['data' => Payments::with('serviceFunc', 'AttractionerFunc', 'sellerFunc', 'developmentFunc')
            ->where($nameOfAttractioner, $req->nameOfAttractioner)
            ->where($nameOfSeller, $req->nameOfSeller)
            ->where($directionDevelopment, $req->directionDevelopment)
            ->get()], ['datalawyers' =>  User::all(), 'dataservices' =>  Services::all(), 'dataclients' =>  ClientsModel::all()]);
          }
          else{ 
            if (!empty($req->nameOfAttractioner)){$nameOfAttractioner='nameOfAttractioner';}
            if (!empty($req->nameOfSeller)){$nameOfSeller='nameOfSeller';}
            if (!empty($req->directionDevelopment)){$directionDevelopment='directionDevelopment';}

            return view ('payments', ['data' => Payments::with('serviceFunc', 'AttractionerFunc', 'sellerFunc', 'developmentFunc')
            ->where(function ($query) {
              $currentuser = Auth::id();
              $query
              ->orWhere('nameOfAttractioner', $currentuser)
              ->orWhere('nameOfSeller', $currentuser)
              ->orWhere('directionDevelopment', $currentuser);
             })
            ->where($nameOfAttractioner, $req->nameOfAttractioner)
            ->where($nameOfSeller, $req->nameOfSeller)
            ->where($directionDevelopment, $req->directionDevelopment)
            ->get()], ['datalawyers' =>  User::all(), 'dataservices' =>  Services::all(), 'dataclients' =>  ClientsModel::all()]);
          }

      }

    public function showPaymentById($id){
          return view ('showPaymentById', ['data' => Payments::with('serviceFunc', 'AttractionerFunc', 'sellerFunc', 'developmentFunc')
          ->find($id)], ['datalawyers' =>  User::all(), 'dataservices' =>  Services::all(), 'dataclients' =>  ClientsModel::all()]);
      }

      public function PaymentUpdateSubmit($id, PaymentsRequest $req){
          $payment = Payments::find($id);
          $summ = $req -> input('summ');
          $payment -> summ = $summ;

          $serviceid = $req -> input('service');//get id of service
          $payment -> service = $serviceid;
          $service = DB::table('services')->find($serviceid);//get service of payment's

          if(($service -> price)>($summ)){
            $payment -> SallerSalary = ($service -> price)/100*5;
            $payment -> AttaractionerSalary = ($service -> price)/100*10;
            $payment -> DeveloperSalary = ($service -> price)/100*10;
            $payment -> modifyAttraction = 0;
            $payment -> modifySeller = 0;

          }
          elseif(($service -> price)<($summ)){
            $payment -> SallerSalary = ($service -> price)/100*13;
            $payment -> AttaractionerSalary = ($service -> price)/100*20;
            $payment -> DeveloperSalary = ($service -> price)/100*17;
            $payment -> modifyAttraction = ($summ - ($service -> price))/100*33;
            $payment -> modifySeller = ($summ - ($service -> price))/100*17;
          }
          else{
            $payment -> SallerSalary = ($service -> price)/100*13;
            $payment -> AttaractionerSalary = ($service -> price)/100*20;
            $payment -> DeveloperSalary = ($service -> price)/100*17;
          }


          $payment -> calculation = $req -> input('calculation');
          $payment -> client = $req -> input('client');
          $payment -> nameOfAttractioner = $req -> input('nameOfAttractioner');
          $payment -> nameOfSeller = $req -> input('nameOfSeller');
          $payment -> directionDevelopment = $req -> input('directionDevelopment');
          if($req -> input('clientidinput')){$payment -> clientid = $req -> input('clientidinput');};
          
          $payment -> save();

          return redirect() -> route('showPaymentById', $id) -> with('success', 'Все в порядке, платеж обновлен');

      }

    public function PaymentDelete($id){
        Payments::find($id)->delete();
        return redirect() -> route('payments') -> with('success', 'Все в порядке, платеж удален');

    }

}
