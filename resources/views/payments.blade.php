  @extends('layouts.app')


  @section('title')
    платежи
  @endsection

    @section('leftmenuone')
      <li class="nav-item text-center p-3">
        <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#paymentModal">Добавить платеж</a>
      </li>
    @endsection

@section('main')

    {{-- start filter payments--}}

    {{-- end filter payments--}}



    {{-- start views for all payments--}}

    <div class="row">
        <div class="col-12">
          <h4 class="header-title mb-3">Платежи</h4>
            <table class="table table-striped table-hover align-middle">
                <thead>
                <tr>
                    <th scope="col">дата</th>
                    <th scope="col">Клиент</th>
                    <th scope="col">Услуга</th>
                    <th scope="col">Цена услуги</th>
                    <th scope="col">Привлек</th>
                    <th scope="col">Оплата за привлечение</th>
                    <th scope="col">Продал</th>
                    <th scope="col">Оплата за продажу</th>
                    <th scope="col">Оплачено</th>
                    <th scope="col">Куда поступили</th>
                </tr>
                </thead>

                <tbody>
                  @foreach($data as $el)
                      <tr >
                          <td>{{$el -> created_at}}</td>
                          <td scope="row">{{$el -> client}}</td>
                          <td>{{$el -> service}}</td>
                          <td>цена услуги</td>
                          <td>{{$el -> nameOfAttractioner}}</td>
                          <td>оплата за привлечение</td>
                          <td>{{$el -> nameOfSeller}}</td>
                          <td>оплата за продажу</td>
                          <td>{{$el -> summ}}</td>
                          <td>
                          <span class="badge py-3 px-4
                          @if ($el -> calculation == 'ГЕНБАНК') bg-primary
                          @elseif ($el -> calculation == 'РНКБ') bg-info
                          @elseif ($el -> calculation == 'НАЛИЧНЫЕ') bg-secondary
                          @elseif ($el -> calculation == 'СБЕРБАНК') bg-succes
                          @else bg-light
                          @endif
                          ">{{$el -> calculation}}</span></td>
                          <td>
                            <a class="btn btn-light w-100" href="{{ route ('showPaymentById', $el->id) }}">
                              <i class="bi-three-dots"></i></a>
                          </td>
                      </tr>

                  @endforeach

                </tbody>
            </table>

                                        <!-- end table-responsive -->



                            </div> <!-- end col -->
    </div>



    {{-- end views for all payments--}}

@endsection
