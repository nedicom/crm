@extends('layouts.app')

@section('title')
  Лиды
@endsection

@section('leftmenuone')
  <li class="nav-item text-center p-3">
    <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#leadsModal">Добавить лид</a>
  </li>
  <li class="nav-item text-center p-3">
    <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#SourcesModal">Источники лидов</a>
  </li>
@endsection

@section('main')

    <h2 class="px-3">Лиды</h2>
{{-- start views for all services--}}


  @include('inc/filter.leadfilter')

    <div class="row">
      <div class="col-4">
        @foreach($data as $el)
          @if($el -> status == "поступил")
            @include('leads/leadcard')
          @endif
        @endforeach
      </div>

      <div class="col-8">
        @foreach($data as $el)
          @if($el -> status !== "поступил")
            @include('leads/leadcard')
          @endif
        @endforeach
      </div>
    </div>

{{-- end views for all services--}}

  @endsection

  @section('modals')
    @include('inc./modal/leadsmodal/addlead')
    @include('inc./modal/leadsmodal/sources')
  @endsection