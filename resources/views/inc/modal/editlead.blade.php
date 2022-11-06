  <div class="modal fade" id="editleadModal">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class ="modal-header">
            <h2>Редактировать лид</h2>
          </div>

          <div class ="modal-body d-flex justify-content-center">

          <div class ="col-10">
            <form action="{{route('LeadUpdateSubmit', $data -> id)}}" class='' autocomplete="off" method="post">
              @csrf

              <div class="form-group mb-3">
                <label for="name">Введите ФИО</label>
                <input type = "text" name="name" id="name" value='{{$data->name}}' class="form-control" required>
              </div>

              <div class="form-group mb-3">
                <label for="phone">Введите телефон</label>
                <input type = "phone" name="phone" placeholder="+7" id="phone" value='{{$data->phone}}' class="form-control">
              </div>

              <div class="form-group mb-3">
                <label for="description">Описание проблемы</label>
                <textarea rows="3" name="description" placeholder="Не увольняют военнослужащего" id="phone" class="form-control" required>{{$data->description}}</textarea>
              </div>

              <div class="form-group mb-3">
                <label for="source">Укажите источник</label>
                <select class="form-select" name="source" id="source" aria-label="Default select example">
                  <option value="Не знаю источник" @if($data->source == "Не знаю источник") selected @endif>Не знаю источник</option>
                  <option value="сайт" @if($data->source == "сайт") selected @endif>Сайт</option>
                  <option value="Рекомендация" @if($data->source == "Рекомендация") selected @endif>Рекомендация</option>
                  <option value="С улицы" @if($data->source == "С улицы") selected @endif>С улицы</option>
                </select>
              </div>

              <div class="form-group mb-3">
                <label for="service">Что можно предложить</label>
                <select class="form-select" name="service" id="service" class="form-control">
                      @foreach($dataservices as $el)
                        <option value="{{$el -> id}}" @if($data->service == $el -> id) selected @endif>{{$el -> name}}</option>
                      @endforeach
                </select>
              </div>

              <div class="form-group mb-3">
                <label for="lawyer">Укажите кто привлек лид</label>
                <select class="form-select" name="lawyer" id="lawyer" class="form-control">
                      @foreach($datalawyers as $el)
                        <option value="{{$el -> id}}"  @if($data->lawyer == $el -> id) selected @endif>{{$el -> name}}</option>
                      @endforeach
                </select>
              </div>

              <div class="form-group mb-3">
                <label for="responsible">Укажите кто ответсвенный за лид</label>
                <select class="form-select" name="responsible" id="responsible" class="form-control">
                      @foreach($datalawyers as $el)
                        <option value="{{$el -> id}}" @if($data->responsible == $el -> id) selected @endif>{{$el -> name}}</option>
                      @endforeach
                </select>
              </div>

              <button type="submit" id='submit' class="btn btn-primary">Сохранить</button>
            </form>
          </div>
        </div>

        </div>
      </div>
    </div>
