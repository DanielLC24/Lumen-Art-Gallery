<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin | Lumen Art Gallery</title>
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
            --shadow: 0 24px 90px rgba(114, 111, 104, .18);
        }

        * { box-sizing: border-box; }

        body {
            align-items: center;
            background:
                radial-gradient(circle at 18% 10%, rgba(197, 163, 93, .16), transparent 26%),
                radial-gradient(circle at 82% 14%, rgba(184, 189, 193, .24), transparent 28%),
                linear-gradient(115deg, transparent 0 14%, rgba(184, 189, 193, .18) 14.4%, transparent 15.2% 42%, rgba(197, 163, 93, .10) 42.5%, transparent 43.4%),
                var(--bg);
            color: var(--ink);
            display: grid;
            font-family: "Instrument Sans", system-ui, sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 24px;
        }

        .login {
            background: var(--surface);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            margin: auto;
            max-width: 460px;
            padding: clamp(28px, 5vw, 44px);
            width: 100%;
        }

        .brand {
            align-items: center;
            display: flex;
            gap: 12px;
            font-weight: 600;
            letter-spacing: .08em;
            margin-bottom: 28px;
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

        h1 {
            font-family: "Playfair Display", Georgia, serif;
            font-size: clamp(36px, 6vw, 56px);
            line-height: 1.05;
            margin: 0 0 10px;
        }

        p {
            color: var(--muted);
            line-height: 1.7;
            margin: 0 0 24px;
        }

        form {
            display: grid;
            gap: 14px;
        }

        label {
            color: var(--muted);
            display: grid;
            gap: 8px;
            font-size: 13px;
        }

        input {
            background: rgba(255,255,255,.8);
            border: 1px solid var(--line);
            color: var(--ink);
            min-height: 48px;
            padding: 12px 14px;
            width: 100%;
        }

        button {
            background: linear-gradient(135deg, var(--gold-deep), var(--gold));
            border: 1px solid rgba(197, 163, 93, .65);
            color: #fffaf0;
            cursor: pointer;
            min-height: 48px;
            padding: 0 18px;
        }

        .message, .errors {
            border: 1px solid var(--line);
            margin-bottom: 16px;
            padding: 12px 14px;
        }

        .message {
            background: rgba(197, 163, 93, .14);
        }

        .errors {
            background: rgba(164, 63, 63, .08);
            color: var(--danger);
        }
    </style>
</head>
<body>
    <main class="login">
        <div class="brand">
            <span class="brand-mark">L</span>
            <span>Lumen Admin</span>
        </div>

        <h1>Acceso privado</h1>
        <p>Ingresa tus credenciales para administrar obras, artistas, eventos y precios.</p>

        @if (session('status'))
            <div class="message">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="errors">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.login.attempt') }}" method="POST">
            @csrf
            <label>Usuario
                <input name="username" value="{{ old('username') }}" autocomplete="username" required autofocus>
            </label>
            <label>Contraseña
                <input name="password" type="password" autocomplete="current-password" required>
            </label>
            <button type="submit">Entrar al panel</button>
        </form>
    </main>
</body>
</html>
