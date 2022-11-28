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
          <label for="name">Введите Имя <span class="text-danger">*</span></label>
          <input type = "text" name="name" placeholder="Иван Васильевич" id="name" value='{{$data->name}}' class="form-control" required>
        </div>
        <div class="form-group mb-3">
          <label for="phone">Введите телефон <span class="text-danger">*</span></label>
          <input type = "phone" name="phone" placeholder="+7" id="phone" value='{{$data->phone}}' class="form-control" required>
        </div>
        <div class="form-group mb-3">
          <label for="address">Введите адрес</label>
          <input type = "text" name="address" placeholder="295000, Симферополь, ул. Кирова, 15" value='{{$data->address}}' id="address" class="form-control">
        </div>
        <div class="form-group mb-3">
          <label for="phone">Введите email</label>
          <input type = "email" name="email" placeholder="ivanov@yandex.ru" id="email" value='{{$data->email}}' class="form-control">
        </div>

        <div class="form-group mb-3">
          <label for="source">Укажите источник</label>
          <select class="form-select" name="source" id="source" class="form-control">
                @foreach($datasource as $el)
                  <option value="{{$el -> name}}"
                     @if($data->source == $el -> name) selected @endif
                     >{{$el -> name}}</option>
                @endforeach
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
