# Manual de Usuario Integral - Sistema Archivística ITSSNA (Sistemarchivista)

---

## 1. Introducción al Sistema

Bienvenido al **Sistema Archivística ITSSNA (Sistemarchivista)**, una plataforma web de gestión documental diseñada específicamente para la organización institucional. Su objetivo principal es automatizar, centralizar y facilitar el control, clasificación y administración de los expedientes físicos y electrónicos que genera o recibe la institución.

Este sistema le permitirá gestionar de manera estructurada el **ciclo de vida documental**, abarcando sus tres fases fundamentales y asegurando el apego normativo:
- **Archivo de Trámite:** Documentos en uso activo.
- **Archivo de Concentración:** Documentos con consulta esporádica que deben conservarse precautoriamente.
- **Disposición Final (Baja o Archivo Histórico):** La destrucción controlada de documentos o su preservación permanente por sus valores testimoniales, evidenciales o informativos.

---

## 2. Acceso y Navegación

Para operar en la plataforma, necesitará un navegador web actualizado (Google Chrome, Firefox, Microsoft Edge) y una conexión a la red donde se aloje el sistema.

1. **Abrir la Plataforma:** Ingrese a la dirección web asignada (por ejemplo, en entornos de desarrollo local es `http://localhost:8000`).
2. **Autenticación Segura:** En la pantalla de inicio de sesión (*Login*), introduzca su cuenta de correo electrónico institucional y contraseña.
3. **Panel Administrativo (Dashboard):** Tras iniciar sesión exitosamente, ingresará al panel de control protegido. Aquí encontrará un menú de navegación (lateral) desde donde podrá acceder a todos los módulos correspondientes a su nivel de acceso.

---

## 3. Configuración Inicial y Estructura Organizacional

Antes de poder crear expedientes o hacer movimientos, es fundamental reflejar la estructura de la institución dentro del sistema.

### 3.1. Gestión de Instituciones
* Ingrese al módulo **Instituciones** para dar de alta a la organización principal, capturando sus datos generales, domicilio fiscal y nombres oficiales. Esto permitirá que los reportes impresos contengan el membrete correcto.

### 3.2. Unidades Administrativas
* En este módulo registrará las diferentes áreas, departamentos o direcciones que conforman a la institución.
* **Campos clave:** Podrá registrar el nombre del área, su **código asignado**, nombre del **titular o responsable**, y definir la jerarquía estructural, indicando si una unidad depende de otra de mayor rango.

---

## 4. Instrumentos de Control Archivístico

Esta es la médula espinal de la organización documental. Se compone de dos herramientas que estructuran cómo se agruparán y por cuánto tiempo se resguardarán los documentos:

### 4.1. Cuadro General de Clasificación Archivística (CGCA)
Permite categorizar la documentación mediante una estructura lógica y codificada:
1. **Secciones:** Definen las grandes funciones sustantivas o áreas comunes de la institución (Ej. Recursos Humanos, Recursos Financieros).
2. **Subsecciones:** Subdividen las secciones para mayor especificidad funcional.
3. **Series Documentales:** El tipo exacto de documentos generados de una misma función (Ej. Expedientes de Personal, Pólizas Contables).
4. **Subseries Documentales:** Variantes más finas dentro de una misma serie.

### 4.2. Catálogo de Disposición Documental (CADIDO / Vigencias)
Por cada Serie o Subserie configurada en el CGCA, este módulo le permitirá establecer las reglas de permanencia en el tiempo y el valor que poseen:
* **Vigencia Documental (Años):** Defina cuánto tiempo (en años) un expediente estará retenido en el **Archivo de Trámite** y, posteriormente, en el **Archivo de Concentración**.
* **Valores Documentales:** Indique si la serie cuenta con valor **Administrativo**, **Legal**, **Fiscal** o **Contable**.
* **Técnica de Selección (Disposición Final):** Determine si los documentos, al expirar su tiempo en Concentración, serán sujetos a **Baja Documental** (eliminación) o si pasarán mediante transferencia al **Archivo Histórico**.

---

## 5. Operación y Gestión de Expedientes

Es el módulo de mayor interacción para la operación diaria, donde los usuarios integran y actualizan las carpetas físicas reflejadas en el sistema.

