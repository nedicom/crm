<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MeetingsRequest;
use App\Models\Meetings;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MeetingsController extends Controller{

    public function index(Request $request){

        $calendar = $request->input('calendar');//month, year, day
        $checkedlawyer = $request->input('checkedlawyer');//lawyer

      //  return dd($checkedlawyer);

        if(!empty($checkedlawyer)){
            if($calendar == 'week'){
              return view ('meetings/meetings', ['data' => Meetings::select("*")
              ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
              ->where('lawyer', '=', $checkedlawyer)
              ->orderBy('date', 'asc')
              ->get()],
              ['datalawyers' =>  User::all()]);
            }

            elseif($calendar == 'day'){
              return view ('meetings/meetings', ['data' => Meetings::select("*")
              ->whereBetween('date', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
              ->where('lawyer', '=', $checkedlawyer)
              ->orderBy('date', 'asc')
              ->get()],
              ['datalawyers' =>  User::all()]);
            }

            elseif($calendar == 'month'){
              return view ('meetings/meetings', ['data' => Meetings::select("*")
              ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
              ->where('lawyer', '=', $checkedlawyer)
              ->orderBy('date', 'asc')
              ->get()],
              ['datalawyers' =>  User::all()]);
            }

            else{
              return view ('meetings/meetings', ['data' => Meetings::select("*")
              ->orderBy('date', 'asc')
              ->where('lawyer', '=', $checkedlawyer)
              ->get()],
              ['datalawyers' =>  User::all()]);
            }

          }


        if(is_null($checkedlawyer)){
          if($calendar == 'week'){
            return view ('meetings/meetings', ['data' => Meetings::select("*")
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->orderBy('date', 'asc')
            ->get()],
            ['datalawyers' =>  User::all(), 'testdata' =>
            Meetings::All()]);
          }

          elseif($calendar == 'day'){
            return view ('meetings/meetings', ['data' => Meetings::select("*")
            ->whereBetween('date', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
            ->orderBy('date', 'asc')
            ->get()],
            ['datalawyers' =>  User::all()]);
          }

          elseif($calendar == 'month'){
            return view ('meetings/meetings', ['data' => Meetings::select("*")
            ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->orderBy('date', 'asc')
            ->get()],
            ['datalawyers' =>  User::all()]);
          }

          else{
            return view ('meetings/meetings', ['data' => Meetings::select("*")
            ->where('lawyer', (Auth::user()->id))
            ->orderBy('date', 'asc')
            ->get()],
            ['datalawyers' =>  User::all()]);
          }

        }

        else{
          return view ('meetings/meetings', ['data' => Meetings::select("*")
          ->get()],
          ['datalawyers' =>  User::all()]);
        }


    }

    public function create(MeetingsRequest $req){
        $meeting = new Meetings();

        $meeting -> name = $req -> name;
        $meeting -> client = $req -> client;
        $meeting -> date = $req -> date;
        $meeting -> lawyer = $req -> lawyer;

        $meeting -> save();
        return redirect() -> route('meetings') -> with('success', 'Все в порядке, заседание добавлено');
    }

    /**
     * Show a newly created resource in storage.
     */
    public function showMeetengById($request){
      return view ('meetings/meetingById', ['data' => Meetings::find($request)], ['datalawyers' =>  User::all()]);

    }


    public function editMeetengById($id, MeetingsRequest $req){
      $meeting = Meetings::find($id);
      $meeting -> name = $req -> name;
      $meeting -> client = $req -> client;
      $meeting -> date = $req -> date;
      $meeting -> lawyer = $req -> lawyer;
      $meeting -> save();
      return redirect() -> route('showMeetengById', $id) -> with('success', 'Все в порядке, заседание обновлено');
    }

    public function MeetingDelete($id){
        Meetings::find($id)->delete();
        return redirect() -> route('meetings') -> with('success', 'Все в порядке, заседание удалено');

    }
}
