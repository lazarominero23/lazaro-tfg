<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>No Escape From Game | Inicio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            text-align: center;
            padding: 20px;
        }

        #imagenHome {
            width: 60%;
            max-width: 650px;
            height: auto;
            margin: 20px 0;
        }

        .btn {
            border: none;
            margin-top: 20px;
        }

        .carousel-inner img {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h1>No Escape From Game</h1>
    <p>¡Bienvenido/a a mi página! Echa un vistazo a los productos y compra lo que te llame la atención.</p>
    
    <!-- Carrusel Bootstrap -->
    <div id="carouselExample" class="carousel slide mt-4" style="max-width: 650px; margin: 0 auto;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./images/imagen-home1.jpg" class="d-block w-100" alt="Imagen 1">
            </div>
            <div class="carousel-item">
                <img src="./images/imagen-home2.jpg" class="d-block w-100" alt="Imagen 2">
            </div>
            <div class="carousel-item">
                <img src="./images/imagen-home3.jpg" class="d-block w-100" alt="Imagen 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <br>
    <a href="{{route('rutaMostrarProductos')}}"><input type="submit" value="Acceder a la página" class="btn btn-dark"></a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>