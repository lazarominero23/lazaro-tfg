# Tienda Online de Videojuegos - TFG

**NOTA:** Este proyecto de Github ya está congelado, lo cual no permitirá commits a partir de ahora.

Soy Gabriel Lázaro, estudiante del curso DAW2 en el IES Santiago Hernández y este proyecto es mi Trabajo de Fin de Grado (TFG). Consiste en el desarrollo de una **plataforma web de comercio electrónico especializada en videojuegos, consolas y merchandising**.  
El objetivo es ofrecer a los usuarios la posibilidad de registrarse, explorar productos, dejar reseñas y realizar compras a través un formulario de pago.

---

## Tecnologías utilizadas

- **Laravel** (PHP)
- **Blade** (motor de plantillas)
- **MySQL** (base de datos relacional)
- **HTML5 / CSS3 / JavaScript**
- **Bcrypt** (para cifrado de contraseñas)

---

## Estructura del Proyecto

### Vistas principales (`resources/views`)
Estas son las vistas que componen el flujo de la aplicación:

- `inicio.blade.php` — Página de inicio con carrusel de imágenes y botón de acceso a productos.
- `productos.blade.php` — Página que muestra todos los productos disponibles.
- `videojuegos.blade.php`, `merchandising.blade.php` — Vistas filtradas por tipo de producto.
- `detalleProducto.blade.php` — Página de detalles individuales del producto (incluye reseñas).
- `formLogin.blade.php` — Formulario de inicio de sesión.
- `formRegistro.blade.php` — Formulario de registro de nuevos usuarios.
- `formPago.blade.php` — Formulario para ingresar datos de facturación y confirmar pedido.
- `pagoExitoso.blade.php` — Confirmación de pedido exitoso.
- `historial.blade.php` — Historial del usuario con reseñas y pedidos anteriores.

---

### Modelos (`app/Models`)

- `Usuario` — Representa a los usuarios registrados.
- `Producto` — Incluye información como nombre, tipo, descripción, precio e imagen.
- `Reseña` — Comentarios y puntuaciones de los productos.
- `Pedido` — Registra los pedidos procesados.
- `DetallePedido` — Relación entre pedido y productos individuales.

---

### Factories (`database/factories`)

- `UsuarioFactory` — Generación de usuarios de prueba.
- `ProductoFactory` — Generación de productos de ejemplo para pruebas iniciales.

---

### Controladores (`app/Http/Controllers`)

- `AuthController` — Registro, login, logout, y gestión de sesiones.
- `CarritoController` — Gestión del carrito de compra.
- `InicioController` — Controlador de la página principal.
- `PagoController` — Procesamiento de formularios de pago y pedidos.
- `ProductoController` — Muestra productos, detalles, búsqueda y filtrado por categoría.

---

## Funcionalidades clave

- **Autenticación**: solo los usuarios autenticados pueden añadir productos al carrito o realizar compras.
- **Carrito interactivo**: botón desplegable que permite ver productos añadidos y acceder al pago.
- **Sistema de reseñas**: cada producto puede recibir valoraciones del 1 al 5 y comentarios.
- **Historial del usuario**: permite consultar pedidos anteriores y reseñas realizadas.
- **Filtrado y búsqueda**: por categoría o por nombre del producto.
- **Formulario de pago con validación**: garantiza que todos los datos sean introducidos correctamente antes de procesar el pedido.
- **Diseño adaptable**: vistas diferenciadas para usuarios autenticados e invitados.

---

## Organización del flujo

Inicio
 └── Productos
       ├── Detalle Producto
       │     └── Reseñas
       └── Carrito
              └── Pago
                     └── Confirmación
Historial
 ├── Pedidos
 └── Reseñas