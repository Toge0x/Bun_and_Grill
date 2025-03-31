@extends('layouts.app')

@section('title', 'Bun & Grill - Hamburguesas Gourmet')

@section('styles')
<style>
    /* Estilos generales */
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

    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    a {
        text-decoration: none;
    }

    /* Hero Section */
    .hero-section {
        position: relative;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('../assets/loginDSS.png');
        background-size: cover;
        background-position: center;
        filter: brightness(0.7);
        z-index: -1;
    }

    .hero-content {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .hero-logo {
        margin-bottom: 30px;
    }

    .hero-logo img {
        max-width: 100%;
        width: 400px;
    }

    .reserva-btn {
        background-color: #2d3748;
        color: white;
        padding: 12px 30px;
        border-radius: 4px;
        font-size: 18px;
        font-weight: 500;
        transition: background-color 0.3s;
    }

    .reserva-btn:hover {
        background-color: #1a202c;
    }

    /* Hamburguesa del Mes Section */
    .hamburguesa-section {
        padding: 80px 0;
        background-color: #fff;
    }

    .hamburguesa-content {
        display: flex;
        align-items: center;
    }

    .hamburguesa-info {
        flex: 1;
        padding-right: 30px;
    }

    .hamburguesa-image {
        flex: 1;
        background-color: #f1f5f9;
        padding: 15px;
        border-radius: 4px;
    }

    .hamburguesa-image img {
        width: 100%;
        height: auto;
        border-radius: 4px;
    }

    .section-title {
        font-size: 28px;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
    }

    .section-description {
        color: #666;
        margin-bottom: 25px;
    }

    .descubre-btn {
        display: inline-block;
        background-color: #2d3748;
        color: white;
        padding: 8px 24px;
        border-radius: 4px;
        font-weight: 500;
        transition: background-color 0.3s;
    }

    .descubre-btn:hover {
        background-color: #1a202c;
    }

    /* Carta Section */
    .carta-section {
        padding: 80px 0;
        background-color: #f8fafc;
    }

    .centered {
        text-align: center;
        margin-bottom: 30px;
        font-size: 36px;
    }

    .carta-button-container {
        text-align: center;
    }

    .carta-btn {
        display: inline-block;
        background-color: #2d3748;
        color: white;
        padding: 12px 30px;
        border-radius: 4px;
        font-weight: 500;
        transition: background-color 0.3s;
    }

    .carta-btn:hover {
        background-color: #1a202c;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .hamburguesa-content {
            flex-direction: column;
        }

        .hamburguesa-info {
            padding-right: 0;
            margin-bottom: 30px;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background"></div>

        <div class="hero-content">
            <div class="hero-logo">
                <img src="{{ asset('images/logo-large.png') }}" alt="Bun & Grill">
            </div>

            <a href="/reservas" class="reserva-btn">
                RESERVA TU SITIO
            </a>
        </div>
    </section>

    <!-- Hamburguesa del Mes Section -->
    <section class="hamburguesa-section">
        <div class="container">
            <div class="hamburguesa-content">
                <div class="hamburguesa-info">
                    <h2 class="section-title">HAMBURGUESA DEL MES: "NOMBRE"</h2>
                    <p class="section-description">Descripcion de la Hamburguesa del Mes</p>
                    <a href="/hamburguesa-del-mes" class="descubre-btn">
                        DESCÚBRELA
                    </a>
                </div>
                <div class="hamburguesa-image">
                    <img src="{{ asset('images/hamburguesa-mes.jpg') }}" alt="Hamburguesa del Mes">
                </div>
            </div>
        </div>
    </section>

    <!-- Carta Section -->
    <section class="carta-section">
        <div class="container">
            <h2 class="section-title centered">CARTA</h2>
            <div class="carta-button-container">
                <a href="/carta" class="carta-btn">
                    VISITA NUESTRA CARTA
                </a>
            </div>
        </div>
    </section>
@endsection