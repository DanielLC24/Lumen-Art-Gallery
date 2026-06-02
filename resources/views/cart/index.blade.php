<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrito | Lumen Art Gallery</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|playfair-display:500,600,700" rel="stylesheet" />
    <style>
        :root {
            --bg: #fbfaf7;
            --surface: rgba(255, 255, 255, .86);
            --ink: #171717;
            --muted: #6d6d69;
            --line: rgba(150, 150, 145, .24);
            --gold: #c5a35d;
            --gold-deep: #8e7138;
            --danger: #a43f3f;
            --shadow: 0 24px 90px rgba(114, 111, 104, .18);
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            background:
                radial-gradient(circle at 18% 10%, rgba(197, 163, 93, .16), transparent 26%),
                radial-gradient(circle at 82% 14%, rgba(184, 189, 193, .24), transparent 28%),
                linear-gradient(115deg, transparent 0 14%, rgba(184, 189, 193, .18) 14.4%, transparent 15.2% 42%, rgba(197, 163, 93, .10) 42.5%, transparent 43.4%),
                var(--bg);
            color: var(--ink);
            font-family: "Instrument Sans", system-ui, sans-serif;
        }
        a { color: inherit; text-decoration: none; }
        img { display: block; width: 100%; }
        button, input, select, textarea { font: inherit; }

        .nav {
            align-items: center;
            backdrop-filter: blur(18px);
            background: color-mix(in srgb, var(--surface) 92%, transparent);
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
            border: 1px solid var(--gold);
            color: var(--gold);
            display: grid;
            height: 34px;
            place-items: center;
            width: 34px;
        }
        .button, .button-secondary, .button-danger {
            align-items: center;
            border: 1px solid var(--line);
            cursor: pointer;
            display: inline-flex;
            justify-content: center;
            min-height: 42px;
            padding: 0 16px;
            transition: border-color .25s ease, transform .25s ease;
        }
        .button {
            background: linear-gradient(135deg, var(--gold-deep), var(--gold));
            border-color: rgba(197, 163, 93, .65);
            color: #fffaf0;
        }
        .button-secondary { background: var(--surface); }
        .button-danger {
            background: rgba(164, 63, 63, .08);
            color: var(--danger);
        }
        .button:hover, .button-secondary:hover, .button-danger:hover {
            border-color: var(--gold);
            transform: translateY(-2px);
        }

        main {
            padding: clamp(34px, 5vw, 72px);
        }
        .hero {
            display: grid;
            gap: 18px;
            margin: 0 auto 34px;
            max-width: 1240px;
        }
        .eyebrow {
            color: var(--gold-deep);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .18em;
            margin: 0;
            text-transform: uppercase;
        }
        h1, h2, h3 {
            font-family: "Playfair Display", Georgia, serif;
            font-weight: 600;
            line-height: 1.04;
            margin: 0;
        }
        h1 { font-size: clamp(44px, 7vw, 88px); }
        h2 { font-size: clamp(28px, 4vw, 44px); }
        p { color: var(--muted); line-height: 1.7; }
        .status {
            background: rgba(197, 163, 93, .14);
            border: 1px solid rgba(197, 163, 93, .28);
            margin: 0 auto 20px;
            max-width: 1240px;
            padding: 12px 14px;
        }
        .errors {
            background: rgba(164, 63, 63, .08);
            border: 1px solid rgba(164, 63, 63, .24);
            color: var(--danger);
            margin: 0 auto 20px;
            max-width: 1240px;
            padding: 12px 14px;
        }

        .checkout {
            align-items: start;
            display: grid;
            gap: 24px;
            grid-template-columns: minmax(0, 1.15fr) minmax(340px, .85fr);
            margin: 0 auto;
            max-width: 1240px;
        }
        .panel {
            background: var(--surface);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            padding: clamp(20px, 3vw, 30px);
        }
        .cart-list {
            display: grid;
            gap: 16px;
        }
        .cart-item {
            border-bottom: 1px solid var(--line);
            display: grid;
            gap: 16px;
            grid-template-columns: 110px 1fr;
            padding-bottom: 16px;
        }
        .cart-item img {
            aspect-ratio: 1;
            object-fit: cover;
        }
        .item-meta {
            align-items: start;
            display: grid;
            gap: 8px;
        }
        .item-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .item-actions form {
            display: contents;
        }
        .availability {
            color: var(--muted);
            font-size: 13px;
        }
        .summary {
            display: grid;
            gap: 14px;
            position: sticky;
            top: 92px;
        }
        .summary-line {
            display: flex;
            justify-content: space-between;
            gap: 16px;
        }
        .summary-line.total {
            border-top: 1px solid var(--line);
            font-size: 20px;
            font-weight: 600;
            padding-top: 14px;
        }
        .currency-block {
            border-top: 1px solid var(--line);
            display: grid;
            gap: 10px;
            padding-top: 14px;
        }
        .form-grid {
            display: grid;
            gap: 14px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin-top: 18px;
        }
        label {
            color: var(--muted);
            display: grid;
            gap: 7px;
            font-size: 13px;
        }
        input, select, textarea {
            background: color-mix(in srgb, var(--bg) 84%, white);
            border: 1px solid var(--line);
            color: var(--ink);
            min-height: 46px;
            padding: 11px 12px;
            width: 100%;
        }
        textarea {
            min-height: 110px;
            resize: vertical;
        }
        .full { grid-column: 1 / -1; }
        .favorite-grid {
            display: grid;
            gap: 12px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            margin-top: 18px;
        }
        .favorite-card {
            border: 1px solid var(--line);
            overflow: hidden;
        }
        .favorite-card img {
            aspect-ratio: 4 / 3;
            object-fit: cover;
        }
        .favorite-card div { padding: 12px; }
        .empty {
            border: 1px dashed var(--line);
            padding: 24px;
        }
        @media (max-width: 900px) {
            .nav {
                gap: 12px;
            }
            .brand {
                min-width: 0;
            }
            .brand span:last-child {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            .checkout {
                grid-template-columns: 1fr;
            }
            .summary {
                position: static;
            }
            .favorite-grid {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 620px) {
            body {
                overflow-x: hidden;
            }
            .nav {
                align-items: stretch;
                flex-direction: column;
                padding: 12px 14px;
            }
            .brand {
                gap: 8px;
                letter-spacing: .04em;
            }
            .brand-mark {
                height: 32px;
                width: 32px;
            }
            .button, .button-secondary, .button-danger {
                min-height: 44px;
                padding: 0 14px;
                width: 100%;
            }
            main {
                padding: 28px 18px;
            }
            .hero {
                gap: 12px;
                margin-bottom: 24px;
            }
            h1 {
                font-size: clamp(40px, 13vw, 58px);
            }
            h2 {
                font-size: clamp(28px, 9vw, 38px);
            }
            .panel {
                padding: 18px;
            }
            .cart-item, .form-grid {
                grid-template-columns: 1fr;
            }
            .cart-item img {
                max-height: 260px;
            }
            .item-actions {
                display: grid;
                grid-template-columns: 1fr;
            }
            .item-actions form {
                display: block;
            }
            .summary-line {
                align-items: start;
                flex-direction: column;
                gap: 4px;
            }
            .summary-line.total {
                font-size: 18px;
            }
            .favorite-card div {
                padding: 14px;
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
        <a class="button-secondary" href="{{ url('/#tienda') }}">Seguir explorando</a>
    </nav>

    <main>
        <section class="hero">
            <p class="eyebrow">Checkout privado</p>
            <h1>Carrito de arte</h1>
            <p>Revisa tus piezas seleccionadas, confirma disponibilidad, guarda favoritos y completa una solicitud de compra simulada.</p>
        </section>

        @if (session('status'))
            <div class="status">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="errors">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="checkout">
            <div class="panel">
                <h2>Obras seleccionadas</h2>

                @if ($items->isEmpty())
                    <div class="empty">
                        <h3>Tu carrito esta vacio</h3>
                        <p>Agrega una obra disponible desde la tienda para comenzar el proceso de compra.</p>
                        <a class="button" href="{{ url('/#tienda') }}">Explorar tienda</a>
                    </div>
                @else
                    <div class="cart-list">
                        @foreach ($items as $item)
                            @php($artwork = $item['artwork'])
                            <article class="cart-item">
                                <img src="{{ $artwork->image_url }}" alt="{{ $artwork->title }}" onerror="this.src='https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=500&q=85'">
                                <div class="item-meta">
                                    <h3>{{ $artwork->title }}</h3>
                                    <p>{{ $artwork->artist?->name }} · {{ $artwork->technique }} · {{ $artwork->dimensions }}</p>
                                    <strong>{{ $artwork->price }}</strong>
                                    <span class="availability">Disponibilidad: {{ $artwork->availability }} · Cantidad: 1 pieza unica</span>
                                    <div class="item-actions">
                                        <form action="{{ route('cart.update', $artwork) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="quantity" value="1">
                                            <button class="button-secondary" type="submit">Actualizar</button>
                                        </form>
                                        <form action="{{ route('favorites.toggle', $artwork) }}" method="POST">
                                            @csrf
                                            <button class="button-secondary" type="submit">Guardar favorito</button>
                                        </form>
                                        <form action="{{ route('cart.remove', $artwork) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button-danger" type="submit">Quitar</button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <h2 style="margin-top: 30px;">Datos de compra</h2>
                        <div class="form-grid">
                            <label>Nombre completo
                                <input name="name" value="{{ old('name') }}" required>
                            </label>
                            <label>Correo
                                <input type="email" name="email" value="{{ old('email') }}" required>
                            </label>
                            <label>Telefono
                                <input name="phone" value="{{ old('phone') }}" required>
                            </label>
                            <label>Metodo de entrega
                                <select name="delivery_method" required>
                                    <option value="Entrega asegurada">Entrega asegurada</option>
                                    <option value="Recoleccion en galeria">Recoleccion en galeria</option>
                                    <option value="Envio internacional">Envio internacional</option>
                                </select>
                            </label>
                            <label class="full">Direccion
                                <input name="address" value="{{ old('address') }}" required>
                            </label>
                            <label>Ciudad
                                <input name="city" value="{{ old('city') }}" required>
                            </label>
                            <label>Estado
                                <input name="state" value="{{ old('state') }}" required>
                            </label>
                            <label>Codigo postal
                                <input name="postal_code" value="{{ old('postal_code') }}" required>
                            </label>
                            <label>Metodo de pago
                                <select name="payment_method" required>
                                    <option value="Tarjeta">Tarjeta</option>
                                    <option value="Transferencia bancaria">Transferencia bancaria</option>
                                    <option value="Pago privado con asesor">Pago privado con asesor</option>
                                </select>
                            </label>
                            <label>Nombre en tarjeta
                                <input name="card_name" value="{{ old('card_name') }}" required>
                            </label>
                            <label>Numero de tarjeta
                                <input name="card_number" value="{{ old('card_number') }}" placeholder="4242 4242 4242 4242" required>
                            </label>
                            <label>Vencimiento
                                <input name="card_expiry" value="{{ old('card_expiry') }}" placeholder="12/28" required>
                            </label>
                            <label>CVV
                                <input name="card_cvv" value="{{ old('card_cvv') }}" placeholder="123" required>
                            </label>
                            <label class="full">Notas para la galeria
                                <textarea name="notes">{{ old('notes') }}</textarea>
                            </label>
                        </div>
                        <p>Este checkout es una simulacion: no procesa pagos reales ni almacena datos de tarjeta.</p>
                        <button class="button" type="submit">Confirmar solicitud de compra</button>
                    </form>
                @endif

                <h2 style="margin-top: 34px;">Favoritos</h2>
                @if ($favorites->isEmpty())
                    <p>No tienes obras favoritas guardadas.</p>
                @else
                    <div class="favorite-grid">
                        @foreach ($favorites as $favorite)
                            <a class="favorite-card" href="{{ route('artworks.show', $favorite->slug) }}">
                                <img src="{{ $favorite->image_url }}" alt="{{ $favorite->title }}" onerror="this.src='https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?auto=format&fit=crop&w=500&q=85'">
                                <div>
                                    <strong>{{ $favorite->title }}</strong>
                                    <p>{{ $favorite->artist?->name }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <aside class="panel summary">
                <h2>Resumen</h2>
                <p>{{ $items->count() }} obra{{ $items->count() === 1 ? '' : 's' }} en carrito</p>

                @forelse ($totals as $currency => $total)
                    <div class="currency-block">
                        <div class="summary-line"><span>Subtotal {{ $currency }}</span><strong>{{ $currency }} {{ number_format($total['subtotal'], 2) }}</strong></div>
                        <div class="summary-line"><span>Envio y manejo</span><strong>{{ $currency }} {{ number_format($total['shipping'], 2) }}</strong></div>
                        <div class="summary-line"><span>Impuesto estimado</span><strong>{{ $currency }} {{ number_format($total['tax'], 2) }}</strong></div>
                        <div class="summary-line total"><span>Total</span><strong>{{ $currency }} {{ number_format($total['total'], 2) }}</strong></div>
                    </div>
                @empty
                    <p>El total aparecera cuando agregues una obra comprable.</p>
                @endforelse

                <p>Las obras con cotizacion privada, agotadas o de referencia museografica no se suman al carrito y se gestionan por consulta.</p>
                <a class="button-secondary" href="{{ url('/#contacto') }}">Hablar con asesor</a>
            </aside>
        </div>
    </main>
</body>
</html>
