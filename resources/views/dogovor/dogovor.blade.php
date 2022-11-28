@extends('layouts.app')


@section('title')
  договоры
@endsection

  @section('leftmenuone')
    <li class="nav-item text-center p-3">
      <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#dogovorModal">Добавить договор</a>
    </li>
  @endsection

@section('main')
  <h2 class="px-3">Договоры</h2>

  {{-- start views for all services--}}

      <div class="col-12">
      </div>
        @foreach($data as $el)
      <div class="col-3 my-3">
        <div class="card border-light">
            <div class="card-body">
              <h5 class="card-title">{{$el -> name}}</h5>
              <h6 class="card-subtitle mb-2 text-muted">{{$el -> subject}}</h6>
                <h4 class="header-title mb-3"></h4>

                <p>{{$el -> created_at}}</p>

              </div>
            </div>
        </div>
        @endforeach

        @include('inc./modal/adddogovor')

@endsection
