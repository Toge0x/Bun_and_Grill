@extends('layouts.app')

@section('title', 'Hamburguesa del Mes - Bun & Grill')

@section('styles')
<style>
    /* Estilos generales */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background-color: #f5f5f5;
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    /* Encabezado */
    .burger-month-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .burger-month-title {
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #222;
        position: relative;
        display: inline-block;
    }

    .burger-month-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background-color: #f0b000;
        border-radius: 2px;
    }

    .burger-month-subtitle {
        font-size: 18px;
        color: #666;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Sección de la hamburguesa destacada */
    .featured-burger {
        display: flex;
        flex-direction: column;
        background-color: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 60px;
    }

    .featured-burger-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .featured-burger-content {
        padding: 40px;
    }

    .featured-burger-price {
        display: inline-block;
        background-color: #f0b000;
        color: #222;
        font-weight: 700;
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 20px;
        margin-bottom: 20px;
    }

    .featured-burger-title {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 20px;
        color: #222;
    }

    .featured-burger-description {
        font-size: 18px;
        line-height: 1.7;
        color: #555;
        margin-bottom: 30px;
    }

    .featured-burger-ingredients {
        margin-bottom: 30px;
    }

    .ingredients-title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #222;
    }

    .ingredients-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .ingredient-tag {
        background-color: #f8f8f8;
        color: #555;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    /* Sección de alérgenos */
    .allergens-section {
        margin-bottom: 30px;
    }

    .allergens-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #222;
    }

    .allergens-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .allergen-tag {
        background-color: #fff0f0;
        color: #e74c3c;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
        border: 1px solid #ffcccc;
    }

    .no-allergens {
        color: #666;
        font-size: 16px;
        font-style: italic;
    }

    /* Botones de acción */
    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .btn {
        display: inline-block;
        padding: 15px 30px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        text-decoration: none;
    }

    .btn-primary {
        background-color: #222;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #333;
    }

    .btn-secondary {
        background-color: transparent;
        color: #222;
        border: 2px solid #222;
    }

    .btn-secondary:hover {
        background-color: #f5f5f5;
    }

    /* Sección de valoraciones */
    .ratings-section {
        background-color: #fff;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .ratings-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 30px;
        color: #222;
        text-align: center;
    }

    .rating-stars {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
        gap: 5px;
    }

    .star {
        font-size: 30px;
        color: #f0b000;
    }

    .rating-value {
        font-size: 24px;
        font-weight: 700;
        color: #222;
        text-align: center;
        margin-bottom: 20px;
    }

    .rating-count {
        font-size: 16px;
        color: #666;
        text-align: center;
        margin-bottom: 30px;
    }

    /* Sección de tiempo limitado */
    .limited-time {
        margin-top: 60px;
        background-color: #f0b000;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        color: #222;
    }

    .limited-time-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .limited-time-text {
        font-size: 16px;
        margin-bottom: 20px;
    }

    .countdown {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .countdown-item {
        background-color: #fff;
        border-radius: 10px;
        padding: 15px;
        min-width: 80px;
    }

    .countdown-value {
        font-size: 28px;
        font-weight: 700;
        color: #222;
    }

    .countdown-label {
        font-size: 14px;
        color: #666;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 20px 15px;
        }

        .burger-month-title {
            font-size: 32px;
        }

        .burger-month-subtitle {
            font-size: 16px;
        }

        .featured-burger-image {
            height: 300px;
        }

        .featured-burger-content {
            padding: 30px;
        }

        .featured-burger-title {
            font-size: 28px;
        }

        .featured-burger-description {
            font-size: 16px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .countdown {
            flex-wrap: wrap;
        }
    }

    @media (max-width: 576px) {
        .burger-month-title {
            font-size: 28px;
        }

        .featured-burger-image {
            height: 250px;
        }

        .featured-burger-content {
            padding: 20px;
        }

        .featured-burger-title {
            font-size: 24px;
        }

        .ratings-section {
            padding: 30px 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="burger-month-header">
        <h1 class="burger-month-title">Hamburguesa del Mes</h1>
        <p class="burger-month-subtitle">Cada mes seleccionamos una hamburguesa especial con ingredientes de temporada y sabores únicos. ¡No te la pierdas, es por tiempo limitado!</p>
    </div>

    <div class="featured-burger">

        <div class="featured-burger-content">
            <div class="featured-burger-price">{{ number_format($hamburguesa->precio, 2) }} €</div>
            <h2 class="featured-burger-title">{{ $hamburguesa->nombre }}</h2>
            <p class="featured-burger-description">
                Nuestra hamburguesa destacada de este mes es una creación especial que combina sabores intensos y texturas sorprendentes.
                Elaborada con ingredientes frescos de la más alta calidad, esta hamburguesa es una experiencia gastronómica que no te puedes perder.
            </p>

            <div class="featured-burger-ingredients">
                <h3 class="ingredients-title">Ingredientes</h3>
                <div class="ingredients-list">
                    @if(is_array($hamburguesa->ingredientes))
                    @foreach($hamburguesa->ingredientes as $ingrediente)
                    <span class="ingredient-tag">{{ $ingrediente }}</span>
                    @endforeach
                    @else
                    <span class="ingredient-tag">{{ $hamburguesa->ingredientes }}</span>
                    @endif
                </div>
            </div>

            <div class="allergens-section">
                <h3 class="allergens-title">Alérgenos</h3>
                <div class="allergens-list">
                    @if(isset($hamburguesa->alergenos) && is_array($hamburguesa->alergenos) && count($hamburguesa->alergenos) > 0)
                    @foreach($hamburguesa->alergenos as $alergeno)
                    <span class="allergen-tag">{{ $alergeno }}</span>
                    @endforeach
                    @else
                    <span class="no-allergens">Sin alérgenos</span>
                    @endif
                </div>
            </div>

            <div class="action-buttons">
                <a href="#" class="btn btn-primary">Añadir al pedido</a>
                <a href="{{ route('carta') }}" class="btn btn-secondary">Ver carta completa</a>
            </div>
        </div>
    </div>

    <div class="limited-time">
        <h3 class="limited-time-title">¡Oferta por tiempo limitado!</h3>
        <p class="limited-time-text">Esta hamburguesa especial solo estará disponible durante este mes. ¡No te la pierdas!</p>

        <div class="countdown">
            <div class="countdown-item">
                <div class="countdown-value" id="countdown-days">30</div>
                <div class="countdown-label">Días</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value" id="countdown-hours">23</div>
                <div class="countdown-label">Horas</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value" id="countdown-minutes">59</div>
                <div class="countdown-label">Minutos</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value" id="countdown-seconds">59</div>
                <div class="countdown-label">Segundos</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cuenta regresiva
        const endOfMonth = new Date();
        endOfMonth.setMonth(endOfMonth.getMonth() + 1);
        endOfMonth.setDate(1);
        endOfMonth.setHours(0, 0, 0, 0);
        endOfMonth.setTime(endOfMonth.getTime() - 1); // Último segundo del mes actual

        function updateCountdown() {
            const now = new Date();
            const diff = endOfMonth - now;

            if (diff <= 0) {
                document.getElementById('countdown-days').textContent = '0';
                document.getElementById('countdown-hours').textContent = '0';
                document.getElementById('countdown-minutes').textContent = '0';
                document.getElementById('countdown-seconds').textContent = '0';
                return;
            }

            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            document.getElementById('countdown-days').textContent = days;
            document.getElementById('countdown-hours').textContent = hours;
            document.getElementById('countdown-minutes').textContent = minutes;
            document.getElementById('countdown-seconds').textContent = seconds;
        }

        // Actualizar cada segundo
        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
</script>
@endsection