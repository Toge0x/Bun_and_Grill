<!DOCTYPE html>
<html lang="es">
<head>
    <title>@yield('title')</title>
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
</body>
</html>