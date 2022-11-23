<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TasksRequest;
use App\Models\Tasks;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

  class TasksController extends Controller{

    public function index(Request $request){

      $calendar = $request->input('calendar');//month, year, day
      $checkedlawyer = $request->input('checkedlawyer');//lawyer

        if(!empty($checkedlawyer)){ //checkedlawyer no empty
            if($calendar == 'week'){
              return view ('tasks/tasks', ['data' => Tasks::select("*")
              ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
              ->where('lawyer', '=', $checkedlawyer)
              ->orderBy('date', 'asc')
              ->get()],
              ['datalawyers' =>  User::all()]);
            }

            elseif($calendar == 'day'){
              return view ('tasks/tasks', ['data' => Tasks::select("*")
              ->whereBetween('date', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
              ->where('lawyer', '=', $checkedlawyer)
              ->orderBy('date', 'asc')
              ->get()],
              ['datalawyers' =>  User::all()]);
            }

            elseif($calendar == 'month'){
              return view ('tasks/tasks', ['data' => Tasks::select("*")
              ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
              ->where('lawyer', '=', $checkedlawyer)
              ->orderBy('date', 'asc')
              ->get()],
              ['datalawyers' =>  User::all()]);
            }

            else{
              return view ('tasks/tasks', ['data' => Tasks::select("*")
              ->orderBy('date', 'asc')
              ->where('lawyer', '=', $checkedlawyer)
              ->get()],
              ['datalawyers' =>  User::all()]);
            }

          }


        if(is_null($checkedlawyer)){ //checkedlawyer is empty

          if($calendar == 'week'){
            return view ('tasks/tasks', ['data' => Tasks::select("*")
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->orderBy('date', 'asc')
            ->get()],
            ['datalawyers' =>  User::all()]);
          }

          elseif($calendar == 'day'){
            return view ('tasks/tasks', ['data' => Tasks::select("*")
            ->whereBetween('date', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
            ->orderBy('date', 'asc')
            ->get()],
            ['datalawyers' =>  User::all()]);
          }

          elseif($calendar == 'month'){
            return view ('tasks/tasks', ['data' => Tasks::select("*")
            ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->orderBy('date', 'asc')
            ->get()],
            ['datalawyers' =>  User::all()]);
          }

          else{
            return view ('tasks/tasks', ['data' => Tasks::select("*")
            ->where('lawyer', (Auth::user()->id))
            ->orderBy('date', 'asc')
            ->get()],
            ['datalawyers' =>  User::all()]);
          }

        }


        else{
          return view ('tasks/tasks', ['data' => Tasks::select("*")
          ->get()],
          ['datalawyers' =>  User::all()]);
        }


    }

        public function create(TasksRequest $req){
            $task = new Tasks();

            $task -> name = $req -> name;
            $task -> client = $req -> client;
            $task -> date = $req -> date;
            $task -> lawyer = $req -> lawyer;
            $task -> duration = $req -> duration;
            $task -> clientid = $req -> clientidinput;
            $task -> status = 'в работе';

            $task -> save();

            return redirect() -> route('tasks') -> with('success', 'Все в порядке, задача добавлена');
        }

        public function showTaskById($request){
          return view ('tasks/taskById', ['data' => Tasks::find($request)], ['datalawyers' =>  User::all()]);

        }

        public function editTaskById($id, TasksRequest $req){
          $task = Tasks::find($id);

          $task -> name = $req -> name;
          $task -> client = $req -> client;
          $task -> date = $req -> date;
          $task -> lawyer = $req -> lawyer;
          $task -> duration = $req -> duration;
          $task -> status = $req -> status;
          if($req -> clientidinput){$task -> clientid = $req -> clientidinput;};  

          $task -> save();

          return redirect() -> route('showTaskById', $id) -> with('success', 'Все в порядке, задача обновлена');
        }

        public function TaskDelete($id){
            Tasks::find($id)->delete();
            return redirect() -> route('tasks') -> with('success', 'Все в порядке, задача удалена');

        }

    }
