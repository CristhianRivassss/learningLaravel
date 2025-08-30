<!DOCTYPE html>
<html>
    <style>
        
    </style>

<head>
    <title>@yield('title', 'Mi sitio')</title>
    <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
</head>
<body>
    <nav>
        <ul>
            <h1> {{request()->is('/')? 'Estas en el home' : 'No estas en el home'. request()->url()}}</h1>
            <li><a href="{{ url('/') }}">Inicio</a></li>
            <li><a href="{{ route('mensajes.create') }}">Contacto</a></li>
            <li><a href="{{ route('saludos') }}">Saludo</a></li>
            @if (Auth::check())
                <li><a href="{{ route('mensajes.index') }}">Mensajes</a></li>
                <form method ="POST" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" onclick = "return confirm('¿Estás seguro de que deseas cerrar sesión?')">Logout {{ Auth::user()->name }}</button>
                </form>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
            @endif
        </ul>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <style>
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 10px;
        }
        nav ul li a {
            text-decoration: none;
            color: blue;
        }
        nav ul li a.active {
            color: green;
            font-weight: bold;
        }
    </style>