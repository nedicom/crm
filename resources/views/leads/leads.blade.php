@extends('layouts.app')

@section('title')
  Лиды
@endsection

@section('leftmenuone')
  <li class="nav-item text-center p-3">
    <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#leadsModal">Добавить лид</a>
  </li>
@endsection

@section('main')

    <h2 class="px-3">Лиды</h2>
{{-- start views for all services--}}


  @include('inc/filter.leadfilter')

      @foreach($data as $el)
        <div class="col-3 my-3">
          <div class="card border-light">
              <div class="card-body">
                <div class ="d-flex justify-content-between">
                  <h6 class="card-title">{{$el -> name}}</h6>
                  <div>
                    <span class="badge
                    @if ($el -> status == 'поступил') badge-postupil
                    @elseif ($el -> status == 'в работе') badge-vrabote
                    @elseif ($el -> status == 'конвертирован') badge-convertirovan
                    @else badge-udalen
                    @endif">{{$el -> status}} </span>
                  </div>
                </div>

               <h4 class="header-title mb-3">{{$el -> phone}}</h4>

               <div class ="d-flex justify-content-between">
                 <p class ="">{{$el -> created_at}}</p>
                 <p class ="">{{$el -> source}}</p>
               </div>

               <p class="header-title mb-3 text-truncate">что делаем: {{$el -> action}}</p>

               <div class="mt-3 row d-flex justify-content-center">
                <div class="col-4 mb-3">
                  <a class="btn btn-light w-100" href="{{ route ('showLeadById', $el->id) }}">
                  <i class="bi-three-dots"></i></a>
                </div>
              </div>
                </div>
              </div>
          </div>
      @endforeach


{{-- end views for all services--}}

  @endsection

  @section('modals')
    @include('inc./modal/leadsmodal/addlead')
  @endsection
