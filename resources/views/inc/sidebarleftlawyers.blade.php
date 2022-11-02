  <div class="col-3 shadow-lg p-3 mb-5 bg-body rounded">
    <div class ="text-center container col-md-9">
      <h2>Добавить юриста</h2>
      <form action="{{route('add-lawyer')}}" method="post">
        @csrf

        <div class="form-group mb-3">
          <label for="name">Введите Имя</label>
          <input type = "text" name="name" placeholder="Иван Васильевич" id="name" class="form-control">
        </div>

        <div class="form-group mb-3">
          <label for="phone">Введите телефон</label>
          <input type = "phone" name="phone" placeholder="+7" id="phone" class="form-control">
        </div>

        <div class="form-group mb-3">
          <label for="email">Введите  email</label>
          <input type = "email" name="email" placeholder="yandex@yandex.ru" id="email" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>

      </form>
    </div>
  </div>
