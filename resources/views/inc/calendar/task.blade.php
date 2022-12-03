  <div class="d-inline-block shadow-sm m-1 taskcard" onmousedown="mouseDown(this.id)" onmouseup="mouseUp(this.id)" 
  date="{{$el['date']['value']}}" id="{{$el -> id}}" style="width: 100%; max-width:140px;">
      <div id="card{{$el -> id}}">
          <div class="task-header d-flex justify-content-between align-items-center"> 
        
                  <span>
                    @foreach($datalawyers as $ellawyer)
                    @if ($ellawyer -> id == $el -> lawyer)  
                    <a class="w-100" href="{{ route ('showTaskById', $el->id) }}">
                      <img src="{{$ellawyer -> avatar}}" style="width: 20px;" class="rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="исполнитель">
                    </a>
                      @endif
                    @endforeach
                  </span>    
                  <div style="font-size: 12px;" class=" text-truncate text-center" tabindex="0" data-bs-toggle="popover" 
                    data-bs-trigger="hover focus" title="{{$el -> name}}" data-bs-content="{{$el -> client}} - {{$el -> description}}">
                    <strong>{{$el -> name}}</strong>
                  </div>
                  <span  style="position:relative; right:-10px;">
                      <i class="bi bi-tag-fill" id="tagspan{{$el -> id}}" style="color:  
                      @if($el -> tag == 'неважно') LightGray
                      @elseif($el -> tag == 'перенос') Aquamarine
                      @elseif($el -> tag == 'срочно') Red
                      @elseif($el -> tag == 'приоритет') BlueViolet
                      @else Black
                      @endif                
                      ;"></i>
                   </span> 
          </div>                  
      </div>
</div>

