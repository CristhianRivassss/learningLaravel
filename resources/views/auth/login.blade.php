@extends ('layout')
@section ('title', 'Login')
@section ('content')
    <h1>Iniciar Sesión</h1>
    
    @if ($errors->any())
        <div style="color: red; background: #ffe6e6; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
            @if($errors->has('csrf'))
                <p><strong>Página expirada:</strong> Intenta de nuevo.</p>
            @else
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            @endif
        </div>
    @endif
    
    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                   style="width: 100%; padding: 8px; margin-top: 5px;">
            @error('email')
                <span style="color: red; font-size: 14px;">{{ $message }}</span>
            @enderror
        </div>
        <div style="margin-bottom: 15px;">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required
                   style="width: 100%; padding: 8px; margin-top: 5px;">
            @error('password')
                <span style="color: red; font-size: 14px;">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            Iniciar Sesión
        </button>
    </form>
    
    <p><a href="/">Volver al inicio</a></p>
@endsection