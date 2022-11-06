<script>
  $(document).ready(function(){

   $('#client').keyup(function(){
          var query = $(this).val();
          var quantity = $(this).val().length;
          if(quantity > 2)
          {
           var _token = $('input[name="_token"]').val();
           $.ajax({
            url:"{{ route('getclient') }}",
            method:"POST",
            data:{query:query, _token:_token},
            success:function(data){
             $('#clientList').fadeIn();
                      $('#clientList').html(data);
            }
           });
          }
      });

      $(document).on('click', '#clientAJAX', function(){
          $('#client').val($(this).text());
          $('#clientList').fadeOut();
      });

  });

  </script>

  <div class="modal fade" id="editpaymentModal">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class ="modal-header">
          <h2>Редактировать платеж</h2>
        </div>

        <div class ="modal-body">
      <form action="{{route('PaymentUpdateSubmit', $data -> id)}}" method="post" autocomplete="off">
        @csrf
        <label for="summ" class="form-label">Введите сумму</label>
        <div class="input-group mb-3">
              <span class="input-group-text">ru</span>
                <input type = "number" step=500 name="summ" placeholder="" id="summ" class="form-control" value='{{$data->summ}}' required>
              <span class="input-group-text">.00</span>
          </div>

        <div class="form-group mb-3">
          <label for="client">Укажите клиента</label>
          <input type = "text" name="client" placeholder="" id="client" value='{{$data->client}}' class="form-control">
          <div id="clientList">
            </div>
        </div>

        <div class="form-group mb-3">
          <label for="service">Укажите услугу</label>
          <select class="form-select" name="service" id="service" class="form-control">
                @foreach($dataservices as $el)
                  <option value="{{$el -> id}}" @if ($data->service == $el -> id) selected @endif>{{$el -> name}}</option>
                @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="nameOfAttractioner">Укажите кто привлек клиента</label>
          <select class="form-select" name="nameOfAttractioner" id="nameOfAttractioner" class="form-control">
                @foreach($datalawyers as $el)
                  <option value="{{$el -> id}}" @if ($data->nameOfAttractioner == $el -> id) selected @endif>{{$el -> name}}</option>
                @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="nameOfSeller">Укажите кто продал услугу</label>
          <select class="form-select" name="nameOfSeller" id="nameOfSeller" class="form-control">
                @foreach($datalawyers as $el)
                  <option value="{{$el -> id}}"  @if ($data->nameOfSeller == $el -> id) selected @endif>{{$el -> name}}</option>
                @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="directionDevelopment">Укажите кто развивал направление</label>
          <select class="form-select" name="directionDevelopment" id="directionDevelopment" class="form-control">
                @foreach($datalawyers as $el)
                  <option value="{{$el -> id}}"  @if ($data->directionDevelopment == $el -> id) selected @endif>{{$el -> name}}</option>
                @endforeach
          </select>
        </div>

        <div class="form-group mb-3">
          <label for="calculation">Куда поступили деньги</label>
          <select class="form-select" name="calculation" id="calculation" aria-label="Default select example">
            <option value="РНКБ" @if ($data->calculation == "РНКБ") selected @endif>РНКБ</option>
            <option value="СБЕР" @if ($data->calculation == "СБЕР") selected @endif>СБЕР</option>
            <option value="ГЕНБАНК" @if ($data->calculation == "ГЕНБАНК") selected @endif>ГЕНБАНК</option>
            <option value="НАЛИЧНЫЕ" @if ($data->calculation == "НАЛИЧНЫЕ") selected @endif>НАЛИЧНЫЕ</option>
          </select>
        </div>

        <button type="submit" id='submit' class="btn btn-primary">Обновить</button>
      </form>
    </div>

    </div>
  </div>
</div>
