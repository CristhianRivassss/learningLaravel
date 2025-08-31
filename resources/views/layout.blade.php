<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Mi sitio')</title>
    
    <!-- Bootstrap CSS LOCAL -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    
    <!-- Vite Assets (CSS + JS) -->
    @vite(['resources/js/app.js'])
</head>
<body>
    <!-- Navigation Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
               Aprendiendo Laravel
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('mensajes.create') ? 'active' : '' }}" href="{{ route('mensajes.create') }}">
                            Contacto
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('saludos') ? 'active' : '' }}" href="{{ route('saludos') }}">
                            Saludo
                        </a>
                    </li>
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('mensajes.index') ? 'active' : '' }}" href="{{ route('mensajes.index') }}">
                                Mensajes
                            </a>
                        </li>
                        
                        @can('admin-only')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('usuarios.index') ? 'active' : '' }}" href="{{ route('usuarios.index') }}">
                                    Usuarios
                                </a>
                            </li>
                        @endcan
                    @endif
                </ul>
                
                <!-- Auth buttons -->
                <ul class="navbar-nav">
                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item" 
                                                onclick="return confirm('¿Estás seguro de cerrar sesión?')">
                                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <div class="container mt-4">
        @yield('content')
    </div>
    
    <!-- Bootstrap JavaScript LOCAL -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>