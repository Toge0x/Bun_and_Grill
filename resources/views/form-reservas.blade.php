@extends('layouts.app')

@section('content')
<div class="hero-section">
    <div class="container">
        <h1 class="hero-title">RESERVA TU MESA</h1>
    </div>
</div>

<div class="reservation-container">
    <div class="reservation-content">
        <h2 class="section-title">HAZ TU RESERVA</h2>

        @guest
        <div class="alert-info">
            Para hacer una reserva necesitas 
            <a href="{{ route('login') }}">iniciar sesión</a>.
        </div>
        @endguest


        @auth
        <form action="{{ route('reservas.store') }}" method="POST" class="reservation-form">
            @csrf

            @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-row">
                <div class="form-group">
                    <label for="fechaReserva">FECHA</label>
                    <input type="date" id="fechaReserva" name="fechaReserva" required value="{{ old('fechaReserva', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}">
                </div>
                <div class="form-group">
                    <label for="horaReserva">HORA</label>
                    <input type="time" id="horaReserva" name="horaReserva" required value="{{ old('horaReserva', '20:00') }}" min="12:00" max="23:00">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="personas">PERSONAS</label>
                    <input type="number" id="personas" name="personas" placeholder="Número de personas" min="1" max="20" required value="{{ old('personas', 2) }}">
                </div>
                <div class="form-group">
                    <label for="zona">ZONA</label>
                    <select id="zona" name="zona" required>
                        <option value="" disabled selected>Selecciona una zona</option>
                        <option value="Interior" {{ old('zona') == 'Interior' ? 'selected' : '' }}>Interior</option>
                        <option value="Exterior" {{ old('zona') == 'Exterior' ? 'selected' : '' }}>Terraza</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="nombre">NOMBRE</label>
                    <input type="text" id="nombre" name="nombre" required value="{{ old('nombre') }}">
                </div>
                <div class="form-group">
                    <label for="telefono">TELÉFONO</label>
                    <input type="tel" id="telefono" name="telefono" required value="{{ old('telefono') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="email">EMAIL</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="comentarios">COMENTARIOS (Opcional)</label>
                <textarea id="comentarios" name="comentarios" rows="3">{{ old('comentarios') }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">RESERVAR AHORA</button>
            </div>
        </form>
        @endauth
    </div>
</div>

<style>
    /* Estilos generales */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f5f5f5;
    }

    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Hero section */
    .hero-section {
        background-image: url('/images/restaurant-interior.jpg');
        background-size: cover;
        background-position: center;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        position: relative;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
    }

    .hero-title {
        font-size: 3rem;
        font-weight: bold;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    /* Reservation container */
    .reservation-container {
        background-color: white;
        padding: 40px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: -50px;
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 50px;
    }

    .section-title {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 30px;
    }

    /* Form */
    .reservation-form {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 5px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 20px;
    }

    .form-row {
        display: flex;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
        }
    }

    .form-group {
        flex: 1;
        margin-bottom: 20px;
    }

    .form-row .form-group {
        margin-right: 15px;
        margin-bottom: 0;
    }

    .form-row .form-group:last-child {
        margin-right: 0;
    }

    @media (max-width: 768px) {
        .form-row .form-group {
            margin-right: 0;
            margin-bottom: 20px;
        }
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #2d3748;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    .form-actions {
        text-align: center;
        margin-top: 30px;
    }

    .btn-primary {
        background-color: #2d3748;
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        text-transform: uppercase;
    }

    .btn-primary:hover {
        background-color: #1a202c;
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validación del formulario
        const form = document.querySelector('.reservation-form');
        form.addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const fechaReserva = document.getElementById('fechaReserva').value;
            const horaReserva = document.getElementById('horaReserva').value;

            if (!email || !fechaReserva || !horaReserva) {
                e.preventDefault();
                alert('Por favor, completa todos los campos obligatorios.');
                return;
            }
        });
    });
</script>
@endpush
@endsection