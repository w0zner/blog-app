# Proyecto Laravel Livewire

Proyecto  Laravel para Livewire. Este proyecto proporciona una base sólida para construir aplicaciones web modernas utilizando Laravel, Livewire y Tailwind CSS.

## 🚀 Tecnologías Principales

- **[Laravel 12](https://laravel.com/)**: El framework PHP para artesanos web.
- **[Livewire 4](https://livewire.laravel.com/)**: Un framework full-stack para Laravel que hace que la construcción de interfaces dinámicas sea sencilla.
- **[Tailwind CSS 4](https://tailwindcss.com/)**: Un framework CSS de utilidad primero para el desarrollo rápido de interfaces de usuario.
- **[Vite](https://vitejs.dev/)**: Herramienta de construcción frontend rápida y moderna.
- **[Laravel Fortify](https://laravel.com/docs/fortify)**: Backend de autenticación para Laravel.

## 📋 Requisitos Previos

Asegúrate de tener instalados los siguientes requerimientos en tu entorno local antes de comenzar:

- PHP >= 8.2
- Composer
- Node.js y npm
- Base de datos (SQLite configurado por defecto)

## 🛠️ Instalación y Configuración

Sigue estos pasos para configurar el proyecto en tu máquina local:

1. **Clona el repositorio** (si aún no lo has hecho) y navega al directorio del proyecto:
   ```bash
   git clone <url-del-repositorio>
   cd livewire-starter-kit
   ```

2. **Ejecuta el script de configuración:**
   El proyecto incluye un script de configuración conveniente que instalará dependencias, configurará el archivo `.env`, generará la clave de la aplicación, ejecutará las migraciones y compilará los activos del frontend.
   ```bash
   composer setup
   ```
   *Nota: Si prefieres hacerlo manualmente, puedes ejecutar `composer install`, copiar `.env.example` a `.env`, ejecutar `php artisan key:generate`, `php artisan migrate`, `npm install` y `npm run build`.*

## 💻 Desarrollo

Para iniciar el entorno de desarrollo local, que incluye el servidor PHP, el procesador de colas, el sistema de logs y Vite para recarga en caliente (HMR), ejecuta:

```bash
composer dev
```

Este comando utiliza `concurrently` para ejecutar múltiples procesos necesarios durante el desarrollo en una sola terminal.

## 🧪 Pruebas y Calidad de Código

El proyecto utiliza **Pest PHP** para pruebas y **Laravel Pint** para el formateo de código.

- **Ejecutar pruebas:**
  ```bash
  composer test
  ```

- **Formatear el código automáticamente (Lint):**
  ```bash
  composer lint
  ```

- **Verificar el formato del código:**
  ```bash
  composer lint:check
  ```

- **Verificaciones de Integración Continua (CI):**
  ```bash
  composer ci:check
  ```

## 📦 Scripts Disponibles

A continuación se resumen los comandos más útiles que puedes usar a través de Composer:

| Comando | Descripción |
|---------|-------------|
| `composer install` | Realiza la configuración inicial completa del proyecto. |
| `composer setup` | Realiza la configuración inicial completa del proyecto. |
| `composer dev` | Inicia todos los servicios necesarios para el desarrollo local. |
| `composer test` | Ejecuta la suite de pruebas del proyecto. |
| `composer lint` | Corrige problemas de estilo de código usando Laravel Pint. |
| `composer lint:check` | Verifica el estilo de código sin modificar archivos. |
| `npm run build` | Compila los recursos de frontend para producción usando Vite. |

## 📄 Licencia

Este proyecto está bajo la Licencia MIT.
