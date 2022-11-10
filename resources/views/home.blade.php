  @extends('layouts.app')

  @section('head')
  @endsection

  @section('title')
    Главная
  @endsection

  @section('leftmenuone')
    <li class="nav-item text-center p-3">
      <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#taskModal">ссылка меню</a>
    </li>
    <li class="nav-item text-center p-3">
      <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#taskModal">еще одна ссылка</a>
  @endsection

  @section('main')
   <div class = "row p-5">

   <div class = "row">
       <div class="card mx-3" style="width: 18rem;">
         <div class="card-body">
          <div class = "d-flex justify-content-between align-items-center mb-3">
             <span class="fs-4">
               Клиенты
             </span>
             <span >
               <a class="btn btn-light" href="/clients">
               <i class="bi-three-dots"></i></a>
             </span>
           </div>

           <div class="d-flex align-items-center text-center">
               <div class="col-4"><i class="bi bi-people " style="font-size: 3rem; color: cornflowerblue;"></i></div>

               <div class="col-4 d-flex flex-column justify-content-center">
                 <h6 class="card-subtitle mb-2 text-muted">всего</h6>
                 <div class="fs-2 mx-3">{{$data['clients']}}</div>

               </div>
               <div class="col-4 d-flex flex-column justify-content-center">
                 <h6 class="card-subtitle mb-2 text-muted">ноябрь</h6>
                 <div class="fs-2 mx-3">{{$data['clients']}}</div>
               </div>

           </div>
         </div>
       </div>


       <div class="card mx-3" style="width: 18rem;">
         <div class="card-body">
          <div class = "d-flex justify-content-between align-items-center mb-3">
             <span class="fs-4">
               Лиды
             </span>
             <span >
               <a class="btn btn-light" href="/leads">
               <i class="bi-three-dots"></i></a>
             </span>
           </div>

           <div class="d-flex align-items-center text-center">
               <div class="col-4"><i class="bi bi-person-plus" style="font-size: 3rem; color: green;"></i></div>

               <div class="col-4 d-flex flex-column justify-content-center">
                 <h6 class="card-subtitle mb-2 text-muted">всего</h6>
                 <div class="fs-2 mx-3">{{$data['leads']}}</div>

               </div>
               <div class="col-4 d-flex flex-column justify-content-center">
                 <h6 class="card-subtitle mb-2 text-muted">ноябрь</h6>
                 <div class="fs-2 mx-3">{{$data['leads']}}</div>
               </div>

           </div>
         </div>
       </div>


       <div class="card mx-3" style="width: 18rem;">
         <div class="card-body">
          <div class = "d-flex justify-content-between align-items-center mb-3">
             <span class="fs-4">
               Заседания
             </span>
             <span >
               <a class="btn btn-light" href="/meetings">
               <i class="bi-three-dots"></i></a>
             </span>
           </div>

           <div class="d-flex align-items-center text-center">
               <div class="col-4"><i class="bi bi-cursor" style="font-size: 3rem; color: Coral;"></i></div>

               <div class="col-4 d-flex flex-column justify-content-center">
                 <h6 class="card-subtitle mb-2 text-muted">всего</h6>
                 <div class="fs-2 mx-3">{{$data['meeting']}}</div>

               </div>
               <div class="col-4 d-flex flex-column justify-content-center">
                 <h6 class="card-subtitle mb-2 text-muted">ноябрь</h6>
                 <div class="fs-2 mx-3">{{$data['meeting']}}</div>
               </div>

           </div>
         </div>
       </div>


       <div class="card mx-3" style="width: 18rem;">
         <div class="card-body">
          <div class = "d-flex justify-content-between align-items-center mb-3">
             <span class="fs-4">
               Задачи
             </span>
             <span >
               <a class="btn btn-light" href="/tasks">
               <i class="bi-three-dots"></i></a>
             </span>
           </div>

           <div class="d-flex align-items-center text-center">
               <div class="col-4"><i class="bi bi-list-task " style="font-size: 3rem; color: indigo;"></i></div>

               <div class="col-4 d-flex flex-column justify-content-center">
                 <h6 class="card-subtitle mb-2 text-muted">всего</h6>
                 <div class="fs-2 mx-3">{{$data['tasks']}}</div>

               </div>
               <div class="col-4 d-flex flex-column justify-content-center">
                 <h6 class="card-subtitle mb-2 text-muted">ноябрь</h6>
                 <div class="fs-2 mx-3">{{$data['tasks']}}</div>
               </div>

           </div>
         </div>
       </div>
     </div>


     <div class = "row">
         <div class="card m-3 pb-5 w-75">
           <div class="card-body">
            <div class = "d-flex justify-content-between align-items-center mb-3">
               <span class="fs-4">
                 Доходы
               </span>
               <span >
                 <a class="btn btn-light" href="/payments">
                 <i class="bi-three-dots"></i></a>
               </span>
             </div>

             <div class="d-flex align-items-center">
                 <div class="col-3 text-left"><i class="bi bi-list-task " style="font-size: 3rem; color: indigo;"></i></div>

             <div class="col-9 d-flex justify-content-center text-center">
                 <div class="col d-flex flex-column justify-content-center">
                   <h6 class="card-subtitle mb-2 text-muted">привлек + превышение</h6>
                   <div class="fs-2 mx-3">{{$data['paymentsattr']}} + {{$data['paymentsmodifyattr']}}</div>
                 </div>

                 <div class="col d-flex flex-column justify-content-center">
                   <h6 class="card-subtitle mb-2 text-muted">продал  + превышение</h6>
                   <div class="fs-2 mx-3">{{$data['paymentsseller']}} + {{$data['paymentsmodifyseller']}}</div>
                 </div>

                 <div class="col d-flex flex-column justify-content-center">
                   <h6 class="card-subtitle mb-2 text-muted">развил направление</h6>
                   <div class="fs-2 mx-3">{{$data['paymentsdev']}}</div>
                 </div>
             </div>

             </div>
           </div>
         </div>
      </div>


   </div>
  @endsection
