@extends('layouts.app')

@section('head')
@endsection

@section('title')
  Задачи
@endsection

@section('leftmenuone')
  <li class="nav-item text-center p-3">
    <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#taskModal">Добавить задачу</a>
  </li>
@endsection

@section('main')

{{-- start filter meetings--}}
  <div class = "row p-4">
      <form class = "row" action="" method="GET">

        <div class="col-8 d-flex justify-content-evenly">
          <div class="">
            <input type="radio" class="btn-check" value="day" name="calendar" id="day"
              @if (app('request')->input('calendar') == 'day') checked @endif
              onchange="this.form.submit()">
            <label class="btn btn-outline-success" for="day">День</label>
            <input type="radio" class="btn-check" value="week" name="calendar" id="week"
              @if (app('request')->input('calendar') == 'week') checked @endif
              onchange="this.form.submit()">
            <label class="btn btn-outline-success" for="week">Неделя</label>
            <input type="radio" class="btn-check" value="month" name="calendar" id="month"
              @if (app('request')->input('calendar') == 'month') checked @endif
              onchange="this.form.submit()">
            <label class="btn btn-outline-success" for="month">Месяц</label>
          </div>

            <div class="">
              <select class="form-select" name="checkedlawyer" id="checkedlawyer">
                <option value=''>не выбрано</option>
                    @foreach($datalawyers as $el)
                      <option value="{{$el -> id}}" @if (($el -> id) == (app('request')->input('checkedlawyer'))) selected @endif>
                        {{$el -> name}}
                      </option>
                    @endforeach
              </select>
            </div>

            <div class="">
              <button type="submit" class="btn btn-primary">Применить</button>
              <a href='tasks' class='button btn btn-secondary'>Сбросить</a>
            </div>
        </div>
      </form>
  </div>
  {{-- end filter meetings--}}



  {{-- start views for all meetings--}}
      <div class="row">

        @php
          $weekMap = [0 => 'Понедельник', 1 => 'Вторник', 2 => 'Среда', 3 => 'Четерг', 4 => 'Пятница', 5 => 'Суббота', 6 => 'Воскресенье']
        @endphp

        @if (app('request')->input('calendar') == '')
        <h2 class="">Задачи</h2>
          @foreach($data as $el)
            <div class="col-2 my-3">
              @include('inc.calendar.task')
            </div>
          @endforeach
        @endif

        @if (app('request')->input('calendar') == 'week')
        <h2 class="">Неделя</h2>
          @for ($i = 0; $i < 7; $i++)
            <div class="col my-3" style="max-width: 14%;">
            <h1 class="badge bg-secondary">{{$weekMap[$i];}}</h1>
              @foreach($data as $el)
                @if($el['date']['day'] == $weekMap[$i])
                  @include('inc.calendar.task')
                @endif
              @endforeach
            </div>
          @endfor
        @endif

        @if (app('request')->input('calendar') == 'day')
        <h2 class="">Сегодня</h2>
            @foreach($data as $el)
            <div class="col-2 my-3">
                @include('inc.calendar.task')
            </div>
            @endforeach
        @endif

        @if (app('request')->input('calendar') == 'month')
          <h2 class="">Месяц</h2>
          @for ($i = 1; $i <= (cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'))); $i++)
            <div class="my-3 col" style="min-width: 14%; max-width: 15%; min-height: 100px">
              {{$i}}
                @foreach($data as $el)
                  @if($el['date']['currentDay'] == $i)
                    @include('inc.calendar.task')
                  @endif
              @endforeach
            </div>
          @endfor
        @endif

      </div>
  {{-- end views for all meetings--}}

@endsection
