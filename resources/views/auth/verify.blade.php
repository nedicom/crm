@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Подтвердите электронную почту') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Свежая ссылка на верификацию направлена') }}
                        </div>
                    @endif

                    {{ __('Проверьте ссылку на верификацию (особенно папку спам).') }}
                    {{ __('Если Вы ее не получили') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary p-0 m-0 align-baseline">{{ __('нажмите здесь ') }}</button>.
                    {{ __('Не кликайте по 10 раз. Достаточно одного.') }},
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
