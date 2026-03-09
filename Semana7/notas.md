# Proyecto unidad 2
Siimulación de un sistema real de logística como los que usan empresas como Mercado Libre, Amazon o DHL.
**Proyecto completo para una unidad de programación o bases de datos**.

# 1. Concepto del sistema

Nombre: **Sistema de Seguimiento Logístico de Pedidos**

Objetivo:
Simular el proceso de compra, envío y entrega de un producto con seguimiento en tiempo real.

---

# 2. Flujo de estados del pedido

### Estados del pedido

1️⃣ **Pedido registrado**
2️⃣ **Solicitud de compra aceptada**
3️⃣ **Producto preparado para envío**
4️⃣ **Paquete enviado**
5️⃣ **En tránsito a centro logístico de origen**
6️⃣ **Recibido en centro logístico de origen**
7️⃣ **En tránsito (aéreo / terrestre / marítimo)**
8️⃣ **Recibido en centro logístico de destino**
9️⃣ **En reparto local**
🔟 **Paquete entregado**

Opcionales:

* Retraso en envío
* Paquete dañado
* Dirección incorrecta
* Devolución

---

# 3. Base de datos

### Tabla usuarios

```sql
usuarios
-------
id
nombre
email
password
tipo_usuario (cliente, operador, admin)
```

---

### Tabla pedidos

```sql
pedidos
-------
id
numero_seguimiento
usuario_id
producto
descripcion
origen
destino
fecha_registro
estado_actual
```

---

### Tabla historial_estados

```sql
historial_estados
-----------------
id
pedido_id
estado
fecha
ubicacion
comentario
usuario_operador
```

Ejemplo:

| pedido | estado               | fecha |
| ------ | -------------------- | ----- |
| 001    | Pedido registrado    | 10:00 |
| 001    | En tránsito          | 12:00 |
| 001    | Recibido en estación | 16:00 |

---

# 4. Módulos del sistema

## 1️⃣ Registro de pedido

Formulario:

* producto
* descripción
* origen
* destino

El sistema genera:

```
MLX-2026-00001
```

(número de seguimiento)

---

## 2️⃣ Panel del operador logístico

Los operadores pueden cambiar estados:

* aceptar pedido
* marcar envío
* registrar llegada

---

## 3️⃣ Seguimiento del cliente

El cliente ingresa:

```
Número de seguimiento
```

Y ve algo como:

```
Pedido: MLX-2026-00001

✔ Pedido registrado
✔ Solicitud aceptada
✔ En tránsito a estación origen
✔ Recibido estación origen
✔ En tránsito aéreo
⬜ En reparto
⬜ Entregado
```

---

## 4️⃣ Historial del paquete

Tabla cronológica:

| Fecha | Estado            | Ubicación |
| ----- | ----------------- | --------- |
| 10:00 | Pedido registrado | Puebla    |
| 12:00 | En tránsito       | CDMX      |

---

# 5. Tecnologías recomendadas para la práctica

Como tú trabajas con **PHP y MySQL**, una buena combinación sería:

Frontend

* HTML
* CSS
* Bootstrap

Backend

* PHP

Base de datos

* MySQL

Extras opcionales

* AJAX
* API REST
* QR para seguimiento

---

# 6. Extras que harían el proyecto MUCHO mejor (nivel profesional)

### 1️⃣ Mapa del recorrido

Mostrar rutas con Google Maps.

---

### 2️⃣ Código QR

El paquete puede tener un QR que abra:

```
misenvios.com/seguimiento/MLX-2026-001
```

---

### 3️⃣ Simulación automática de estados

Cada cierto tiempo el sistema cambia estados automáticamente.

---

### 4️⃣ Dashboard logístico

Panel con estadísticas:

* pedidos entregados
* en tránsito
* retrasados

---

# 7. Idea para que sea una práctica más interesante para alumnos

Puedes pedirles:

✔ diseñar la **base de datos**
✔ crear el **registro de pedidos**
✔ implementar **seguimiento por número**
✔ mostrar **historial del paquete**

Nivel avanzado:

✔ roles de usuario
✔ panel logístico
✔ QR

---

✅ Si quieres, también puedo darte:

* **el modelo completo de base de datos (SQL listo)**
* **la estructura de carpetas del proyecto PHP**
* **un diseño de interfaz tipo Mercado Libre**
* **una idea de algoritmo de simulación de envíos**

para que esta práctica quede **muy profesional para tus alumnos**.
