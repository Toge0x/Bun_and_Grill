@extends('layouts.app')

@section('title', 'Login - Bun & Grill')

@section('styles')
<style>
    /* Estilos para la página de login */
    .login-container {
        position: relative;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .login-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        overflow: hidden;
    }

    .login-background img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        filter: brightness(0.8);
    }

    .login-form-container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 400px;
        padding: 40px 30px;
        text-align: center;
    }

    .login-logo {
        margin-bottom: 30px;
    }

    .login-logo img {
        width: 150px;
        height: auto;
    }

    .form-group {
        margin-bottom: 20px;
        text-align: left;
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

    .login-button {
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
    }

    .login-button:hover {
        background-color: #1a202c;
    }

    .forgot-password {
        margin-top: 15px;
        display: block;
        color: #666;
        font-size: 14px;
        text-decoration: underline;
    }

    .forgot-password:hover {
        color: #333;
    }

    .registro-link {
        margin-top: 20px;
        display: block;
        color: #666;
        font-size: 14px;
    }

    .registro-link a {
        color: #f0b000;
        text-decoration: underline;
    }

    .registro-link a:hover {
        color: #e0a500;
    }
</style>
@endsection

@section('content')
<div class="login-container">
    <div class="login-background">
        <img src="{{ asset('storage/images/loginDSS.png') }}" alt="Entrada al restaurante Bun & Grill">
    </div>

    <div class="login-form-container">
        <div class="login-logo">
            <img src="{{ asset('storage/images/Logo.jpg') }}" alt="Bun & Grill Logo">
        </div>

        <form method="POST" action="/login">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-input"
                    placeholder="example@email.com"
                    required
                    autofocus>
                @error('email')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    placeholder="••••••••••••••"
                    required>
                @error('password')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="login-button">LOGIN</button>

            <div class="registro-link">
                ¿No tienes una cuenta? <a href="{{ route('registro') }}">Registrate aquí</a>
            </div>

            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="forgot-password">
                ¿Olvidaste tu contraseña?
            </a>
            @endif
        </form>
    </div>
</div>
@endsection