# Proyecto Banco ADSO

Este es mi proyecto para el taller de desarrollo de un sistema bancario del programa ADSO (Análisis y Desarrollo de Software) del SENA. 

Es una aplicación web desarrollada desde cero en **PHP puro**, aplicando **Programación Orientada a Objetos (POO)** y una **arquitectura MVC (Modelo-Vista-Controlador)** propia.

## Tecnologías y Versiones
* **PHP:** Versión 8.2 o superior (con soporte para tipado estricto `declare(strict_types=1)`).
* **MySQL:** Versión 8.0 o superior (gestión de base de datos relacional).
* **PDO (PHP Data Objects):** Utilizado para la conexión segura y prevención de inyecciones SQL.
* **Composer:** Versión 2.x (usado para el autoloader de clases bajo el estándar PSR-4).
* **HTML5 y CSS3:** Estructura de las vistas y diseño de la interfaz de usuario.
* **Seguridad:** Encriptación de contraseñas mediante `password_hash()` y validación con `password_verify()`.

## Organización de mis carpetas
La estructura del proyecto sigue el patrón MVC:
* `config/`: Archivos de configuración general, incluyendo `database.php` para los parámetros de conexión a la base de datos.
* `public/`: Directorio raíz web del servidor. Contiene el archivo `index.php` (Front Controller) que centraliza y enruta todas las peticiones HTTP.
* `src/`: Núcleo de la lógica de negocio de la aplicación.
  * `Controladores/`: Gestionan las acciones del usuario (Login, Panel, Retiros, Transferencias, Logout).
  * `Modelos/`: Clases que representan las entidades del sistema (Cliente, Cuenta, Usuario, Retiro, Transferencia).
  * `Nucleo/`: Clases base del sistema como el Router, la Conexión PDO y el ControladorBase.
  * `Repositorios/`: Capa de persistencia encargada de interactuar directamente con la base de datos mediante consultas SQL.
* `vistas/`: Plantillas HTML y archivos de presentación visual para el usuario.

## Cómo ejecutar el proyecto localmente

Si deseas desplegar y probar este proyecto en tu entorno de desarrollo local, sigue estos pasos:

1. **Requisitos previos:** Asegúrate de tener instalado PHP (>= 8.2), Composer y un servidor de bases de datos MySQL (como XAMPP o WampServer).
2. **Base de datos:** Crea una base de datos en tu gestor MySQL e importa el script con las tablas relacionales y los datos de prueba correspondientes.
3. **Configuración:** Ingresa a la carpeta `config/`, abre el archivo `database.php` y configura tus credenciales de acceso a MySQL (host, nombre de la BD, usuario y contraseña).
4. **Dependencias:** Abre tu terminal en la raíz del proyecto y ejecuta el comando de Composer para asegurar que el autoloader reconozca las clases:
   ```bash
   composer dump-autoload
