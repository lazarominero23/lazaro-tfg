<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [InicioController::class, 'index'])->name('rutaIndex');

// Rutas para el registro
Route::get('/registro', [AuthController::class, 'showRegistrationForm'])->name('rutaFormularioRegistro');
Route::post('/registro', [AuthController::class, 'register'])->name('register');

// Rutas para el inicio de sesión
Route::get('/iniciar_sesion', [AuthController::class, 'showLoginForm'])->name('rutaFormularioInicio');
Route::post('/iniciar_sesion', [AuthController::class, 'login'])->name('login');

// Ruta para cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/historial', [AuthController::class, 'verHistorial'])->name('verHistorial');

// Ruta para productos
Route::get('/productos', [ProductoController::class, 'mostrarProductos'])->name('rutaMostrarProductos');
Route::get('/videojuegos', [ProductoController::class, 'mostrarVideojuegos'])->name('rutaMostrarVideojuegos');
Route::get('/merchandising', [ProductoController::class, 'mostrarMerchandising'])->name('rutaMostrarMerchandising');
Route::post('/productos/añadirProducto', [ProductoController::class, 'add'])->name('rutaAñadirProducto');
Route::get('/filter', [ProductoController::class, 'filter'])->name('metodoFilter');
Route::get('/filtrarCategoria', [ProductoController::class, 'filtrarCategoria'])->name('metodoFiltrarCategoria');
Route::get('/producto/{id}', [ProductoController::class, 'mostrarDetalles'])->name('mostrarDetallesProducto');
Route::post('/producto/{id}/resena', [ProductoController::class, 'anadirResena'])->name('enviarResena')->middleware('auth');

// Ruta para carrito
Route::post('/agregar-carrito/{id}', [CarritoController::class, 'agregar'])->name('agregarAlCarrito');
Route::delete('/productos/vaciar', [CarritoController::class, 'vaciarCarrito'])->name('metodoVaciarCarrito');
Route::delete('/productos/quitar/{id}', [CarritoController::class, 'quitarDelCarrito'])->name('metodoQuitarDelCarrito');
Route::patch('/productos/modificar/{id}/{accion}', [CarritoController::class, 'modificarCantidad'])->name('metodoModificarCantidad');

// Ruta para pago
Route::get('/formularioPago', [PagoController::class, 'mostrarFormulario'])->name('rutaMostrarFormularioPago');
Route::post('/confirmar-pago', [PagoController::class, 'confirmar'])->name('confirmarPago');
Route::get('/confirmacion-pago', [PagoController::class, 'mostrarPagoExitoso'])->name('rutaMostrarPagoExitoso');

// Mostrar formulario para cambiar contraseña
Route::get('/cambiar-password', [AuthController::class, 'showChangePasswordForm'])->name('formularioPassword')->middleware('auth');

// Procesar formulario de cambio de contraseña
Route::post('/cambiar-password', [AuthController::class, 'cambiarPassword'])->name('cambiarPassword')->middleware('auth');