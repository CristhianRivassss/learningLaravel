@extends('layout')

@section('title', 'Mensajes')

@section('content')
    <h1>Mensajes</h1>
    <p>Esta es la página de mensajes.</p>
    <div class="table-container">
        <table class="table-elegant">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Mensaje</th>
                    <th>Id</th>
                    <th>editar</th>
                    <th>eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                <tr>
                    <td>{{ $message->nombre }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->mensaje }}</td>
                    <td>{{ $message->created_at }}</td>
                    <td><a href="{{ route('mensajes.show', $message->id) }}">Ver</a></td>
                    <td><a href="{{ route('mensajes.edit', $message->id) }}">Editar</a></td>
                    <td>
                        <form method="POST" action="{{ route('mensajes.destroy', $message->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este mensaje?')">
                                Eliminar
                            </button>
                        </form>  
                    </td>           
                        @if(session('info'))
                        <div class="alert-elegant info">
                            {{ session('info') }}
                        </div>
                    @endif

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection