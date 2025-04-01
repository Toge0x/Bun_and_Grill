@extends('layouts.app')

@section('title', 'Registro - Bun & Grill')

@section('styles')
<style>
/* Estilos para la página de registro */
.register-container {
    position: relative;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.register-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('../images/hero-background.jpg');
    background-size: cover;
    background-position: center;
    filter: brightness(0.8);
    z-index: -1;
}

.register-form-container {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 600px;
    padding: 40px 30px;
    text-align: center;
}

.register-logo {
    margin-bottom: 30px;
}

.register-logo img {
    width: 150px;
    height: auto;
}

.register-title {
    font-size: 24px;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 25px;
}

.form-row {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
    text-align: left;
    flex: 1;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #333;
}

.form-input {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    transition: border-color 0.3s;
}

.form-input:focus {
    outline: none;
    border-color: #f0b000;
}

.form-select {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    transition: border-color 0.3s;
    background-color: white;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 12px;
}

.form-select:focus {
    outline: none;
    border-color: #f0b000;
}

.register-button {
    width: 100%;
    background-color: #2d3748;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 12px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 10px;
}

.register-button:hover {
    background-color: #1a202c;
}

.login-link {
    margin-top: 20px;
    display: block;
    color: #666;
    font-size: 14px;
}

.login-link a {
    color: #f0b000;
    text-decoration: underline;
}

.login-link a:hover {
    color: #e0a500;
}

.error-message {
    color: #e53e3e;
    font-size: 14px;
    margin-top: 5px;
    display: block;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .form-row {
        flex-direction: column;
        gap: 0;
    }

    .register-form-container {
        padding: 30px 20px;
    }
}
</style>
@endsection

@section('content')
<div class="register-container">
    <div class="register-background"></div>

    <div class="register-form-container">
        <div class="register-logo">
            <img src="{{ asset('storage/images/Logo.jpg') }}" alt="Bun & Grill Logo">
        </div>

        <h2 class="register-title">Crea tu cuenta</h2>

        {{-- Mostrar errores de validación --}}

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom: 20px; text-align: left;">
                <ul style="padding-left: 20px; color: #e53e3e;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Cambiar más adelante el action del formulario -->
        <form method="POST" action="{{ route('registro') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        class="form-input"
                        value="{{ old('nombre') }}"
                        required
                        autofocus
                    >
                    @error('nombre')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input
                        type="text"
                        id="apellidos"
                        name="apellidos"
                        class="form-input"
                        value="{{ old('apellidos') }}"
                        required
                    >
                    @error('apellidos')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-input"
                    value="{{ old('email') }}"
                    placeholder="example@email.com"
                    required
                >
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input"
                        placeholder="••••••••••••••"
                        required
                    >
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-input"
                        placeholder="••••••••••••••"
                        required
                    >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input
                        type="tel"
                        id="telefono"
                        name="telefono"
                        class="form-input"
                        value="{{ old('telefono') }}"
                        placeholder="123-456-789"
                    >
                    @error('telefono')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select id="sexo" name="sexo" class="form-select">
                        <option value="">Seleccionar</option>
                        <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="otro" {{ old('sexo') == 'otro' ? 'selected' : '' }}>Otro</option>
                        <option value="prefiero_no_decir" {{ old('sexo') == 'prefiero_no_decir' ? 'selected' : '' }}>Prefiero no decir</option>
                    </select>
                    @error('sexo')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="direccion" class="form-label">Dirección</label>
                <input
                    type="text"
                    id="direccion"
                    name="direccion"
                    class="form-input"
                    value="{{ old('direccion') }}"
                    placeholder="Calle, número, código postal, ciudad"
                >
                @error('direccion')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="register-button">REGISTRARSE</button>

            <div class="login-link">
                ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
            </div>
        </form>
    </div>
</div>
@endsection