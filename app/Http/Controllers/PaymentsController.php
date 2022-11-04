<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Models\Payments;
use App\Http\Requests\PaymentsRequest;
use Illuminate\Support\Facades\DB;

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

        }
        elseif(($service -> price)<($summ)){
          $payment -> SallerSalary = ($service -> price)/100*13;
          $payment -> AttaractionerSalary = ($service -> price)/100*20;
          $payment -> modifyAttraction = ($summ - ($service -> price))/100*33;
          $payment -> modifySeller = ($summ - ($service -> price))/100*17;
        }
        else{
          $payment -> SallerSalary = ($service -> price)/100*13;
          $payment -> AttaractionerSalary = ($service -> price)/100*20;
        }


        $payment -> calculation = $req -> input('calculation');
        $payment -> client = $req -> input('client');

        $payment -> nameOfAttractioner = $req -> input('nameOfAttractioner');
        $payment -> nameOfSeller = $req -> input('nameOfSeller');
        $payment -> save();

        return redirect() -> route('payments') -> with('success', 'Все в порядке, платеж добавлен');
    }


    public function showpayments(){
          return view ('payments', ['data' => Payments::with('serviceFunc', 'AttractionerFunc', 'sellerFunc')->get()], ['datalawyers' =>  User::all(), 'dataservices' =>  Services::all()]);
      }

      public function test(){
            return view ('test', ['data' => Payments::with('serviceFunc')->get()]);
        }



    public function showPaymentById($id){
          return view ('showPaymentById', ['data' => Payments::with('serviceFunc', 'AttractionerFunc', 'sellerFunc')->find($id)], ['datalawyers' =>  User::all(), 'dataservices' =>  Services::all()]);
      }

      public function PaymentUpdate($id){
        $payment = new Payments();
        return view ('PaymentUpdate', ['data' => $payment->find($id)]);
      }

      public function PaymentUpdateSubmit($id, PaymentsRequest $req){
          $payment = Payments::find($id);
          if(strstr($req -> input('summ'), ',', true)){
            $payment -> summ = strstr($req -> input('summ'), ',', true);
          }
          else{
            $payment -> summ = $req -> input('summ');
          }
          $payment -> calculation = $req -> input('calculation');
          $payment -> client = $req -> input('client');
          $payment -> service = $req -> input('service');
          $payment -> nameOfAttractioner = $req -> input('nameOfAttractioner');
          $payment -> nameOfSeller = $req -> input('nameOfSeller');
          $payment -> save();

          return redirect() -> route('showPaymentById', $id) -> with('success', 'Все в порядке, платеж обновлен');

      }

    public function PaymentDelete($id){
        Payments::find($id)->delete();
        return redirect() -> route('payments') -> with('success', 'Все в порядке, платеж удален');

    }

}
