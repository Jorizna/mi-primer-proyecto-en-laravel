<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido a MovieApp</title>
    <style>
        /* Reset simple */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f8;
            color: #333;
            line-height: 1.6;
        }

        header {
            background-color: #1f2937;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin-bottom: 10px;
            font-size: 2rem;
        }

        nav a, nav form button {
            color: #e5e7eb;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
        }

        nav form button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            font: inherit;
        }

        nav a:hover, nav form button:hover {
            text-decoration: underline;
        }

        main {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            text-align: center;
        }

        main p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            background-color: #2563eb;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #1d4ed8;
        }
    </style>
</head>
<body>

<header>
    <h1>Bienvenido a MovieApp</h1>
    <nav>
        @if (Route::has('login'))
            @auth
                <a href="{{ route('movies.index') }}">Películas</a>
                <a href="{{ route('movies.create') }}">Crear nueva película</a>
                <a href="{{ route('profile.edit') }}">Perfil</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit">Cerrar sesión</button>
                </form>
            @else
                <a class="btn" href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                    <a class="btn" href="{{ route('register') }}">Registro</a>
                @endif
            @endauth
        @endif
    </nav>
</header>

<main>
    <p>No hay películas registradas aún.</p>
</main>

</body>
</html>

