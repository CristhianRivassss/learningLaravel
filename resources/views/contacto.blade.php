@extends('layout')

@section('title', 'Contacto')

@section('content')
    <h1>Contacto</h1>
    <p>Esta es la página de contacto.</p>
    <form method="POST" action="/contacto">
        @csrf
        <p><label for="nombre">
            Nombre
            <input type="text" name="nombre" value="{{ old('nombre') }}">
            {{ $errors->first('nombre') }}
        </label></p>
        <p><label for="email">
            Email
            <input type="email" name="email" value="{{ old('email') }}">
            {{ $errors->first('email') }}
        </label></p>
        <p><label for="mensaje">
            Mensaje
            <textarea name="mensaje">{{ old('mensaje') }}</textarea>
            {{ $errors->first('mensaje') }}
        </label></p>
        <input type="submit" value="Enviar">
    </form>
@endsection