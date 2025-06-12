<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>No Escape From Game | Pago Confirmado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-overlay {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 50;
        }
        .modal-box {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .check-icon {
            background-color: #d1fae5;
            color: #10b981;
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }
        .modal-button {
            background-color: #3b82f6;
            color: white;
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 1rem;
        }
        .modal-button:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>
    <div class="modal-overlay">
        <div class="modal-box">
            <div class="check-icon">
                <i class="ri-check-line"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">¡Pago exitoso!</h3>
            <p class="text-gray-600 mb-6">Tu pedido ha sido confirmado correctamente. Pronto recibirás un correo de confirmación.</p>
            <a href="{{ route('rutaMostrarProductos') }}">
                <button class="modal-button">Volver al inicio</button>
            </a>
        </div>
    </div>
</body>
</html>
