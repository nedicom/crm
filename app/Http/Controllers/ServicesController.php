<?php

namespace App\Http\Controllers;
use App\Models\Services;

class ServicesController extends Controller{

    /*public function addservice(PaymentsRequest $req){
        $payment = new Services();


        $payment -> calculation = $req -> input('calculation');
        $payment -> client = $req -> input('client');
        $payment -> service = $req -> input('service');
        $payment -> nameOfAttractioner = $req -> input('nameOfAttractioner');
        $payment -> save();

        return redirect() -> route('payments') -> with('success', 'Все в порядке, платеж добавлен');
    }*/


    public function showservices(){
          return view ('services', ['data' => Services::all()]);
      }

}
