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

    {{-- start views for all payments--}}

    <div class="row">
        <div class="col-12">
            <table class="table table-hover table-borderless align-middle caption-top" style="font-size: 14px;">
            <div class="d-flex flex-row-reverse"><a class="btn btn-secondary" href="payments" role="button">сбросить фильтры</a></div>
                <thead class="fw-bold text-center">
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">дата</th>
                    <th scope="col">Клиент</th>
                    <th scope="col">Услуга</th>
                    <th scope="col">Цена услуги</th>
                    <th scope="col">Оплачено</th>
                    <th scope="col">Куда поступили</th>
                    <th scope="col">
                      <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          привлек
                        </button>
                        <ul class="dropdown-menu">
                          @foreach($datalawyers as $el)
                            <li>
                            <a class="dropdown-item" href="payments/?nameOfAttractioner={{$el -> id}}">{{$el -> name}}</a>                            
                            </li>
                          @endforeach
                            <li><hr class="dropdown-divider"></li>
                            <li>
                              <a class="dropdown-item" href="payments">сбросить</a>                            
                            </li>
                        </ul>
                      </div>
                    </th>
                    <th scope="col">Оплата + повышение</th>
                    <th scope="col">
                     <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          продал
                        </button>
                        <ul class="dropdown-menu">
                          @foreach($datalawyers as $el)
                            <li>
                            <a class="dropdown-item" href="payments/?nameOfSeller={{$el -> id}}">{{$el -> name}}</a>                            
                            </li>
                          @endforeach
                            <li><hr class="dropdown-divider"></li>
                            <li>
                              <a class="dropdown-item" href="payments">сбросить</a>                            
                            </li>
                        </ul>
                      </div>
                    </th>
                    <th scope="col">Оплата + повышение</th>
                    <th scope="col">
                      <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          развил
                        </button>
                        <ul class="dropdown-menu">
                          @foreach($datalawyers as $el)
                            <li>
                            <a class="dropdown-item" href="payments/?directionDevelopment={{$el -> id}}">{{$el -> name}}</a>                            
                            </li>
                          @endforeach
                            <li><hr class="dropdown-divider"></li>
                            <li>
                              <a class="dropdown-item" href="payments">сбросить</a>                            
                            </li>
                        </ul>
                      </div>
                    </th>
                    <th scope="col">Оплата</th>
                </tr>
                </thead>

                <tbody class="fw-light text-center">
                  @php 
                    $total = 0; $totalattr = 0; $totalattrup = 0; $totalsell = 0; $totalsellup = 0; $totaldirect = 0;
                    $number = 1;                    
                  @endphp

                  @foreach($data as $el)
                      <tr>
                          <td>{{$number}}</td>
                          <td>{{$el -> created_at}}</td>
                          <td scope="row">{{$el -> client}}</td>
                          <td>{{$el -> serviceFunc -> name}}</td>
                          <td class="fw-bold text-center">{{$el -> serviceFunc -> price}}</td>                          
                          <td class="fw-bold text-center">{{$el -> summ}}</td>
                          <td>
                          <span class="badge py-1 px-1
                            @if ($el -> calculation == 'ГЕНБАНК') bg-primary
                            @elseif ($el -> calculation == 'РНКБ') bg-info
                            @elseif ($el -> calculation == 'НАЛИЧНЫЕ') bg-secondary
                            @elseif ($el -> calculation == 'СБЕР') bg-success
                            @else bg-light
                            @endif
                          ">{{$el -> calculation}}</span></td>
                          <td>{{$el -> AttractionerFunc -> name}}</td>
                          <td class="fw-bold text-center">{{$el -> AttaractionerSalary}} + {{$el -> modifyAttraction}}</td>
                          
                          <td>{{$el -> sellerFunc -> name}}</td>
                          <td class="fw-bold text-center">{{$el -> SallerSalary}} + {{$el -> modifySeller}}</td>
                          <td>{{$el -> developmentFunc -> name}}</td>
                          <td class="fw-bold text-center">{{$el -> DeveloperSalary}}</td>
                          <td>
                            <a class="btn btn-light w-100" href="{{ route ('showPaymentById', $el->id) }}">
                              <i class="bi-three-dots"></i></a>
                          </td>
                      </tr>

                      @php
                        $number++;
                        $total = $total + ($el -> summ); 
                        $totalattr= $totalattr + ($el -> AttaractionerSalary); $totalattrup = $totalattrup + ($el -> modifyAttraction); 
                        $totalsell = $totalsell + ($el -> SallerSalary); $totalsellup = $totalsellup + ($el -> modifySeller);
                        $totaldirect = $totaldirect + ($el -> DeveloperSalary);  
                      @endphp


                  @endforeach
                  <tfoot>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td class="fw-bold text-center"><span class="badge bg-primary py-2 px-2 fs-6">{{$totalattr}} + {{$totalattrup}}</span></td>
                      <td></td>
                      <td class="fw-bold text-center"> <span class="badge bg-primary py-2 px-2 fs-6">{{$totalsell}} + {{$totalsellup}}</span></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td class="fw-bold text-center fs-6">итого:</td>
                      <td></td>
                      <td class="fw-bold text-center"><span class="badge bg-primary py-2 px-2 fs-6">{{$total}}</span></td>
                      <td></td>
                      <td></td>
                      @php
                      $totalattrall = $totalattr + $totalattrup; $totalsellrall = $totalsell + $totalsellup;
                      @endphp
                      <td class="fw-bold text-center"><span class="badge bg-primary py-2 px-2 fs-6">{{$totalattrall}}</span></td>
                      <td></td>
                      <td class="fw-bold text-center"> <span class="badge bg-primary py-2 px-2 fs-6">{{$totalsellrall}}</span></td>
                      <td></td>
                      <td class="fw-bold text-center"><span class="badge bg-primary py-2 px-2 fs-6">{{$totaldirect}}</span></td>
                      <td></td>
                    </tr>
                  </tfoot>
                  </tbody>
            </table>

                                        <!-- end table-responsive -->



        </div> <!-- end col -->
    </div>



    {{-- end views for all payments--}}

@endsection
