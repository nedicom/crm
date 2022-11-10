@extends('layouts.app')

@section('head')
@endsection


@section('title')
  Задача
@endsection

@section('leftmenuone')
  <li class="nav-item text-center p-3">
    <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#edittaskModal">Изменить задачу</a>
  </li>
@endsection

@section('main')

  {{-- start views for meeting--}}
      <div class="col-4 text-center">

        @php
          $weekMap = [0 => 'Понедельник', 1 => 'Вторник', 2 => 'Среда', 3 => 'Четерг', 4 => 'Пятница', 5 => 'Суббота', 6 => 'Воскресенье']
        @endphp

          <div class="card border-light">
            <div class="card-body">
              <h5 class="card-title text-truncate">{{$data -> name}}</h5>
                <h5>
                  <span class="badge bg-primary"> {{$data['date']['currentMonth']}}</span>
                  <span class="badge bg-primary"> {{$data['date']['currentDay']}}</span>
                  <span class="badge bg-success"> {{$data['date']['currentTime']}}</span>
                </h5>
                <h6>@foreach($datalawyers as $ellawyer)
                    @if ($ellawyer -> id == $data -> lawyer)  {{$ellawyer -> name}} @endif
                  @endforeach
                </h6>
                <p class="text-truncate">создано: {{$data -> created_at}}</p>
                <p class="text-truncate">изменено: {{$data -> updated_at}}</p>
                <p class="text-truncate">{{$data -> client}}</p>
                <div class="mt-3 row d-flex justify-content-center">
                  <div class="col-4 mb-3">
                    <a class="btn btn-light w-100" href="#" data-bs-toggle="modal" data-bs-target="#edittaskModal">
                    <i class="bi-three-dots"></i></a>
                  </div>
                  <div class="col-2 mb-3">
                    <a class="btn btn-light w-100" href="{{ route ('TaskDelete', $data->id) }}">
                    <i class="bi-trash"></i></a>
                  </div>
                </div>
            </div>
          </div>

      </div>
  {{-- end views for all meetings--}}

@endsection
