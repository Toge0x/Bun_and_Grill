@extends('layouts.admin')

@section('title', 'Gestión de Clientes')

@section('page-title', 'Gestión de Clientes')

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

    .client-stats {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 12px;
        background-color: #f8f9fa;
    }

    .client-stats i {
        color: #f0b000;
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

        <a href="{{ route('admin.clientes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Cliente
        </a>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Contacto</th>
                <th>Actividad</th>
                <th>Fecha de registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#C001</td>
                <td>Juan Pérez</td>
                <td>
                    <div>555-123-4567</div>
                    <div><small>juan@example.com</small></div>
                </td>
                <td>
                    <div class="client-stats"><i class="fas fa-calendar-alt"></i> 5 reservas</div>
                    <div class="client-stats"><i class="fas fa-shopping-bag"></i> 8 pedidos</div>
                </td>
                <td>01/01/2023</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.clientes.show', 1) }}" class="btn-icon btn-view" title="Ver detalles">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.clientes.edit', 1) }}" class="btn-icon btn-edit" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn-icon btn-delete" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>#C002</td>
                <td>María García</td>
                <td>
                    <div>555-987-6543</div>
                    <div><small>maria@example.com</small></div>
                </td>
                <td>
                    <div class="client-stats"><i class="fas fa-calendar-alt"></i> 3 reservas</div>
                    <div class="client-stats"><i class="fas fa-shopping-bag"></i> 5 pedidos</div>
                </td>
                <td>15/02/2023</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.clientes.show', 2) }}" class="btn-icon btn-view" title="Ver detalles">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.clientes.edit', 2) }}" class="btn-icon btn-edit" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn-icon btn-delete" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>#C003</td>
                <td>Carlos Rodríguez</td>
                <td>
                    <div>555-456-7890</div>
                    <div><small>carlos@example.com</small></div>
                </td>
                <td>
                    <div class="client-stats"><i class="fas fa-calendar-alt"></i> 2 reservas</div>
                    <div class="client-stats"><i class="fas fa-shopping-bag"></i> 4 pedidos</div>
                </td>
                <td>10/03/2023</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.clientes.show', 3) }}" class="btn-icon btn-view" title="Ver detalles">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.clientes.edit', 3) }}" class="btn-icon btn-edit" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn-icon btn-delete" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>#C004</td>
                <td>Ana Martínez</td>
                <td>
                    <div>555-789-0123</div>
                    <div><small>ana@example.com</small></div>
                </td>
                <td>
                    <div class="client-stats"><i class="fas fa-calendar-alt"></i> 1 reserva</div>
                    <div class="client-stats"><i class="fas fa-shopping-bag"></i> 2 pedidos</div>
                </td>
                <td>05/04/2023</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.clientes.show', 4) }}" class="btn-icon btn-view" title="Ver detalles">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.clientes.edit', 4) }}" class="btn-icon btn-edit" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn-icon btn-delete" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>#C005</td>
                <td>Luis Sánchez</td>
                <td>
                    <div>555-234-5678</div>
                    <div><small>luis@example.com</small></div>
                </td>
                <td>
                    <div class="client-stats"><i class="fas fa-calendar-alt"></i> 4 reservas</div>
                    <div class="client-stats"><i class="fas fa-shopping-bag"></i> 6 pedidos</div>
                </td>
                <td>20/04/2023</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.clientes.show', 5) }}" class="btn-icon btn-view" title="Ver detalles">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.clientes.edit', 5) }}" class="btn-icon btn-edit" title="Editar">
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
            Mostrando 1-5 de 20 clientes
        </div>
        <div class="pagination-buttons">
            <a href="#" class="pagination-button disabled">
                <i class="fas fa-chevron-left"></i>
            </a>
            <a href="#" class="pagination-button active">1</a>
            <a href="#" class="pagination-button">2</a>
            <a href="#" class="pagination-button">3</a>
            <a href="#" class="pagination-button">4</a>
            <a href="#" class="pagination-button">
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>
@endsection