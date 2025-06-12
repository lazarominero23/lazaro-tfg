<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>No Escape From Game | Confirmar pago</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <!-- IZQUIERDA: Datos de facturación -->
            <div class="col-md-6">
                <h3 class="mb-4">Datos de Facturación</h3>

                @php
                    $carrito = session('carrito', []);
                    $total = 0;
                    if (count($carrito) > 0) {
                        foreach ($carrito as $item) {
                            $subtotal = $item['subtotal'] ?? ($item['precio'] * $item['cantidad']);
                            $total += $subtotal;
                        }
                    }
                @endphp

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form id="payment-form" action="{{ route('confirmarPago') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required />
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" id="email" required />
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" required />
                    </div>

                    <div class="mb-3">
                        <label for="codigo_postal" class="form-label">Código postal</label>
                        <input type="text" class="form-control" name="codigo_postal" id="codigo_postal" required />
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" required />
                    </div>

                    <div class="mb-3">
                        <label for="card-element" class="form-label">Tarjeta de crédito</label>
                        <div id="card-element" class="form-control"></div>
                    </div>

                    <input type="hidden" name="total" value="{{ $total }}" />

                    <button type="submit" class="btn btn-success">Confirmar Pago</button>
                    <a href="{{ route('rutaMostrarProductos') }}" class="btn btn-secondary ms-2">Volver a inicio</a>
                </form>
                <br>
            </div>

            <!-- DERECHA: Resumen del pedido -->
            <div class="col-md-6">
                <h2 class="mb-4">Resumen del Pedido</h2>

                @if(count($carrito) > 0)
                    <div class="list-group mb-4">
                        @foreach ($carrito as $item)
                            @php
                                $subtotal = $item['subtotal'] ?? ($item['precio'] * $item['cantidad']);
                            @endphp
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1">{{ $item['nombre'] }}</h5>
                                    <small>Cantidad: {{ $item['cantidad'] }}</small>
                                </div>
                                <span class="fw-bold">{{ number_format($subtotal, 2) }} €</span>
                            </div>
                        @endforeach
                        <div class="list-group-item d-flex justify-content-between align-items-center bg-light">
                            <strong>Total:</strong>
                            <strong>{{ number_format($total, 2) }} €</strong>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning">Tu carrito está vacío.</div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const stripe = Stripe("{{ env('STRIPE_KEY') }}");
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');

            const form = document.getElementById('payment-form');
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const { token, error } = await stripe.createToken(cardElement);
                if (error) {
                    alert(error.message);
                } else {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'stripeToken';
                    hiddenInput.value = token.id;
                    form.appendChild(hiddenInput);
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
