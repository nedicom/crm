    <div class = "row p-4">
      <div class = "col-10 d-flex justify-content-center">
        <form class = "row gx-3 gy-2 align-items-center d-flex justify-content-between" action="{{route('clients')}}" method="GET">

          <div class="col-2 d-flex justify-content-center">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox"
              id="flexSwitchCheckDefault" name="status" id="status" value="1"

              @if (null !== app('request')->input('status'))checked @endif>

              <label class="form-check-label" for="flexSwitchCheckDefault">В работе</label>
            </div>
          </div>


          <div class="col-4">
          <input type = "text" name="findclient" placeholder="введите клиента" id="findclient" class="form-control">
          </div>

            <div class="col-2">
                  <select class="form-select" name="checkedlawyer" id="checkedlawyer">
                    <option value="">не выбрано</option>
                        @foreach($datalawyers as $el)
                          <option value="{{$el -> id}}" @if (($el -> id) == (app('request')->input('checkedlawyer'))) selected @endif>
                            {{$el -> name}}
                          </option>
                        @endforeach
                  </select>
            </div>

            <div class="col-4">
            <button type="submit" class="btn btn-primary">Применить</button>
            <a href='clients' class='button btn btn-secondary'>Сбросить</a>
            </div>


      </form>
    </div>
  </div>
