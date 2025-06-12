<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Resena;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function mostrarProductos(){
        $productos = Producto::paginate(10);

        return view('productos', ['productos' => $productos]);
    }

    public function mostrarVideojuegos()
    {
        $productos = Producto::where('categoria', 'Videojuegos')->paginate(10);
        return view('videojuegos', compact('productos'));
    }

    public function mostrarMerchandising()
    {
        $productos = Producto::where('categoria', 'Merchandising')->paginate(10);
        return view('videojuegos', compact('productos'));
    }

    public function add(Request $request)
    {
        $productoPrecio = $request->productoPrecio;

        if (!isset($_SESSION['productosPedido'])) {
            $productosPedido = [];
        } else {
            $productosPedido = $_SESSION['productosPedido'];
        }

        $productosPedido[] = $productoPrecio;

        $_SESSION['productosPedido'] = $productosPedido;

        return redirect()->route('rutaMostrarProductos');
    }

    public function filter(Request $request)
    {
        $productos = Producto::where('nombre', 'like', '%' . $request->nombre . '%')->paginate(5);

        return view('productos', ['productos' => $productos]);
    }

    public function filtrarCategoria(Request $request)
    {
        // Iniciamos la consulta para los productos
        $query = Producto::query();

        // Filtramos por nombre si se ha proporcionado
        if ($request->has('nombre') && $request->nombre != '') {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        // Filtramos por categoría si se ha seleccionado una categoría
        if ($request->has('categoria') && $request->categoria != '') {
            $query->where('categoria', $request->categoria);
        }

        // Obtenemos los productos filtrados
        $productos = $query->paginate(10);

        // Retornamos la vista con los productos filtrados
        return view('productos', ['productos' => $productos]);
    }

    public function mostrarDetalles($id)
    {
        // Obtener el producto por su ID
        $producto = Producto::findOrFail($id);

        // Retornar la vista con el producto
        return view('detallesproducto', compact('producto'));
    }

    public function anadirResena(Request $request, $id)
{
    $request->validate([
        'puntuacion' => 'required|integer|min:1|max:5',
        'comentario' => 'nullable|string|max:500',
    ]);

    try {
        Resena::create([
            'idUsuario'   => Auth::id(),
            'idProducto'  => $id,
            'puntuacion'   => $request->puntuacion,
            'comentario'  => $request->comentario,
        ]);

        return redirect()->route('mostrarDetallesProducto', $id)->with('success', 'Gracias por tu reseña.');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Error al guardar la reseña: ' . $e->getMessage()]);
    }
}

}