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
                <p class="text-truncate">
                    <i class="bi bi-stopwatch"></i>
                    <span class="badge rounded-pill text-bg-primary">{{$el -> duration}}</span>
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
                <div class="col-4 mb-3">
                <a class="btn btn-light w-100" href="{{ route ('showTaskById', $el->id) }}">
                <i class="bi-three-dots"></i></a>
                </div>
          `</div>
        </div>
    </div>
</div>