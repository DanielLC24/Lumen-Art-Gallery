<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $artwork->title }} | Lumen Art Gallery</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|playfair-display:500,600,700" rel="stylesheet" />
    <style>
        :root {
            --bg: #fbfaf7;
            --surface: rgba(255, 255, 255, .84);
            --ink: #171717;
            --muted: #6d6d69;
            --line: rgba(150, 150, 145, .24);
            --gold: #c5a35d;
            --gold-deep: #8e7138;
            --silver: #b8bdc1;
            --shadow: 0 24px 90px rgba(114, 111, 104, .18);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background:
                radial-gradient(circle at 18% 10%, rgba(197, 163, 93, .16), transparent 26%),
                radial-gradient(circle at 82% 14%, rgba(184, 189, 193, .24), transparent 28%),
                linear-gradient(115deg, transparent 0 14%, rgba(184, 189, 193, .18) 14.4%, transparent 15.2% 42%, rgba(197, 163, 93, .10) 42.5%, transparent 43.4%),
                linear-gradient(150deg, transparent 0 28%, rgba(184, 189, 193, .15) 28.3%, transparent 29.1% 68%, rgba(184, 189, 193, .13) 68.4%, transparent 69.1%),
                var(--bg);
            background-attachment: fixed;
            color: var(--ink);
            font-family: "Instrument Sans", system-ui, sans-serif;
            letter-spacing: 0;
        }

        body::before {
            background-image:
                linear-gradient(105deg, transparent 0 47%, rgba(118, 122, 126, .10) 47.2%, transparent 48%),
                linear-gradient(28deg, transparent 0 58%, rgba(197, 163, 93, .08) 58.3%, transparent 59%),
                linear-gradient(162deg, transparent 0 74%, rgba(118, 122, 126, .09) 74.2%, transparent 75%);
            content: "";
            inset: 0;
            opacity: .74;
            pointer-events: none;
            position: fixed;
            z-index: -1;
        }

        a { color: inherit; text-decoration: none; }
        img { display: block; width: 100%; }

        .nav {
            align-items: center;
            backdrop-filter: blur(18px);
            background: color-mix(in srgb, var(--surface) 88%, transparent);
            border-bottom: 1px solid var(--line);
            display: flex;
            justify-content: space-between;
            padding: 16px clamp(18px, 4vw, 52px);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .brand {
            align-items: center;
            display: flex;
            gap: 12px;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .brand-mark {
            background: linear-gradient(135deg, rgba(255,255,255,.72), rgba(197, 163, 93, .12));
            border: 1px solid var(--gold);
            color: var(--gold);
            display: grid;
            height: 34px;
            place-items: center;
            width: 34px;
        }

        .back-link, .pill-button, .outline-button {
            align-items: center;
            border: 1px solid var(--line);
            display: inline-flex;
            gap: 10px;
            justify-content: center;
            min-height: 42px;
            padding: 0 18px;
            transition: transform .25s ease, border-color .25s ease;
        }

        .nav-actions {
            align-items: center;
            display: flex;
            gap: 10px;
        }

        .cart-link {
            min-width: 42px;
            padding: 0;
            position: relative;
        }

        .cart-link svg {
            height: 19px;
            width: 19px;
        }

        .cart-badge {
            background: var(--gold);
            color: #111;
            display: inline-grid;
            font-size: 12px;
            height: 20px;
            place-items: center;
            position: absolute;
            right: -8px;
            top: -8px;
            width: 20px;
        }

        .back-link, .outline-button {
            background: color-mix(in srgb, var(--surface) 72%, transparent);
        }

        .pill-button {
            background: linear-gradient(135deg, var(--gold-deep), var(--gold));
            border-color: rgba(197, 163, 93, .65);
            color: #fffaf0;
            box-shadow: 0 12px 32px rgba(142, 113, 56, .24);
        }

        .back-link:hover, .pill-button:hover, .outline-button:hover {
            border-color: var(--gold);
            transform: translateY(-2px);
        }

        main {
            padding: clamp(32px, 5vw, 72px);
        }

        .detail {
            display: grid;
            gap: clamp(28px, 5vw, 64px);
            grid-template-columns: minmax(280px, .95fr) minmax(300px, 1.05fr);
            margin: 0 auto;
            max-width: 1280px;
        }

        .art-image {
            background: var(--surface);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: clamp(12px, 2vw, 22px);
        }

        .art-image img {
            aspect-ratio: 4 / 5;
            object-fit: cover;
        }

        .eyebrow {
            color: var(--gold-deep);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .18em;
            margin: 0 0 18px;
            text-transform: uppercase;
        }

        h1, h2, h3 {
            font-family: "Playfair Display", Georgia, serif;
            font-weight: 600;
            letter-spacing: 0;
            line-height: 1.02;
            margin: 0;
        }

        h1 {
            font-size: clamp(46px, 7vw, 92px);
        }

        .artist {
            color: var(--muted);
            font-size: clamp(18px, 2vw, 24px);
            margin: 18px 0 28px;
        }

        .description {
            color: var(--muted);
            font-size: 17px;
            line-height: 1.8;
            margin: 0 0 30px;
            max-width: 720px;
        }

        .facts {
            background: var(--surface);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin: 28px 0;
        }

        .fact {
            border-bottom: 1px solid var(--line);
            padding: 18px;
        }

        .fact:nth-child(odd) {
            border-right: 1px solid var(--line);
        }

        .fact span {
            color: var(--muted);
            display: block;
            font-size: 12px;
            letter-spacing: .14em;
            margin-bottom: 7px;
            text-transform: uppercase;
        }

        .fact strong {
            font-size: 16px;
            line-height: 1.4;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .source-note {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
            margin-top: 22px;
        }

        .related {
            margin: clamp(70px, 9vw, 120px) auto 0;
            max-width: 1280px;
        }

        .related h2 {
            font-size: clamp(32px, 5vw, 58px);
            margin-bottom: 24px;
        }

        .related-grid {
            display: grid;
            gap: 18px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .related-card {
            background: var(--surface);
            border: 1px solid var(--line);
            box-shadow: 0 16px 50px rgba(114, 111, 104, .10);
            overflow: hidden;
        }

        .related-card img {
            aspect-ratio: 4 / 3.4;
            object-fit: cover;
        }

        .related-card div {
            padding: 18px;
        }

        .related-card p {
            color: var(--muted);
            margin: 8px 0 0;
        }

        footer {
            border-top: 1px solid var(--line);
            color: var(--muted);
            margin-top: 70px;
            padding: 32px clamp(18px, 5vw, 72px);
        }

        @media (max-width: 900px) {
            .detail, .related-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 620px) {
            .facts {
                grid-template-columns: 1fr;
            }
            .fact:nth-child(odd) {
                border-right: 0;
            }
        }
    </style>
</head>
<body>
    <nav class="nav">
        <a class="brand" href="{{ url('/') }}">
            <span class="brand-mark">L</span>
            <span>Lumen Art Gallery</span>
        </a>
        <div class="nav-actions">
            <a class="back-link cart-link" href="{{ route('cart.index') }}" aria-label="Ver carrito">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M6 6h15l-1.5 8.5H8L6 3H3"></path>
                    <circle cx="9" cy="20" r="1.5"></circle>
                    <circle cx="18" cy="20" r="1.5"></circle>
                </svg>
                <span class="cart-badge">{{ array_sum(session('cart', [])) }}</span>
            </a>
            <a class="back-link" href="{{ url('/#galeria') }}">Volver a obras</a>
        </div>
    </nav>

    <main>
        <section class="detail">
            <div class="art-image">
                <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }} de {{ $artwork->artist?->name }}" onerror="this.src='https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=1200&q=85'">
            </div>

            <article>
                <p class="eyebrow">Ficha de obra</p>
                <h1>{{ $artwork->title }}</h1>
                <p class="artist">{{ $artwork->artist?->name }}</p>
                <p class="description">{{ $artwork->description }}</p>

                <div class="facts">
                    <div class="fact"><span>Artista</span><strong>{{ $artwork->artist?->name }}</strong></div>
                    <div class="fact"><span>Tecnica</span><strong>{{ $artwork->technique }}</strong></div>
                    <div class="fact"><span>Dimensiones</span><strong>{{ $artwork->dimensions }}</strong></div>
                    <div class="fact"><span>Año</span><strong>{{ $artwork->year }}</strong></div>
                    <div class="fact"><span>Disponibilidad</span><strong>{{ $artwork->availability }}</strong></div>
                    <div class="fact"><span>Precio</span><strong>{{ $artwork->price }}</strong></div>
                </div>

                <div class="actions">
                    <a class="pill-button" href="{{ url('/#contacto') }}">Solicitar informacion</a>
                    @if ($artwork->source_url)
                        <a class="outline-button" href="{{ $artwork->source_url }}" target="_blank" rel="noreferrer">Ver referencia</a>
                    @endif
                </div>

                <p class="source-note">Los datos curatoriales se basan en fuentes museograficas. Las imagenes usadas aqui son fotografias ambientales de referencia para evitar reproducir obras protegidas por derechos de autor.</p>
            </article>
        </section>

        <section class="related">
            <p class="eyebrow">Tambien te puede interesar</p>
            <h2>Obras relacionadas</h2>
            <div class="related-grid">
                @foreach ($relatedArtworks as $related)
                    <a class="related-card" href="{{ route('artworks.show', $related->slug) }}">
                        <img src="{{ $related->image_url }}" alt="{{ $related->title }} de {{ $related->artist?->name }}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=800&q=85'">
                        <div>
                            <h3>{{ $related->title }}</h3>
                            <p>{{ $related->artist?->name }} · {{ $related->year }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </main>

    <footer>
        Lumen Art Gallery · Ficha individual de obra
    </footer>
</body>
</html>
