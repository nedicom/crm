<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeetingsRequest;
use App\Http\Requests\UpdateMeetingsRequest;
use App\Models\Meetings;
use App\Models\User;

class MeetingsController extends Controller
{
    public function index()
    {
     return view ('meetings/meetings', ['data' => Meetings::all()], ['datalawyers' =>  User::all()]);
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
