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


        //создание платежа

    public function addpayment(PaymentsRequest $req){
        $payment = new Payments();

        $summ = $req -> input('summ');
        
        $payment -> summ = $summ;


        $serviceid = $req -> input('service');
        $payment -> service = $serviceid;
        $service = DB::table('services')->find($serviceid);
        $price = $service -> price;                                  // цена услуги стандартная

        if(!empty($req -> input('sellsumm'))){ // если взял предоплату
          $sellsumm = $req -> input('sellsumm');                       // поступившая предоплата
          $payment -> predoplatasumm = $sellsumm; // запись в БД
          $sootnoshnie = $sellsumm/$summ; // расчитываем соотношение цены за которую продали к предоплате
        }
        else{
          $sellsumm = $summ; // если предоплата не указана выполняется условия когда цена продажи равна сумме поступивших денег
          $sootnoshnie = 1; // соотношение не расчитывается
          $payment -> predoplatasumm = $summ; // запись в БД
        }              

        if($price < $sellsumm){
            $totalprice = $price / $sootnoshnie;
            $payment -> SallerSalary = $totalprice/100*13; // доход продавца от цены услуги (производной)
            $payment -> modifySeller = ($summ - $totalprice)/100*17; // увеличение дохода продавца от разницы в платеже минус цены услуги
            $payment -> AttaractionerSalary = $totalprice/100*20; // доход привлеченца            
            $payment -> modifyAttraction = ($summ - $totalprice)/100*33; // увеличение дохода привлеченца
            $payment -> DeveloperSalary = $summ/100*17; // доход развивателя
        }

        if($price > $sellsumm){
          $payment -> SallerSalary = $summ/100*5;
          $payment -> AttaractionerSalary = $summ/100*10;
          $payment -> DeveloperSalary = $summ/100*10;
          $payment -> modifyAttraction = 0;
          $payment -> modifySeller = 0;
        }

        if($price == $sellsumm){
          $payment -> SallerSalary = $summ/100*13;
          $payment -> AttaractionerSalary = $summ/100*20;
          $payment -> DeveloperSalary = $summ/100*17;
          $payment -> modifyAttraction = 0;
          $payment -> modifySeller = 0;
        }

        $payment -> calculation = $req -> input('calculation');
        $payment -> client = $req -> input('client');
        if($req -> input('clientidinput')){$payment -> clientid = $req -> input('clientidinput');};

        $payment -> nameOfAttractioner = $req -> input('nameOfAttractioner');
        $payment -> nameOfSeller = $req -> input('nameOfSeller');
        $payment -> directionDevelopment = $req -> input('directionDevelopment');
        $payment -> firmearning = ($summ - $payment -> SallerSalary - $payment -> AttaractionerSalary
         - $payment -> DeveloperSalary - $payment -> modifyAttraction - $payment -> modifySeller);

        $payment -> save();

        return redirect() -> route('payments') -> with('success', 'Все в порядке, платеж добавлен');
    }

        //конец создания платежа


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

      //обновление платежа

      public function PaymentUpdateSubmit($id, PaymentsRequest $req){
          
        $payment = Payments::find($id);
          $summ = $req -> input('summ');                                 // поступивший платеж
          $payment -> summ = $summ;

          $serviceid = $req -> input('service');
          $payment -> service = $serviceid;
          $service = DB::table('services')->find($serviceid);
          $price = $service -> price;                                  // цена услуги стандартная

          if(!empty($req -> input('sellsumm'))){ // если взял предоплату
            $sellsumm = $req -> input('sellsumm');                       // поступившая предоплата
            $payment -> predoplatasumm = $sellsumm; // запись в БД
            $sootnoshnie = $sellsumm/$summ; // расчитываем соотношение цены за которую продали к предоплате
          }
          else{
            $sellsumm = $summ; // если предоплата не указана выполняется условия когда цена продажи равна сумме поступивших денег
            $sootnoshnie = 1; // соотношение не расчитывается
            $payment -> predoplatasumm = $summ; // запись в БД
          }              

          if($price < $sellsumm){
              $totalprice = $price / $sootnoshnie;
              $payment -> SallerSalary = $totalprice/100*13; // доход продавца от цены услуги (производной)
              $payment -> modifySeller = ($summ - $totalprice)/100*17; // увеличение дохода продавца от разницы в платеже минус цены услуги
              $payment -> AttaractionerSalary = $totalprice/100*20; // доход привлеченца            
              $payment -> modifyAttraction = ($summ - $totalprice)/100*33; // увеличение дохода привлеченца
              $payment -> DeveloperSalary = $summ/100*17; // доход развивателя
          }

          if($price > $sellsumm){
            $payment -> SallerSalary = $summ/100*5;
            $payment -> AttaractionerSalary = $summ/100*10;
            $payment -> DeveloperSalary = $summ/100*10;
            $payment -> modifyAttraction = 0;
            $payment -> modifySeller = 0;
          }

          if($price == $sellsumm){
            $payment -> SallerSalary = $summ/100*13;
            $payment -> AttaractionerSalary = $summ/100*20;
            $payment -> DeveloperSalary = $summ/100*17;
            $payment -> modifyAttraction = 0;
            $payment -> modifySeller = 0;
          }

          $payment -> calculation = $req -> input('calculation');
          $payment -> client = $req -> input('client');
          $payment -> nameOfAttractioner = $req -> input('nameOfAttractioner');
          $payment -> nameOfSeller = $req -> input('nameOfSeller');
          $payment -> directionDevelopment = $req -> input('directionDevelopment');
          if($req -> input('clientidinput')){$payment -> clientid = $req -> input('clientidinput');};
          
          $payment -> firmearning = ($summ - $payment -> SallerSalary - $payment -> AttaractionerSalary
          - $payment -> DeveloperSalary - $payment -> modifyAttraction - $payment -> modifySeller);
          
          $payment -> save();

          return redirect() -> route('showPaymentById', $id) -> with('success', 'Все в порядке, платеж обновлен');

      }
      //конец обновления платежа


    public function PaymentDelete($id){
        Payments::find($id)->delete();
        return redirect() -> route('payments') -> with('success', 'Все в порядке, платеж удален');

    }

}
