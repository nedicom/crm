  {{-- start ajax payments--}}

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

        $(document).on('click', '.clientList', function(){
            $('#client').val($(this).text());
            $('#clientList').fadeOut();
        });

    });


        </script>

  {{-- end ajax payments--}}


  <div class="modal fade" id="paymentModal">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class ="modal-header">
            <h2>Добавить платеж</h2>
          </div>

          <div class ="modal-body d-flex justify-content-center">

          <div class ="col-10">
            <form action="{{route('addpayment')}}" class='' autocomplete="off" method="post">
              @csrf


              <label for="summ" class="form-label">Введите сумму</label>
              <div class="input-group mb-3">
                    <span class="input-group-text">ru</span>
                      <input type = "text" name="summ" placeholder="" id="summ" class="form-control" value='' required>
                    <span class="input-group-text">.00</span>
                </div>

              <div class="form-group mb-3">
                <label for="client">Укажите клиента</label>
                <input type = "text" name="client" id="client" class="form-control">
                <div id="clientList">
                </div>
              </div>

              <div class="form-group mb-3">
                <label for="service">Укажите услугу</label>
                <select class="form-select" name="service" id="service" class="form-control">
                      @foreach($dataservices as $el)
                        <option value="{{$el -> id}}">{{$el -> name}}</option>
                      @endforeach
                </select>
              </div>

              <div class="form-group mb-3">
                <label for="nameOfAttractioner">Укажите кто привлек клиента</label>
                <select class="form-select" name="nameOfAttractioner" id="nameOfAttractioner" class="form-control">
                      @foreach($datalawyers as $el)
                        <option value="{{$el -> id}}">{{$el -> name}}</option>
                      @endforeach
                </select>
              </div>


              <div class="form-group mb-3">
                <label for="nameOfSeller">Укажите кто продал услугу</label>
                <select class="form-select" name="nameOfSeller" id="nameOfSeller" class="form-control">
                      @foreach($datalawyers as $el)
                        <option value="{{$el -> id}}">{{$el -> name}}</option>
                      @endforeach
                </select>
              </div>

              <div class="form-group mb-3">
                <label for="directionDevelopment">Укажите кто развивал направление</label>
                <select class="form-select" name="directionDevelopment" id="directionDevelopment" class="form-control">
                      @foreach($datalawyers as $el)
                        <option value="{{$el -> id}}">{{$el -> name}}</option>
                      @endforeach
                </select>
              </div>

              <div class="form-group mb-3">
                <label for="calculation">Куда поступили деньги</label>
                <select class="form-select" name="calculation" id="calculation" aria-label="Default select example">
                  <option value="РНКБ" selected>РНКБ</option>
                  <option value="СБЕР">СБЕР</option>
                  <option value="ГЕНБАНК">ГЕНБАНК</option>
                  <option value="НАЛИЧНЫЕ">НАЛИЧНЫЕ</option>
                </select>
              </div>

              <button type="submit" id='submit' class="btn btn-primary">Сохранить</button>
            </form>
          </div>
        </div>

        </div>
      </div>
    </div>
