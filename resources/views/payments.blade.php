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
    <h2 class="px-3">Платежи</h2>
    {{-- start filter payments--}}

    {{-- end filter payments--}}



    {{-- start views for all payments--}}

    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover align-middle">
                <thead>
                <tr>
                    <th scope="col">дата</th>
                    <th scope="col">Клиент</th>
                    <th scope="col">Услуга</th>
                    <th scope="col">Цена услуги</th>
                    <th scope="col">Оплачено</th>
                    <th scope="col">Куда поступили</th>
                    <th scope="col">Привлек</th>
                    <th scope="col">Оплата + повышение</th>
                    <th scope="col">Продал</th>
                    <th scope="col">Оплата + повышение</th>
                    <th scope="col">Развитие направления</th>
                    <th scope="col">Оплата</th>
                </tr>
                </thead>

                <tbody>
                  @foreach($data as $el)
                      <tr >
                          <td>{{$el -> created_at}}</td>
                          <td scope="row">{{$el -> client}}</td>
                          <td>{{$el -> serviceFunc -> name}}</td>
                          <td><span class="badge bg-primary py-3 px-4">{{$el -> serviceFunc -> price}}</span></td>
                          <td><span class="badge bg-primary py-3 px-4">{{$el -> summ}}</span></td>
                          <td>
                          <span class="badge py-3 px-4
                          @if ($el -> calculation == 'ГЕНБАНК') bg-primary
                          @elseif ($el -> calculation == 'РНКБ') bg-info
                          @elseif ($el -> calculation == 'НАЛИЧНЫЕ') bg-secondary
                          @elseif ($el -> calculation == 'СБЕР') bg-success
                          @else bg-light
                          @endif
                          ">{{$el -> calculation}}</span></td>
                          <td>{{$el -> AttractionerFunc -> name}}</td>
                          <td><span class="badge bg-success py-3 px-4">{{$el -> AttaractionerSalary}} + {{$el -> modifyAttraction}}</span></td>
                          <td>{{$el -> sellerFunc -> name}}</td>
                          <td><span class="badge bg-success py-3 px-4">{{$el -> SallerSalary}} + {{$el -> modifySeller}}</span></td>
                          <td>{{$el -> developmentFunc -> name}}</td>
                          <td><span class="badge bg-success py-3 px-4">{{$el -> DeveloperSalary}}</span></td>
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
