<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TasksRequest;
use App\Models\Tasks;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

  class TasksController extends Controller{

    public function index(Request $request){
      $lawyerfilter = $typefilter = null;
      $checkedlawyer = $type = null;
      $calendar = $request->input('calendar');//month, year, day
      if($request->input('checkedlawyer')){$lawyerfilter='lawyer'; $checkedlawyer = $request->input('checkedlawyer');}//lawyer
      if($request->input('type')){$typefilter='type'; $type = $request->input('type');}//type

        //if(!empty($checkedlawyer)){ //checkedlawyer no empty
            if($calendar == 'week'){
              return view ('tasks/tasks', ['data' => Tasks::select("*")
              ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
              ->where($lawyerfilter, '=', $checkedlawyer)
              ->where($typefilter, '=', $type)
              ->orderBy('date', 'asc')
              ->get()],
              ['datalawyers' =>  User::all()]);
            }

            elseif($calendar == 'day'){
              return view ('tasks/tasks', ['data' => Tasks::select("*")
              ->whereBetween('date', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
              ->where($lawyerfilter, '=', $checkedlawyer)
              ->where($typefilter, '=', $type)
              ->orderBy('date', 'asc')
              ->get()],
              ['datalawyers' =>  User::all()]);
            }

            elseif($calendar == 'month'){
              return view ('tasks/tasks', ['data' => Tasks::select("*")
              ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
              ->where($lawyerfilter, '=', $checkedlawyer)
              ->where($typefilter, '=', $type)
              ->orderBy('date', 'asc')
              ->get()],
              ['datalawyers' =>  User::all()]);
            }

            else{
              return view ('tasks/tasks', ['data' => Tasks::select("*")
              ->where($lawyerfilter, '=', $checkedlawyer)
              ->where($typefilter, '=', $type)
              ->orderBy('date', 'asc')
              ->get()],
              ['datalawyers' =>  User::all()]);
            }

         // }


      /*  if(is_null($checkedlawyer)){ //checkedlawyer is empty

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
            ->orWhere('soispolintel', (Auth::user()->id))
            ->orWhere('postanovshik', (Auth::user()->id))
            ->orderBy('date', 'asc')
            ->get()],
            ['datalawyers' =>  User::all()]);
          }

        }


        else{
          return view ('tasks/tasks', ['data' => Tasks::select("*")
          ->get()],
          ['datalawyers' =>  User::all()]);
        }*/


    }

        public function create(TasksRequest $req){
            $task = new Tasks();

            $task -> name = $req -> nameoftask;
            $task -> client = $req -> client;
            $task -> date = $req -> date;
            $task -> lawyer = $req -> lawyer;
            $task -> duration = $req -> duration;
            $task -> clientid = $req -> clientidinput;
            if($req -> hrftodcm){$task -> hrftodcm = $req -> hrftodcm;};
            if($req -> type){$task -> type = $req -> type;};

            $task -> postanovshik = Auth::user()->id;
            if($req -> tag){$task -> tag = $req -> tag;};
            if($req -> soispolintel){$task -> soispolintel = $req -> soispolintel;};
            if($req -> description){$task -> description = $req -> description;};

            $task -> status = 'ожидает';

            $task -> save();

            return redirect() -> route('tasks') -> with('success', 'Все в порядке, задача добавлена');
        }

        public function tag(Request $request){
          if($request->get('id')){
            $id = $request->get('id');
            $task = Tasks::find($id);
            $task -> tag = $request->get('value');
            $task -> save();
          }
        }


        public function showTaskById($request){
          return view ('tasks/taskById', ['data' => Tasks::find($request)], ['datalawyers' =>  User::all()]);

        }

        public function editTaskById($id, TasksRequest $req){
          $task = Tasks::find($id);

          $task -> name = $req -> nameoftask;
          $task -> client = $req -> client;
          $task -> date = $req -> date;
          $task -> lawyer = $req -> lawyer;
          $task -> duration = $req -> duration;
          $task -> status = $req -> status;

          if($req -> tag){$task -> tag = $req -> tag;};
          if($req -> postanovshik){$task -> postanovshik = $req -> postanovshik;};
          if($req -> soispolintel){$task -> soispolintel = $req -> soispolintel;};
          if($req -> description){$task -> description = $req -> description;};

          if($req -> hrftodcm){$task -> hrftodcm = $req -> hrftodcm;};
          if($req -> type){$task -> type = $req -> type;};
          if($req -> clientidinput){$task -> clientid = $req -> clientidinput;};  

          $task -> save();

          return redirect() -> route('showTaskById', $id) -> with('success', 'Все в порядке, задача обновлена');
        }

        public function TaskDelete($id){
            Tasks::find($id)->delete();
            return redirect() -> route('tasks') -> with('success', 'Все в порядке, задача удалена');

        }

    }
