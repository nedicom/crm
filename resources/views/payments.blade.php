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

    <div class="row mb-4">
    <div class="col-2">
      <div class="">
        <h3 class="text-uppercase">Платежи <i class="bi bi-credit-card text-info mx-2"></i></h3>
        <h5></h5>
      </div>
    </div>

    <div class="col-10 row">
       <div class="col-4">
       <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h4><i class="bi bi-clipboard2-check" style="color: blue"></i></h4>
              <p class="mb-1"> Цена продажи равна цене услуги </p>
            </div>

            <table class="mt-2 text-center w-100">
              <thead class="">              
                <th>Привлечение</th>
                <th>Продажа</th>
                <th>Развитие</th>
              </thead>
              <tbody class="fs-5">
                <tr>
                  <td>20 %</td>
                  <td>13 %</td>
                  <td>17 %</td>
                </tr>
                <tr style="font-size: .8rem !important;">
                <td colspan="3">от общей стоимости</td>
                </tr>
              </tbody>
            </table>
          </div>          
        </div> 
      </div>

      <div class="col-4">
       <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h4><i class="bi bi-clipboard2-plus" style="color: green"></i></h4>
              <p class="mb-1">Цена продажи больше цены услуги</p>
            </div>

            <table class="mt-2 text-center w-100">
              <thead class="">              
                <th>Привлечение</th>
                <th>Продажа</th>
                <th>Развитие</th>
              </thead>
              <tbody class="fs-5">
                <tr>
                  <td>20 % + 33 %</td>
                  <td>13 % + 17 %</td>
                  <td>17%</td>
                </tr>
                <tr style="font-size: .8rem !important;">
                  <td colspan="2">от общей стоимости + от размера превышение</td>
                  <td>от общей стоимости</td>
                </tr>
              </tbody>
            </table>
          </div>          
        </div> 
      </div>


      <div class="col-4">
       <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h4><i class="bi bi-clipboard-x" style="color: red"></i></h4>
              <p class="mb-1">Цена продажи меньше цены услуги</p>
            </div>

            <table class="mt-2 text-center w-100">
              <thead class="">              
                <th>Привлечение</th>
                <th>Продажа</th>
                <th>Развитие</th>
              </thead>
              <tbody class="fs-5">
                <tr>
                  <td>10 %</td>
                  <td>5 %</td>
                  <td>10 %</td>
                </tr>
                <tr style="font-size: .8rem !important;">
                <td colspan="3">от общей стоимости</td>
                </tr>
              </tbody>
            </table>
          </div>          
        </div> 
      </div>


      </div>
    </div>

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
                    @if (auth()->user()->role == 'admin')
                      <th scope="col">Доход компании</th>
                    @endif                    
                    <th scope="col"></th>
                </tr>
                </thead>

                <tbody class="fw-light text-center">
                  @php 
                    $total = 0; $totalattr = 0; $totalattrup = 0; $totalsell = 0; $totalsellup = 0; $totaldirect = 0; $totalfirmearning=0;
                    $number = 1;                    
                  @endphp

                  @foreach($data as $el)
                      <tr>
                          <td>{{$number}}</td>
                          <td>{{$el -> created_at}}</td>
                          <td scope="row">{{$el -> client}}</td>
                          <td>{{$el -> serviceFunc -> name}}</td>
                          <td class="text-center">{{$el -> serviceFunc -> price}}</td>                          
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
                          @if (auth()->user()->role == 'admin')
                            <th scope="col">{{$el -> firmearning}}</th>
                          @endif   
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
                        $totaldirect = $totaldirect + ($el -> DeveloperSalary); $totalfirmearning = $totalfirmearning + ($el -> firmearning);   
                      @endphp


                  @endforeach
                  <tfoot class="border-top">
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td class="fw-bold text-center">{{$totalattr}} + {{$totalattrup}}</td>
                      <td></td>
                      <td class="fw-bold text-center">{{$totalsell}} + {{$totalsellup}}</td>
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
                      <td class="fw-bold text-center">{{$total}}</td>
                      <td></td>
                      <td></td>
                      @php
                      $totalattrall = $totalattr + $totalattrup; $totalsellrall = $totalsell + $totalsellup;
                      @endphp
                      <td class="fw-bold text-center">{{$totalattrall}}</td>
                      <td></td>
                      <td class="fw-bold text-center">{{$totalsellrall}}</td>
                      <td></td>
                      <td class="fw-bold text-center">{{$totaldirect}}</td>
                                      @if (auth()->user()->role == 'admin')
                                      <td class="fw-bold text-center">{{$totalfirmearning}}</td>
                                      @endif    
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
