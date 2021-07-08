<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'I.E.PNP FELIX TELLO ROJAS - CHICLAYO') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>

<body>
    <div id="app" class="d-flex flex-column vh-100">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('storage/img/logo.png')}}" width="30" height="30" class="d-inline-block align-top" alt="">
                    {{ config('app.name', 'I.E.PNP FELIX TELLO ROJAS - CHICLAYO') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @auth
        <nav class="mt-2">
            <div class="container">
                <ul class="nav nav-pills nav-justified navbar-light bg-white shadow-sm">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Mantenimientos</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('/usuario') }}">Usuarios</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/grado') }}">Grados</a>
                            <a class="dropdown-item" href="{{ url('/seccion') }}">Secciones</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/grado-seccion') }}">Grado y sección</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/pregunta') }}">Preguntas</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/estudiante') }}">Estudiante</a>
                            <a class="dropdown-item" href="{{ url('/colaborador') }}">Colaborador</a>
                        </div>
                    </li>
                    <li class="nav-item border">
                        <a class="nav-link" href="{{ url('/diagnostico') }}">Tests</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Reportes</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('/rpt-grado') }}">Casos por grado</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/rpt-seccion') }}">Casos por sección</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/rpt-nivel') }}">Casos por niveles</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        @endauth


        <main class="py-4 flex-fill">
            @yield('content')
        </main>
        <footer>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container justify-content-center">
                    <div class="font-weight-bold">2021</div>
                </div>
            </nav>
    </div>
    </div>
    @yield('scripts')
</body>

</html>