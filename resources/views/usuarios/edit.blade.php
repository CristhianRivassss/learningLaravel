@extends('layout')
@section('title', 'Editar Usuario')

@section('content')
    <h1>Editar Usuario: {{ $user->name }}</h1>
  @if($errors->any())
        <div class="alert alert-danger">
            <h5>¡Hay errores en el formulario!</h5>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

    <div class="mb-3">
        <label class="form-label">Roles</label>
        <div>
            @foreach($roles as $role)
            <div class="form-check form-check-inline">
                <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="role_{{ $role->id }}" 
                    name="roles[]" 
                    value="{{ $role->id }}"
                    {{ in_array($role->id, $userRoles) ? 'checked' : '' }}>
                <label class="form-check-label" for="role_{{ $role->id }}">
                    {{ $role->name }}
                </label>
            </div>
            @endforeach
        </div>
    </div>

        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
    </form>
@endsection