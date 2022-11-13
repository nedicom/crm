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

    <div class="col-12">
    </div>

      @foreach($data as $el)
        <div class="col-3 my-3">
          <div class="card border-light">
              <div class="card-body">
                <div class ="d-flex justify-content-between">
                  <h6 class="card-title">{{$el -> name}}</h6>
                  <div>
                    <span class="badge bg-success">{{$el -> status}} </span>
                  </div>
                </div>

                 <h4 class="header-title mb-3">{{$el -> phone}}</h4>

               <div class ="d-flex justify-content-left">
                 <p class ="px-2">{{$el -> created_at}}</p>
                 <p class ="px-2">{{$el -> source}}</p>
               </div>



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
