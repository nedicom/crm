@extends('layouts.app')

@section('head')
@endsection


@section('title')
  Заседания
@endsection

@section('leftmenuone')
  <li class="nav-item text-center p-3">
    <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#meetingModal">Добавить заседание</a>
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
                    @foreach($datalawyers as $el)
                      <option value="{{$el -> id}}" @if (($el -> id) == (app('request')->input('checkedlawyer'))) selected @endif>
                        {{$el -> name}}
                      </option>
                    @endforeach
              </select>
            </div>

            <div class="">
              <button type="submit" class="btn btn-primary">Применить</button>
              <a href='meetings' class='button btn btn-secondary'>Сбросить</a>
            </div>

        </div>

      </form>
  </div>
  {{-- end filter meetings--}}



{{-- start views for all meetings--}}
    <div class="col-12">
    </div>
      @foreach($data as $el)
    <div class="col-3 my-3">
      <div class="card border-light">
          <div class="card-body">
            <h5 class="card-title">{{$el -> description}}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{$el -> client}}</h6>
              <h4 class="header-title mb-3">{{$el -> name}}</h4>
               <span class="badge bg-success"> {{$el['date']}}</span>
              <p>
                @foreach($datalawyers as $ellawyer)
                  @if ($ellawyer -> id == $el -> lawyer)  {{$ellawyer -> name}} @endif
                @endforeach
              </p>


              <div class="mt-3 row d-flex justify-content-center">
                      <div class="col-4 mb-3">
                        <a class="btn btn-light w-100" href="#">
                        <i class="bi-three-dots"></i></a>
                      </div>
              </div>
            </div>
          </div>
      </div>
      @endforeach
{{-- end views for all meetings--}}

@endsection
