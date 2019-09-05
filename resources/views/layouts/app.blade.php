<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/138baeb1f9.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #009688;">
            <div class="container">
            <a class="navbar-brand" href="#">Dream List</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="{{action('DreamsController@index')}}"><i class="fas fa-angle-right"></i> Dreams <i class="fas fa-rocket"></i></a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="{{action('DreamsController@stats')}}"><i class="fas fa-angle-right"></i> Stats <i class="fas fa-chart-pie"></i></a>
                </li>
            </div>
            </div>
          </nav>
        @yield('content')




    </div>
</body>
</html>
