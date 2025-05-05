@extends('layouts.app')

@section('title', 'Conócenos - Bun & Grill')

@section('styles')
<style>
    .hero-section {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/img/restaurant-bg.jpg');
        background-size: cover;
        background-position: center;
        height: 400px;
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

    .content-section {
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

    .about-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 60px;
    }

    .about-image {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .about-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .about-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .about-content h3 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #2d3748;
    }

    .about-content p {
        font-size: 16px;
        line-height: 1.6;
        color: #4a5568;
        margin-bottom: 20px;
    }

    .values-section {
        background-color: #f8f9fa;
        padding: 60px 0;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .value-card {
        background-color: white;
        border-radius: 8px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .value-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .value-icon {
        font-size: 40px;
        color: #f0b000;
        margin-bottom: 20px;
    }

    .value-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #2d3748;
    }

    .value-description {
        font-size: 16px;
        line-height: 1.5;
        color: #4a5568;
    }

    .team-section {
        padding: 60px 0;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    .team-member {
        text-align: center;
    }

    .team-photo {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .team-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .team-name {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #2d3748;
    }

    .team-position {
        font-size: 16px;
        color: #f0b000;
        margin-bottom: 15px;
    }

    .team-bio {
        font-size: 14px;
        line-height: 1.5;
        color: #4a5568;
    }

    .cta-section {
        background-color: #2d3748;
        color: white;
        padding: 60px 0;
        text-align: center;
    }

    .cta-title {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .cta-text {
        font-size: 18px;
        margin-bottom: 30px;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-button {
        display: inline-block;
        background-color: #f0b000;
        color: #2d3748;
        font-weight: bold;
        padding: 15px 30px;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s;
        font-size: 18px;
    }

    .cta-button:hover {
        background-color: #e0a500;
    }

    @media (max-width: 992px) {
        .about-grid {
            grid-template-columns: 1fr;
        }

        .values-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .team-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
        }
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 36px;
        }

        .section-title {
            font-size: 30px;
        }

        .values-grid {
            grid-template-columns: 1fr;
        }

        .team-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Nuestra Historia</h1>
        <p class="hero-subtitle">Descubre la pasión que hay detrás de cada hamburguesa que servimos</p>
    </div>
</section>

<!-- About Section -->
<section class="content-section">
    <div class="container">
        <h2 class="section-title">Conócenos</h2>
        <p class="section-subtitle">Más que un restaurante, somos una experiencia gastronómica</p>

        <div class="about-grid">
            <div class="about-image">
                <img src="{{ asset('storage/images/loginDSS.png') }}" alt="Bun & Grill Interior">
            </div>
            <div class="about-content">
                <h3>Nuestra Historia</h3>
                <p>Bun & Grill nació en 2015 de la pasión de dos amigos por las hamburguesas artesanales. Cansados de la comida rápida industrial, decidimos crear un espacio donde la calidad, el sabor y la creatividad fueran los protagonistas.</p>
                <p>Comenzamos con un pequeño local y una carta de 5 hamburguesas. Hoy, nos hemos convertido en un referente gastronómico en la ciudad, manteniendo nuestra esencia: ingredientes frescos, recetas originales y un servicio cercano.</p>
            </div>
        </div>

        <div class="about-grid">
            <div class="about-content">
                <h3>Nuestra Filosofía</h3>
                <p>En Bun & Grill creemos que una buena hamburguesa debe ser una experiencia completa. Por eso, elaboramos nuestro pan diariamente, seleccionamos las mejores carnes de productores locales y creamos nuestras salsas con recetas propias.</p>
                <p>Nos esforzamos por ofrecer opciones para todos, incluyendo alternativas vegetarianas y veganas que no renuncian al sabor. Nuestro compromiso es sorprender a cada cliente con sabores únicos y una experiencia memorable.</p>
            </div>
            <div class="about-image">
                <img src="{{ asset('storage/images/cartaDSS.jpg') }}" alt="Nuestras hamburguesas">
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="values-section">
    <div class="container">
        <h2 class="section-title">Nuestros Valores</h2>
        <p class="section-subtitle">Los principios que guían cada hamburguesa que servimos</p>

        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 class="value-title">Calidad</h3>
                <p class="value-description">Seleccionamos cuidadosamente cada ingrediente para garantizar el mejor sabor en cada bocado. Trabajamos con proveedores locales que comparten nuestra pasión por la excelencia.</p>
            </div>

            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h3 class="value-title">Creatividad</h3>
                <p class="value-description">Nos atrevemos a innovar y experimentar con nuevos sabores y combinaciones. Nuestra carta evoluciona constantemente, siempre buscando sorprender a nuestros clientes.</p>
            </div>

            <div class="value-card">
                <div class="value-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 class="value-title">Pasión</h3>
                <p class="value-description">Amamos lo que hacemos y eso se refleja en cada detalle. Desde la preparación hasta el servicio, ponemos nuestro corazón en ofrecer una experiencia gastronómica única.</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section">
    <div class="container">
        <h2 class="section-title">Nuestro Equipo</h2>
        <p class="section-subtitle">Las personas que hacen posible la magia de Bun & Grill</p>

        <div class="team-grid">
            <div class="team-member">
                <h3 class="team-name">Carlos Martínez</h3>
                <p class="team-position">Chef Principal</p>
                <p class="team-bio">Con más de 15 años de experiencia, Carlos es el creador de nuestras recetas más emblemáticas. Su pasión por la gastronomía y su creatividad son el alma de Bun & Grill.</p>
            </div>

            <div class="team-member">
                <h3 class="team-name">Laura Sánchez</h3>
                <p class="team-position">Jefa de Cocina</p>
                <p class="team-bio">Especialista en cocina de autor, Laura aporta un toque de innovación a nuestras hamburguesas. Su dedicación a la calidad es inquebrantable.</p>
            </div>

            <div class="team-member">
                <h3 class="team-name">Miguel Rodríguez</h3>
                <p class="team-position">Gerente</p>
                <p class="team-bio">Miguel se asegura de que cada cliente viva una experiencia excepcional. Su atención al detalle y calidez son la clave de nuestro servicio.</p>
            </div>

            <div class="team-member">
                <h3 class="team-name">Ana López</h3>
                <p class="team-position">Panadera</p>
                <p class="team-bio">Ana elabora diariamente nuestro pan artesanal. Su maestría y dedicación son fundamentales para el sabor único de nuestras hamburguesas.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2 class="cta-title">¿Listo para probar nuestras hamburguesas?</h2>
        <p class="cta-text">Ven a visitarnos y descubre por qué nuestros clientes vuelven una y otra vez. También puedes hacer tu pedido online y disfrutar de Bun & Grill donde quieras.</p>
        <a href="{{ route('form-reservas') }}" class="cta-button">RESERVA TU SITIO</a>
    </div>
</section>
@endsection