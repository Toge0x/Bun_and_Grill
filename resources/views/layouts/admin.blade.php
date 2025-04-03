<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Bun & Grill Admin</title>
    <style>
        /* Estilos globales del panel de administración */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #2d3748;
            color: #fff;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #3e4a5e;
        }

        .sidebar-header img {
            max-width: 120px;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
        }

        .menu-item:hover {
            background-color: #3e4a5e;
        }

        .menu-item.active {
            background-color: #f0b000;
            color: #2d3748;
            font-weight: bold;
        }

        .menu-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Contenido principal */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
        }

        .user-menu {
            display: flex;
            align-items: center;
        }

        .user-info {
            margin-right: 15px;
            text-align: right;
        }

        .user-name {
            font-weight: bold;
        }

        .user-role {
            font-size: 12px;
            color: #666;
        }

        .logout-btn {
            background-color: #f0b000;
            color: #2d3748;
            padding: 8px 15px;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #e0a500;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }

            .sidebar-header {
                padding: 10px;
            }

            .sidebar-header img {
                max-width: 50px;
            }

            .menu-item span {
                display: none;
            }

            .menu-item i {
                margin-right: 0;
                font-size: 20px;
            }

            .main-content {
                margin-left: 70px;
            }
        }

        /* Botón para mostrar/ocultar sidebar en móvil */
        .toggle-sidebar {
            display: none;
            background: none;
            border: none;
            color: #333;
            font-size: 24px;
            cursor: pointer;
        }

        @media (max-width: 576px) {
            .toggle-sidebar {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
                z-index: 1000;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('styles')
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/logo.png') }}" alt="Bun & Grill">
            </div>
            <nav class="sidebar-menu">
                <a href="{{ route('reservas.index') }}" class="menu-item {{ request()->routeIs('admin.reservas*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Reservas</span>
                </a>
                <a href="/admin-clientes" class="menu-item {{ request()->routeIs('admin.clientes*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Clientes</span>
                </a>
                <a href="/admin-pedidos" class="menu-item {{ request()->routeIs('admin.pedidos*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Pedidos</span>
                </a>
                <a href="/admin-hamburguesas" class="menu-item {{ request()->routeIs('admin.hamburguesas*') ? 'active' : '' }}">
                    <i class="fas fa-hamburger"></i>
                    <span>Hamburguesas</span>
                </a>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="main-content">
            <header class="header">
                <div class="left-section">
                    <button id="toggleSidebar" class="toggle-sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title">@yield('page-title')</h1>
                </div>
                <div class="user-menu">
                    <div class="user-info">
                        <div class="user-name">{{ Auth::user()->name ?? 'Administrador' }}</div>
                        <div class="user-role">Administrador</div>
                    </div>
                    <a href="/logout" class="logout-btn"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesión
                    </a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </header>

            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Toggle sidebar en móvil
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
    </script>
    @yield('scripts')
</body>

</html>