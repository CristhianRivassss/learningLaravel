@extends('layout')

@section('title', 'Mensajes')

@section('content')


    <!-- Alertas Bootstrap -->
    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="text-end">
        <a href="{{route('usuarios.create')}}" class="btn btn-primary m-3">Crear Usuario</a>
    </div>

    <!-- Tabla Bootstrap Responsive -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">
                                <i class="fas fa-user me-1"></i> Nombre
                            </th>
                            <th scope="col">
                                <i class="fas fa-envelope me-1"></i> Email
                            </th>
                            <th scope="col" class="d-none d-lg-table-cell">
                                <i class="fas fa-comment me-1"></i> Role
                            </th>
                            <th scope="col" class="d-none d-lg-table-cell">
                                <i class="fas fa-comment me-1"></i> Notas
                            </th>
                            <th scope="col" class="text-center">
                                <i class="fas fa-cogs me-1"></i> Created At
                            </th>

                            <th scope="col" class="text-center">
                                <i class="fas fa-cogs me-1"></i> Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $user->name }}</div>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $user->email}}</div>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $user->getRoleNames() }}</div>
                            </td>
                            <td>
                                <div class="fw-bold">{{ optional($user->note)->body ?? '' }}</div>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $user->created_at}}</div>
                            </td>
                            <td>
                                <a class = "btn btn-info btn-xs"
                                   href="{{ route('usuarios.edit', $user) }}">
                                Editar</a>
                                <br>
                                 <form method="POST" action="{{ route('usuarios.destroy', $user) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="tooltip" 
                                                title="Eliminar mensaje"
                                                onclick="return confirm('⚠️ ¿Estás seguro de eliminar este mensaje?\n\nEsta acción no se puede deshacer.')">
                                            <i class="fas fa-trash"></i>
                                            <span class="d-none d-md-inline ms-1">Eliminar</span>
                                        </button>
                                    </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="fw-bold">No hay usuarios registrados</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
