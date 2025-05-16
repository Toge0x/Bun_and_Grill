<style>
    /* Estilos del Navbar */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 30px;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 100;
    }

    .logo img {
        height: 48px;
    }

    .nav-links {
        display: flex;
        align-items: center;
    }

    .nav-link {
        margin: 0 20px;
        color: #333;
        font-weight: 500;
        transition: color 0.3s;
    }

    .nav-link:hover {
        color: #f0b000;
    }

    .login-btn {
        background-color: #2d3748;
        color: white;
        padding: 8px 16px;
        border-radius: 4px;
        font-weight: 500;
        transition: background-color 0.3s;
    }

    .login-btn:hover {
        background-color: #1a202c;
    }

    .mobile-menu-button {
        display: none;
    }

    .mobile-menu {
        display: none;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .mobile-menu.show {
        display: block;
    }

    .mobile-nav-links {
        display: flex;
        flex-direction: column;
    }

    .mobile-nav-link {
        padding: 10px 0;
        color: #333;
        font-weight: 500;
        border-bottom: 1px solid #eee;
    }

    .mobile-login-btn {
        display: block;
        background-color: #2d3748;
        color: white;
        padding: 10px;
        border-radius: 4px;
        font-weight: 500;
        text-align: center;
        margin-top: 15px;
    }

    /* Estilos para el menú desplegable de usuario */
    .user-dropdown {
        position: relative;
        display: inline-block;
    }

    .user-dropdown-btn {
        background-color: #2d3748;
        color: white;
        padding: 8px 16px;
        border-radius: 4px;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .user-dropdown-btn:hover {
        background-color: #1a202c;
    }

    .admin-link {
        color: #e53e3e !important;
        font-weight: 600 !important;
    }

    .admin-link:hover {
        background-color: #fff5f5 !important;
    }

    .user-dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: #fff;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        border-radius: 4px;
        margin-top: 5px;
    }

    .user-dropdown-content a {
        color: #333;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        font-weight: 500;
    }

    .user-dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .user-dropdown.show .user-dropdown-content {
        display: block;
    }

    /* Estilos para el menú desplegable en móvil */
    .mobile-user-dropdown {
        margin-top: 15px;
    }

    .mobile-user-dropdown-btn {
        background-color: #2d3748;
        color: white;
        padding: 10px;
        border-radius: 4px;
        font-weight: 500;
        text-align: center;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .mobile-user-dropdown-content {
        display: none;
        background-color: #f9f9f9;
        margin-top: 5px;
        border-radius: 4px;
    }

    .mobile-user-dropdown-content a {
        color: #333;
        padding: 10px;
        text-decoration: none;
        display: block;
        font-weight: 500;
        border-bottom: 1px solid #eee;
    }

    .mobile-user-dropdown.show .mobile-user-dropdown-content {
        display: block;
    }

    /* Responsive Styles para Navbar */
    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        .mobile-menu-button {
            display: block;
        }

        .mobile-menu-button button {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 20px;
            width: 30px;
        }

        .mobile-menu-button button span {
            display: block;
            height: 3px;
            width: 100%;
            background-color: #333;
            border-radius: 3px;
        }
    }
</style>

<nav class="navbar">
    <div class="logo">
        <a href="/">
            <img src="{{ asset('storage/images/Logo.jpg') }}" alt="Bun & Grill Logo">
        </a>
    </div>

    <div class="nav-links">
        <a href="{{ route('about-us') }}" class="nav-link">Conócenos</a>
        <a href="{{ route('form-contacto') }}" class="nav-link">Contáctanos</a>
        <a href="/hamburguesa-del-mes" class="nav-link">Hamburguesa del Mes</a>
        <a href="/carta" class="nav-link">Carta</a>
        <a href="{{ route('form-reservas') }}" class="nav-link">Reservas</a>
        <a href="{{ route('form-pedidos') }}" class="nav-link">Haz tu pedido</a>

        @if(session()->has('logged_user'))
        <div class="user-dropdown">
            <div class="user-dropdown-btn">
                {{ session('logged_user.nombre') }} {{ session('logged_user.apellidos') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </div>
            <div class="user-dropdown-content">
                @if(session('logged_user.email') === 'pacop@gmail.com')
                <a href="/admin-reservas" class="admin-link">Administración</a>
                @endif
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar Sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        @else
        <a href="/login" class="login-btn">LOGIN</a>
        @endif
    </div>

    <div class="mobile-menu-button">
        <button id="mobile-menu-button">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>

<!-- Mobile Menu -->
<div id="mobile-menu" class="mobile-menu">
    <div class="mobile-nav-links">
        <a href="/hamburguesa-del-mes" class="mobile-nav-link">Hamburgusa del Mes</a>
        <a href="/carta" class="mobile-nav-link">Carta</a>
        <a href="/reservas" class="mobile-nav-link">Reservas</a>
        <a href="/contactanos" class="mobile-nav-link">Contáctanos</a>

        @if(session()->has('logged_user'))
        <div class="mobile-user-dropdown">
            <div class="mobile-user-dropdown-btn">
                {{ session('logged_user.nombre') }} {{ session('logged_user.apellidos') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </div>
            <div class="mobile-user-dropdown-content">
                @if(session('logged_user.email') === 'pacop@gmail.com')
                <a href="/admin-reservas" class="admin-link">Administración</a>
                @endif
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                    Cerrar Sesión
                </a>

                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        @else
        <a href="/login" class="mobile-login-btn">LOGIN</a>
        @endif
    </div>
</div>

<script>
    // Toggle mobile menu
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('show');
    });

    // Toggle user dropdown menu (desktop)
    document.addEventListener('DOMContentLoaded', function() {
        const userDropdownBtn = document.querySelector('.user-dropdown-btn');
        if (userDropdownBtn) {
            userDropdownBtn.addEventListener('click', function() {
                const dropdown = this.closest('.user-dropdown');
                dropdown.classList.toggle('show');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                const dropdown = document.querySelector('.user-dropdown');
                if (dropdown && !dropdown.contains(event.target)) {
                    dropdown.classList.remove('show');
                }
            });
        }

        // Toggle user dropdown menu (mobile)
        const mobileUserDropdownBtn = document.querySelector('.mobile-user-dropdown-btn');
        if (mobileUserDropdownBtn) {
            mobileUserDropdownBtn.addEventListener('click', function() {
                const dropdown = this.closest('.mobile-user-dropdown');
                dropdown.classList.toggle('show');
            });
        }
    });
</script>