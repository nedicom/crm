@extends('layouts.app')

@section('title')
  Юристы
@endsection

@section('main')

{{-- start views for all lawyers--}}
  <div class = "alert alert-info d-flex justify-content-between align-items-center m-2">
    <h3 class =''>Имя</h3>
    <p class=''>
      <div>Телефон</div>
      <div>email</div>
    </p>
  </div>
  
    @foreach($data as $el)

    <div class = "alert alert-info d-flex justify-content-between align-items-center m-2">
      <h3 class =''>{{$el -> name}}</h3>
      <p class=''>
        <div>{{$el -> phone}}</div>
        <div>{{$el -> email}}</div>
        <a class="btn btn-primary" href="{{ route ('showClientById', $el->id) }}" role="button">Подробнее</a>
      </p>
    </div>

    @endforeach

{{-- end views for all lawyers--}}


@endsection
