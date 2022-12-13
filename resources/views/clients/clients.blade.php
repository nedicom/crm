@extends('layouts.app')

@section('title')
  Все клиенты
@endsection

@section('leftmenuone')
  <li class="nav-item text-center p-3">
    <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#myModal">Добавить клиента</a>
  </li>
@endsection

@section('main')
    <h2 class="px-3">Клиенты ({{$data->count()}})</h2>

    @include('inc/filter.clientfilter')

    <div class = "row p-4">

    @foreach($data as $el)

      <div class= 'col-md-6 col-xxl-3 my-3'>
        <div class= 'card border-light'>
          <div class= 'd-inline-flex justify-content-between px-4 pt-2'>

        <div>
          @foreach($el -> tasksFunc as $val)
            @if($val -> lawyer == Auth::user()->id && $val -> status == 'просрочена')
            <i class="bi bi-alarm" style = "color: red;"></i>          
            @endif
          @endforeach
        </div>

        <div>
          @foreach($el -> tasksFunc as $val)
            @if($val -> lawyer == Auth::user()->id && $val -> status == 'в работе')
            <i class="bi bi-person-workspace" style = "color: green;"></i>          
            @endif
          @endforeach
        </div>

        <div>
          @foreach($el -> tasksFunc as $val)
            @if($val -> lawyer == Auth::user()->id && $val -> status == 'ожидает')
            <i class="bi bi-hourglass-split" style = "color: orange;"></i>          
            @endif
          @endforeach
        </div>

        <div>
            @if ($el -> status == 1)
                <i class="bi bi-person" style = "color: #0acf97;"></i>
            @else
                <i class="bi bi-person text-secondary"></i>
            @endif
            </div>

          </div>

          <div class="text-center">
            <h6 class="mb-2 px-3 text-muted text-truncate">{{$el -> name}}</h6>
            <p class="mb-0 text-muted">{{$el -> phone}}</p>
            <p class="mb-0 text-muted">{{$el -> email}}</p>
            <p class="mb-0 text-muted">закреплен за: </br>@if($el -> userFunc -> name){{$el -> userFunc -> name}}@endif</p>

            <hr class="bg-dark-lighten my-3">
            <p class="mt-3 fw-semibold text-muted">Задач:
              <strong>@if($el -> tasksFunc -> count()){{$el -> tasksFunc -> count()}}@endif</strong> </p>           
            <div class="mt-3 row d-flex justify-content-center">
                <div class="col-4 mb-3">
                  <a class="btn btn-light w-100" href="{{ route ('showClientById', $el->id) }}">
                  <i class="bi-three-dots"></i></a>
                </div>
                <div class="col-4 mb-3">
                  <a class="btn btn-light w-100 nameToForm" href="#"
                  dataclient="{{$el -> name}}" datavalueid="{{$el -> id}}" data-bs-toggle="modal" data-bs-target="#taskModal">
                  <i class="bi-clipboard-plus"></i></a>
                </div>
            </div>
          </div>

        </div>
      </div>

    @endforeach

    </div>

    </div>
    @include('inc./modal/addclient')
    @include('inc/modal/addtask')

    @endsection
