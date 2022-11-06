@extends('layouts.app')

@section('title')
  Юристы
@endsection

@section('main')

{{-- start views for all lawyers--}}

@foreach($data as $el)

  <div class= 'col-md-6 col-xxl-3 my-3'>
    <div class= 'card border-light'>
      <div class= 'd-inline-flex justify-content-end px-2'>

        @if ($el -> status == 1)
            <i class="bi bi-circle-fill" style = "color: #eee;"></i>
        @else
            <i class="bi bi-circle-fill text-secondary"></i>
        @endif

      </div>

      <div class="text-center">
        <h5 class="mb-2 text-muted text-truncate">{{$el -> name}}</h5>
        <p class="mb-0 text-muted">{{$el -> phone}}</p>
        <p class="mb-0 text-muted">{{$el -> email}}</p>


        <hr class="bg-dark-lighten my-3">
        <p class="mt-3 fw-semibold text-muted">Задач: <strong>18</strong> </p>
        <p class="mt-3 fw-semibold text-muted">Заседаний: <strong>18</strong> </p>
        <div class="mt-3 row d-flex justify-content-center">
            <div class="col-4 mb-3">
              <a class="btn btn-light w-100" href="{{ route ('showClientById', $el->id) }}">
              <i class="bi-three-dots"></i></a>
            </div>
        </div>
      </div>

    </div>
  </div>

@endforeach


{{-- end views for all lawyers--}}


@endsection
