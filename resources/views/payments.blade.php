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
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Платежи</h4>

                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead class="table-light">
                                                <tr>
                                                    <th>дата</th>
                                                    <th>Клиент</th>
                                                    <th>Услуга</th>
                                                    <th>Цена услуги</th>
                                                    <th>Привлек</th>
                                                    <th>Оплата за привлечение</th>
                                                    <th>Продал</th>
                                                    <th>Оплата за продажу</th>
                                                    <th>Оплачено</th>
                                                    <th>Куда поступили</th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                  @foreach($data as $el)

                                                      <tr>
                                                          <td>{{$el -> created_at}}</td>
                                                          <td>{{$el -> client}}</td>
                                                          <td>{{$el -> service}}</td>
                                                          <td>цена услуги</td>
                                                          <td>{{$el -> nameOfAttractioner}}</td>
                                                          <td>оплата за привлечение</td>
                                                          <td>{{$el -> nameOfSeller}}</td>
                                                          <td>оплата за продажу</td>
                                                          <td>{{$el -> summ}}</td>


                                                            <td>{{$el -> calculation}}</td>
                                                          <td>
                                                          <a class="btn btn-primary" href="{{ route ('showPaymentById', $el->id) }}" role="button">Подробнее</a>
                                                          </td>
                                                      </tr>

                                                  @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->

                                    </div>
                                </div>
                            </div> <!-- end col -->


                        </div>



    {{-- end views for all payments--}}

@endsection
