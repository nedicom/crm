@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Необходимо подтвердить почту для доступа') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Свежая ссылка на верификацию уже направлена') }}
                        </div>
                    @endif

                    {{ __('Нажмите на кнопку, затем проверьте почту.') }}
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" id="clicked" class="btn btn-primary">{{ __('нажмите здесь ') }}</button>
                        
                    {{ __('Не кликайте по 10 раз. Достаточно одного.') }}
                    </form>
                    @php
                    $mail = Auth::user()->email;
                    $explode = explode("@",$mail);                    
                    @endphp
                    <script>
                        $( "#clicked" ).click(function() {
                         $( "#mail" ).show( "fast" );
                        });
                    </script>
                    <span id="mail" style="display:none;">проверьте: <a href="http://{{ $explode[1] }}" type="submit" class="btn btn-primary">{{ Auth::user()->email }}</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
