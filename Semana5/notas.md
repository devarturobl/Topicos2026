# Documento de Referencia — Proyecto ToDo (Semana5)

Fecha: 26-02-2026

Resumen
- Proyecto simple de gestión de tareas (ToDo) con autenticación de usuarios usando PHP y MySQL.
- Funcionalidad: registro de usuarios, inicio de sesión, CRUD de tareas (crear, leer, actualizar, borrar), cierre de sesión.

Requisitos
- Servidor local PHP (p.ej. WAMP/XAMPP) con MySQL.
- Importar la tabla `tareas` desde `tareas.sql`.
- Crear manualmente la tabla `usuarios` (esquema sugerido en la sección de BD).

Estructura de archivos y descripción
- [index.php](index.php)
  - Página de inicio / login. Comprueba credenciales contra la tabla `usuarios`. Usa `password_verify()` para validar contraseña.

- [registro.php](registro.php)
  - Formulario de registro. Inserta en `usuarios` los campos `username`, `email`, `password` (guardado con `password_hash`).

- [conexion.php](conexion.php)
  - Establece la conexión MySQL con `mysqli_connect` y asigna el objeto a `$conn`. Si falla, redirige a [errorconn.php](errorconn.php).

- [errorconn.php](errorconn.php)
  - Página amistosa que muestra un error de conexión al servidor.

- [validate.php](validate.php)
  - Módulo de control de acceso. Llamar con `include 'validate.php'` en páginas que requieran sesión iniciada. Verifica `$_SESSION['username']`.

- [bienvenida.php](bienvenida.php)
  - Panel principal después del login. Lista las tareas del usuario actual (filtra por `email_id = $_SESSION['username']`). Proporciona enlaces a `agregar.php`, `editar.php`, `borrar.php` y botón de `logout.php`.

- [agregar.php](agregar.php)
  - Formulario para crear una nueva tarea. Inserta en `tareas` con `titulo` y `email_id` (usuario actual). Redirige a `index.php` después de insertar.

- [editar.php](editar.php)
  - Permite editar el título y estado (`completado`) de una tarea específica (identificada por `id`).

- [borrar.php](borrar.php)
  - Elimina una tarea por `id` y redirige al listado.

- [demomostrar.php](demomostrar.php)
  - Página de demo protegida por sesión (usa `validate.php`).

- [logout.php](logout.php)
  - Destruye la sesión y redirige a `index.php`.

Base de datos (esquema)
- Archivo importable: `tareas.sql` (contiene la tabla `tareas`):
  - Tabla `tareas` (definida en `tareas.sql`):
    - `id` INT AUTO_INCREMENT PRIMARY KEY
    - `titulo` VARCHAR(255)
    - `completado` TINYINT(1) DEFAULT 0
    - `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  - Ejemplo de datos incluidos en `tareas.sql`.

- Tabla `usuarios` (no incluida en SQL del repo; esquema sugerido):
  - CREATE TABLE usuarios (
      id INT AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(100) NOT NULL,
      email VARCHAR(255) NOT NULL UNIQUE,
      password VARCHAR(255) NOT NULL
    );

Flujos principales
1. Registro
  - Usuario va a [registro.php](registro.php) → envía `nombre`, `email`, `password` → `password_hash()` genera hash → inserción en `usuarios`.
2. Login
  - Usuario va a [index.php](index.php) → busca por `email` en `usuarios` → `password_verify()` valida → si OK, setea `$_SESSION['username']` con el email y redirige a [bienvenida.php](bienvenida.php).
3. Gestión de tareas (usuario autenticado)
  - [bienvenida.php](bienvenida.php) consulta `tareas` filtrando por `email_id = $_SESSION['username']` y muestra CRUD.
  - Crear: [agregar.php](agregar.php) inserta nueva fila con `email_id` igual al email del usuario.
  - Editar: [editar.php](editar.php) actualiza `titulo` y `completado` por `id`.
  - Borrar: [borrar.php](borrar.php) elimina por `id`.

Notas de seguridad y mejoras sugeridas
- Inyección SQL: el código usa concatenación directa en consultas (p. ej. `"INSERT INTO tareas ... VALUES ('$titulo', '...')"`). Recomendación: usar consultas preparadas (`mysqli_prepare` / `PDO`) para evitar SQL Injection.
- Validación de permisos: actualmente las operaciones sobre `tareas` usan solo `id` y `email_id` no siempre se verifica; validar que la tarea pertenece al usuario autenticado antes de permitir editar/borrar.
- Manejo de errores: muchas operaciones muestran `echo "Error: " . $conn->error;` en producción esto podría filtrar información sensible; mejor registrar errores en archivos de log y mostrar mensajes genéricos al usuario.
- CSRF: formularios no usan tokens CSRF; agregar protección para operaciones que modifican datos.
- Sesiones: se usa `$_SESSION['username']` con el email; sería mejor almacenar el `id` del usuario y consultar por `id` para evitar problemas si el email cambia.

Cómo poner en marcha (rápido)
1. Configurar WAMP/XAMPP y crear base de datos (`unidad1` o la que use `conexion.php`).
2. Importar `tareas.sql` en la base de datos.
3. Crear la tabla `usuarios` según el esquema sugerido.
4. Colocar la carpeta del proyecto en el `www` del servidor local.
5. Abrir en el navegador `http://localhost/Topicos/Semana5/index.php`.

Archivos disponibles en el proyecto
- [index.php](index.php)
- [registro.php](registro.php)
- [conexion.php](conexion.php)
- [errorconn.php](errorconn.php)
- [validate.php](validate.php)
- [bienvenida.php](bienvenida.php)
- [agregar.php](agregar.php)
- [editar.php](editar.php)
- [borrar.php](borrar.php)
- [demomostrar.php](demomostrar.php)
- [logout.php](logout.php)
- [tareas.sql](tareas.sql)

Siguientes pasos recomendados (opcionales)
- Reemplazar consultas por consultas preparadas.
- Usar `id` de usuario en sesión en lugar del email.
- Añadir manejo de roles/privilegios si el proyecto crece.
- Añadir tests y documentación adicional de la API.

---
Generado automáticamente: resumen y guía de lectura del código fuente para facilitar mantenimiento y extensión.
