# Blog App

Aplicación de blog desarrollada con Laravel 12 para practicar desarrollo web full stack con panel de administración, autenticación, gestión de posts y control de roles y permisos.

## Características

- Blog público con listado de publicaciones.
- Vista individual de post por `slug`.
- Panel de administración.
- CRUD de categorías.
- CRUD de posts.
- Relación entre posts, categorías, etiquetas y usuarios.
- Publicación y despublicación de posts.
- Carga y descarga de imágenes de posts.
- Redimensionado de imágenes mediante eventos y listeners.
- Autenticación con Laravel Fortify.
- Soporte para doble factor de autenticación.
- Gestión de roles y permisos con Spatie.
- Seeders y factories para generar datos de prueba.

## Tecnologías

- PHP 8.2+
- Laravel 12
- MySQL
- Livewire 4
- Livewire Flux
- Laravel Fortify
- Spatie Laravel Permission
- Intervention Image
- Tailwind CSS
- Vite

## Requisitos

- PHP 8.2 o superior
- Composer
- Node.js y npm
- MySQL o MariaDB
- Extensiones PHP necesarias para Laravel

## Instalación

1. Clona el repositorio.

```bash
git clone <url-del-repositorio>
cd blog-app
```

2. Instala las dependencias de PHP.

```bash
composer install
```

3. Instala las dependencias de frontend.

```bash
npm install
```

4. Crea el archivo de entorno.

```bash
cp .env.example .env
```

En Windows PowerShell puedes usar:

```powershell
Copy-Item .env.example .env
```

5. Genera la clave de la aplicación.

```bash
php artisan key:generate
```

6. Configura tu conexión a base de datos en `.env`.

Ejemplo:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=root
DB_PASSWORD=
```

7. Ejecuta las migraciones y seeders.

```bash
php artisan migrate:fresh --seed
```

8. Crea el enlace simbólico para almacenamiento público.

```bash
php artisan storage:link
```

9. Inicia el entorno de desarrollo.

En una terminal:

```bash
php artisan serve
```

En otra terminal:

```bash
npm run dev
```

Opcionalmente puedes usar:

```bash
composer run dev
```

## Usuario de prueba

El seeder principal crea un usuario inicial:

- Email: `usuario.prueba@gmail.com`
- Contraseña: `12345678`

Nota:
Después del seeding, los roles y permisos se crean, pero la asignación de roles al usuario depende de la lógica que agregues en tus seeders o controladores.

## Estructura funcional actual

### Área pública

- `/` muestra el listado de posts publicados.
- `/post/{post}` muestra el detalle de un post usando el `slug`.

### Área administrativa

Las rutas administrativas incluyen:

- dashboard
- gestión de categorías
- gestión de posts
- gestión de permisos
- gestión de roles

## Modelos principales

- `User`
- `Post`
- `Category`
- `Tag`
- `Comment`

## Seeders

Actualmente el seeding principal:

- limpia y recrea la carpeta pública de imágenes de posts
- crea un usuario inicial
- crea categorías de prueba
- crea posts de prueba
- ejecuta `PermissionSeeder`
- ejecuta `RoleSeeder`

## Comandos útiles

Ejecutar migraciones y seeders:

```bash
php artisan migrate:fresh --seed
```

Ejecutar solo el seeder de roles:

```bash
php artisan db:seed --class=RoleSeeder
```

Ejecutar solo el seeder de permisos:

```bash
php artisan db:seed --class=PermissionSeeder
```

Ejecutar pruebas:

```bash
php artisan test
```

Revisar formato del código:

```bash
composer run lint:check
```

Formatear código:

```bash
composer run lint
```

## Próximas mejoras sugeridas

- Comentarios reales con moderación.
- Asignación automática de roles a usuarios.
- Dashboard con métricas.
- Búsqueda y filtros por categoría o etiqueta.
- Tests de feature para posts, permisos y roles.
- API REST para posts y comentarios.

## Estado del proyecto

Este proyecto está orientado al aprendizaje y práctica con Laravel. Ya cubre una base bastante completa para seguir creciendo hacia un sistema de blog más robusto.

