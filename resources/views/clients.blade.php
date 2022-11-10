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
    <h2 class="px-3">Клиенты</h2>
  {{-- start filter clients--}}
  <div>
    <div class = "row p-4">
      <div class = "col-10 d-flex justify-content-center">
        <form class = "row gx-3 gy-2 align-items-center d-flex justify-content-between" action="{{route('clients')}}" method="GET">

            <div class="col-2 d-flex justify-content-center">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox"
                id="flexSwitchCheckDefault" name="status" id="status" value="1"

                @if (null !== app('request')->input('status'))checked @endif>

                <label class="form-check-label" for="flexSwitchCheckDefault">В работе</label>
              </div>
            </div>

            <div class="col-4">
            <input type = "text" name="findclient" placeholder="введите клиента" id="findclient" class="form-control">
            </div>

            <div class="col-2">
                  <select class="form-select" name="checkedlawyer" id="checkedlawyer">
                        @foreach($datalawyers as $el)
                          <option value="{{$el -> id}}" @if (($el -> id) == (app('request')->input('checkedlawyer'))) selected @endif>
                            {{$el -> name}}
                          </option>
                        @endforeach
                  </select>
            </div>

            <div class="col-4">
            <button type="submit" class="btn btn-primary">Применить</button>
            <a href='clients' class='button btn btn-secondary'>Сбросить</a>
            </div>


        </form>
      </div>
    </div>
    {{-- end filter clients--}}

    {{-- start views for all clients--}}

    <div class = "row p-4">

    @foreach($data as $el)

      <div class= 'col-md-6 col-xxl-3 my-3'>
        <div class= 'card border-light'>
          <div class= 'd-inline-flex justify-content-end px-2'>

            @if ($el -> status == 1)
                <i class="bi bi-circle-fill" style = "color: #0acf97;"></i>
            @else
                <i class="bi bi-circle-fill text-secondary"></i>
            @endif

          </div>

          <div class="text-center">
            <h5 class="mb-2 text-muted text-truncate">{{$el -> name}}</h5>
            <p class="mb-0 text-muted">{{$el -> phone}}</p>
            <p class="mb-0 text-muted">{{$el -> email}}</p>
            <p class="mb-0 text-muted">закреплен за: </br>{{$el -> userFunc -> name}}</p>

            <hr class="bg-dark-lighten my-3">
            <p class="mt-3 fw-semibold text-muted">Задач: <strong>18</strong> </p>
            <p class="mt-3 fw-semibold text-muted">Стоимость: <strong>18000</strong> </p>
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

      <div class="d-flex justify-content-center">
      {{ $data->links() }}
      </div>

    </div>
    {{-- end views for all clients--}}

    </div>

    @endsection
