<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Artwork;
use App\Models\GalleryEvent;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'test@example.com'], [
            'name' => 'Test User',
            'password' => bcrypt('password'),
        ]);

        $artists = collect([
            [
                'name' => 'Diego Rivera',
                'slug' => 'diego-rivera',
                'specialty' => 'Muralismo y pintura moderna mexicana',
                'photo_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=800&q=85',
                'bio' => 'Pintor mexicano clave del siglo XX, reconocido por su obra mural y por integrar tradicion popular, historia social y lenguajes modernos.',
                'featured_works' => 'La noche de los rabanos, El puente de San Martin',
            ],
            [
                'name' => 'David Alfaro Siqueiros',
                'slug' => 'david-alfaro-siqueiros',
                'specialty' => 'Muralismo, experimentacion tecnica y composicion dinamica',
                'photo_url' => 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=800&q=85',
                'bio' => 'Artista mexicano asociado con el muralismo y con el uso de materiales industriales, piroxilina, aerografo y composiciones de gran energia.',
                'featured_works' => 'Fuego, Retrato de Nora Beteta',
            ],
            [
                'name' => 'Rufino Tamayo',
                'slug' => 'rufino-tamayo',
                'specialty' => 'Pintura moderna, color y sintesis formal',
                'photo_url' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=800&q=85',
                'bio' => 'Pintor oaxaqueño que desarrollo un lenguaje propio entre modernidad internacional, arte popular y referencias prehispanicas.',
                'featured_works' => 'Naturaleza muerta con pie, Naturaleza muerta con alcatraces',
            ],
            [
                'name' => 'Maria Izquierdo',
                'slug' => 'maria-izquierdo',
                'specialty' => 'Pintura moderna, bodegon y escena popular',
                'photo_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=800&q=85',
                'bio' => 'Una de las artistas mexicanas modernas mas importantes, con una obra de fuerte sensibilidad cromatica y compositiva.',
                'featured_works' => 'La sopera',
            ],
            [
                'name' => 'Frida Kahlo',
                'slug' => 'frida-kahlo',
                'specialty' => 'Autorretrato, dibujo y pintura autobiografica',
                'photo_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=85',
                'bio' => 'Artista mexicana reconocida por una obra profundamente autobiografica, simbolica y ligada a la identidad mexicana.',
                'featured_works' => 'Puebla de los angeles, Las dos Fridas',
            ],
            [
                'name' => 'Manuel Rodriguez Lozano',
                'slug' => 'manuel-rodriguez-lozano',
                'specialty' => 'Pintura moderna y figura urbana',
                'photo_url' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=800&q=85',
                'bio' => 'Pintor mexicano vinculado con una expresion moderna de lo urbano, con ecos de las vanguardias europeas.',
                'featured_works' => 'La ramera',
            ],
            [
                'name' => 'Armando Ahuatzi',
                'slug' => 'armando-ahuatzi',
                'specialty' => 'Realismo, bodegon y tradiciones mexicanas',
                'photo_url' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=800&q=85',
                'bio' => 'Pintor mexicano originario de Tlaxcala, reconocido por bodegones, ofrendas y escenas de tradicion popular con manejo cuidadoso de luz y realismo.',
                'featured_works' => 'Calabaza, Bodegon de dia de muertos',
            ],
            [
                'name' => 'Gustavo Valenzuela',
                'slug' => 'gustavo-valenzuela',
                'specialty' => 'Pintura figurativa, naturaleza y sensibilidad cromatica',
                'photo_url' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=800&q=85',
                'bio' => 'Pintor nacido en Hermosillo, Sonora; estudio en la Universidad de Sonora, San Carlos y La Esmeralda, con una obra centrada en la naturaleza.',
                'featured_works' => 'Obras de naturaleza, composiciones figurativas',
            ],
            [
                'name' => 'Enrique Quevedo',
                'slug' => 'enrique-quevedo',
                'specialty' => 'Pintura mixta y precision formal',
                'photo_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=85',
                'bio' => 'Artista contemporaneo con obra de tecnica mixta, tramas precisas y composiciones de alta disciplina visual.',
                'featured_works' => 'Renacimiento',
            ],
            [
                'name' => 'Alberto Salazar',
                'slug' => 'alberto-salazar',
                'specialty' => 'Acrilico contemporaneo y pintura de gran formato',
                'photo_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=800&q=85',
                'bio' => 'Artista contemporaneo asociado con pintura acrilica de formato amplio y composiciones de presencia organica.',
                'featured_works' => 'Natura',
            ],
            [
                'name' => 'Rafael Vallejo',
                'slug' => 'rafael-vallejo',
                'specialty' => 'Acrilico sobre tela y narrativa mexicana',
                'photo_url' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=800&q=85',
                'bio' => 'Artista con obra en acrilico sobre tela, de lenguaje narrativo y referencias culturales mexicanas.',
                'featured_works' => 'La oracion en la mesa, El universo de Quetzalcoatl',
            ],
        ])->mapWithKeys(fn ($artist) => [
            $artist['slug'] => Artist::updateOrCreate(['slug' => $artist['slug']], $artist),
        ]);

        $artworks = [
            [
                'artist_id' => $artists['diego-rivera']->id,
                'slug' => 'la-noche-de-los-rabanos',
                'title' => 'La noche de los rabanos',
                'category' => 'moderno',
                'technique' => 'Acuarela sobre papel',
                'dimensions' => '64.7 x 49.9 cm',
                'year' => '1946',
                'availability' => 'Pieza de referencia museografica',
                'price' => 'Cotizacion privada',
                'image_url' => 'https://images.unsplash.com/photo-1545989253-02cc26577f88?auto=format&fit=crop&w=1200&q=85',
                'source_url' => 'https://museoblaisten.com/Obra/2521/La-noche-de-los-rabanos/full',
                'description' => 'Obra vinculada con la etapa surrealista de Rivera e inspirada en la celebracion popular oaxaqueña de la Noche de Rabanos. Para el catalogo de Lumen se presenta como referencia historica, no como pieza comercial disponible.',
            ],
            [
                'artist_id' => $artists['david-alfaro-siqueiros']->id,
                'slug' => 'fuego',
                'title' => 'Fuego',
                'category' => 'abstracto',
                'technique' => 'Piroxilina sobre plastico y tela',
                'dimensions' => '49 x 61.5 cm',
                'year' => '1939',
                'availability' => 'Pieza de referencia museografica',
                'price' => 'Cotizacion privada',
                'image_url' => 'https://images.unsplash.com/photo-1547826039-bfc35e0f1ea8?auto=format&fit=crop&w=1200&q=85',
                'source_url' => 'https://museoblaisten.com/Obra/2584/Fuego',
                'description' => 'Composicion experimental donde Siqueiros incorpora materiales modernos, pistolas de aire y estenciles para construir una imagen de energia explosiva y lectura antifascista.',
            ],
            [
                'artist_id' => $artists['rufino-tamayo']->id,
                'slug' => 'naturaleza-muerta-con-pie',
                'title' => 'Naturaleza muerta con pie',
                'category' => 'moderno',
                'technique' => 'Oleo sobre tela',
                'dimensions' => '58.1 x 51 cm',
                'year' => '1928',
                'availability' => 'Pieza de referencia museografica',
                'price' => 'Cotizacion privada',
                'image_url' => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=1200&q=85',
                'source_url' => 'https://museoblaisten.com/Obra/2600/Naturaleza-muerta-con-pie',
                'description' => 'Naturaleza muerta de atmosfera enigmatica, asociada con las busquedas modernas de Tamayo despues de su contacto con Nueva York y con lenguajes de vanguardia.',
            ],
            [
                'artist_id' => $artists['maria-izquierdo']->id,
                'slug' => 'la-sopera',
                'title' => 'La sopera',
                'category' => 'moderno',
                'technique' => 'Oleo sobre tela',
                'dimensions' => '50.5 x 60.5 cm',
                'year' => '1929',
                'availability' => 'Pieza de referencia museografica',
                'price' => 'Cotizacion privada',
                'image_url' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=1200&q=85',
                'source_url' => 'https://museoblaisten.com/Obra/2061/La-sopera',
                'description' => 'Bodegon de gran fuerza visual donde brillos plateados, blancos, negros y grises construyen volumen y una textura pictorica especialmente sensible.',
            ],
            [
                'artist_id' => $artists['frida-kahlo']->id,
                'slug' => 'puebla-de-los-angeles',
                'title' => 'Puebla de los angeles',
                'category' => 'digital',
                'technique' => 'Lapices de color sobre papel',
                'dimensions' => '22 x 29 cm',
                'year' => '1952',
                'availability' => 'Pieza de referencia museografica',
                'price' => 'No disponible para venta',
                'image_url' => 'https://images.unsplash.com/photo-1515405295579-ba7b45403062?auto=format&fit=crop&w=1200&q=85',
                'source_url' => 'https://museoblaisten.com/obra.php?id=2090&url=Puebla-de-los-angeles',
                'description' => 'Dibujo tardio de Frida Kahlo presentado en el catalogo como referencia historica. Su inclusion permite ampliar la lectura del arte mexicano mas alla de la pintura de caballete monumental.',
            ],
            [
                'artist_id' => $artists['manuel-rodriguez-lozano']->id,
                'slug' => 'la-ramera',
                'title' => 'La ramera',
                'category' => 'fotografia',
                'technique' => 'Oleo sobre carton',
                'dimensions' => '70 x 60 cm',
                'year' => '1927',
                'availability' => 'Pieza de referencia museografica',
                'price' => 'Cotizacion privada',
                'image_url' => 'https://images.unsplash.com/photo-1551732998-9573f695fdbb?auto=format&fit=crop&w=1200&q=85',
                'source_url' => 'https://museoblaisten.com/Obra/2528/La-ramera',
                'description' => 'Obra temprana que aborda personajes urbanos con crudeza y distancia del costumbrismo, vinculando una sensibilidad mexicana con ecos de las vanguardias europeas.',
            ],
            [
                'artist_id' => $artists['armando-ahuatzi']->id,
                'slug' => 'calabaza',
                'title' => 'Calabaza',
                'category' => 'moderno',
                'technique' => 'Oleo sobre tela',
                'dimensions' => '50 x 70 cm',
                'year' => '1984',
                'availability' => 'Disponible bajo consulta',
                'price' => 'Cotizacion privada',
                'image_url' => 'https://galeriascastillo.net/wp-content/uploads/2022/09/Armando-Ahuatzi-Calabaza-50-x-70-cm-Oleo-sobre-tela-1984.jpg',
                'source_url' => 'https://galeriascastillo.net/armando-ahuatzi/',
                'description' => 'Bodegon de realismo minucioso que destaca por su tratamiento de luz, volumen y elementos tradicionales de la pintura mexicana.',
            ],
            [
                'artist_id' => $artists['armando-ahuatzi']->id,
                'slug' => 'bodegon-de-dia-de-muertos',
                'title' => 'Bodegon de dia de muertos',
                'category' => 'moderno',
                'technique' => 'Oleo sobre tela',
                'dimensions' => '80 x 60 cm',
                'year' => '1987',
                'availability' => 'Disponible bajo consulta',
                'price' => 'Cotizacion privada',
                'image_url' => 'https://galeriascastillo.net/wp-content/uploads/2022/09/Armando-Ahuatzi-Bodegon-de-dia-de-muertos-80-x-60-cm-Oleo-sobre-tela-1987.jpg',
                'source_url' => 'https://galeriascastillo.net/armando-ahuatzi/',
                'description' => 'Naturaleza muerta vinculada a las ofrendas mexicanas, con objetos, frutos y una paleta rica en contraste y tradicion.',
            ],
            [
                'artist_id' => $artists['gustavo-valenzuela']->id,
                'slug' => 'naturaleza-valenzuela',
                'title' => 'Naturaleza',
                'category' => 'moderno',
                'technique' => 'Pintura sobre lienzo',
                'dimensions' => 'Formato no especificado',
                'year' => 's/f',
                'availability' => 'Disponible bajo consulta',
                'price' => 'Cotizacion privada',
                'image_url' => 'https://static.wixstatic.com/media/ed49c0_334bd16806d7433bbec682966e08bed8~mv2.jpg',
                'source_url' => 'https://www.peimbertart.com/es/artistas/gustavo-valenzuela',
                'description' => 'Obra representativa del interes de Valenzuela por la naturaleza, la sensibilidad cromatica y una tecnica figurativa cuidada.',
            ],
            [
                'artist_id' => $artists['enrique-quevedo']->id,
                'slug' => 'renacimiento',
                'title' => 'Renacimiento',
                'category' => 'digital',
                'technique' => 'Mixta sobre carton',
                'dimensions' => '102 x 90 x 5 cm',
                'year' => '2023',
                'availability' => 'Disponible',
                'price' => 'US$2,762',
                'image_url' => 'https://d32dm0rphc51dk.cloudfront.net/fzMHFfjVchG1a0NUZCGcTw/larger.jpg',
                'source_url' => 'https://www.artsy.net/artwork/enrique-quevedo-renacimiento-1',
                'description' => 'Pieza contemporanea de tecnica mixta con composicion precisa y presencia objetual, presentada como obra unica.',
            ],
            [
                'artist_id' => $artists['alberto-salazar']->id,
                'slug' => 'natura',
                'title' => 'Natura',
                'category' => 'abstracto',
                'technique' => 'Acrilico sobre lienzo',
                'dimensions' => '165 x 145 x 8 cm',
                'year' => '2020',
                'availability' => 'Disponible',
                'price' => 'US$13,500',
                'image_url' => 'https://d32dm0rphc51dk.cloudfront.net/EnPZ6d0om7NNJHv3snCrVg/larger.jpg',
                'source_url' => 'https://www.artsy.net/artwork/alberto-salazar-natura-1',
                'description' => 'Pintura acrilica de gran formato con presencia organica, volumen visual y una lectura contemporanea de lo natural.',
            ],
            [
                'artist_id' => $artists['rafael-vallejo']->id,
                'slug' => 'la-oracion-en-la-mesa',
                'title' => 'La oracion en la mesa',
                'category' => 'moderno',
                'technique' => 'Acrilico sobre tela',
                'dimensions' => '100 x 150 cm',
                'year' => 's/f',
                'availability' => 'Agotado',
                'price' => '$190,000 MXN',
                'image_url' => 'https://compra.aguafuertegaleria.com/cdn/shop/files/IMG_9717.jpg',
                'source_url' => 'https://compra.aguafuertegaleria.com/products/la-oracion-en-la-mesa',
                'description' => 'Pintura narrativa de mesa y reunion, con tratamiento acrilico y una composicion de fuerte presencia cultural.',
            ],
            [
                'artist_id' => $artists['rafael-vallejo']->id,
                'slug' => 'el-universo-de-quetzalcoatl',
                'title' => 'El universo de Quetzalcoatl',
                'category' => 'moderno',
                'technique' => 'Acrilico sobre tela',
                'dimensions' => '100 x 80 cm',
                'year' => '1995',
                'availability' => 'Referencia de subasta',
                'price' => 'Cotizacion privada',
                'image_url' => 'https://media.mutualart.com/Images/2023_03/23/21/212652419/rafael-vallejo-muniz-el-universo-de-quetzalcoatl-MPFUN.Jpeg',
                'source_url' => 'https://www.mutualart.com/Artwork/El-universo-de-Quetzalcoatl/4716168B70D1680DB8570DB0EC91F406',
                'description' => 'Acrilico sobre tela con referencias mitologicas mesoamericanas y una composicion de imaginario simbolico.',
            ],
        ];

        foreach ($artworks as $artwork) {
            Artwork::updateOrCreate(['slug' => $artwork['slug']], $artwork + ['is_featured' => true]);
        }

        foreach ([
            ['title' => 'Nocturne Forms', 'slug' => 'nocturne-forms', 'event_date' => '2026-06-18', 'location' => 'Sala Principal', 'description' => 'Exposicion de escultura y luz con visita guiada.'],
            ['title' => 'Digital Matter', 'slug' => 'digital-matter', 'event_date' => '2026-07-04', 'location' => 'Laboratorio Lumen', 'description' => 'Muestra de arte digital, videoarte y experiencias generativas.'],
            ['title' => 'Private Collectors Night', 'slug' => 'private-collectors-night', 'event_date' => '2026-08-22', 'location' => 'Salon privado', 'description' => 'Presentacion exclusiva de nuevas adquisiciones.'],
        ] as $event) {
            GalleryEvent::updateOrCreate(['slug' => $event['slug']], $event + ['is_published' => true]);
        }
    }
}
