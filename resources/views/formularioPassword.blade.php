<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Escape From Game | Cambiar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Cambiar Contraseña</h2>

    {{-- Mostrar mensaje si la nueva contraseña es igual a la actual --}}
    @if(session('misma_password'))
        <div class="alert alert-warning">
            {{ session('misma_password') }}
        </div>
    @endif

    {{-- Mostrar mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('cambiarPassword') }}">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">Nueva contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required minlength="8">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required minlength="8">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar contraseña</button>
        <a href="{{ route('rutaMostrarProductos') }}" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>
</body>
</html>