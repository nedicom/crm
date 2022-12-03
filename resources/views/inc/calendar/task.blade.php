@if (app('request')->input('calendar') == 'month')
    <div>
      <a class="" href="{{ route ('showTaskById', $el->id) }}">
        <p class="badge bg-primary text-truncate">{{$el -> name}}</p>
      </a>
    </div>
  @endif


