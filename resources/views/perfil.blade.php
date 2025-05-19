@extends('layouts.app')

@section('title', 'Perfil')

@section('content')
<div class="profile-container">
    <div class="profile-card">
        <div class="profile-header">
            <h3>MI PERFIL</h3>
        </div>
        <div class="profile-body">
            @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="profile-tabs">
                <div class="tab-links">
                    <a href="#datos" class="tab-link active" id="datos-tab" onclick="openTab(event, 'datos')">Datos Personales</a>
                    <a href="#password" class="tab-link" id="password-tab" onclick="openTab(event, 'password')">Cambiar Contraseña</a>
                </div>

                <div class="tab-content">
                    <!-- Datos Personales -->
                    <div id="datos" class="tab-pane active">
                        <form action="{{ route('perfil.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" type="text" class="form-input @error('nombre') input-error @enderror" name="nombre" value="{{ old('nombre', session('logged_user.nombre')) }}" required>
                                @error('nombre')
                                <span class="error-message">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input id="apellidos" type="text" class="form-input @error('apellidos') input-error @enderror" name="apellidos" value="{{ old('apellidos', session('logged_user.apellidos')) }}" required>
                                @error('apellidos')
                                <span class="error-message">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input disabled id="email" type="email" class="form-input @error('email') input-error @enderror" name="email" value="{{ old('email', session('logged_user.email')) }}" required>
                                @error('email')
                                <span class="error-message">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input id="telefono" type="text" class="form-input @error('telefono') input-error @enderror" name="telefono" value="{{ old('telefono', $usuario->telefono ?? '') }}">
                                @error('telefono')
                                <span class="error-message">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input id="direccion" type="text" class="form-input @error('direccion') input-error @enderror" name="direccion" value="{{ old('direccion', $usuario->direccion ?? '') }}">
                                @error('direccion')
                                <span class="error-message">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="sexo">Sexo</label>
                                <select id="sexo" class="form-select @error('sexo') input-error @enderror" name="sexo">
                                    <option value="M" {{ (old('sexo', $usuario->sexo ?? '') == 'M') ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ (old('sexo', $usuario->sexo ?? '') == 'F') ? 'selected' : '' }}>Femenino</option>
                                    <option value="O" {{ (old('sexo', $usuario->sexo ?? '') == 'O') ? 'selected' : '' }}>Otro</option>
                                </select>
                                @error('sexo')
                                <span class="error-message">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-dark">
                                    Actualizar Datos
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Cambiar Contraseña -->
                    <div id="password" class="tab-pane">
                        <form action="{{ route('perfil.password') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="current_password">Contraseña Actual</label>
                                <input id="current_password" type="password" class="form-input @error('current_password') input-error @enderror" name="current_password" required>
                                @error('current_password')
                                <span class="error-message">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Nueva Contraseña</label>
                                <input id="password" type="password" class="form-input @error('password') input-error @enderror" name="password" required>
                                @error('password')
                                <span class="error-message">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirmar Contraseña</label>
                                <input id="password_confirmation" type="password" class="form-input" name="password_confirmation" required>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-dark">
                                    Cambiar Contraseña
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Estilos CSS puros para la página de perfil */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .profile-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .profile-card {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .profile-header {
        background-color: #343a40;
        color: white;
        padding: 20px;
    }

    .profile-header h3 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .profile-body {
        padding: 30px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        padding: 12px 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #c3e6cb;
    }

    /* Tabs */
    .profile-tabs {
        margin-top: 20px;
    }

    .tab-links {
        display: flex;
        border-bottom: 1px solid #dee2e6;
        margin-bottom: 20px;
    }

    .tab-link {
        padding: 10px 15px;
        margin-right: 5px;
        color: #495057;
        text-decoration: none;
        font-weight: 500;
        border: 1px solid transparent;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        cursor: pointer;
    }

    .tab-link.active {
        color: #343a40;
        font-weight: 600;
        border-color: #dee2e6 #dee2e6 #fff;
        background-color: #fff;
        margin-bottom: -1px;
    }

    .tab-content {
        padding: 10px 0;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
    }

    /* Form elements */
    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.2s;
    }

    .form-input:focus,
    .form-select:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .input-error {
        border-color: #dc3545;
    }

    .error-message {
        display: block;
        color: #dc3545;
        font-size: 14px;
        margin-top: 5px;
    }

    .form-actions {
        margin-top: 30px;
    }

    .btn-dark {
        background-color: #343a40;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-dark:hover {
        background-color: #23272b;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-body {
            padding: 20px;
        }

        .tab-link {
            padding: 8px 12px;
            font-size: 14px;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    function openTab(evt, tabName) {
        // Ocultar todos los contenidos de pestañas
        var tabcontent = document.getElementsByClassName("tab-pane");
        for (var i = 0; i < tabcontent.length; i++) {
            tabcontent[i].classList.remove("active");
        }

        // Desactivar todos los botones de pestañas
        var tablinks = document.getElementsByClassName("tab-link");
        for (var i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }

        // Mostrar la pestaña actual y activar el botón
        document.getElementById(tabName).classList.add("active");
        evt.currentTarget.classList.add("active");
    }

    // Asegurarse de que la primera pestaña esté activa al cargar
    document.addEventListener('DOMContentLoaded', function() {
        // La pestaña de datos personales está activa por defecto
        document.getElementById('datos').classList.add('active');
        document.getElementById('datos-tab').classList.add('active');
    });
</script>
@endsection