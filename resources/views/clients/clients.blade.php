@extends('layouts.app')

@section('title')
  Все клиенты
@endsection

@section('leftmenuone')
  <li class="nav-item text-center p-3">
    <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#myModal">Добавить клиента</a>
  </li>
@endsection

@section('main')
    <h2 class="px-3">Клиенты ({{$data->count()}})</h2>

    @include('inc/filter.clientfilter')

    <div class = "row p-4">

    @foreach($data as $el)

      <div class= 'card row my-3 p-3 border'>
        <div class="text-center d-inline-flex justify-content-between align-items-center">

        <div class="col-4">
            <div class="col-6 d-flex justify-content-center">
                  <div class="px-1 col-4">
                    <a class="btn btn-light w-100" href="{{ route ('showClientById', $el->id) }}">
                    <i class="bi-three-dots"></i></a>
                  </div>
                  <div class="px-1 col-4">
                    <a class="btn btn-light w-100 nameToForm" href="#"
                    dataclient="{{$el -> name}}" datavalueid="{{$el -> id}}" data-bs-toggle="modal" data-bs-target="#taskModal">
                    <i class="bi-clipboard-plus"></i></a>
                  </div>
                  <div class="px-1 col-4">
                  <img src="@if($el -> userFunc -> avatar){{$el -> userFunc -> avatar}}@endif" style="width: 30px;  height:30px"
                  class="rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" 
                  title="@if($el -> userFunc -> name){{$el -> userFunc -> name}}@endif">
                </div>
            </div>
          </div>
            <div class="col-4 text-muted text-truncate fw-bold">{{$el -> name}}</div>

          <div class="col-4 d-flex align-items-center justify-content-end">
            <div class="col-6 d-flex align-items-cente justify-content-end">
              <div>
                <p class="mb-0 text-muted">{{$el -> phone}}</p>
                <p class="mb-0 text-muted">{{$el -> email}}</p>
              </div>
            </div>
          

            <div class="col-6 d-flex align-items-center justify-content-end">
              <div  class="px-3">
                @if ($el -> status == 1)
                    <i class="bi bi-person" style = "font-size: 2rem; color: #0acf97;"></i>
                @else
                    <i class="bi bi-person" style = "font-size: 2rem; color: gray;"></i>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="d-flex flex-wrap">            
            @foreach($el -> tasksFunc as $val)
              @if($val -> status !== 'выполнена')
              <div class="col-2 px-3 py-4 border border-4 border-light rounded" style="background-color:
                @if($val -> status == 'просрочена') LightCoral
                @elseif($val -> status == 'в работе') MediumAquaMarine
                @elseif($val -> status == 'ожидает') Cornsilk
                @else Cornsilk  @endif
                
              ;">
                  <span class="px-1 fw-normal bg-white border border-white rounded-top" style="font-size: 14px;!important">{{$val -> date['value']}}</span>   
                  <div class="px-1 fw-normal bg-white border border-white rounded-end"  style="height: 80px; overflow: hidden; position: relative;"> 
                    <a href="/tasks/{{$val -> id}}" style="font-size: 14px;!important" target="_blank">{{$val -> name}}</a>
                  </div>                                         
              </div>                       
              @endif
            @endforeach
            <div class="col-2 px-3 py-4 border border-4 border-light rounded" style="background-color: Cornsilk;;">
                  <span class="px-1 fw-normal bg-white border border-white rounded-top" style="font-size: 14px;!important">добавить задачу</span>   
                  <div class="px-1 fw-normal bg-white border border-white rounded-end d-flex align-items-center "  style="height: 80px; overflow: hidden; position: relative;"> 
                    <a class="btn w-100 nameToForm" href="#"
                    dataclient="{{$el -> name}}" datavalueid="{{$el -> id}}" data-bs-toggle="modal" data-bs-target="#taskModal"
                   target="_blank">
                    <i class="bi-clipboard-plus"></i></a>
                  </div>                                         
              </div> 
          </div>
        </div>

      </div>

    @endforeach

    </div>

    </div>
    @include('inc./modal/addclient')
    @include('inc/modal/addtask')

    <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    </script>

    @endsection
