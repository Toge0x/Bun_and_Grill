@extends('layouts.admin')

@section('title', 'Gestión de Reservas')

@section('page-title', 'Gestión de Reservas')

@section('styles')
<style>
    .actions-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .search-container {
        display: flex;
        gap: 10px;
        max-width: 500px;
    }

    .search-input {
        flex: 1;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .search-input:focus {
        outline: none;
        border-color: #f0b000;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 4px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn i {
        margin-right: 8px;
    }

    .btn-primary {
        background-color: #f0b000;
        color: #2d3748;
    }

    .btn-primary:hover {
        background-color: #e0a500;
    }

    .btn-secondary {
        background-color: #e2e8f0;
        color: #2d3748;
    }

    .btn-secondary:hover {
        background-color: #cbd5e0;
    }

    .filters-container {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        align-items: center;
    }

    .filter-label {
        margin-right: 8px;
        font-weight: 500;
        font-size: 14px;
    }

    .filter-select {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: white;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .data-table th {
        background-color: #f8f9fa;
        padding: 12px 15px;
        text-align: left;
        font-weight: bold;
        color: #333;
        border-bottom: 1px solid #ddd;
    }

    .data-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
    }

    .data-table tr:last-child td {
        border-bottom: none;
    }

    .data-table tr:hover {
        background-color: #f9f9f9;
    }

    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        display: inline-block;
    }

    .status-pendiente {
        background-color: #ffeaa7;
        color: #d35400;
    }

    .status-confirmada {
        background-color: #d5f5e3;
        color: #27ae60;
    }

    .status-cancelada {
        background-color: #fadbd8;
        color: #c0392b;
    }

    .status-completada {
        background-color: #d6eaf8;
        color: #2980b9;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 14px;
        transition: all 0.3s;
    }

    .btn-view {
        background-color: #3498db;
    }

    .btn-view:hover {
        background-color: #2980b9;
    }

    .btn-edit {
        background-color: #f0b000;
    }

    .btn-edit:hover {
        background-color: #e0a500;
    }

    .btn-delete {
        background-color: #e74c3c;
    }

    .btn-delete:hover {
        background-color: #c0392b;
    }

    .pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }

    .pagination-info {
        color: #666;
        font-size: 14px;
    }

    .pagination-buttons {
        display: flex;
        gap: 5px;
    }

    .pagination-button {
        padding: 8px 12px;
        border-radius: 4px;
        background-color: #f8f9fa;
        color: #333;
        font-size: 14px;
        transition: all 0.3s;
    }

    .pagination-button:hover {
        background-color: #e2e8f0;
    }

    .pagination-button.active {
        background-color: #f0b000;
        color: #2d3748;
        font-weight: bold;
    }

    .pagination-button.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>
@endsection

@section('content')
<div class="actions-container">
    <div class="search-container">
        <form action="{{ route('reservas.index') }}" method="GET">
            <input type="text" name="search" class="search-input" placeholder="Buscar por nombre, teléfono o email..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">
                <i class="fas fa-search"></i> Buscar
            </button>
        </form>
    </div>

    <a href="/admin-reservas" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nueva Reserva
    </a>
</div>

<div class="filters-container">
    <form action="{{ route('reservas.index') }}" method="GET" id="filters-form">
        <input type="hidden" name="search" value="{{ request('search') }}">
        <!-- Mas tarde
        <div class="filter-group">
            <label class="filter-label">Estado:</label>
            <select class="filter-select" name="estado" onchange="document.getElementById('filters-form').submit()">
                <option value="">Todos</option>
                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="confirmada" {{ request('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                <option value="completada" {{ request('estado') == 'completada' ? 'selected' : '' }}>Completada</option>
            </select>
        </div>

        <div class="filter-group">
            <label class="filter-label">Personas:</label>
            <select class="filter-select" name="personas" onchange="document.getElementById('filters-form').submit()">
                <option value="">Todas</option>
                <option value="1-2" {{ request('personas') == '1-2' ? 'selected' : '' }}>1-2</option>
                <option value="3-4" {{ request('personas') == '3-4' ? 'selected' : '' }}>3-4</option>
                <option value="5-6" {{ request('personas') == '5-6' ? 'selected' : '' }}>5-6</option>
                <option value="7+" {{ request('personas') == '7+' ? 'selected' : '' }}>7+</option>
            </select>
        </div> -->

        <div class="filter-group">
            <label class="filter-label">Fecha:</label>
            <select class="filter-select" name="fecha" onchange="document.getElementById('filters-form').submit()">
                <option value="">Todas</option>
                <option value="hoy" {{ request('fecha') == 'hoy' ? 'selected' : '' }}>Hoy</option>
                <option value="manana" {{ request('fecha') == 'manana' ? 'selected' : '' }}>Mañana</option>
                <option value="semana" {{ request('fecha') == 'semana' ? 'selected' : '' }}>Esta semana</option>
                <option value="mes" {{ request('fecha') == 'mes' ? 'selected' : '' }}>Este mes</option>
            </select>
        </div>


    </form>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Fecha y Hora</th>
            <!-- <th>Personas</th>
            <th>Mesa</th>
            <th>Estado</th> -->
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservas as $reserva)
        <tr>
            <td>
                <small>
                    {{ $reserva->cliente_email}}
                </small>
            </td>
            <td>
                {{ $reserva->fechaReserva }}
                <br>
                <small>
                    {{ $reserva->horaReserva }}
                </small>
            </td>
            <td>
                <div class="action-buttons">
                    <a href="/admin-reservas" class="btn-icon btn-view" title="Ver detalles">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="/admin-reservas" class="btn-icon btn-edit" title="Editar">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn-icon btn-delete" title="Eliminar">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="pagination">
    <div class="pagination-info">
        Mostrando {{ $reservas->firstItem() ?? 0 }}-{{ $reservas->lastItem() ?? 0 }} de {{ $reservas->total() }} reservas
    </div>
    <div class="pagination-buttons">
        <a href="{{ $reservas->appends(request()->except('page'))->previousPageUrl() }}" class="pagination-button {{ $reservas->onFirstPage() ? 'disabled' : '' }}">
            <i class="fas fa-chevron-left"></i>
        </a>

        @for ($i = 1; $i <= $reservas->lastPage(); $i++)
            <a href="{{ $reservas->appends(request()->except('page'))->url($i) }}" class="pagination-button {{ $reservas->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
            @endfor

            <a href="{{ $reservas->appends(request()->except('page'))->nextPageUrl() }}" class="pagination-button {{ !$reservas->hasMorePages() ? 'disabled' : '' }}">
                <i class="fas fa-chevron-right"></i>
            </a>
    </div>
</div>
@endsection