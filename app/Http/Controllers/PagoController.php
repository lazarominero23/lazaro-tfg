<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Charge;
use Stripe\Stripe;

class PagoController extends Controller
{
    public function mostrarFormulario(){
        return view('formularioPago');
    }

    public function mostrarPagoExitoso(){
        return view('pagoExitoso');
    }

    public function confirmar(Request $request)
    {
        $carrito = session('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('rutaMostrarProductos')->with('error', 'El carrito está vacío.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'direccion' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:10',
            'telefono' => 'required|string|max:20',
            'stripeToken' => 'required|string',
        ]);

        // Calcular total
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

      

        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            // Crear el cargo
            Charge::create([
                'amount' => intval($total * 100), // en céntimos
                'currency' => 'eur',
                'description' => 'Pago de pedido No Escape From Game',
                'source' => $request->stripeToken,
                'receipt_email' => $request->email,
            ]);

            DB::beginTransaction();

            // Crear pedido
            $pedido = Pedido::create([
                'idUsuario' => auth()->id(),
                'fecha' => now(),
                'precio_total' => $total,
            ]);

            // Insertar detalles
            foreach ($carrito as $idProducto => $item) {
                DB::table('detalles_pedido')->insert([
                    'idPedido'   => $pedido->id,
                    'idProducto' => $idProducto,
                    'cantidad'   => $item['cantidad'],
                    'subtotal'   => $item['precio'] * $item['cantidad'],
                ]);
            
                // Reducir stock del producto
                $producto = Producto::find($idProducto);
                if ($producto) {
                    $producto->stock -= $item['cantidad'];
                    $producto->save();
                }
            }

            DB::commit();
            session()->forget('carrito');

            return redirect()->route('rutaMostrarPagoExitoso')->with('success', 'Pago realizado y pedido confirmado.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }
}