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
    </style>
</head>
<body>
    <h1>No Escape From Game</h1>
    <p>¡Bienvenido/a a mi página! Echa un vistazo a los productos y compra lo que te llame la atención.</p>
    <img src="./images/imagen-home1.jpg" alt="Inicio" id="imagenHome">
    <br>
    <a href="{{route('rutaMostrarProductos')}}"><input type="submit" value="Acceder a la página" class="btn btn-dark"></button></a>
</body>
</html>