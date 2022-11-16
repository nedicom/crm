@extends('layouts.app')

@section('title')
  Клиент
@endsection

@section('leftmenuone')
  <li class="nav-item text-center p-3">
    <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#editModal">Редактировать клиента</a>
  </li>
@endsection

@section('main')

<h2 class="px-3">Клиент</h2>

    <div class= 'col-md-6 col-xxl-3 my-3'>
      <div class= 'card border-light'>
        <div class= 'd-inline-flex justify-content-end px-2'>

          @if ($data -> status == 1)
              <i class="bi bi-circle-fill" style = "color: #0acf97;"></i>
          @else
              <i class="bi bi-circle-fill text-secondary"></i>
          @endif

        </div>

        <div class="text-center">
          <h5 class="mb-2 text-muted text-truncate">{{$data -> name}}</h5>
          <p class="mb-0 text-muted">{{$data -> phone}}</p>
          <p class="mb-0 text-muted">{{$data -> email}}</p>
          <p class="mb-0 text-muted">закреплен за: </br>{{$data -> userFunc -> name}}</p>
          <hr class="bg-dark-lighten my-3">
          <p class="mt-3 fw-semibold text-muted">Задач: <strong>18</strong> </p>
          <p class="mt-3 fw-semibold text-muted">Стоимость: <strong>18000</strong> </p>
          <div class="mt-3 row d-flex justify-content-center">
              <div class="col-4 mb-3">
                <a class="btn btn-light w-100" href="#" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="bi-pen"></i></a>
              </div>
              <div class="col-4 mb-3">
                <a class="btn btn-light w-100" href="{{ route ('Client-Delete', $data->id) }}">
                <i class="bi-trash"></i></a>
              </div>
          </div>
        </div>

      </div>
    </div>

@endsection
