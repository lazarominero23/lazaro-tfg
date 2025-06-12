<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>No Escape From Game | Historial de Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Historial de {{ Auth::user()->nombre }}</h2>

        {{-- Sección: Transacciones --}}
        <div class="mb-5">
            <h4 class="mb-3">Transacciones</h4>

            @forelse ($transacciones as $transaccion)
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between">
                        <span><strong>Fecha:</strong> {{ $transaccion->created_at->format('d/m/Y H:i') }}</span>
                        @php
                            $total = $transaccion->detalles->sum('subtotal');
                        @endphp

                        <span><strong>Total:</strong> {{ number_format($total, 2) }} €</span>

                    </div>
                    <ul class="list-group list-group-flush">
                    @foreach ($transaccion->detalles as $detalle)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $detalle->producto->nombre }} 
                            <span>{{ number_format($detalle->subtotal, 2) }} €</span>
                        </li>
                    @endforeach
                    </ul>
                </div>
            @empty
                <div class="alert alert-warning">No se encontraron transacciones.</div>
            @endforelse
        </div>

        {{-- Sección: Reseñas --}}
        <div class="mb-5">
            <h4 class="mb-3">Reseñas Escritas</h4>

            @forelse ($resenas as $resena)
                <div class="border p-3 mb-3 rounded bg-light">
                    <strong>{{ $resena->producto->nombre }}</strong>
                    <span class="text-warning">({{ $resena->puntuacion }} ★)</span>
                    <p class="mb-0">{{ $resena->comentario }}</p>
                    <small class="text-muted">Fecha: {{ $resena->created_at->format('d/m/Y H:i') }}</small>
                </div>
            @empty
                <div class="alert alert-info">Aún no has escrito reseñas.</div>
            @endforelse
        </div>

        <a href="{{ route('rutaMostrarProductos') }}" class="btn btn-secondary">Volver al inicio</a>
    </div>
</body>
</html>
