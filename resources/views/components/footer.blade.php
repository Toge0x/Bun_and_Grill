<style>
    /* Estilos del Footer */
    .footer {
        background-color: #fff;
        padding: 50px 0 20px;
        border-top: 1px solid #e2e8f0;
    }

    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .footer-logo img {
        height: 64px;
    }

    .footer-links {
        display: flex;
        align-items: center;
    }

    .footer-link {
        color: #666;
        transition: color 0.3s;
        text-decoration: none;
    }

    .footer-link:hover {
        color: #333;
    }

    .separator {
        color: #ccc;
        margin: 0 15px;
    }

    .footer-address {
        color: #666;
    }

    .footer-copyright {
        text-align: center;
        color: #999;
        font-size: 14px;
        margin-top: 30px;
    }

    /* Estilos para los iconos de redes sociales */
    .footer-social {
        margin-top: 20px;
        text-align: center;
    }
    .social-media {
        list-style: none;
        padding: 0;
        margin: 0;
        display: inline-flex;
    }
    .social-media li {
        margin: 0 10px;
    }
    .social-media img {
        width: 32px;
        height: 32px;
        transition: transform 0.3s;
    }
    .social-media img:hover {
        transform: scale(1.1);
    }

    /* Responsive Styles para Footer */
    @media (max-width: 768px) {
        .footer-content {
            flex-direction: column;
            text-align: center;
        }

        .footer-logo {
            margin-bottom: 20px;
        }

        .footer-links {
            margin-bottom: 20px;
            justify-content: center;
        }
    }
</style>

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <!-- Logo: Al hacer clic redirige a la URL definida en href -->
            <div class="footer-logo">
                <!-- Cambia el valor de href si quieres que redirija a otro enlace -->
                <a href="/">
                    <img src="{{ asset('images/Logo.jpg') }}" alt="Bun & Grill Logo">
                </a>
            </div>

            <!-- Enlaces de navegación -->
            <div class="footer-links">
                <!-- Cambia los enlaces modificando los atributos href -->
                <a href="/carta" class="footer-link">Carta</a>
                <span class="separator">|</span>
                <a href="/reservas" class="footer-link">Reservas</a>
                <span class="separator">|</span>
                <a href="/contactanos" class="footer-link">Contáctanos</a>
            </div>

            <!-- Dirección -->
            <div class="footer-address">
                Alicante, España
            </div>
        </div>

        <!-- Bloque para redes sociales -->
        <div class="footer-social">
            <ul class="social-media">
                <li>
                    <a href="https://www.facebook.com/profile.php?id=61575102363500" target="_blank">
                        <img src="{{ asset('images/facebook-icon.png') }}" alt="Facebook">
                    </a>
                </li>
                <li>
                    <a href="https://x.com/bungrill8" target="_blank">
                        <img src="{{ asset('images/twitter-icon.png') }}" alt="Twitter">
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/bun.and.grill?igsh=MWYwZWx5OGtmZGwz&utm_source=qr" target="_blank">
                        <img src="{{ asset('images/instagram-icon.png') }}" alt="Instagram">
                    </a>
                </li>
            </ul>
        </div>

        <!-- Copyright -->
        <div class="footer-copyright">
            &copy; {{ date('Y') }} Bun & Grill. Todos los derechos reservados.
        </div>
    </div>
</footer>
