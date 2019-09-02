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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://kit.fontawesome.com/138baeb1f9.js"></script>
    
</head>
<body>
    <div id="app">


        <main class="py-4">       
                 <div class="w3-row">
                <div class="w3-col m4 l4">
                  &nbsp;
                </div>
                <div class="w3-col s12 m4 l4">
        
                  <div class="w3-container w3-teal w3-center">
                      <center>
                    <h1>My Dream List</h1>
                    <div class="w3-cell-row">
                            <div class="w3-container w3-cell w3-right-align">
                    <a href="/"><h4>Dream List</h4></a>
                            </div>
                    <div class="w3-container w3-cell">
                    <a href="/stats"><h4>Statistiky</h4></a>
                    </div>
                    </div>
                        </center>
                  </div><br><br>
            @yield('content')



        </main>
    </div>
</body>
</html>