### 5.1. Registro de Nuevos Expedientes
Al dar clic en "Nuevo Expediente", se desplegará un formulario completo donde deberá capturar:
* **Clasificación y Códigos:** Seleccione la Unidad Administrativa que lo genera y la Serie Documental (del Cuadro General) a la que pertenece. El sistema le ayudará a conformar el código del expediente.
* **Datos Descriptivos:** Ingrese el *Asunto*, una breve *Descripción*, así como la fecha de *apertura* y, cuando aplique, de *cierre*.
* **Características Físicas:** Precise el número de fojas (hojas), la cantidad de legajos o tomos, el estado del trámite y su soporte documental (si es un archivo físico en papel, electrónico, o híbrido).
* **Fase Archivística actual:** Registre en qué archivo se encuentra alojado físicamente (Trámite, Concentración, o Histórico).

### 5.2. Control de Acceso y Clasificación de la Información
El sistema incorpora los principios de Transparencia y Acceso a la Información. Si el expediente o partes del mismo contienen datos sensibles, puede gestionar su privacidad:
* **Información Reservada:** Aplica cuando se trata de información estratégica. Debe registrar la fecha en la que fue clasificada y el periodo de reserva. Al expirar el tiempo, podrá ingresar los datos de **Desclasificación**.
* **Información Confidencial:** Aplica cuando el expediente contiene datos personales que requieren protección indefinida, sin periodo de desclasificación.

### 5.3. Generación e Impresión de Portadas (Ceja)
Una vez guardado el expediente, podrá acceder a la opción de generar e imprimir su **Portada de Expediente**. El sistema generará una vista formateada en PDF o lista para impresión que contiene los códigos y datos requeridos por ley, diseñada para ser adherida al exterior de la carpeta o caja archivadora.

---

## 6. Movimientos y Transferencias Documentales

Para reflejar el flujo de vida del documento, el sistema no solo permite editar expedientes aislados, sino gestionar y autorizar traslados físicos masivos formales entre áreas o archivos.

### 6.1. Tipos de Transferencias
En el módulo de **Transferencias Documentales**, podrá gestionar dos flujos operativos:
* **Transferencia Primaria:** El movimiento formal de los expedientes que ya cumplieron su vigencia en el Archivo de Trámite y son enviados al Archivo de Concentración.
* **Transferencia Secundaria:** El movimiento desde el Archivo de Concentración hacia el Archivo Histórico para su resguardo perpetuo.

### 6.2. Creación de una Transferencia
1. Diríjase a **Transferencias Documentales** y presione "Nueva Transferencia".
2. Seleccione la **Unidad Administrativa de origen** y la **Unidad Administrativa de destino**.
3. Agregue uno a uno en la lista de detalles, los **expedientes específicos** que se incluyen en el paquete de traslado.
4. Añada notas u observaciones referentes al estado general físico de la entrega.

### 6.3. Formatos y Control de Entrega-Recepción
Desde el registro de una transferencia ya guardada, se habilita la opción para generar una vista de impresión conocida como **Inventario de Transferencia Documental**. 
Este reporte, generado automáticamente por el sistema, funge como acuse de recibo y contiene los apartados de firmas oficiales para el responsable que entrega y el archivista que recibe.

---

## 7. Consejos de Uso, Recomendaciones y Seguridad

Para garantizar el éxito en la implementación y orden del Sistema Archivística ITSSNA, considere los siguientes lineamientos:

* **El Orden Importa:** No intente dar de alta expedientes sin antes asegurarse de que los catálogos raíz (Unidades Administrativas, Cuadro de Clasificación y Vigencias) han sido capturados y verificados por la autoridad del Archivo Coordinador o titular responsable.
* **Integridad de los Códigos:** Una vez asignados los códigos de la Serie Documental en el CGCA, evite modificarlos, ya que los expedientes ya registrados estarán vinculados permanentemente a esta nomenclatura.
* **Actualización en Tiempo Real:** Fomente la cultura de registrar los movimientos en el sistema en el mismo instante en el que ocurran los movimientos físicos de los documentos (cierre de carpetas, transferencias, incremento de fojas).
* **Cierre de Sesión:** El sistema maneja información confidencial y reservada que requiere extrema protección. Por seguridad y prevención, recuerde siempre **cerrar su sesión activa** haciendo clic en el perfil o menú de usuario (usualmente ubicado en la esquina superior derecha) y luego en "Cerrar sesión" (*Log out*) una vez que haya terminado su jornada de operación.