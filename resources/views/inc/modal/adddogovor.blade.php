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
              $('#adress').val($(this).attr( "address" ));
              $('#phone').val($(this).attr( "phone" ));
              $('#clientidinput').val($(this).val());
              $('#client').val($(this).text());
              $('#clientList').fadeOut();
            });

        });
    </script>
  
  <div class="modal fade" id="dogovorModal">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class ="modal-header">
            <h2>Добавить договор</h2>
          </div>

          <div class ="modal-body d-flex justify-content-center">

          <div class ="col-10">
            <form action="{{route('adddogovor')}}" autocomplete="off" method="post">
              @csrf

              <div class="form-group mb-3">
                <label for="name">Укажите название</label>
                <input type = "text" name="name" placeholder="" id="name" class="form-control" required>
              </div>

              <div class="form-group mb-3">
                <label for="subject">Укажите предмет (услуги)</label>
                <textarea rows="3" name="subject"
                placeholder="Исковое заявление о признании права собственности, участие в судебном заседании..." id="subject" class="form-control" required></textarea>
              </div>

              <div class="form-group mb-3">
                <label for="allstoimost">Укажите общую стоимость услуг</label>
                <input type = "text" name="allstoimost" placeholder="" id="allstoimost" class="form-control" required>
              </div>

              <div class="form-group mb-3">
                <label for="preduslugi">Укажите какие услуги предоплачены</label>
                <textarea rows="3" name="preduslugi"
                placeholder="Например, исковое заявление о признании права собственности." id="preduslugi" class="form-control" required></textarea>
              </div>

              <div class="form-group mb-3">
                <label for="predoplata">Укажите размер предоплаты</label>
                <input type = "text" name="predoplata" placeholder="" id="predoplata" class="form-control" required>
              </div>


              <div class="form-group mb-3">
                <label for="client">Укажите клиента</label>
                <input type = "text" name="client" id="client" class="form-control">
                <div id="clientList">
                </div>
              </div>

              <div class="form-group mb-3">
                <label for="adress">Укажите адрес клиента</label>
                <input type = "text" name="adress" placeholder="" id="adress" class="form-control" required>
              </div>

              <div class="form-group mb-3">
                <label for="phone">Укажите телефон клиента</label>
                <input type = "text" name="phone" placeholder="" id="phone" class="form-control" required>
              </div>


              <input type="hidden" name="clientidinput" id="clientidinput" class="form-control">

              <button type="submit" id='submit' class="btn btn-primary">Сохранить</button>
            </form>
          </div>
        </div>

        </div>
      </div>
    </div>
