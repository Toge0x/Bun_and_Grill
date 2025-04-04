<!DOCTYPE html>
<html lang="es">

<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Estilos globales básicos */
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
    </style>
    @yield('styles')
</head>

<body>
    <header>
        @include('components.navbar')
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @include('components.footer')
    </footer>

    <!-- Scripts base -->
    <script>
        // Scripts globales aquí
    </script>

    <!-- Scripts específicos de cada página -->
    @yield('scripts')

</body>

</html>