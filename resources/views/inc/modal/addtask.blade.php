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
            data:{query:query, _token:'{{csrf_token()}}'},
            success:function(data){
             $('#clientList').fadeIn();
             $('#clientList').html(data);
            }
           });
          }
      });

      $(document).on('click', '.clientAJAX', function(){
          $('#clientidinput').val($(this).val());
          $('#client').val($(this).text());
          $('#clientList').fadeOut();
      });

      $(".nameToForm").click(function() {
        var namevalue = $(this).attr('dataclient');
        var clientIdValue = $(this).attr('datavalueid');
        document.getElementById("client").value = namevalue;
        document.getElementById("clientidinput").value = clientIdValue;
    });

  });
</script>

  <script>
    $(document).ready(function(){
      $.datetimepicker.setLocale('ru');
      $('#date').datetimepicker({
    });
  });
  </script>

  <div class="modal fade" id="taskModal">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">
          <div class ="modal-header">
            <h2>+ <span id="taskname">задачу</span></h2>
          </div>

          <div class ="modal-body d-flex justify-content-center">

          <div class ="col-10">
            <form action="{{route('addtask')}}" autocomplete="off" method="post">
              @csrf

              <div class="form-group mb-3 hideme">
                <label for="nameoftask">Укажите название задачи <span class="text-danger">*</span></label>
                <input type = "text" name="nameoftask" placeholder="Получить решение по делу" value="{{ old('nameoftask') }}" placeholder="" id="nameoftask" class="form-control" required>
              </div>

              <div class="form-group mb-3">
                <label for="description">Описание</label>
                <textarea rows="3" name="description" placeholder="Немного подробнее, если это нужно" id="description" class="form-control">{{ old('description') }}</textarea>
              </div>



              <div class="row">
                <div class="col-4 form-group mb-3">
                  <label for="date">Время начала: <span class="text-danger">*</span></label>
                  <input type="text" id="date" class="form-control" name="date"
                        min="{{ date('Y-m-d H:i') }}">
                </div>

                <div class="col-4 form-group mb-3">
                <span>Продолжительность<span class="text-danger">*</span>
                  <div class="input-group form-group mb-3">
                    
                    <label class="input-group-text" for="duration"><i class="bi bi-stopwatch"></i></label>
                    <input type = "number" name="duration" min="0.5" max="25" step="0.5" id="duration" class="form-control" required>
                    <span class="input-group-text">час</span>
                  </div>
                </div>

                <div class="col-4 form-group mb-3 hideme">
                  <label for="name">Яндекс-диск</label>
                  <input type = "url" name="hrftodcm" placeholder="https://disk.yandex.ru" id="hrftodcm" class="form-control">
                </div>
              </div>

              <div class="row">
                <div class="col-6 form-group mb-3">
                  <label for="client">Клиент<span class="text-danger">*</span></label>
                  <input type = "text" name="client" id="client" class="form-control" required>
                    <div id="clientList">
                    </div>
                </div>

                <div class="col-3 form-group mb-3 hideme">
                  <label for="tag">Сделайте отметку</label>
                  <select class="form-select" name="tag" id="tag">
                      <option value="неважно">неважно</option>
                      <option value="перенос">перенос</option>
                      <option value="срочно">срочно</option>
                      <option value="приоритет">приоритет</option>
                  </select>
                 </div>

                <div class="col-3 form-group mb-3 hideme">
                  <label for="status">Cтатус</label>
                    <select class="form-select" name="status" id="status" class="form-control">
                        <option value="в работе">в работе</option>
                        <option value="просрочена">просрочена</option>                      
                        <option value="выполнена" >выполнена</option>
                        <option value="ожидает" selected>ожидает</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <div class="col-4 form-group mb-3 hideme">
                  <label for="type">Тип</label>
                    <select class="form-select" name="type" id="type" class="form-control">
                        <option value="задача">задача</option>
                        <option value="заседание">заседание</option>
                        <option value="допрос" >допрос</option>                      
                        <option value="звонок" >звонок</option>
                        <option value="консультация" >консультация</option>
                    </select>
                </div>

                <div class="col-4 form-group mb-3">
                  <label for="lawyer">Укажите исполнителя <span class="text-danger">*</span></label>
                  <select class="form-select" name="lawyer" id="lawyer" class="form-control">
                        @foreach($datalawyers as $el)
                          <option value="{{$el -> id}}" @if ((Auth::user()->id) == $el -> id) selected @endif>{{$el -> name}}</option>
                        @endforeach
                  </select>
                </div>

                <div class="col-4 form-group mb-3 hideme">
                  <label for="soispolintel">Укажите соИсполнителя</label>
                  <select class="form-select" name="soispolintel" id="soispolintel" class="form-control">
                        @foreach($datalawyers as $el)
                          <option value="{{$el -> id}}" @if ((Auth::user()->id) == $el -> id) selected @endif>{{$el -> name}}</option>
                        @endforeach
                  </select>
                </div>
              </div>

              <input type="hidden" name="clientidinput" id="clientidinput" class="form-control">

              <button type="submit" id='submit' class="btn btn-primary">Сохранить</button>
            </form>
          </div>
        </div>

        </div>
      </div>
    </div>
