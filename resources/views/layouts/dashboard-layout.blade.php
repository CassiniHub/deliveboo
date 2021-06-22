<!doctype html>
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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="dashboard">

        <section id="dashboard-nav">

            <div class="title">
                <h1 class="company-name">
                    {{ Auth::user()->company_name }}
                </h1>
            </div>

            <div class="restaurants">
                <h4>
                    Le tue attività
                </h4>

                <a href="{{ route('restaurants.create') }}">
                    Aggiungi un'attività
                </a>
                <div class="    ">   
                    @yield('content')
                </div>
            </div>

            <div class="nav-links">
                <a class="navbar-brand" href="{{ route('restaurants.index') }}">
                    Home
                </a>
               <div>
                    <a class="navbar-brand" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
               </div>
            </div>

        </section>
        
        

        <section id="dashboard-main">
        </section>

    </div>
</body>
</html>
