@extends('layouts.app')

@section('title', 'Contáctanos - Bun & Grill')

@section('styles')
<style>
    .hero-section {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/img/contact-bg.jpg');
        background-size: cover;
        background-position: center;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }

    .hero-content {
        max-width: 800px;
        padding: 0 20px;
    }

    .hero-title {
        font-size: 48px;
        font-weight: bold;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .hero-subtitle {
        font-size: 20px;
        margin-bottom: 30px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    .contact-section {
        background-color: white;
        padding: 60px 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .section-title {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 30px;
        color: #2d3748;
        text-align: center;
    }

    .section-subtitle {
        font-size: 20px;
        margin-bottom: 40px;
        color: #666;
        text-align: center;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }

    .contact-info {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .info-item {
        margin-bottom: 25px;
        display: flex;
        align-items: flex-start;
    }

    .info-icon {
        font-size: 24px;
        color: #f0b000;
        margin-right: 15px;
        width: 24px;
        text-align: center;
    }

    .info-content h3 {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #2d3748;
    }

    .info-content p,
    .info-content a {
        font-size: 16px;
        color: #4a5568;
        line-height: 1.5;
        text-decoration: none;
    }

    .info-content a:hover {
        color: #f0b000;
    }

    .social-links {
        display: flex;
        gap: 15px;
        margin-top: 10px;
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: #f0b000;
        color: white;
        border-radius: 50%;
        font-size: 20px;
        transition: background-color 0.3s;
    }

    .social-link:hover {
        background-color: #e0a500;
    }

    .contact-form {
        background-color: white;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 8px;
        color: #2d3748;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        transition: border-color 0.3s;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #f0b000;
    }

    .form-textarea {
        min-height: 150px;
        resize: vertical;
    }

    .form-button {
        background-color: #f0b000;
        color: #2d3748;
        font-weight: bold;
        padding: 12px 25px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .form-button:hover {
        background-color: #e0a500;
    }

    .map-section {
        padding: 60px 0;
        background-color: #f8f9fa;
    }

    .map-container {
        height: 450px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }

    .hours-section {
        padding: 60px 0;
    }

    .hours-container {
        max-width: 800px;
        margin: 0 auto;
        background-color: white;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .hours-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #2d3748;
        text-align: center;
    }

    .hours-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .hours-column {
        text-align: center;
    }

    .hours-day {
        font-weight: bold;
        font-size: 18px;
        color: #2d3748;
        margin-bottom: 5px;
    }

    .hours-time {
        font-size: 16px;
        color: #4a5568;
    }

    .hours-note {
        text-align: center;
        margin-top: 20px;
        font-size: 16px;
        color: #f0b000;
        font-weight: 500;
    }

    .faq-section {
        padding: 60px 0;
        background-color: #f8f9fa;
    }

    .faq-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .faq-item {
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .faq-question {
        font-size: 18px;
        font-weight: bold;
        color: #2d3748;
        margin-bottom: 10px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .faq-question:after {
        content: '+';
        font-size: 22px;
        color: #f0b000;
    }

    .faq-answer {
        font-size: 16px;
        color: #4a5568;
        line-height: 1.6;
        display: none;
    }

    .faq-item.active .faq-question:after {
        content: '-';
    }

    .faq-item.active .faq-answer {
        display: block;
    }

    @media (max-width: 992px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }

        .hours-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 36px;
        }

        .section-title {
            font-size: 30px;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Contáctanos</h1>
        <p class="hero-subtitle">Estamos aquí para atenderte</p>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <h2 class="section-title">Ponte en contacto</h2>
        <p class="section-subtitle">¿Tienes alguna pregunta o comentario? Nos encantaría saber de ti</p>

        <div class="contact-grid">
            <div class="contact-info">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-content">
                        <h3>Dirección</h3>
                        <p>Calle Hamburguesa 123<br>28001 Madrid, España</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="info-content">
                        <h3>Teléfono</h3>
                        <p><a href="tel:+34912345678">+34 912 345 678</a></p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p><a href="mailto:info@bungrill.com">info@bungrill.com</a></p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="info-content">
                        <h3>Horario</h3>
                        <p>Lunes a Jueves: 13:00 - 23:00<br>
                            Viernes a Domingo: 13:00 - 00:00</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <div class="info-content">
                        <h3>Síguenos</h3>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <form action="{{ route('contacto.enviar') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" class="form-input">
                    </div>

                    <div class="form-group">
                        <label for="asunto" class="form-label">Asunto</label>
                        <input type="text" id="asunto" name="asunto" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea id="mensaje" name="mensaje" class="form-textarea" required></textarea>
                    </div>

                    <button type="submit" class="form-button">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="container">
        <h2 class="section-title">Encuéntranos</h2>
        <p class="section-subtitle">Visítanos y disfruta de la mejor experiencia gastronómica</p>

        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12143.354068973692!2d-3.7037974302246036!3d40.41677007936127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422997800a3c81%3A0xc436dec1618c2269!2sMadrid%2C%20Spain!5e0!3m2!1sen!2sus!4v1650000000000!5m2!1sen!2sus" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>

<!-- Hours Section -->
<section class="hours-section">
    <div class="container">
        <h2 class="section-title">Horario de Apertura</h2>
        <p class="section-subtitle">Planifica tu visita</p>

        <div class="hours-container">
            <h3 class="hours-title">Nuestro Horario</h3>
            <div class="hours-grid">
                <div class="hours-column">
                    <div class="hours-day">Lunes</div>
                    <div class="hours-time">13:00 - 23:00</div>
                </div>
                <div class="hours-column">
                    <div class="hours-day">Martes</div>
                    <div class="hours-time">13:00 - 23:00</div>
                </div>
                <div class="hours-column">
                    <div class="hours-day">Miércoles</div>
                    <div class="hours-time">13:00 - 23:00</div>
                </div>
                <div class="hours-column">
                    <div class="hours-day">Jueves</div>
                    <div class="hours-time">13:00 - 23:00</div>
                </div>
                <div class="hours-column">
                    <div class="hours-day">Viernes</div>
                    <div class="hours-time">13:00 - 00:00</div>
                </div>
                <div class="hours-column">
                    <div class="hours-day">Sábado</div>
                    <div class="hours-time">13:00 - 00:00</div>
                </div>
                <div class="hours-column">
                    <div class="hours-day">Domingo</div>
                    <div class="hours-time">13:00 - 00:00</div>
                </div>
            </div>
            <p class="hours-note">La cocina cierra 30 minutos antes del cierre del restaurante</p>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <h2 class="section-title">Preguntas Frecuentes</h2>
        <p class="section-subtitle">Respuestas a las dudas más comunes</p>

        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">¿Hacen entregas a domicilio?</div>
                <div class="faq-answer">
                    <p>Sí, realizamos entregas a domicilio en un radio de 5 km desde nuestro local. También puedes hacer tu pedido para recoger en el restaurante. Consulta nuestra sección de "Haz tu pedido" para más información.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">¿Es necesario reservar mesa?</div>
                <div class="faq-answer">
                    <p>Recomendamos reservar, especialmente los fines de semana y festivos, ya que solemos tener mucha afluencia. Puedes hacer tu reserva online a través de nuestra web o llamando por teléfono.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">¿Tienen opciones vegetarianas o veganas?</div>
                <div class="faq-answer">
                    <p>¡Por supuesto! Contamos con varias opciones vegetarianas y veganas en nuestra carta. Nuestras hamburguesas vegetales están elaboradas con ingredientes frescos y de alta calidad para garantizar el mejor sabor.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">¿Se pueden celebrar eventos o cumpleaños?</div>
                <div class="faq-answer">
                    <p>Sí, disponemos de un espacio reservado para eventos y celebraciones. Contáctanos para más información sobre disponibilidad y menús especiales para grupos.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">¿Tienen menú infantil?</div>
                <div class="faq-answer">
                    <p>Sí, contamos con un menú especial para los más pequeños que incluye hamburguesa, patatas fritas y bebida. También disponemos de tronas y material para colorear.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Script para el funcionamiento de las FAQ
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');

            question.addEventListener('click', () => {
                item.classList.toggle('active');
            });
        });
    });
</script>
@endsection