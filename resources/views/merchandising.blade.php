<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Escape From Game | Merchandising</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Paginator oscuro */
        .page-item .page-link {
            background-color: #2a2a2a;  /* Gris oscuro */
            color: white;
            border-color: #444;
        }

        .page-item.active .page-link {
            background-color: #000;     /* Activo aún más oscuro */
            border-color: #555;
            color: white;
        }

        .page-item.disabled .page-link {
            background-color: #1e1e1e;
            color: #aaa;
            border-color: #333;
        }     

        /* Aseguramos que las tarjetas tengan la misma altura */
        .card {
            display: flex;
            flex-direction: column;
            height: 100%; /* Hace que la tarjeta ocupe todo el alto disponible */
        }

        /* Aseguramos que las imágenes no se corten */
        .card-img-top {
            height: 200px; /* Establecemos una altura fija */
            object-fit: contain; /* La imagen se ajustará dentro del espacio sin perder proporción ni cortarse */
            width: 100%; /* Asegura que ocupe todo el ancho disponible */
        }

        .card-body {
            flex-grow: 1; /* Hace que el cuerpo de la tarjeta ocupe todo el espacio restante */
        }

        /* Ajustar tamaño del botón "Añadir al carrito" */
        .btn-sm {
            padding: 0.375rem 0.75rem; /* Ajustamos los márgenes */
            font-size: 0.875rem; /* Reducción de tamaño del texto */
        }

        /* Texto general (blanco por defecto) */
        .custom-footer p,
        .custom-footer small {
            color: white;
        }

        /* INPUTS Y SELECTS */
        .form-control:focus,
        .form-select:focus {
            border-color: #8B0000;
            box-shadow: 0 0 0 0.2rem rgba(139, 0, 0, 0.25);
        }

        .carrito-item {
            padding: 0.5rem 0;
            border-bottom: 1px solid #e0e0e0;
            padding-left: 0.5rem;
        }

        .carrito-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 4px;
        }

        .carrito-nombre {
            font-size: 0.9rem;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .carrito-precio {
            font-size: 0.85rem;
        }

        .carrito-item form button {
            min-width: 28px;
        }
    </style>
</head>
<body>

    <!-- Header superior -->
    <header class="bg-white py-2 border-bottom">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <a href="{{ route('rutaIndex') }}">
                <img src="{{ asset('images/proyecto-logo.png') }}" alt="NOEF" style="height: 40px;">
            </a>

            <!-- Botones de carrito y perfil -->
<div class="d-flex align-items-center gap-3">
    @auth
        <!-- Icono Carrito -->
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownCarrito">
                <i class="bi bi-cart"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownCarrito" style="min-width: 300px;">
                @if(session('carrito') && count(session('carrito')) > 0)
                    @foreach(session('carrito') as $id => $item)
                        <li class="dropdown-item d-flex flex-column carrito-item">
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ asset('images/productos/' . $item['categoria'] . '/' . $item['imagen']) }}" alt="{{ $item['nombre'] }}" class="carrito-img">
                                <div class="flex-grow-1">
                                    <div class="carrito-nombre">{{ $item['nombre'] }}</div>
                                    <div class="carrito-precio text-muted">{{ $item['precio'] }} €</div>
                                </div>
                                <form action="{{ route('metodoQuitarDelCarrito', $id) }}" method="POST" class="ms-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger p-1">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="d-flex justify-content-center align-items-center gap-2 mt-2">
                                <form action="{{ route('metodoModificarCantidad', [$id, 'decrementar']) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-outline-secondary btn-sm px-2">-</button>
                                </form>

                                <span class="fw-bold">{{ $item['cantidad'] }}</span>

                                <form action="{{ route('metodoModificarCantidad', [$id, 'incrementar']) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-outline-secondary btn-sm px-2">+</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                    <li><hr class="dropdown-divider"></li>
                    <li class="text-center">
                        <a href="{{ route('rutaMostrarFormularioPago') }}" class="btn btn-warning w-75">Pagar pedido</a>
                    </li>
                @else
                    <li class="dropdown-item text-muted text-center">No hay productos en el carrito</li>
                @endif
            </ul>
        </div>

        <!-- Icono Perfil -->
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownPerfil" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownPerfil">
                <li class="dropdown-header">Hola, {{ Auth::user()->nombre }}</li>
                <li><a class="dropdown-item" href="{{ route('formularioPassword') }}">Cambiar contraseña</a></li>
                <li><a class="dropdown-item" href="{{ route('verHistorial') }}">Ver historial</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    @endauth

    @guest
        <a href="{{ route('rutaFormularioInicio') }}" class="btn btn-dark">Iniciar sesión</a>
    @endguest
