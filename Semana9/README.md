## 1. Datos generales
- **Nombre del sistema:** Sistema Archivística ITSSNA
- **Nombre de referencia del proyecto:** Sistemachivista
- **Tipo de sistema:** Sistema web de gestión archivística y documental
- **Fecha de elaboración:** 07 de agosto de 2024 al 28 de febrero de 2025
- **Entorno de despliegue:** Aplicación cliente servidor se puede manejar local o en servicios de hosting.

## 2. Descripción general del sistema
El sistema Archivo es una plataforma web orientada a la gestión archivística institucional. Su objetivo principal es apoyar el control, organización, clasificación y administración de expedientes, así como el seguimiento del ciclo de vida documental dentro de una organización.
De acuerdo con la estructura del proyecto y los módulos implementados, el sistema permite registrar instituciones, unidades administrativas, secciones, subsecciones, series y subseries documentales, así como administrar expedientes, controles de acceso, valores documentales, vigencias de conservación y procesos de transferencia archivística.
La aplicación sigue un enfoque de gestión documental basado en el ciclo de vida del documento, contemplando fases como tramite, concentración e histórico, además de la identificación de información reservada y confidencial.

## 3. Objetivo del sistema
Automatizar y centralizar la gestión archivística institucional mediante una plataforma web que facilite:
- El registro estructurado de expedientes.
- La clasificación archivística conforme al cuadro general.
- La administración de series, subseries y vigencias documentales.
- El control de transferencias primarias y secundarias.
- La consulta y presentación de portadas de expedientes.
- El apoyo a la organización documental de áreas administrativas.

## 4. Funcionalidades identificadas
Con base en el análisis del código fuente, se identificaron las siguientes funcionalidades principales:
- **Gestión de instituciones:** alta y administración de instituciones activas.
- **Gestión de unidades administrativas:** registro de áreas, códigos, responsables y relaciones jerárquicas.
- **Cuadro general de clasificación archivística:** administración de secciones, subsecciones, series y subseries.
- **Catálogo de disposición documental / vigencias:** configuración de anos de trámite, concentración, disposición final y valores documentales.
- **Gestión de expedientes:** captura de código, asunto, descripción, fechas de apertura y cierre, soporte documental, numero de fojas, legajos, estado y fase archivística.
- **Clasificación y acceso a la información:** manejo de información reservada y confidencial, así como datos de desclasificación.
- **Transferencias archivísticas:** registro de transferencias entre unidades de origen y destino con expedientes asociados.
- **Impresión y consulta:** generación de portada de expediente y vista de impresión para transferencias.
- **Acceso administrativo:** panel con autenticación para la operación del sistema.

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

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

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
