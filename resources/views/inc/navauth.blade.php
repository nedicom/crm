<div class="col-10 p-3 shadow-sm">
    <header class="d-flex justify-content-evenly">

      <ul class="nav nav-pills">
        <li class="nav-item"><a href="{{route('leads')}}" class="nav-link {{ (request()->is('leads*')) ? 'active' : '' }}">Лиды</a></li>
        
        <li class="nav-item btn-group dropdown">          
          <a href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false"
          class="nav-link dropdown-toggle {{ (request()->is('clients*')) ? 'active' : '' }} {{ (request()->is('dogovor*')) ? 'active' : '' }}">Клиенты</a>

          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('clients')}}">Все клиенты</a></li>
            <li><a class="dropdown-item" href="{{route('dogovor')}}">Договоры</a></li>
          </ul>      
        </li>


        <li class="nav-item"><a href="{{route('tasks')}}" class="nav-link {{ (request()->is('tasks*')) ? 'active' : '' }}">Задачи</a></li>
        <li class="nav-item"><a href="{{route('meetings')}}" class="nav-link {{ (request()->is('meetings*')) ? 'active' : '' }}">Заседания</a></li>
        <li class="nav-item"><a href="{{route('showservices')}}" class="nav-link {{ (request()->is('services*')) ? 'active' : '' }}">Услуги</a></li>
        <li class="nav-item"><a href="{{route('payments')}}" class="nav-link {{ (request()->is('payments*')) ? 'active' : '' }}">Платежи</a></li>
        <li class="nav-item"><a href="{{route('lawyers')}}" class="nav-link {{ (request()->is('lawyers*')) ? 'active' : '' }}">Юристы</a></li>
      </ul>

      <ul class="nav nav-pills ">
        <li class="nav-item"><a href="\" class="nav-link {{(request()->is('home*')) ? 'active' : '' }}">{{ Auth::user()->name }}</a>            
        </li>
        <img src="{{ Auth::user()->avatar }}" style="width: 40px; height:40px" class="mx-5 rounded-circle" alt="...">
         <li class="nav-item"><a href="{{ route('logout') }}"  class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a></li>
      </ul>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>

    </header>
</div>
