@extends('layout')

@section('title', 'Saludos')

@section('content')
    <h1>Hola, {{ $nombre }}</h1>
    <p>Bienvenido a nuestra aplicación.</p>
    <ul>
    @foreach($nombres as $n)
        <li>{{ $n }}</li>
    @endforeach
    </ul>
    @if (count($nombres) > 0)
        <p>Hay {{ count($nombres) }} nombres registrados.</p>
    @else
        <p>No hay nombres registrados.</p>
    @endif
@endsection