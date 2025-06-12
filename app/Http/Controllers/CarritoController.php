<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function agregar(Request $request, $id){

        $producto = Producto::findOrFail($id);
        $carrito = session()->get('carrito', []);
        $cantidadDeseada = $request->input('cantidad', 1);

        if (!is_numeric($cantidadDeseada) || $cantidadDeseada < 1) {
            return back()->with('error', 'Cantidad inválida.');
        }

        // Si el producto ya está en el carrito, sumamos
        $cantidadTotal = isset($carrito[$id])
            ? $carrito[$id]['cantidad'] + $cantidadDeseada
            : $cantidadDeseada;

        if ($cantidadTotal > $producto->stock) {
            return back()->with('error', 'No hay suficiente stock disponible para "' . $producto->nombre . '". Stock disponible: ' . $producto->stock);
        }

        $carrito[$id] = [
            'imagen' => $producto->imagen,
            "nombre" => $producto->nombre,
            "precio" => $producto->precio,
            "imagen" => $producto->imagen,
            "categoria" => $producto->categoria,
            "cantidad" => $cantidadDeseada,
        ];

        session()->put('carrito', $carrito);

        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    public function modificarCantidad(Request $request, $id, $accion)
    {
        // Validamos que la acción sea válida
        if (!in_array($accion, ['incrementar', 'decrementar'])) {
            return redirect()->back()->with('error', 'Acción no válida');
        }

        $carrito = session()->get('carrito', []);

        // Verificamos si el producto existe en el carrito
        if (isset($carrito[$id])) {
            if ($accion === 'incrementar') {
                $carrito[$id]['cantidad'] += 1; // Incrementamos la cantidad
            } elseif ($accion === 'decrementar') {
                $carrito[$id]['cantidad'] -= 1; // Decrementamos la cantidad
                if ($carrito[$id]['cantidad'] <= 0) {
                    unset($carrito[$id]); // Eliminar si la cantidad llega a 0 o menos
                }
            }
        }

        // Guardamos el carrito actualizado en la sesión
        session()->put('carrito', $carrito);

        // Redirigimos con un mensaje de éxito
        return redirect()->back()->with('success', 'Cantidad actualizada');
    }

    public function quitarDelCarrito($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }
}
