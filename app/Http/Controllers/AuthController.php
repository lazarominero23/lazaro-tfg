<?php

namespace App\Http\Controllers;

use App\Models\Usuario; // Asegúrate de importar tu modelo de Usuario
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar el formulario de registro
    public function showRegistrationForm()
    {
        return view('formularioregistro'); // Asegúrate de que esta vista esté creada
    }

    public function register(Request $request)
    {
        // Validación de los campos
        $validator = Validator::make($request->all(), [
            'nombre' => [
                'required',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u',
                'max:255'
            ],
            'correo' => [
                'required',
                'regex:/^[^@]+@[^@]+\.[^@]+$/',
                'max:255',
                'unique:usuarios,correo'
            ],
            'direccion' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed', // Confirmación de contraseña
        ], [
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'nombre.required' => 'El nombre es obligatorio.',
            'correo.regex' => 'El formato del correo debe ser texto@texto.texto.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.unique' => 'Este correo ya está registrado.',
            'direccion.required' => 'La dirección es obligatoria.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crear el usuario
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'direccion' => $request->direccion,
            'password' => bcrypt($request->password), // Usamos bcrypt para cifrar la contraseña
        ]);

        // Iniciar sesión automáticamente después del registro
        Auth::login($usuario);

        // Verificar que el usuario esté autenticado correctamente
        if (Auth::check()) {
            // Redirigir al usuario a la página principal o donde desees
            return redirect()->route('rutaMostrarProductos');
        } else {
            // Si no está autenticado, redirigir a la página de inicio de sesión
            return redirect()->route('rutaFormularioInicio')->withErrors(['login' => 'Hubo un error al iniciar sesión.']);
        }
    }

    // Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('formularioinicio'); // Vista para el formulario de inicio de sesión
    }

    // Mostrar el historial de usuario
    public function verHistorial()
    {
        $usuario = Auth::user();

        /** @var \App\Models\Usuario $usuario */
        // Cargar pedidos con detalles y productos
        $pedidos = $usuario->pedidos()
            ->with(['detalles.producto'])
            ->orderBy('fecha', 'desc')
            ->get();

        $resenas = $usuario->resenas()
            ->with('producto')
            ->orderBy('created_at', 'desc')
            ->get();

            return view('historial', [
                'usuario' => $usuario,
                'transacciones' => $pedidos, // <- renombramos pedidos como transacciones
                'resenas' => $resenas,
            ]);
            
    }

    // Manejar el inicio de sesión
    public function login(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar iniciar sesión
        if (Auth::attempt(['correo' => $request->correo, 'password' => $request->password])) {
            return redirect()->route('rutaMostrarProductos'); // Redirigir al usuario al inicio o a donde esté su destino original
        }

        return back()->withErrors([
            'correo' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect()->route('rutaMostrarProductos'); // Redirigir al inicio de sesión
    }

    // Mostrar el formulario de cambio de contraseña
    public function showChangePasswordForm()
    {
        return view('formularioPassword');
    }

    // Procesar el cambio de contraseña
    public function cambiarPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $usuario = Auth::user();

        // Verificar si la nueva contraseña es la misma que la actual
        if (Hash::check($request->password, $usuario->password)) {
            return back()->with('misma_password', 'La contraseña introducida es la que ya tienes actualmente.');
        }

        $usuario->password = Hash::make($request->password);

        /** @var \App\Models\Usuario $usuario */
        $usuario->save();

        return redirect()->route('rutaMostrarProductos')->with('success', 'La contraseña actualizada correctamente.');
    }
}
