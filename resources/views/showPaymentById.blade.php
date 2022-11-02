@extends('layouts.app')

@section('title')
  платеж
@endsection

@section('main')
<div class ="text-center container col-md-9">
    <div>
      <div class = "alert alert-info d-flex justify-content-between align-items-center m-2">
      <h3 class =''>{{$data->summ}}</h3>
      <p class=''>
        <div>{{$data -> client}}</div>
        <div>{{$data -> service}}</div>
        <div>{{$data -> created_at}}</div>
        <a class="btn btn-primary" href="{{ route ('PaymentUpdate', $data->id) }}" role="button">Редактировать</a>
        <a class="btn btn-danger" href="{{ route ('PaymentDelete', $data->id) }}" role="button">Удалить</a>
      </p>
    </div>

  </div>
</div>
@endsection
