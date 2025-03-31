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
            <div class="footer-logo">
                <a href="/">
                    <img src="{{ asset('storage/images/Logo.jpg') }}" alt="Bun & Grill Logo">
                </a>
            </div>

            <div class="footer-links">
                <a href="/carta'" class="footer-link">Carta</a>
                <span class="separator">|</span>
                <a href="/reservas" class="footer-link">Reservas</a>
                <span class="separator">|</span>
                <a href="/contactanos" class="footer-link">Conáctanos</a>
            </div>

            <div class="footer-address">
                1717 Harrison St, San Francisco
            </div>
        </div>

        <div class="footer-copyright">
            &copy; {{ date('Y') }} Bun & Grill. Todos los derechos reservados.
        </div>
    </div>
</footer>