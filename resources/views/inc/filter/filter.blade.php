    <div class = "row p-4">
      <div class = "col-10 d-flex justify-content-center">
        <form class = "row gx-3 gy-2 align-items-center d-flex justify-content-between" action="{{route('leads')}}" method="GET">

          <div class="col-2">
                <select class="form-select" name="checkedstatus" id="checkedstatus">
                    <option value="">статус</option>
                    <option value="поступил" @if ('поступил' == (app('request')->input('checkedstatus'))) selected @endif>
                      поступил
                    </option>
                    <option value="в работе" @if ('в работе' == (app('request')->input('checkedstatus'))) selected @endif>
                      в работе
                    </option>
                    <option value="конвертирован" @if ('конвертирован' == (app('request')->input('checkedstatus'))) selected @endif>
                      конвертирован
                    </option>
                    <option value="удален" @if ('удален' == (app('request')->input('checkedstatus'))) selected @endif>
                      удален
                    </option>
                </select>
          </div>

          <div class="col-2">
                <select class="form-select" name="checkedsources" id="checkedsources">
                    <option value="">источник</option>
                    <option value="сайт" @if ('сайт' == (app('request')->input('checkedsources'))) selected @endif>
                      сайт
                    </option>
                    <option value="рекомендация" @if ('рекомендация' == (app('request')->input('checkedsources'))) selected @endif>
                      рекомендация
                    </option>
                    <option value="с улицы" @if ('с улицы' == (app('request')->input('checkedsources'))) selected @endif>
                      с улицы
                    </option>
                    <option value="не знаю источник" @if ('не знаю источник' == (app('request')->input('checkedsources'))) selected @endif>
                      не знаю источник
                    </option>
                    <option value="сайт ПФР" @if ('сайт ПФР' == (app('request')->input('checkedsources'))) selected @endif>
                      сайт ПФР
                    </option>
                </select>
          </div>


            <div class="col-2">
                  <select class="form-select" name="checkedlawyer" id="checkedlawyer">
                    <option value="">Привлек лид</option>
                        @foreach($datalawyers as $el)
                          <option value="{{$el -> id}}" @if (($el -> id) == (app('request')->input('checkedlawyer'))) selected @endif>
                            {{$el -> name}}
                          </option>
                        @endforeach
                  </select>
            </div>

            <div class="col-2">
                  <select class="form-select" name="checkedresponsible" id="checkedresponsible">
                    <option value="">Ответственный</option>
                        @foreach($datalawyers as $el)
                          <option value="{{$el -> id}}" @if (($el -> id) == (app('request')->input('checkedresponsible'))) selected @endif>
                            {{$el -> name}}
                          </option>
                        @endforeach
                  </select>
            </div>

            <div class="col-4">
            <button type="submit" class="btn btn-primary">Применить</button>
            <a href='leads' class='button btn btn-secondary'>Сбросить</a>
            </div>


      </form>
    </div>
  </div>
