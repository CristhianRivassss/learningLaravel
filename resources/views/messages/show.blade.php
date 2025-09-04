@extends('layout')

@section('title', 'Mensaje')

@section('content')
    <h1>Mensaje</h1>
    <p>Nombre: {{ $message->nombre }}</p>
    <p>Email: {{ $message->email }}</p>
    <p>Teléfono: {{ $message->telefono }}</p>
    <p>Mensaje: {{ $message->mensaje }}</p>
    <p>Fecha: {{ $message->created_at }}</p>
    @if($message->user)
        <p>Enviado por: {{ $message->user->name }}</p>
    @endif
    <a href="{{ route('mensajes.edit', $message->id) }}">Editar</a>
@endsection