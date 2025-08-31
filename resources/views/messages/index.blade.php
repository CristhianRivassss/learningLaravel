@extends('layout')

@section('title', 'Mensajes')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 mb-2">📬 Mensajes Recibidos</h1>
            <p class="text-muted">Gestiona todos los mensajes de contacto</p>
        </div>
        <div>
            <span class="badge bg-primary fs-6">{{ count($messages) }} mensajes</span>
        </div>
    </div>

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
                            <th scope="col" class="d-none d-md-table-cell">
                                <i class="fas fa-phone me-1"></i> Teléfono
                            </th>
                            <th scope="col" class="d-none d-lg-table-cell">
                                <i class="fas fa-comment me-1"></i> Mensaje
                            </th>
                            <th scope="col" class="d-none d-md-table-cell">
                                <i class="fas fa-calendar me-1"></i> Fecha
                            </th>
                            <th scope="col" class="text-center">
                                <i class="fas fa-cogs me-1"></i> Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $message->nombre }}</div>
                                <small class="text-muted d-md-none">{{ $message->email }}</small>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <a href="mailto:{{ $message->email }}" class="text-decoration-none">
                                    {{ $message->email }}
                                </a>
                            </td>
                            <td class="d-none d-md-table-cell">
                                @if($message->telefono)
                                    <a href="tel:{{ $message->telefono }}" class="text-decoration-none">
                                        {{ $message->telefono }}
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="d-none d-lg-table-cell">
                                <div class="message-preview">
                                    {{ Str::limit($message->mensaje, 50) }}
                                </div>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <small class="text-muted">
                                    {{ $message->created_at->format('d/m/Y') }}
                                    <br>
                                    {{ $message->created_at->format('H:i') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- Ver -->
                                    <a href="{{ route('mensajes.show', $message->id) }}" 
                                       class="btn btn-outline-primary btn-sm"
                                       data-bs-toggle="tooltip" 
                                       title="Ver mensaje completo">
                                        <i class="fas fa-eye"></i>
                                        <span class="d-none d-md-inline ms-1">Ver</span>
                                    </a>
                                    
                                    <!-- Editar -->
                                    <a href="{{ route('mensajes.edit', $message->id) }}" 
                                       class="btn btn-outline-warning btn-sm"
                                       data-bs-toggle="tooltip" 
                                       title="Editar mensaje">
                                        <i class="fas fa-edit"></i>
                                        <span class="d-none d-md-inline ms-1">Editar</span>
                                    </a>
                                    
                                    <!-- Eliminar -->
                                    <form method="POST" action="{{ route('mensajes.destroy', $message->id) }}" class="d-inline">
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
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                    <h5>No hay mensajes</h5>
                                    <p>Aún no has recibido ningún mensaje de contacto.</p>
                                    <a href="{{ route('mensajes.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-1"></i> Crear mensaje de prueba
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer con información adicional -->
    @if(count($messages) > 0)
        <div class="mt-4 text-center">
            <small class="text-muted">
                Total: {{ count($messages) }} mensajes | 
                Último actualizado: {{ now()->format('d/m/Y H:i') }}
            </small>
        </div>
    @endif
@endsection