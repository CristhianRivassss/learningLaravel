@extends('layout')

@section('title', 'Contacto')

@section('content')
    
    <h1>Contacto</h1>
    <p>Esta es la página de contacto.</p>
    @if (session()->has('info'))
    <h3>{{session('info')}} </h3>
    @else
    <div class="form-elegant">
        <form method="POST" action="{{ route('mensajes.store') }}">
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
            <p><label for="telefono">
                Teléfono
                <input type="text" name="telefono" value="{{ old('telefono') }}">
                {{ $errors->first('telefono') }}
            </label></p>
            <p><label for="mensaje">
                Mensaje
                <textarea name="mensaje">{{ old('mensaje') }}</textarea>
                {{ $errors->first('mensaje') }}
            </label></p>
            <input type="submit" value="Enviar">
        </form>
    </div>
@endif
@endsection