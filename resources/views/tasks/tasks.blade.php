@extends('layouts.app')

@section('head')
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>

<style>
  .task-toggle {
    position: absolute;
    top: 50%;
    right: 0;
    margin-top: -8px;
  }
  .task-content {
    padding: 0.4em;
  }
  .task-placeholder {
    border: 1px dotted black;
    margin: 0 1em 1em 0;
    height: 50px;
  }
  
  </style>
@endsection

@section('title')
  Задачи
@endsection

@section('leftmenuone')
  <li class="nav-item text-center p-3">
    <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#taskModal">Добавить задачу</a>
  </li>
@endsection

@section('main')

{{-- start filter meetings--}}
  <div class = "row">

      <form class = "row" action="" method="GET">
        <h2 class="col-2 px-3">Задачи</h2>
        <div class="col-8 d-flex justify-content-evenly">
          <div class="">  
            <a href="{{route('tasks')}}?checkedlawyer={{ Auth::user()->id}}" class="btn btn-outline-primary">все мои задачи</a>
          </div>  

          <div class="">          
            <input type="radio" class="btn-check" value="day" name="calendar" id="day"
              @if (app('request')->input('calendar') == 'day') checked @endif
              onchange="this.form.submit()">
            <label class="btn btn-outline-success" for="day">День</label>
            <input type="radio" class="btn-check" value="week" name="calendar" id="week"
              @if (app('request')->input('calendar') == 'week') checked @endif
              onchange="this.form.submit()">
            <label class="btn btn-outline-success" for="week">Неделя</label>
            <input type="radio" class="btn-check" value="month" name="calendar" id="month"
              @if (app('request')->input('calendar') == 'month') checked @endif
              onchange="this.form.submit()">
            <label class="btn btn-outline-success" for="month">Месяц</label>
          </div>

            <div class="">
              <select class="form-select" name="checkedlawyer" id="checkedlawyer">
                <option value=''>не выбрано</option>
                    @foreach($datalawyers as $el)
                      <option value="{{$el -> id}}" @if (($el -> id) == (app('request')->input('checkedlawyer'))) selected @endif>
                        {{$el -> name}}
                      </option>
                    @endforeach
              </select>
            </div>

            <div class="">
              <button type="submit" class="btn btn-primary">Применить</button>
              <a href='tasks' class='button btn btn-secondary'>Сбросить</a>
            </div>
        </div>
      </form>
  </div>
  {{-- end filter meetings--}}




  {{-- start views for all meetings--}}
      <div class="row" id="taskarea">

        @php
          $weekMap = [1 => 'Понедельник', 2 => 'Вторник', 3 => 'Среда', 4 => 'Четерг', 5 => 'Пятница', 6 => 'Суббота', 7 => 'Воскресенье'];
        @endphp




       @if (app('request')->input('calendar') == '')        
        <div class="row pt-4">

        <div class="col-3 columncard text-center" id="timeleft">
            <h5 class="page-title" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Сюда попадают просроченные задачи каждый день в 8.00 утра">просрочка</h5>
            @foreach($data as $el)
              @if($el -> status == "просрочена")
                @include('tasks.taskcard')
              @endif
            @endforeach
          </div>  

          <div class="col-3 columncard text-center" id="waiting">
            <h5 class="page-title" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Тут задачи которые Вам поставили, но не принятые в работу">ожидает</h5>
            @foreach($data as $el)
              @if($el -> status == "ожидает")
                @include('tasks.taskcard')
              @endif
            @endforeach
          </div>


 

          <div class="col-3 columncard text-center" id="inwork">
            <h5 class="page-title" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Здесь задачи с которыми вы работаете сейчас. Позже будет учитываться время потраченное на выполнение">в работе</h5>
            @foreach($data as $el)
              @if($el -> status == "в работе")
                @include('tasks.taskcard')
              @endif
            @endforeach
          </div>     

          <div class="col-3 columncard text-center" id="finished">
              <h5 class="page-title" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Каждый день в 00.00 выполненные задачи будут пропадать из списка">выполнена</h5>
              @foreach($data as $el)
                @if(($el -> status == "выполнена") && ($el -> donetime > Carbon\Carbon::today()))
                  @include('tasks.taskcard')
                @endif
              @endforeach            
          </div>

        </div>
      @endif

        @if (app('request')->input('calendar') == 'week')
        <h2 class="">Неделя</h2>
        @for ($i = 1; $i < 6; $i++)  
        <div style="width: 20%;"> 
          <h1 class="badge bg-secondary">{{$weekMap[$i]}}</h1>
        </div>
        @endfor
          @for ($i = 1; $i < 6; $i++)           
            <div class="my-3 columncard" style="font-size:12px; width: 20%;" dayofweek="{{$i}}"> 
              @foreach($data as $el)              
                @if($el['date']['day'] == $weekMap[$i])
                  @include('tasks.taskcard')                  
                @endif
              @endforeach
            </div>
         
          @endfor
        @endif

        @if (app('request')->input('calendar') == 'day')
        <h2 class="">Сегодня</h2>
            @foreach($data as $el)
            <div class="col-2 my-3">
                @include('inc.calendar.task')
            </div>
            @endforeach
        @endif





        @if (app('request')->input('calendar') == 'month')
          <h2 class="">Месяц</h2>
          @for ($i = 1; $i < 8; $i++)  
          <div style="width: 14%;"> 
            <h1 class="badge bg-secondary">{{$weekMap[$i]}}</h1>
          </div>
          @endfor
          @php 
            $time = mktime(0, 0, 0, date('n'), 1, date('Y'));
            $firstday = (date('w', $time) + 6) % 7; //воскресенье сделаем 7-м днем, а не первым
            $daycount = date('t', $time);
          @endphp
          @for ($i = 0; $i < $firstday; $i++)
            <div class="my-3 col" style="min-width: 14%; max-width: 15%; min-height: 100px"></div>
          @endfor

          @for ($i = 1; $i <= (cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'))); $i++)
            <div class="my-3 col columncard" style="min-width: 14%; max-width: 15%; min-height: 100px" dayofmonth="{{$i}}">
            
              {{$i}}
                @foreach($data as $el)                
                  @if($el['date']['currentDay'] == $i)
                   @include('inc.calendar.task') 
                  @endif
              @endforeach
            </div>
          @endfor
        @endif





      </div>
  {{-- end views for all meetings--}}

          <script>
          function mouseDown(clicked_id) {
            document.getElementById(clicked_id).style.border = "solid 1px #FF1493";
            document.getElementById('status'+clicked_id).innerHTML = "изменен"; 
          }

          function mouseUp(clicked_id) {
            document.getElementById(clicked_id).style.border = "";
          }
          </script>
 






          <script> 
          $( document ).ready(function() { 
            $( function() {
                $( ".columncard" ).sortable({
                  connectWith: ".columncard",
                  handle: ".task-header",
                  cancel: ".task-toggle",
                  placeholder: "task-placeholder ui-corner-all",
                  opacity: 0.5,
                  receive: function(event, ui) { 
                    var id =  ui.item.attr("id");

                    if(this.id){var status =  this.id;}
                    else{var status = 0;};

                    $input = $( this );
                    if($input.attr( "dayofweek" )){var dayofweek =  $input.attr( "dayofweek" );}
                    else{var dayofweek = 0;};
                    if(ui.item.attr("date")){var date =  ui.item.attr("date");}
                    else{var date = 0;};                                 
                    
                    if($input.attr( "dayofmonth" )){var dayofmonth =  $input.attr( "dayofmonth" );}
                    else{var dayofmonth = 0;};
                    
                    $.ajax({
                      method:"POST",
                      url: "{{ route('setstatus') }}",
                      data: { id: id, status: status, date: date, dayofweek: dayofweek, dayofmonth: dayofmonth, _token: '{{csrf_token()}}' },
                      success: function(data) {
                      }                  
                    });
                  } 
                });
            
                $( ".taskcard" )
                  .addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
                  .find( ".task-header" )
                    .addClass( "ui-widget-header ui-corner-all" )
                    .prepend( "<span class='ui-icon ui-icon-minusthick task-toggle'></span>");
                 
                $( ".task-toggle" ).on( "click", function() {
                  var icon = $( this );                  
                  icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
                  icon.closest( ".taskcard" ).find( ".task-content" ).toggle();    
                });
              });
           });
           </script>






         <script>
          var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
          var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
          })

          const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
          const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        </script>

        <script>
            $( document ).ready(function() {   
                $( ".changetags" ).click(function() {
                        var $input = $( this );  
                        var id =  $input.attr( "tagName" )
                        var color =  $input.attr( "color" )
                        var value =  this.value;  
                        $('#tagspan'+id).css("color", color); 
                            $.ajax({
                            url:"{{ route('tag') }}",
                            method:"POST",
                            data: { id: id, value: value, _token: '{{csrf_token()}}' },
                              success:function(data){                              
                              }                            
                            });   
                  });
                });
        </script>




  @include('inc/modal/addtask')

@endsection
