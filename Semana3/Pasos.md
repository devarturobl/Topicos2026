# Proyecto ToDo con inicio de sesion
Paso 1: La Base de Datos 🗄️
Antes de escribir código PHP, necesitamos un lugar donde guardar a los usuarios. Necesitamos una tabla llamada usuarios (o users).

Para un sistema de login básico, ¿qué columnas crees que debería tener esta tabla para identificar a una persona y permitirle entrar de forma segura?

R = Nombre o identificador de usuario y una contraseña

Estructura de la tabla usuarios

| Campo | Tipo de dato | Descripción |
|-------|--------------|-------------|
| id 🆔 | INT | Un número único para cada usuario. Usaremos AUTO_INCREMENT y PRIMARY KEY. |
| username 👤 | VARCHAR(50) | El nombre de usuario. Debe ser UNIQUE para que no se repitan. |
| password 🔑 | VARCHAR(255) | Guardaremos el "hash" de la contraseña, por eso necesita espacio suficiente. |

## Preparando la conexión en PHP 🔗
Ahora que tenemos clara la estructura, el siguiente paso es conectar nuestro código PHP con la base de datos. Usaremos la extensión mysqli con el enfoque de objetos, que es más moderno y limpio.

Para establecer la conexión, PHP necesita saber cuatro cosas:

+ El servidor (normalmente localhost).
+ El usuario de la base de datos (por defecto suele ser root).
+ La contraseña del usuario de la base de datos.
+ El nombre de la base de datos que creaste.

### Archivo de Conexion
