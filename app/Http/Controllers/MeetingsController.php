<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MeetingsRequest;
//use App\Http\Requests\UpdateMeetingsRequest;
use App\Models\Meetings;
use App\Models\User;
use Carbon\Carbon;

class MeetingsController extends Controller
{
    public function index(Request $request){

        $calendar = $request->input('calendar');//month, year, day
        $checkedlawyer = $request->input('checkedlawyer');//lawyer

        if($calendar == 'week'){
          return view ('meetings/meetings', ['data' => Meetings::select("*")
          ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
          ->where('lawyer', '=', $checkedlawyer)
          ->get()],
          ['datalawyers' =>  User::all()]);
        }
        elseif($calendar == 'day'){
          return view ('meetings/meetings', ['data' => Meetings::select("*")
          ->whereBetween('date', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
          ->where('lawyer', '=', $checkedlawyer)
          ->get()],
          ['datalawyers' =>  User::all()]);
        }
        elseif($calendar == 'month'){
          return view ('meetings/meetings', ['data' => Meetings::select("*")
          ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
          ->where('lawyer', '=', $checkedlawyer)
          ->get()],
          ['datalawyers' =>  User::all()]);
        }
        elseif(!empty($checkedlawyer)){
          return view ('meetings/meetings', ['data' => Meetings::select("*")
          ->where('lawyer', '=', $checkedlawyer)
          ->get()],
          ['datalawyers' =>  User::all()]);
        }
        else{
          return view ('meetings/meetings', ['data' => Meetings::All()],
          ['datalawyers' =>  User::all()]);
        }


    }

    public function create(MeetingsRequest $req)
    {
        $meeting = new Meetings();

        $meeting -> name = $req -> name;
        $meeting -> client = $req -> client;
        $meeting -> date = $req -> date;
        $meeting -> lawyer = $req -> lawyer;

        $meeting -> save();
        return redirect() -> route('meetings') -> with('success', 'Все в порядке, заседание добавлено');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMeetingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeetingsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meetings  $meetings
     * @return \Illuminate\Http\Response
     */
    public function show(Meetings $meetings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meetings  $meetings
     * @return \Illuminate\Http\Response
     */
    public function edit(Meetings $meetings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMeetingsRequest  $request
     * @param  \App\Models\Meetings  $meetings
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMeetingsRequest $request, Meetings $meetings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meetings  $meetings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meetings $meetings)
    {
        //
    }
}
