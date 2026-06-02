# Lumen Art Gallery - Guia de inicio

## Abrir el proyecto en Visual Studio Code

Desde PowerShell, entra a la carpeta del proyecto:

```powershell
cd C:\Users\danie\Documents\Codex\2026-06-01\quiero-hacer-una-pagina-web-sobre\lumen-art-gallery
code .
```

## Ejecutar Laravel

En la terminal de Visual Studio Code:

```powershell
php artisan serve
```

Luego abre:

```text
http://127.0.0.1:8000
```

## Panel administrativo

Cuando el servidor este encendido, abre:

```text
http://127.0.0.1:8000/admin
```

Credenciales:

```text
Usuario: admin
Contraseña: 12345
```

Desde ahi puedes administrar:

```text
Obras: http://127.0.0.1:8000/admin/artworks
Artistas: http://127.0.0.1:8000/admin/artists
Eventos: http://127.0.0.1:8000/admin/events
Mensajes: http://127.0.0.1:8000/admin/messages
```

## Formulario de contacto

El formulario de la seccion Contacto guarda los mensajes en la base de datos.
Desde el panel admin puedes leerlos, cambiar su estado y eliminarlos:

```text
http://127.0.0.1:8000/admin/messages
```

## Carrito

```text
http://127.0.0.1:8000/carrito
```

## Si necesitas usar npm

En tu Windows, PowerShell bloqueo `npm.ps1`. Usa este comando:

```powershell
npm.cmd install
npm.cmd run dev
```

## Archivo principal de la pagina

La primera version de la pagina esta en:

```text
resources/views/welcome.blade.php
```

## Verificar que todo funcione

```powershell
php artisan test
```
