<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Pokédex</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;500;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #1a1a1a;
            font-family: 'Roboto', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #333;
        }

        /* Header */
        header {
            background: linear-gradient(90deg, #DC143C 0%, #8B0000 50%, #000000 100%);
            padding: 15px 30px;
            box-shadow: 0 8px 16px rgba(220, 20, 60, 0.5);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .logo {
            font-family: 'Press Start 2P', cursive;
            color: white;
            font-size: 1.2em;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);
            text-decoration: none;
            letter-spacing: 2px;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95em;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .nav-links a.active {
            background: rgba(255, 255, 255, 0.3);
            border-color: white;
        }

        /* Main Content */
        main {
            flex: 1;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            padding: 40px 20px;
        }

        /* Container */
        .container {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
            margin: 0 auto;
        }

        h1 {
            color: #DC143C;
            font-size: 2.5em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            border-bottom: 4px solid #DC143C;
            padding-bottom: 15px;
        }

        h2 {
            color: #000000;
            font-size: 1.8em;
            margin-bottom: 20px;
        }

        h3 {
            color: #8B0000;
            font-size: 1.3em;
            margin-bottom: 15px;
        }

        p {
            color: #555;
            line-height: 1.6;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 12px 25px;
            border: 2px solid transparent;
            border-radius: 8px;
            font-size: 1em;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #DC143C 0%, #8B0000 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(220, 20, 60, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #DC143C;
            border-color: #DC143C;
        }

        .btn-secondary:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }

        .btn-success {
            background: linear-gradient(135deg, #228B22 0%, #006400 100%);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(34, 139, 34, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #8B0000 0%, #DC143C 100%);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(139, 0, 0, 0.4);
        }

        /* Forms */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
        }

        input, textarea, select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1em;
            font-family: 'Roboto', sans-serif;
            transition: border-color 0.3s ease;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #DC143C;
            box-shadow: 0 0 8px rgba(220, 20, 60, 0.2);
        }

        .form-error {
            color: #DC143C;
            font-size: 0.9em;
            margin-top: 5px;
        }

        /* Alerts */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }

        .alert-success {
            background: #E8F5E9;
            color: #2E7D32;
            border-color: #4CAF50;
        }

        .alert-error {
            background: #FFEBEE;
            color: #C62828;
            border-color: #DC143C;
        }

        /* Grid */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            border: 2px solid #f0f0f0;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(220, 20, 60, 0.25);
            border-color: #DC143C;
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 1.3em;
            font-weight: 700;
            color: #DC143C;
            margin-bottom: 5px;
        }

        .card-id {
            font-size: 0.85em;
            color: #888;
            margin-bottom: 15px;
        }

        .card-text {
            color: #666;
            margin-bottom: 10px;
            font-size: 0.95em;
        }

        .card-actions {
            display: flex;
            gap: 8px;
            margin-top: 15px;
        }

        .card-actions a, .card-actions button {
            flex: 1;
            padding: 8px;
            font-size: 0.85em;
        }

        /* Search */
        .search-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-bar input {
            flex: 1;
        }

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, rgba(220, 20, 60, 0.1) 0%, rgba(0, 0, 0, 0.05) 100%);
            border-radius: 15px;
            margin-bottom: 40px;
            border: 2px solid #DC143C;
        }

        .hero h1 {
            font-size: 3em;
            margin-bottom: 20px;
            border: none;
            padding: 0;
        }

        .hero p {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 30px;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Footer */
        footer {
            background: #000000;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
            border-top: 3px solid #DC143C;
        }

        @media (max-width: 768px) {
            .nav-links {
                flex-direction: column;
                gap: 10px;
                width: 100%;
            }

            .hero h1 {
                font-size: 2em;
            }

            main {
                padding: 20px 10px;
            }

            .container {
                padding: 20px;
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('home') }}" class="logo">⚡ POKÉDEX ⚡</a>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="{{ Route::currentRouteName() === 'home' ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('pokedex') }}" class="{{ Route::currentRouteName() === 'pokedex' ? 'active' : '' }}">Pokedex</a></li>
                <li><a href="{{ route('pokemon.list') }}" class="{{ Route::currentRouteName() === 'pokemon.list' ? 'active' : '' }}">Meus Pokémons</a></li>
                <li><a href="{{ route('pokemon.create') }}" class="{{ Route::currentRouteName() === 'pokemon.create' ? 'active' : '' }}">Criar</a></li>
                <li><a href="{{ route('pokemon.search') }}" class="{{ Route::currentRouteName() === 'pokemon.search' ? 'active' : '' }}">Procurar</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                ✅ {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-error">
                ❌ {{ $message }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <p>&copy; 2026 Pokédex - Uma aplicação de Pokémons | Desenvolvido com Laravel</p>
    </footer>
</body>
</html>
