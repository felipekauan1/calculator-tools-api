<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator Tools</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap');

        :root {
            --bg: #0f0f0f;
            --surface: #1a1a1a;
            --surface2: #242424;
            --border: #2e2e2e;
            --accent: #c8f135;
            --accent-dim: #9ab82a;
            --text: #f0f0f0;
            --text-muted: #888;
            --danger: #ff4d4d;
            --radius: 8px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAV */
        nav {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-logo {
            font-family: 'Space Mono', monospace;
            font-size: 1rem;
            font-weight: 700;
            color: var(--accent);
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .nav-logo span {
            color: var(--text-muted);
            font-weight: 400;
        }

        .nav-back {
            font-size: 0.8rem;
            color: var(--text-muted);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s;
        }

        .nav-back:hover { color: var(--accent); }

        /* MAIN */
        main {
            flex: 1;
            max-width: 860px;
            width: 100%;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        /* FORMS */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 2rem;
        }

        .card-title {
            font-family: 'Space Mono', monospace;
            font-size: 1.1rem;
            color: var(--accent);
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }

        label {
            display: block;
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            color: var(--text);
            font-family: 'Space Mono', monospace;
            font-size: 0.95rem;
            padding: 0.7rem 1rem;
            transition: border-color 0.2s;
            outline: none;
        }

        input:focus {
            border-color: var(--accent);
        }

        .field { margin-bottom: 1.2rem; }

        .btn {
            display: inline-block;
            background: var(--accent);
            color: #0f0f0f;
            font-family: 'Space Mono', monospace;
            font-size: 0.85rem;
            font-weight: 700;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            text-decoration: none;
            letter-spacing: 0.03em;
        }

        .btn:hover { background: var(--accent-dim); }
        .btn:active { transform: scale(0.98); }

        /* RESULTADO */
        .resultado {
            margin-top: 1.5rem;
            background: var(--surface2);
            border: 1px solid var(--accent);
            border-radius: var(--radius);
            padding: 1.2rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .resultado-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .resultado-valor {
            font-family: 'Space Mono', monospace;
            font-size: 1.8rem;
            color: var(--accent);
            font-weight: 700;
        }

        /* ERRORS */
        .error-msg {
            font-size: 0.78rem;
            color: var(--danger);
            margin-top: 4px;
        }

        .alert-errors {
            background: rgba(255,77,77,0.08);
            border: 1px solid rgba(255,77,77,0.3);
            border-radius: var(--radius);
            padding: 1rem 1.2rem;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            color: var(--danger);
        }

        /* FOOTER */
        footer {
            text-align: center;
            padding: 1.5rem;
            font-size: 0.75rem;
            color: var(--text-muted);
            border-top: 1px solid var(--border);
        }
    </style>
</head>
<body>
    <nav>
        <a href="/calculadoras" class="nav-logo">calc<span>/</span>tools</a>
        @if(!request()->is('calculadoras'))
            <a href="/calculadoras" class="nav-back">← voltar</a>
        @endif
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        calculator tools &mdash; feito com Laravel
    </footer>
</body>
</html>
