<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

  class LawyersController extends Controller{

      public function Alllawyers(){
          return view ('lawyers', ['data' => User::all()]);

      }


  }
