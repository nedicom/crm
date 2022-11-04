@extends('layouts.app')

@section('title')
  платеж
@endsection

@section('leftmenuone')
  <li class="nav-item text-center p-3">
    <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#editpaymentModal">Редактировать платеж</a>
  </li>
@endsection

@section('main')
  <div class="col-md-6 col-xxl-3 my-3">
        <div class="card border-light">
          <div class="d-inline-flex justify-content-between px-2">
            <span class="badge py-3 px-4
            @if ($data -> calculation == 'ГЕНБАНК') bg-primary
            @elseif ($data -> calculation == 'РНКБ') bg-info
            @elseif ($data -> calculation == 'НАЛИЧНЫЕ') bg-secondary
            @elseif ($data -> calculation == 'СБЕР') bg-success
            @else bg-light
            @endif
            ">{{$data -> calculation}}</span>
            <span class="badge  bg-primary py-3 px-4">{{$data->summ}}</span>
          </div>

          <div class="text-center">
            <h5 class="mb-2 text-muted text-truncate">{{$data -> client}}</h5>

            <p class="mb-0 text-muted">{{$data -> service}}</p>
            <p class="mb-0 text-muted"> {{$data -> created_at}}</p>

            <hr class="bg-dark-lighten my-3">
            <p class="mt-3 fw-semibold text-muted">привлек {{$data -> AttractionerFunc -> name}}: <strong>18</strong> </p>
            <p class="mt-3 fw-semibold text-muted">продал {{$data -> sellerFunc -> name}}: <strong>18000</strong> </p>

            <div class="mt-3 row d-flex justify-content-center">
                <div class="mt-3 row d-flex justify-content-center">
                    <div class="col-4 mb-3">
                      <a class="btn btn-light w-100" href="#" data-bs-toggle="modal" data-bs-target="#editpaymentModal">
                      <i class="bi-pen"></i></a>
                    </div>
                    <div class="col-4 mb-3">
                      <a class="btn btn-light w-100 disabled" href="{{ route ('PaymentDelete', $data->id) }}">
                      <i class="bi-trash"></i></a>
                    </div>
                  </div>
            </div>
          </div>

        </div>
      </div>

@endsection
