<div class="reservation-form">
    <h2 class="form-title">HAZ TU RESERVA</h2>
    
    <form action="{{ route('reservas.store') }}" method="POST">
        @csrf
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="mb-4">
            <label for="dia" class="form-label fw-bold">DIA</label>
            <div class="input-group">
                <input type="text" id="dia" name="dia" class="form-control" placeholder="Selecciona una fecha" required value="{{ old('dia') }}">
                <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                    </svg>
                </span>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="hora" class="form-label fw-bold">HORA</label>
                <input type="text" id="hora" name="hora" class="form-control" placeholder="hora" required value="{{ old('hora') }}">
            </div>
            <div class="col-md-4">
                <label for="personas" class="form-label fw-bold">PERSONAS</label>
                <input type="number" id="personas" name="personas" class="form-control" placeholder="nº personas" min="1" max="20" required value="{{ old('personas') }}">
            </div>
            <div class="col-md-4">
                <label for="zona" class="form-label fw-bold">ZONA</label>
                <select id="zona" name="zona" class="form-control" required>
                    <option value="" disabled selected>Interior/Exterior</option>
                    <option value="Interior" {{ old('zona') == 'Interior' ? 'selected' : '' }}>Interior</option>
                    <option value="Exterior" {{ old('zona') == 'Exterior' ? 'selected' : '' }}>Exterior</option>
                </select>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label fw-bold">NOMBRE</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required value="{{ old('nombre') }}">
            </div>
            <div class="col-md-6">
                <label for="telefono" class="form-label fw-bold">TELÉFONO</label>
                <input type="tel" id="telefono" name="telefono" class="form-control" required value="{{ old('telefono') }}">
            </div>
        </div>
        
        <div class="mb-4">
            <label for="email" class="form-label fw-bold">EMAIL</label>
            <input type="email" id="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>
        
        <div class="mb-4">
            <label for="comentarios" class="form-label fw-bold">COMENTARIOS (Opcional)</label>
            <textarea id="comentarios" name="comentarios" class="form-control" rows="3">{{ old('comentarios') }}</textarea>
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-reserva">RESERVA</button>
        </div>
    </form>
</div>

<style>
    .reservation-form {
        background-color: white;
        padding: 40px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: -50px;
        position: relative;
        z-index: 2;
    }
    
    .form-title {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 30px;
    }
    
    .btn-reserva {
        background-color: #2d3748;
        color: white;
        padding: 10px 30px;
        font-weight: bold;
    }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#dia", {
            locale: "es",
            dateFormat: "d/m/Y",
            minDate: "today",
            disableMobile: "true"
        });
        
        flatpickr("#hora", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            minTime: "12:00",
            maxTime: "23:00",
            disableMobile: "true"
        });
    });
</script>
@endpush