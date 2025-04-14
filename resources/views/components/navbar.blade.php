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
        <a href="/login" class="login-btn">LOGIN</a>
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
        <a href="/login" class="mobile-login-btn">LOGIN</a>
    </div>
</div>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('show');
    });
</script>