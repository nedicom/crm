@extends('layouts.app')

@section('title')
  Платежи
@endsection

@section('leftmenuone')
  Добавить платеж
@endsection

@section('main')

    {{-- start filter payments--}}

    {{-- end filter payments--}}



    {{-- start views for all payments--}}

    @foreach($data as $el)

        <div class = "alert alert-info d-flex justify-content-between align-items-center m-2">
            <h6 class ='fw-semi-bold'>{{$el -> summ}}</h6>
          <p class=''>
            <div>{{$el -> client}}</div>
            <div>{{$el -> calculation}}</div>
            <div>{{$el -> service}}</div>
            <div>{{$el -> nameOfAttractioner}}</div>
            <a class="btn btn-primary" href="{{ route ('showPaymentById', $el->id) }}" role="button">Подробнее</a>
          </p>
        </div>

    @endforeach

    {{-- end views for all payments--}}

@endsection
