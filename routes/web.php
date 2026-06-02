<?php

use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ArtworkController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryEventController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactMessageController;
use App\Models\Artist;
use App\Models\Artwork;
use App\Models\GalleryEvent;
use Illuminate\Support\Facades\Route;

if (! function_exists('lumenArtworks')) {
    function lumenArtworks(): array
    {
        return [
        [
            'slug' => 'la-noche-de-los-rabanos',
            'title' => 'La noche de los rabanos',
            'artist' => 'Diego Rivera',
            'category' => 'moderno',
            'technique' => 'Acuarela sobre papel',
            'dimensions' => '64.7 x 49.9 cm',
            'year' => '1946',
            'availability' => 'Pieza de referencia museografica',
            'price' => 'Cotizacion privada',
            'image' => 'https://images.unsplash.com/photo-1545989253-02cc26577f88?auto=format&fit=crop&w=1200&q=85',
            'description' => 'Obra vinculada con la etapa surrealista de Rivera e inspirada en la celebracion popular oaxaqueña de la Noche de Rabanos. Para el catalogo de Lumen se presenta como referencia historica, no como pieza comercial disponible.',
            'source' => 'https://museoblaisten.com/Obra/2521/La-noche-de-los-rabanos/full',
        ],
        [
            'slug' => 'fuego',
            'title' => 'Fuego',
            'artist' => 'David Alfaro Siqueiros',
            'category' => 'abstracto',
            'technique' => 'Piroxilina sobre plastico y tela',
            'dimensions' => '49 x 61.5 cm',
            'year' => '1939',
            'availability' => 'Pieza de referencia museografica',
            'price' => 'Cotizacion privada',
            'image' => 'https://images.unsplash.com/photo-1547826039-bfc35e0f1ea8?auto=format&fit=crop&w=1200&q=85',
            'description' => 'Composicion experimental donde Siqueiros incorpora materiales modernos, pistolas de aire y estenciles para construir una imagen de energia explosiva y lectura antifascista.',
            'source' => 'https://museoblaisten.com/Obra/2584/Fuego',
        ],
        [
            'slug' => 'naturaleza-muerta-con-pie',
            'title' => 'Naturaleza muerta con pie',
            'artist' => 'Rufino Tamayo',
            'category' => 'moderno',
            'technique' => 'Oleo sobre tela',
            'dimensions' => '58.1 x 51 cm',
            'year' => '1928',
            'availability' => 'Pieza de referencia museografica',
            'price' => 'Cotizacion privada',
            'image' => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=1200&q=85',
            'description' => 'Naturaleza muerta de atmosfera enigmatica, asociada con las busquedas modernas de Tamayo despues de su contacto con Nueva York y con lenguajes de vanguardia.',
            'source' => 'https://museoblaisten.com/Obra/2600/Naturaleza-muerta-con-pie',
        ],
        [
            'slug' => 'la-sopera',
            'title' => 'La sopera',
            'artist' => 'Maria Izquierdo',
            'category' => 'moderno',
            'technique' => 'Oleo sobre tela',
            'dimensions' => '50.5 x 60.5 cm',
            'year' => '1929',
            'availability' => 'Pieza de referencia museografica',
            'price' => 'Cotizacion privada',
            'image' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=1200&q=85',
            'description' => 'Bodegon de gran fuerza visual donde brillos plateados, blancos, negros y grises construyen volumen y una textura pictorica especialmente sensible.',
            'source' => 'https://museoblaisten.com/Obra/2061/La-sopera',
        ],
        [
            'slug' => 'puebla-de-los-angeles',
            'title' => 'Puebla de los angeles',
            'artist' => 'Frida Kahlo',
            'category' => 'digital',
            'technique' => 'Lapices de color sobre papel',
            'dimensions' => '22 x 29 cm',
            'year' => '1952',
            'availability' => 'Pieza de referencia museografica',
            'price' => 'No disponible para venta',
            'image' => 'https://images.unsplash.com/photo-1515405295579-ba7b45403062?auto=format&fit=crop&w=1200&q=85',
            'description' => 'Dibujo tardio de Frida Kahlo presentado en el catalogo como referencia historica. Su inclusion permite ampliar la lectura del arte mexicano mas alla de la pintura de caballete monumental.',
            'source' => 'https://museoblaisten.com/obra.php?id=2090&url=Puebla-de-los-angeles',
        ],
        [
            'slug' => 'la-ramera',
            'title' => 'La ramera',
            'artist' => 'Manuel Rodriguez Lozano',
            'category' => 'fotografia',
            'technique' => 'Oleo sobre carton',
            'dimensions' => '70 x 60 cm',
            'year' => '1927',
            'availability' => 'Pieza de referencia museografica',
            'price' => 'Cotizacion privada',
            'image' => 'https://images.unsplash.com/photo-1551732998-9573f695fdbb?auto=format&fit=crop&w=1200&q=85',
            'description' => 'Obra temprana que aborda personajes urbanos con crudeza y distancia del costumbrismo, vinculando una sensibilidad mexicana con ecos de las vanguardias europeas.',
            'source' => 'https://museoblaisten.com/Obra/2528/La-ramera',
        ],
        ];
    }
}

Route::get('/', function () {
    return view('welcome', [
        'artists' => Artist::withCount('artworks')->latest()->take(12)->get(),
        'artworks' => Artwork::with('artist')->where('is_featured', true)->latest()->get(),
        'shopArtworks' => Artwork::with('artist')->latest()->get()->filter(fn (Artwork $artwork) => $artwork->priceAmount() !== null)->take(8),
        'events' => GalleryEvent::where('is_published', true)->orderBy('event_date')->take(3)->get(),
    ]);
});

Route::get('/obras/{slug}', function (string $slug) {
    $artwork = Artwork::with('artist')->where('slug', $slug)->firstOrFail();

    return view('artwork-detail', [
        'artwork' => $artwork,
        'relatedArtworks' => Artwork::with('artist')
            ->where('id', '!=', $artwork->id)
            ->take(3)
            ->get(),
    ]);
})->name('artworks.show');

Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/agregar/{artwork}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/carrito/{artwork}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/carrito/{artwork}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/favoritos/{artwork}', [CartController::class, 'favorite'])->name('favorites.toggle');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout.store');
Route::post('/contacto', [ContactMessageController::class, 'store'])->name('contact.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.attempt');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('artists', ArtistController::class)->except(['show']);
    Route::resource('artworks', ArtworkController::class)->except(['show']);
    Route::resource('events', GalleryEventController::class)->parameters([
        'events' => 'event',
    ])->except(['show']);
    Route::get('messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [AdminContactMessageController::class, 'show'])->name('messages.show');
    Route::patch('messages/{message}', [AdminContactMessageController::class, 'update'])->name('messages.update');
    Route::delete('messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');
});
