<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Version

-   PHP v8.1 - 8.3
-   Laravel v10
-   Bootstrap
-   Sanctum

## Clonar repositorio

-   git clone "url del repositorio"

## Instalación de las dependencias

Una vez clonado el repositorio se debe ejecutar

```
composer update
```

Una vez instalado las dependencias ejecutar los comandos de php artisan de Laravel

-   copiar el .env.example como .env, ya que es requisito principal

```
cp .env.example .env
```

-   Para crear el link con el almacenamiento publico de Laravel

```
php arisan storage:link
```

-   Ejecutar las migraciones y alimentar con datos fake

```
php artisan migrate --seed
```

-   instalar node modules para la interfaz de boostrap

```
npm install
```

-   ejecutar el servidor npm

```
npm run dev
```

-   ejecutar el servidor de desarrollo de Laravel``

```
php artisan serve
```

Si se obtiene error de vite o los estilos no se cargan ejecute npm run dev siempre

## EndPoints de API Auth

-   {{ dominio }}/api/v1/auth/**login**
