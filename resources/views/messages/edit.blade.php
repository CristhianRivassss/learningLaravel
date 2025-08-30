@extends ('layout')
@section('title', 'Editar Mensaje')

@section('content')
    <h1>Editar Mensaje</h1>
    <div class="form-elegant">
        <form action="{{ route('mensajes.update', $message->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ $message->nombre }}">
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ $message->email }}">
            </div>
            <div>
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="{{ $message->telefono }}">
            </div>
            <div>
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje">{{ $message->mensaje }}</textarea>
            </div>
            <button type="submit">Actualizar</button>
        </form>
    </div>
@endsection