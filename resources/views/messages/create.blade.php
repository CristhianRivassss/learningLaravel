@extends('layout')

@section('title', 'Contacto')

@section('content')
    <div class="container">         <!-- 1. Contenedor -->
         <div class="row justify-content-center">            <!-- 2. Fila -->
            <div class="col-md-6">          <!-- 3. Columna -->
                <h1>Contacto</h1>
                <p>Esta es la página de contacto.</p>
                @if (session()->has('info'))
                <h3>{{session('info')}} </h3>
                @else
                    <form method="POST" action="/contacto" >
                        @csrf
                        <p><label for="nombre">
                            Nombre
                            <input type="text" name="nombre" value="{{ old('nombre') }} " class="form-control">
                            {{ $errors->first('nombre') }}
                        </label></p>
                        <p><label for="email">
                            Email
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                            {{ $errors->first('email') }}
                        </label></p>
                        <p><label for="mensaje">
                            Mensaje
                            <textarea name="mensaje" class="form-control">{{ old('mensaje') }}</textarea>
                            {{ $errors->first('mensaje') }}
                        </label></p>
                        <button type="submit" class="btn btn-danger">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection