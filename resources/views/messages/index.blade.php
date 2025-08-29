@extends('layout')

@section('title', 'Mensajes')

@section('content')
    <h1>Mensajes</h1>
    <p>Esta es la página de mensajes.</p>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Mensaje</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
            <tr>
                <td>{{ $message->nombre }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->mensaje }}</td>
                <td>{{ $message->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection