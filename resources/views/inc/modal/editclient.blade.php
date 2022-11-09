<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class ="modal-header">
          <h2>Редактировать клиента</h2>
        </div>

        <div class ="modal-body">
      <form action="{{route('Client-Update-Submit', $data -> id)}}" method="post">
        @csrf
        <div class="form-group mb-3">
          <label for="name">Введите Имя</label>
          <input type = "text" name="name" placeholder="Иван Васильевич" id="name" value='{{$data->name}}' class="form-control">
        </div>
        <div class="form-group mb-3">
          <label for="phone">Введите телефон</label>
          <input type = "phone" name="phone" placeholder="+7" id="phone" value='{{$data->phone}}' class="form-control">
        </div>
        <div class="form-group mb-3">
          <label for="phone">Введите email</label>
          <input type = "email" name="email" placeholder="ivanov@yandex.ru" id="email" value='{{$data->email}}' class="form-control">
        </div>
        <div class="form-group mb-3">
          <select class="form-select" name="source" id="source" aria-label="Default select example">
            <option value="Не знаю источник" @if($data->source == "Не знаю источник") selected @endif>Не знаю источник</option>
            <option value="сайт" @if($data->source == "сайт") selected @endif>Сайт</option>
            <option value="Рекомендация" @if($data->source == "Рекомендация") selected @endif>Рекомендация</option>
            <option value="С улицы" @if($data->source == "С улицы") selected @endif>С улицы</option>
          </select>
        </div>
        <div class="form-group mb-3">
          <label for="lawyer">Укажите юриста</label>
          <select class="form-select" name="lawyer" id="lawyer">
            @foreach($datalawyers as $el)
              <option value="{{$el -> id}}"  @if ($data->lawyer == $el -> id) selected @endif>{{$el -> name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" id="status" value="1" @if (($data -> status) == 1) checked @else @endif>
          <label class="form-check-label" for="flexSwitchCheckDefault">В работе</label>
        </div>
        <button type="submit" class="btn btn-primary">Обновить</button>
      </form>
    </div>

    </div>
  </div>
</div>
