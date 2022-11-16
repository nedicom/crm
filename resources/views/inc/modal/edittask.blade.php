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

      $(document).on('click', '.clientAJAX', function(){
          $('#clientidinput').val($(this).val());
          $('#client').val($(this).text());
          $('#clientList').fadeOut();
      });

  });
</script>

  <div class="modal fade" id="edittaskModal">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class ="modal-header">
            <h2>Изменить задачу</h2>
          </div>

          <div class ="modal-body d-flex justify-content-center">

          <div class ="col-10">
            <form action="{{route('editTaskById', $data -> id)}}" autocomplete="off" method="post">
              @csrf

              <div class="form-group mb-3">
                <label for="name">Укажите название</label>
                <input type = "text" name="name" placeholder="" id="name" value="{{$data->name}}" class="form-control" required>
              </div>

              <div class="form-group mb-3">
                <label for="date">Укажите время:</label>
                <input type="datetime-local" id="date" value="{{$data->date['value']}}" class="form-control" name="date"
                      min="{{ date('Y-m-d H:i') }}">
              </div>

              <div class="input-group form-group mb-3">
                <label class="input-group-text" for="duration"><i class="bi bi-stopwatch"></i></label>
                <input type = "number" name="duration" value="{{$data->duration}}" min="0.5" max="25" step="0.5" id="duration" class="form-control">
                <span class="input-group-text">час</span>
              </div>

              <div class="form-group mb-3">
                <label for="client">Укажите клиента</label>
                <input type = "text" name="client" id="client" value="{{$data->client}}" class="form-control">
                <div id="clientList">
                  </div>
              </div>

              <div class="form-group mb-3">
                <label for="lawyer">Укажите юриста</label>
                <select class="form-select" name="lawyer" id="lawyer" class="form-control">
                  @foreach($datalawyers as $el)
                    <option value="{{$el -> id}}"  @if ($data->lawyer == $el -> id) selected @endif>{{$el -> name}}</option>
                  @endforeach
                </select>
              </div>

              <input type="hidden" name="clientidinput" id="clientidinput" class="form-control">

              <button type="submit" id='submit' class="btn btn-primary">обновить</button>
            </form>
          </div>
        </div>

        </div>
      </div>
    </div>
