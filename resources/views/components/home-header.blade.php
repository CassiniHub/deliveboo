<nav id="home-header" class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">

            <img src="{{asset('storage/images/header/logo.png')}}" alt="">
            <span class="header-logo-span">Deliveboo</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="dropdown" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <div class="header-slogan">

                Ogni tuo desiderio è un ordine!

            </div>

            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest

                    <li class="nav-item dropdown">

                        <a class="nav-link navbar-button-style resp-disp-none" href="{{ route('login') }}" >{{ __('Login') }}  </a>

                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown-style resp-lg-disp-none" aria-labelledby="navbarDropdown">

                            <div class="dropdown-header">

                                <img src="{{asset('storage/images/header/logo.png')}}" alt="">


                                <div class="dropdown-header-title">

                                    Deliveboo

                                </div>

                            </div>

                            <a class="nav-link navbar-button-style resp-head-pop-mtop" href="{{ route('login') }}" >{{ __('Login') }} </a>

                            <a class="nav-link navbar-button-style" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </div>
                    </li>

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link navbar-button-style resp-disp-none" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle navbar-button-style resp-disp-none" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->company_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown-style" aria-labelledby="navbarDropdown">

                            <div class="dropdown-header">

                                <img src="{{asset('storage/images/header/logo.png')}}" alt="">


                                <div class="dropdown-header-title">

                                    Deliveboo

                                </div>

                            </div>
                            <div class="dropdown-item dropdown-welcome">

                                Bentornato {{ Auth::user()->company_name }} <br>

                                Account: {{ Auth::user()->email }}

                            </div>
                            <div class="dropdown-actions">

                                <a class="dropdown-item navbar-color-style" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <a class="dropdown-item navbar-color-style" href="{{ route('users.show', Auth::user() -> id) }}">
                                    La tua Dashboard
                                </a>
                                <a class="dropdown-item navbar-color-style" href="{{ route('restaurants.create') }}">
                                    Aggiungi un'attività
                                </a>

                            </div>

                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

