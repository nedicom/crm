<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
      <link href="/style.css" rel="stylesheet">

  </head>

  <body>
            @guest
              @include('inc.navguest')
            @endguest

            @auth
              @include('inc.leftmenu')
              @include('inc.navauth')
              @include('inc/messages')

              @include('inc.maincontent')

              @if (request()->is('clients'))
                 @include('inc./modal/addclient')
               @endif

              @if (request()->is('clients/*'))
                @include('inc./modal/editclient')
              @endif

               @if (request()->is('lawyers*'))
                 @include('inc.sidebarleftlawyers')
               @endif
               @if (request()->is('payments'))
                 @include('inc.sidebarleftpayments')
               @endif
            @endauth

    @yield('content') {{--user register form--}}
  </body>
</html>
