<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>No Escape From Game | Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        html, body {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa;
        }

        .full-height-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
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

        .btn-submit {
            border: none;
            margin-left: 10px;
        }

        /* Opcional: para limitar el ancho de las columnas en pantallas grandes */
        .form-column, .logo-column {
            max-width: 500px;
        }
    </style>
</head>
<body>
    <div class="container full-height-container">
        <div class="row w-100 align-items-center justify-content-center">
            <div class="col-md-6 form-column">
                <a href="javascript:history.back()" class="btn btn-dark">
                    &larr; Volver
                </a>

                <h2>Iniciar Sesión</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control @error('correo') is-invalid @enderror" id="correo" name="correo" value="{{ old('correo') }}" />
                        @error('correo')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" />
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <p>¿No tienes una cuenta? <a href="{{ route('rutaFormularioRegistro') }}">Registrarse</a></p>

                    <div class="d-flex justify-content-start gap-2">
                        <button type="submit" class="btn btn-dark">Iniciar sesión</button>
                        <a href="{{ route('rutaMostrarProductos') }}" class="btn btn-secondary">Volver al inicio</a>
                    </div>
                </form>
            </div>

            <div class="col-md-6 logo-column d-flex justify-content-center">
                <img src="{{ asset('images/imagen-forminicio.png') }}" alt="Logo No Escape From Game" />
            </div>
        </div>
    </div>
</body>
</html>