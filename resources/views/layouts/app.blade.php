<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Proyecto')</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        a {
            text-decoration: none;
        }
        /* Estilo mínimo para el botón de logout */
        .btn-logout {
            background: none;
            border: none;
            color: #f00;
            cursor: pointer;
            font-size: 1rem;
            margin-left: 1rem;
        }
        .btn-logout:hover {
            text-decoration: underline;
        }
    </style>

    @yield('styles')
</head>
<body>
    <header>
        @include('components.navbar')

        @auth
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Cerrar sesión</button>
            </form>
        @endauth
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @include('components.footer')
    </footer>
</body>
</html>
