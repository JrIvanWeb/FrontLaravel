<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Back-ICT API

API REST con Laravel 12 y PHP 8.2+. Los archivos recibidos se guardan en `storage/app/public` y la base de datos conserva su ruta.

### Desarrollo

Requisitos: PHP con `pdo_sqlite`, `fileinfo`, `mbstring`, `openssl` y `zip`; Composer; Node.js y npm.

```powershell
composer run setup
php artisan storage:link
composer run dev
```

La API local queda en `http://127.0.0.1:8000/api`. Para iniciar solo el backend, usa `php artisan serve --host=127.0.0.1 --port=8000`.

### Autenticación y roles

- `GET /api/sliders`: devuelve los banners activos del inicio. El frontend carga las imágenes desde `storage/app/public`; ejecuta `php artisan storage:link` para servirlas.
- En desarrollo, `CORS_ALLOWED_ORIGINS` debe incluir el origen de Angular (`http://localhost:4200` o `http://127.0.0.1:4200`).

Crea los roles con `php artisan db:seed` y crea el primer administrador con `php artisan back-ict:admin:create`. El comando solicita los datos y la contraseña de forma interactiva; nunca se define una contraseña inicial en el código.

- `POST /api/auth/login`: recibe `Correo` y `Password`, y devuelve un token Bearer.
- `POST /api/auth/forgot-password`: recibe `Correo`; envía un código temporal si la cuenta está activa.
- `POST /api/auth/reset-password`: recibe `Correo`, `Codigo`, `Password` y `Password_confirmation`.
- `POST /api/auth/change-password`: requiere autenticación y recibe `CurrentPassword`, `Password` y `Password_confirmation`; al cambiarla, revoca todas las sesiones activas de la cuenta.
- `GET /api/auth/me`: devuelve el usuario autenticado y su rol.
- `DELETE /api/auth/logout`: revoca el token enviado.
- `GET /api/tipos-documento`: devuelve el catálogo para formularios de usuario; solo Admin puede administrarlo.
- Al crear o editar usuarios, envía `IdTipoDocumento` con el ID de este catálogo.
- La lectura de contenido es pública. Admin y Editor pueden modificar contenido; solo Admin puede gestionar usuarios y roles.

Envía el token en las rutas protegidas usando `Authorization: Bearer <token>`.

El código de recuperación vence en 10 minutos, se almacena como hash, se limita por correo y solo se puede usar una vez. En desarrollo `MAIL_MAILER=log` escribe el mensaje en `storage/logs/laravel.log`; configura `MAIL_MAILER=smtp` y las variables SMTP de `.env` para enviar correos reales. La expiración se puede cambiar con `AUTH_PASSWORD_RESET_CODE_EXPIRE`.

### Errores de la API

Todas las rutas API devuelven errores con el mismo formato:

```json
{
	"success": false,
	"code": "VALIDATION_ERROR",
	"message": "Los datos enviados no son válidos.",
	"errors": {
		"Correo": ["El campo correo es obligatorio."]
	}
}
```

El frontend puede distinguir errores por `code` y mostrar los mensajes de `errors`. Los errores de validación responden `422`, autenticación `401`, autorización `403`, recurso inexistente `404`, conflictos de datos `409` y errores internos `500`. Con `APP_DEBUG=true`, los errores internos incluyen `debug.detail`; en producción se omite para no filtrar información del servidor. Las excepciones se registran en el log de Laravel.

Excepciones personalizadas disponibles en `app/Exceptions/`:

- `InvalidCredentialsException`: credenciales incorrectas (`401`).
- `InsufficientRoleException`: usuario sin permiso suficiente (`403`).
- `ResourceNotFoundException`: registro inexistente (`404`), lanzada por los servicios CRUD.
- `DataConflictException`: duplicados o conflictos de integridad (`409`).
- `FileStorageException`: fallo al guardar un archivo (`500`).

Para una regla de negocio específica dentro de un servicio, lanza la excepción correspondiente. Por ejemplo: `throw new DataConflictException(['Correo' => ['El correo ya está registrado.']]);`. Todas heredan de `ApiException`, que permite definir el código HTTP y errores de campo para el manejador central.

### Producción

El frontend de producción configurado consume `https://ict.com/api`. Usa `.env.production.example` como guía y crea `.env` en el servidor; completa las credenciales MySQL y SMTP que entrega el hosting. No publiques ni compartas `.env`, contraseñas, ni la clave `APP_KEY`. Mantén `APP_DEBUG=false` y restringe `CORS_ALLOWED_ORIGINS` a los orígenes HTTPS del frontend.

En el servidor, conserva el proyecto Laravel fuera del directorio público y configura el document root del dominio `ict.com` para que apunte a la carpeta `public/` de Laravel. El directorio público debe servir la API bajo `/api` y los archivos subidos bajo `/storage`. Si el hosting no permite apuntar el document root a `public/`, consulta con el proveedor la configuración segura; no expongas el resto del proyecto ni el archivo `.env` dentro de `public_html`.

Con acceso SSH, después de cargar el proyecto y configurar `.env`, ejecuta desde la raíz de Laravel:

```sh
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan optimize
php artisan back-ict:admin:create
```

`key:generate` solo se ejecuta al crear la aplicación por primera vez; conserva la misma `APP_KEY` en despliegues futuros. Haz una copia de seguridad de la base de datos antes de aplicar migraciones. El seeder crea los roles iniciales y el comando de administrador solicita sus credenciales de forma interactiva. No uses `php artisan serve` como servidor público.

Comprueba que `storage/` y `bootstrap/cache/` tengan permisos de escritura para el usuario de PHP. Configura el hosting para usar HTTPS, que PHP disponga de `pdo_mysql`, `fileinfo`, `mbstring`, `openssl` y `zip`, y que `upload_max_filesize`/`post_max_size` permitan las imágenes de hasta 5 MB que admite la API. El SMTP de `.env` debe ser válido para que funcionen la recuperación de contraseña y los correos de admisión. Los tokens de administración vencen tras 30 minutos de inactividad.

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
