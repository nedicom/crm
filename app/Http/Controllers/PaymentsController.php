<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Payments;
use App\Http\Requests\PaymentsRequest;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller{

    public function addpayment(PaymentsRequest $req){
        $payment = new Payments();

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
        $payment -> save();

        return redirect() -> route('payments') -> with('success', 'Все в порядке, платеж добавлен');
    }


    public function showpayments(){
          return view ('payments', ['data' => Payments::all()], ['datalawyers' =>  User::all()]);
      }

    public function showPaymentById($id){
          $payment = new Payments();
          return view ('showPaymentById', ['data' => $payment->find($id)]);
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
          $payment -> save();

          return redirect() -> route('showPaymentById', $id) -> with('success', 'Все в порядке, платеж обновлен');

      }

    public function PaymentDelete($id){
        Payments::find($id)->delete();
        return redirect() -> route('payments') -> with('success', 'Все в порядке, платеж удален');

    }

}
