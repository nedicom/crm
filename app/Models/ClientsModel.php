<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tasks;

  class ClientsModel extends Model
  {

    use HasFactory;

    public function userFunc()
      {
          return $this->belongsTo(USER::class, 'lawyer');
      }

    public function tasksFunc()
      {
          return $this->belongsTo(Tasks::class, 'lawyer');
      }

  }
