<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>No Escape From Game | Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa;
        }

        .full-height-container {
            min-height: 100vh; /* ← Cambio aquí */
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 30px; /* ← Empuje visual hacia abajo */
        }

        .logo-container img {
            max-width: 100%;
            max-height: 300px;
            object-fit: contain;
        }

        .btn {
            margin-top: 10px;
        }

        h2 {
            margin-top: 15px;
        }

        .form-column, .logo-column {
            max-width: 500px;
        }

        .btn-submit {
            border: none;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container full-height-container">
        <div class="row w-100 align-items-center justify-content-center">
            <!-- Columna de formulario -->
            <div class="col-md-6 form-column">
                <a href="javascript:history.back()" class="btn btn-dark">
                    &larr; Volver
                </a>

                <h2>Formulario de Registro</h2>

                <form action="{{ route('register') }}" method="POST" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}">
                        @error('nombre')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo') }}" autocomplete="off">
                        @error('correo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}">
                        @error('direccion')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                        @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <p>¿Ya tienes una cuenta? <a href="{{route('rutaFormularioInicio')}}">Iniciar sesión</a></p>

                    <div class="d-flex justify-content-start gap-2">
                        <button type="submit" class="btn btn-dark">Registrarse</button>
                        <a href="{{ route('rutaMostrarProductos') }}" class="btn btn-secondary">Volver al inicio</a>
                    </div>
                </form>
                <br>
            </div>

            <!-- Columna de imagen -->
            <div class="col-md-6 logo-column d-flex justify-content-center">
                <img src="{{ asset('images/imagen-forminicio.png') }}" alt="Logo Registro">
            </div>
        </div>
    </div>
</body>
</html>