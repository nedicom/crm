<div class="my-3 d-inline-block shadow m-1 taskcard" onmousedown="mouseDown(this.id)" onmouseup="mouseUp(this.id)" id="{{$el -> id}}" style="width: 20rem;">
    <div class="card border-light">
        <div class="task-header px-4 pt-4 d-flex justify-content-between">
            <p>                
                <i class="bi bi-calendar"></i>
                <span> {{$el['date']['currentDay']}}</span>
                <span> {{$el['date']['currentMonth']}}</span>                
                <span> {{$el['date']['currentTime']}}</span>
            </p>
            <p id="status{{$el -> id}}"> 
                {{$el -> status}}
            </p>
            
        </div>
        <div class="card-body task-content">
        <div class="progress" style="height: 2px; ">
            <div class="progress-bar" role="progressbar" aria-label="Example 1px high" 
            @if($el -> status == 'ожидает')
            style="width: 50%;">
            @elseif($el -> status == 'в работе') 
            style="width: 75%;">
            @elseif($el -> status == 'просрочена') 
            style="width: 25%;">
            @elseif($el -> status == 'выполнена') 
            style="width: 100%;">
            @endif
            </div>
        </div>

            <div class="px-4 pt-3 d-flex justify-content-between">                
                <p class="">                    
                    <span class="">{{$el -> duration}} </span><i class="bi bi-stopwatch"></i>
                </p>
                <p class="">
                    
                              
                </p>
                <p class="text-truncate">
                    @foreach($datalawyers as $ellawyer)
                    @if ($ellawyer -> id == $el -> lawyer)  {{$ellawyer -> name}} @endif
                    @endforeach
                </p>
            </div>
            <p class="px-4 py-2 text-truncate"><strong>{{$el -> name}}</strong></p>
            <p class="px-4 text-truncate">{{$el -> client}}</p>

            <div class="mt-3 row d-flex justify-content-center">
            @if($el -> hrftodcm)
                <div class="col-4 mb-3">
                <a href="{{$el -> hrftodcm}}"class="btn btn-light w-100" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="Blue" class="bi bi-hdd" viewBox="0 0 16 16">
                        <path d="M4.5 11a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zM3 10.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"></path>
                        <path d="M16 11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V9.51c0-.418.105-.83.305-1.197l2.472-4.531A1.5 1.5 0 0 1 4.094 3h7.812a1.5 1.5 0 0 1 1.317.782l2.472 4.53c.2.368.305.78.305 1.198V11zM3.655 4.26 1.592 8.043C1.724 8.014 1.86 8 2 8h12c.14 0 .276.014.408.042L12.345 4.26a.5.5 0 0 0-.439-.26H4.094a.5.5 0 0 0-.44.26zM1 10v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1z"></path>
                    </svg>
                    </a> 
                </div>
            @endif   
                <div class="col-4 mb-3">
                <a class="btn btn-light w-100" href="{{ route ('showTaskById', $el->id) }}">
                <i class="bi-three-dots"></i></a>
                </div>
          `</div>
        </div>
    </div>
</div>