</div>
        </div>
    </header>

    <!-- NAVBAR oscuro centrado -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container justify-content-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('rutaMostrarProductos') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('rutaMostrarVideojuegos') }}">Videojuegos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('rutaMostrarMerchandising') }}">Merchandising</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Ofertas</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-4">
        <!-- Formulario de búsqueda -->
        <form method="GET" action="{{ route('metodoFilter') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="nombre" class="form-control" value="{{ request('nombre') }}" placeholder="Buscar producto...">
                <button type="submit" class="btn btn-dark">Buscar</button>
            </div>
        </form>

        @if(request('nombre'))
            <div class="mt-2">
                <a href="{{ route('rutaMostrarProductos') }}" class="text-muted">Deshacer búsqueda</a>
            </div>
        @endif

        <div class="row">
            @if($productos->isEmpty())
                <div class="col-12 text-center text-muted">No se encontraron resultados</div>
            @else
            @foreach ($productos as $producto)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        <!-- Redirigir a la página de detalles del producto -->
                        <a href="{{ route('mostrarDetallesProducto', $producto->id) }}">
                            <img src="{{ asset('images/productos/' . $producto->categoria . '/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">
                                <!-- Redirigir a la página de detalles del producto -->
                                <a href="{{ route('mostrarDetallesProducto', $producto->id) }}" class="text-reset text-decoration-none">
                                    {{ $producto->nombre }}
                                </a>
                            </h5>
                            <p class="card-text"><strong>{{ $producto->precio }} €</strong></p>

                            @auth
                            <form action="{{ route('agregarAlCarrito', $producto->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="productoPrecio" value="{{ $producto->precio }}">
                                <button type="submit" class="btn btn-dark btn-sm w-100">Añadir al carrito</button>
                            </form>
                            @endauth
                        </div>
                        
                    </div>
                </div>
            @endforeach
            @endif
        </div>

        <div>
            {{$productos->links()}}
        </div>
    </div>
</body>
<!-- Footer -->
<footer class="bg-dark text-white mt-5 py-4">
    <div class="container">
        <div class="row">
            <!-- Información -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('rutaIndex') }}">
                    <img src="{{ asset('images/proyecto-logo.png') }}" alt="NOEF" style="height: 40px;">
                </a>
                <p class="small">Tu tienda de confianza para todo lo relacionado con videojuegos y merchandising.</p>
            </div>

            <!-- Enlaces rápidos -->
            <div class="col-md-4 mb-3 d-flex flex-column align-items-center">
                <div class="w-100" style="max-width: 200px;">
                    <h6>Enlaces útiles</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('rutaMostrarProductos') }}" class="text-white text-decoration-none">Inicio</a></li>
                        <li><a href="{{ route('rutaMostrarVideojuegos') }}" class="text-white text-decoration-none">Videojuegos</a></li>
                        <li><a href="{{ route('rutaMostrarMerchandising') }}" class="text-white text-decoration-none">Merchandising</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Ofertas</a></li>
                    </ul>
                </div>
            </div>

            <!-- Contacto -->
            <div class="col-md-4 mb-3">
                <h6>Contacto</h6>
                <p class="small mb-1"><i class="bi bi-envelope-fill me-2"></i> lazarominero23@iessantiagohernandez.com</p>
                <p class="small mb-0"><i class="bi bi-geo-alt-fill me-2"></i> Av. de Navarra 141, Zaragoza, España</p>
            </div>
        </div>

        <div class="text-center mt-3">
            <small>&copy; {{ date('Y') }} No Escape From Game. Todos los derechos reservados.</small>
        </div>
    </div>
</footer>
</html>
