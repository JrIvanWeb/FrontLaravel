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

Crea los roles con `php artisan db:seed` y crea el primer administrador con `php artisan back-ict:admin:create`. El comando solicita los datos y la contraseña de forma interactiva; nunca se define una contraseña inicial en el código.

- `POST /api/auth/login`: recibe `Correo` y `Password`, y devuelve un token Bearer.
- `POST /api/auth/forgot-password`: recibe `Correo`; envía un código temporal si la cuenta está activa.
- `POST /api/auth/reset-password`: recibe `Correo`, `Codigo`, `Password` y `Password_confirmation`.
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

Configura `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL` con HTTPS, una clave `APP_KEY` segura, la conexión a la base de datos de producción y `CORS_ALLOWED_ORIGINS` con el dominio real del frontend. No subas `.env` al repositorio. Instala dependencias, compila los recursos, ejecuta migraciones y `php artisan optimize`; apunta el servidor web a `public/` y concede permisos de escritura a `storage/` y `bootstrap/cache/`.

Antes de publicar, define límites de expiración/rotación de tokens y restringe `CORS_ALLOWED_ORIGINS` al dominio del frontend.

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
