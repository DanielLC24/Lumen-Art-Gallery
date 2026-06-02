<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') | Lumen Art Gallery</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|playfair-display:600" rel="stylesheet" />
    <style>
        :root {
            --bg: #fbfaf7;
            --surface: rgba(255, 255, 255, .88);
            --ink: #171717;
            --muted: #6d6d69;
            --line: rgba(150, 150, 145, .24);
            --gold: #c5a35d;
            --gold-deep: #8e7138;
            --danger: #a43f3f;
            --shadow: 0 20px 70px rgba(114, 111, 104, .14);
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
        button, input, select, textarea { font: inherit; }
        img { display: block; max-width: 100%; }

        .shell {
            display: grid;
            grid-template-columns: 260px 1fr;
            min-height: 100vh;
        }
        aside {
            background: rgba(255,255,255,.72);
            border-right: 1px solid var(--line);
            padding: 24px;
            position: sticky;
            top: 0;
            height: 100vh;
        }
        .brand {
            align-items: center;
            display: flex;
            gap: 12px;
            font-weight: 600;
            letter-spacing: .08em;
            margin-bottom: 34px;
            text-transform: uppercase;
        }
        .brand-mark {
            border: 1px solid var(--gold);
            color: var(--gold);
            display: grid;
            height: 36px;
            place-items: center;
            width: 36px;
        }
        nav {
            display: grid;
            gap: 8px;
        }
        nav a {
            border: 1px solid transparent;
            color: var(--muted);
            padding: 12px 14px;
        }
        nav a:hover, nav a.active {
            background: var(--surface);
            border-color: var(--line);
            color: var(--ink);
        }
        main {
            padding: clamp(24px, 4vw, 52px);
        }
        .topbar {
            align-items: center;
            display: flex;
            gap: 16px;
            justify-content: space-between;
            margin-bottom: 28px;
        }
        h1, h2, h3 {
            font-family: "Playfair Display", Georgia, serif;
            font-weight: 600;
            line-height: 1.05;
            margin: 0;
        }
        h1 { font-size: clamp(36px, 5vw, 62px); }
        h2 { font-size: 28px; }
        .muted { color: var(--muted); }
        .button, .button-secondary, .button-danger {
            align-items: center;
            border: 1px solid var(--line);
            cursor: pointer;
            display: inline-flex;
            justify-content: center;
            min-height: 42px;
            padding: 0 16px;
        }
        .button {
            background: linear-gradient(135deg, var(--gold-deep), var(--gold));
            border-color: rgba(197, 163, 93, .65);
            color: #fffaf0;
        }
        .button-secondary {
            background: var(--surface);
        }
        .button-danger {
            background: rgba(164, 63, 63, .08);
            color: var(--danger);
        }
        .grid {
            display: grid;
            gap: 18px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
        .card, .panel {
            background: var(--surface);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
        }
        .card { padding: 24px; }
        .card strong {
            display: block;
            font-size: 34px;
            margin-top: 8px;
        }
        .panel { overflow: hidden; }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border-bottom: 1px solid var(--line);
            padding: 14px;
            text-align: left;
            vertical-align: top;
        }
        th {
            color: var(--muted);
            font-size: 12px;
            letter-spacing: .12em;
            text-transform: uppercase;
        }
        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .status {
            background: rgba(197, 163, 93, .16);
            border: 1px solid rgba(197, 163, 93, .34);
            margin-bottom: 18px;
            padding: 12px 14px;
        }
        .errors {
            background: rgba(164, 63, 63, .08);
            border: 1px solid rgba(164, 63, 63, .24);
            color: var(--danger);
            margin-bottom: 18px;
            padding: 12px 14px;
        }
        form.grid-form {
            background: var(--surface);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            padding: 24px;
        }
        label {
            color: var(--muted);
            display: grid;
            gap: 8px;
            font-size: 13px;
        }
        input, select, textarea {
            background: rgba(255,255,255,.78);
            border: 1px solid var(--line);
            color: var(--ink);
            min-height: 46px;
            padding: 11px 12px;
            width: 100%;
        }
        textarea {
            min-height: 140px;
            resize: vertical;
        }
        .full { grid-column: 1 / -1; }
        .checkbox {
            align-items: center;
            display: flex;
            gap: 10px;
        }
        .checkbox input {
            min-height: auto;
            width: auto;
        }
        .pagination {
            padding: 16px;
        }
        @media (max-width: 900px) {
            .shell { grid-template-columns: 1fr; }
            aside {
                height: auto;
                position: static;
            }
            .grid, form.grid-form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="shell">
        <aside>
            <a class="brand" href="{{ route('admin.dashboard') }}">
                <span class="brand-mark">L</span>
                <span>Admin</span>
            </a>
            <nav>
                <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="{{ request()->routeIs('admin.artworks.*') ? 'active' : '' }}" href="{{ route('admin.artworks.index') }}">Obras</a>
                <a class="{{ request()->routeIs('admin.artists.*') ? 'active' : '' }}" href="{{ route('admin.artists.index') }}">Artistas</a>
                <a class="{{ request()->routeIs('admin.events.*') ? 'active' : '' }}" href="{{ route('admin.events.index') }}">Eventos</a>
                <a class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}">Mensajes</a>
                <a href="{{ url('/') }}">Ver sitio</a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button class="button-secondary" type="submit" style="width: 100%; margin-top: 12px;">Cerrar sesion</button>
                </form>
            </nav>
        </aside>
        <main>
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

            @yield('content')
        </main>
    </div>
</body>
</html>
