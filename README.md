# Lumen Art Gallery

Lumen Art Gallery es una pagina web desarrollada en Laravel para una galeria de arte contemporaneo. El proyecto busca transmitir una experiencia visual elegante, moderna e inmersiva, combinando catalogo de obras, artistas, exposiciones, tienda simulada, recorrido virtual, formulario de contacto funcional y panel administrativo.

## Caracteristicas principales

- Pagina principal tipo galeria premium con hero cinematografico.
- Modo claro y oscuro con estetica marmol, dorado, plateado y tonos neutros.
- Galeria masonry con filtros animados por categoria.
- Lightbox tipo museo para ver obras en grande, con zoom, flechas y datos de la pieza.
- Pagina individual por obra con artista, tecnica, dimensiones, anio, disponibilidad, precio y descripcion.
- Seccion de artistas con biografia, especialidad y obras representativas.
- Recorrido virtual con salas, hotspots y transiciones.
- Tienda de arte con carrito simulado, favoritos, resumen de compra y disponibilidad.
- Formulario de contacto funcional que guarda mensajes en la base de datos.
- Panel administrativo protegido para gestionar obras, artistas, eventos, precios y mensajes.
- Disenio responsive para escritorio, tablet y movil.

## Estructura de la pagina

La pagina principal esta organizada en estas secciones:

- **Hero:** bienvenida visual con imagen cinematografica de galeria.
- **Sobre la galeria:** historia, filosofia y estadisticas.
- **Obras destacadas:** catalogo masonry con filtros y lightbox.
- **Artistas:** tarjetas con datos de artistas representados.
- **Recorrido virtual:** salas interactivas con hotspots.
- **Coleccion exclusiva:** presentacion premium de piezas seleccionadas.
- **Exposiciones y eventos:** calendario visual de eventos publicados.
- **Tienda de arte:** obras disponibles, favoritos y carrito.
- **Testimonios:** carrusel de opiniones.
- **Contacto:** formulario funcional y mapa.

## Tecnologias usadas

- Laravel
- PHP
- Blade
- SQLite/MySQL compatible mediante migraciones
- HTML, CSS y JavaScript
- PHPUnit para pruebas

## Requisitos

Antes de ejecutar el proyecto necesitas tener instalado:

- PHP 8.2 o superior
- Composer
- Node.js y npm, si quieres compilar assets con Vite
- Git

## Instalacion

Clona el repositorio:

```bash
git clone <url-del-repositorio>
cd lumen-art-gallery
```

Instala dependencias de PHP:

```bash
composer install
```

Copia el archivo de variables de entorno:

```bash
cp .env.example .env
```

En Windows PowerShell puedes usar:

```powershell
Copy-Item .env.example .env
```

Genera la llave de Laravel:

```bash
php artisan key:generate
```

Ejecuta migraciones y seeders:

```bash
php artisan migrate --seed
```

Inicia el servidor:

```bash
php artisan serve
```

Abre el sitio en:

```text
http://127.0.0.1:8000
```

## Panel administrativo

El panel admin permite administrar el contenido principal sin tocar codigo:

```text
http://127.0.0.1:8000/admin
```

Credenciales de demostracion:

```text
Usuario: admin
Contrasena: 12345
```

Desde el panel se puede gestionar:

- Obras
- Artistas
- Eventos
- Precios
- Mensajes recibidos desde el formulario de contacto

## Rutas importantes

```text
/                         Pagina principal
/obras/{slug}             Detalle individual de obra
/carrito                  Vista del carrito
/contacto                 Envio del formulario de contacto
/admin                    Dashboard administrativo
/admin/artworks           Administracion de obras
/admin/artists            Administracion de artistas
/admin/events             Administracion de eventos
/admin/messages           Mensajes de contacto
```

## Base de datos

El proyecto utiliza migraciones para crear las tablas necesarias. Los modelos principales son:

- `Artist`
- `Artwork`
- `GalleryEvent`
- `ContactMessage`

Los seeders cargan informacion inicial de artistas, obras y eventos para que el sitio tenga contenido al iniciar.

## Carrito y tienda

La tienda funciona como simulacion de compra:

- Agregar obras disponibles al carrito.
- Quitar productos.
- Guardar favoritos.
- Calcular subtotal y total.
- Mostrar disponibilidad.
- Completar una vista de checkout simulada.

No procesa pagos reales todavia.

## Formulario de contacto

El formulario solicita:

- Nombre completo
- Correo electronico
- Numero de telefono
- Medio preferido de contacto
- Tipo de consulta
- Asunto
- Mensaje
- Consentimiento de uso de datos

Los mensajes se guardan en la base de datos y se pueden revisar desde:

```text
/admin/messages
```

## Pruebas

Para verificar que el proyecto funciona correctamente:

```bash
php artisan test
```

Las pruebas cubren:

- Carga de la pagina principal
- Pagina individual de obra
- Acceso al panel admin
- Login del admin
- Carrito
- Formulario de contacto
- Lectura de mensajes desde admin

## Archivos importantes

```text
resources/views/welcome.blade.php          Pagina principal
resources/views/artwork-detail.blade.php   Detalle de obra
resources/views/cart/index.blade.php       Carrito
resources/views/admin                      Vistas del panel administrativo
routes/web.php                             Rutas del sitio
app/Models                                 Modelos principales
app/Http/Controllers                       Controladores publicos y admin
database/migrations                        Migraciones
database/seeders/DatabaseSeeder.php        Datos iniciales
public/images                              Imagenes locales del sitio
```

## Estado actual del proyecto

El proyecto ya incluye una experiencia visual avanzada para presentacion de arte, administracion basica de contenido y funcionalidades simuladas de tienda. Quedan como posibles mejoras futuras:

- Envio real de correos desde el formulario.
- Integracion con pasarela de pago como Stripe o PayPal.
- Subida de imagenes desde el panel admin.
- Busqueda avanzada de obras.
- Dashboard con estadisticas mas completas.

## Nota

Este proyecto fue creado con fines educativos y de demostracion. Las credenciales del panel admin son simples porque estan pensadas para entorno local o presentacion academica; en produccion deben cambiarse por un sistema de autenticacion real y contrasenas seguras.
