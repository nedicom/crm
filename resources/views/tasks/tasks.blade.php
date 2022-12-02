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
    <h2 class="px-3">Задачи</h2>
{{-- start filter meetings--}}
  <div class = "row p-4">

      <form class = "row" action="" method="GET">

        <div class="col-8 d-flex justify-content-evenly">
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
          $weekMap = [0 => 'Понедельник', 1 => 'Вторник', 2 => 'Среда', 3 => 'Четерг', 4 => 'Пятница', 5 => 'Суббота', 6 => 'Воскресенье']
        @endphp




       @if (app('request')->input('calendar') == '')        
        <div class="row">

        <div class="col-3 columncard text-center" id="timeleft">
            <h5 class="page-title">просрочена</h5>
            @foreach($data as $el)
              @if($el -> status == "просрочена")
                @include('tasks.taskcard')
              @endif
            @endforeach
          </div>  

          <div class="col-3 columncard text-center" id="waiting">
            <h5 class="page-title">ожидает</h5>
            @foreach($data as $el)
              @if($el -> status == "ожидает")
                @include('tasks.taskcard')
              @endif
            @endforeach
          </div>


 

          <div class="col-3 columncard text-center" id="inwork">
            <h5 class="page-title">в работе</h5>
            @foreach($data as $el)
              @if($el -> status == "в работе")
                @include('tasks.taskcard')
              @endif
            @endforeach
          </div>     

          <div class="col-3 columncard text-center" id="finished">
              <h5 class="page-title">выполнена</h5>
              @foreach($data as $el)
                @if($el -> status == "выполнена")
                  @include('tasks.taskcard')
                @endif
              @endforeach            
          </div>

        </div>
      @endif




        @if (app('request')->input('calendar') == 'week')
        <h2 class="">Неделя</h2>
          @for ($i = 0; $i < 7; $i++)
            <div class="col my-3" style="max-width: 14%;">
            <h1 class="badge bg-secondary">{{$weekMap[$i];}}</h1>
              @foreach($data as $el)
                @if($el['date']['day'] == $weekMap[$i])
                  @include('inc.calendar.task')
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
          @for ($i = 1; $i <= (cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'))); $i++)
            <div class="my-3 col" style="min-width: 14%; max-width: 15%; min-height: 100px">
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
            $( function() {
                $( ".columncard" ).sortable({
                  connectWith: ".columncard",
                  handle: ".task-header",
                  cancel: ".task-toggle",
                  placeholder: "task-placeholder ui-corner-all",
                  opacity: 0.5,
                  receive: function(event, ui) {
                    var status =  this.id;
                    var id =  ui.item.attr("id");
                    $.ajax({
                      method:"POST",
                      url: "{{ route('setstatus') }}",
                      data: { id: id, status: status, _token: '{{csrf_token()}}' },
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
           </script>

         <script>
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
