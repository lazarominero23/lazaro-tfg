<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Videojuegos
        $nuevoProducto = new Producto();
        $nuevoProducto->nombre = "Red Dead Redemption 2";
        $nuevoProducto->descripcion = "La épica aventura del lejano oeste, con una historia de venganza y supervivencia en un mundo abierto lleno de detalles.";
        $nuevoProducto->precio = 59.99;
        $nuevoProducto->stock = 50;
        $nuevoProducto->categoria = "Videojuegos";
        $nuevoProducto->imagen = "rdr2.jpg";
        $nuevoProducto->save();

        $nuevoProducto = new Producto();
        $nuevoProducto->nombre = "The Legend of Zelda: Breath of the Wild";
        $nuevoProducto->descripcion = "Explora el vasto reino de Hyrule en este juego de aventuras y acción, con un mundo abierto y un estilo de juego innovador.";
        $nuevoProducto->precio = 69.99;
        $nuevoProducto->stock = 40;
        $nuevoProducto->categoria = "Videojuegos";
        $nuevoProducto->imagen = "zeldabotw.jpg";
        $nuevoProducto->save();

        $nuevoProducto = new Producto();
        $nuevoProducto->nombre = "God of War (2018)";
        $nuevoProducto->descripcion = "Kratos regresa en esta aventura épica, enfrentándose a los dioses nórdicos mientras explora un mundo lleno de mitología y acción.";
        $nuevoProducto->precio = 49.99;
        $nuevoProducto->stock = 35;
        $nuevoProducto->categoria = "Videojuegos";
        $nuevoProducto->imagen = "gow2018.jpg";
        $nuevoProducto->save();

        // Consolas
        $nuevoProducto = new Producto();
        $nuevoProducto->nombre = "PlayStation 5";
        $nuevoProducto->descripcion = "La última consola de Sony con gráficos 4K, tiempos de carga ultra rápidos y una experiencia de juego más inmersiva.";
        $nuevoProducto->precio = 499.99;
        $nuevoProducto->stock = 15;
        $nuevoProducto->categoria = "Consolas";
        $nuevoProducto->imagen = "ps5.jpg";
        $nuevoProducto->save();

        $nuevoProducto = new Producto();
        $nuevoProducto->nombre = "Xbox Series X";
        $nuevoProducto->descripcion = "La consola más potente de Microsoft, diseñada para ofrecer gráficos 4K y una experiencia de juego fluida y rápida.";
        $nuevoProducto->precio = 499.99;
        $nuevoProducto->stock = 20;
        $nuevoProducto->categoria = "Consolas";
        $nuevoProducto->imagen = "xboxseriesx.jpg";
        $nuevoProducto->save();

        $nuevoProducto = new Producto();
        $nuevoProducto->nombre = "Nintendo Switch OLED";
        $nuevoProducto->descripcion = "Disfruta de la versatilidad de la Nintendo Switch en su versión OLED, con una pantalla más grande y brillante para una experiencia portátil mejorada.";
        $nuevoProducto->precio = 349.99;
        $nuevoProducto->stock = 30;
        $nuevoProducto->categoria = "Consolas";
        $nuevoProducto->imagen = "switch.jpg";
        $nuevoProducto->save();

        // Merchandising
        $nuevoProducto = new Producto();
        $nuevoProducto->nombre = "Taza de Super Mario";
        $nuevoProducto->descripcion = "Una taza de cerámica con el icónico diseño de Super Mario. Perfecta para los fans del fontanero más famoso del mundo.";
        $nuevoProducto->precio = 14.99;
        $nuevoProducto->stock = 100;
        $nuevoProducto->categoria = "Merchandising";
        $nuevoProducto->imagen = "tazamario.jpg";
        $nuevoProducto->save();

        $nuevoProducto = new Producto();
        $nuevoProducto->nombre = "Camiseta de Zelda";
        $nuevoProducto->descripcion = "Camiseta oficial de The Legend of Zelda con un diseño clásico del Triforce. Hecha de algodón de alta calidad.";
        $nuevoProducto->precio = 24.99;
        $nuevoProducto->stock = 75;
        $nuevoProducto->categoria = "Merchandising";
        $nuevoProducto->imagen = "camisetazelda.jpg";
        $nuevoProducto->save();

        $nuevoProducto = new Producto();
        $nuevoProducto->nombre = "Figura Funko Pop! - Geralt de Rivia";
        $nuevoProducto->descripcion = "Figura coleccionable Funko Pop! de Geralt de Rivia, el protagonista de The Witcher, ideal para decorar tu espacio gamer.";
        $nuevoProducto->precio = 19.99;
        $nuevoProducto->stock = 50;
        $nuevoProducto->categoria = "Merchandising";
        $nuevoProducto->imagen = "funkogeralt.jpg";
        $nuevoProducto->save();
    }
}
