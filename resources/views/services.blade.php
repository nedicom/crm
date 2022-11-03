  @extends('layouts.app')


  @section('title')
    услуги
  @endsection

    @section('leftmenuone')
      <li class="nav-item text-center p-3">
        <a class="text-white text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#serviceModal">Добавить услугу</a>
      </li>
    @endsection

@section('main')


    {{-- start views for all services--}}

    <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Услуги</h4>



                                                  @foreach($data as $el)


                                                          {{$el -> created_at}}
                                                          {{$el -> name}}
                                                          {{$el -> price}}

                                                          <td>
                                                          <a class="btn btn-primary" href="#" role="button">Подробнее</a>
                                                          </td>
                                                      </tr>

                                                  @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->

                                    </div>
                                </div>
                            </div> <!-- end col -->


                        </div>



    {{-- end views for all services--}}

@endsection
