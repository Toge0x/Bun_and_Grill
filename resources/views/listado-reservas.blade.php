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
        <input type="text" class="search-input" placeholder="Buscar por nombre, teléfono o email...">
        <button class="btn btn-secondary">
            <i class="fas fa-search"></i> Buscar
        </button>
    </div>

    <a href="/admin-reservas" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nueva Reserva
    </a>
</div>

<div class="filters-container">
    <div class="filter-group">
        <label class="filter-label">Estado:</label>
        <select class="filter-select">
            <option value="">Todos</option>
            <option value="pendiente">Pendiente</option>
            <option value="confirmada">Confirmada</option>
            <option value="cancelada">Cancelada</option>
            <option value="completada">Completada</option>
        </select>
    </div>

    <div class="filter-group">
        <label class="filter-label">Fecha:</label>
        <select class="filter-select">
            <option value="">Todas</option>
            <option value="hoy">Hoy</option>
            <option value="manana">Mañana</option>
            <option value="semana">Esta semana</option>
            <option value="mes">Este mes</option>
        </select>
    </div>

    <div class="filter-group">
        <label class="filter-label">Personas:</label>
        <select class="filter-select">
            <option value="">Todas</option>
            <option value="1-2">1-2</option>
            <option value="3-4">3-4</option>
            <option value="5-6">5-6</option>
            <option value="7+">7+</option>
        </select>
    </div>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Fecha y Hora</th>
            <th>Personas</th>
            <th>Mesa</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservas as $reserva)
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
        @endforeach
        <tr>
            <td>Juan Pérez<br><small>Tel: 555-123-4567</small></td>
            <td>15/05/2023<br><small>20:00</small></td>
            <td>4</td>
            <td>5</td>
            <td><span class="status-badge status-pendiente">Pendiente</span></td>
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
        <tr>
            <td>María García<br><small>Tel: 555-987-6543</small></td>
            <td>15/05/2023<br><small>21:30</small></td>
            <td>2</td>
            <td>8</td>
            <td><span class="status-badge status-confirmada">Confirmada</span></td>
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
    </tbody>
</table>

<div class="pagination">
    <div class="pagination-info">
        Mostrando 1-5 de 25 reservas
    </div>
    <div class="pagination-buttons">
        <a href="#" class="pagination-button disabled">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a href="#" class="pagination-button active">1</a>
        <a href="#" class="pagination-button">2</a>
        <a href="#" class="pagination-button">3</a>
        <a href="#" class="pagination-button">4</a>
        <a href="#" class="pagination-button">5</a>
        <a href="#" class="pagination-button">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
</div>
@endsection