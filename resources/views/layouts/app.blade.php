<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Glide</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a style="color:midnightblue" class="navbar-brand" href="{{ url('/home') }}"><strong><h2>
                                Glide</h2></strong></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth()
                            @can('afficher utilisateur')
                         <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                Utilisateurs</a>
                        </li>
                            @endcan
                            @can('afficher rôle')
                                <li class="nav-item">
                            <a class="nav-link" href="{{ route('roles.index') }}">
                                <img style="width: 19px; " src="https://img.icons8.com/ios/50/000000/important-property.png" /> Rôles</a>
                        </li>
                            @endcan
                                @can('afficher stage')

                                <li class="nav-item">
                             <a class="nav-link" href="{{ route('stages.index') }}">
                                 <i class="fa fa-envelope" aria-hidden="true"></i>
                                 Stages</a>
                        </li>
                                @endcan

                                @can('afficher stagiaire')
                                    <li class="nav-item" >
                            <a class="nav-link" href="{{ route('stagiaires.index') }}">
                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                Stagiaires</a>
                        </li>
                                @endcan

                                @can('afficher sujet')

                                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('sujets.index') }}">
                               <i class="fa fa-pencil-square-o"></i>
                               Sujets</a>
                        </li>
                                @endcan
                                @can('afficher département')

                                    <li class="nav-item">
                                <a class="nav-link" href="{{ route('departements.index') }}">
                                    <i class="fa fa-building-o" aria-hidden="true"></i>
                                    Départements</a>
                            </li>
                                @endcan

                                @can('afficher service')
                                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('services.index') }}">
                                <i class="fa fa-wrench" aria-hidden="true"></i>
                                Services</a>
                        </li>
                                @endcan
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                               
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->prenom }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                       href="{{ route('profil') }}"
                                      >
                <img style="width: 18px" src="https://img.icons8.com/ios-glyphs/30/000000/user-male-circle.png"/> {{ __('Profil') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                        {{ __('Déconnexion') }}
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
