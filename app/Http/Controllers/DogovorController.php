<?php

namespace App\Http\Controllers;

use App\Models\Dogovor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ClientsModel;
//use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DogovorController extends Controller{

    public function dogovor(){
        return view ('dogovor', ['data' => Dogovor::all()]);
    }

    public function showdogovorById($id){
        return view ('dogovor/showdogovorById', ['data' => Dogovor::with('userFunc', 'clientFunc')->find($id)], ['datalawyers' =>  User::all(),
        ]);
      }

    public function adddogovor(Request $req){
        $Dogovor = new Dogovor();
            $name = $req -> input('name');
            $client = $req -> input('client'); 
            $predoplata = $req -> input('predoplata');
            $today= Carbon::now(); 
            $ispolnitel = 'Адвокатский кабинет Мина Марк Анатольевич';
            $adresispolnitelya = '295000, РФ, Респ. Крым, ул. Долгоруковская 13а'; 
            $kontaktyispolnitelya ='+7978 8838 978';
            $adress = $req -> input('adress');
            $phone = $req -> input('phone');
            $uslugi = $req -> input('subject');
            $allstoimost = $req -> input('allstoimost');
            $preduslugi = $req -> input('preduslugi');
            $predoplata = $req -> input('predoplata');
        $Dogovor -> name = $name;
        //$Dogovor -> adress = $adress;
        $Dogovor -> subject = $req -> input('subject');
        $Dogovor -> client_id = $req -> input('clientidinput');
        $Dogovor -> lawyer_id = Auth::id();
        $Dogovor -> date =  $today;

        $Dogovor -> save();

        $client = ClientsModel::find($id);
        if(!is_null($req -> input('address'))) {$client -> address = $req -> input('address');}
        $client -> save();

        $Rekvizitydogovora = array(
            'field_calendar', 'field_ispolnitel', 'field_adresispolnitelya', 'field_kontaktyispolnitelya', 'field_fio',
            'field_addres', 'field_phone', 'field_uslugi', 'field_allstoimost', 'field_preduslugi', 'field_predoplata');

        $Rekvizitydogovoravar = array(
            $today, $ispolnitel, $adresispolnitelya, $kontaktyispolnitelya, $client,
            $adress, $phone, $uslugi, $allstoimost, $preduslugi, $predoplata);

        $psthxml = "dogovor/document.xml";

        $zip = new ZipArchive;
				if($zip->open('dogovor/soglashenie.docx') === TRUE) {
					$handle = fopen($psthxml, "r");
					$content = fread($handle, filesize($psthxml));
					fclose($handle);
					$content = str_replace($Rekvizitydogovora, $Rekvizitydogovoravar, $content);
					$zip->deleteName('word/document.xml');
					$zip->addFromString('word/document.xml',$content);
					$zip->close();                  
				}

		$file = ("dogovor/soglashenie.docx");//path
		header ("Content-Type: application/octet-stream");
		header ("Accept-Ranges: bytes");
		header ("Content-Length: ".filesize($file));
		header ("Content-Disposition: attachment; filename=test.docx");
		flush();		
		readfile($file);

        //return redirect() -> route('clients') -> with('success', 'Все в порядке, договор добавлен'); 
    }
}
