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
        <form action="{{ route('usuarios.index') }}" method="GET">
            <input type="text" name="search" class="search-input" placeholder="Buscar por nombre, teléfono o email..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">
                <i class="fas fa-search"></i> Buscar
            </button>
        </form>
    </div>

    <a href="/admin-clientes" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nuevo Cliente
    </a>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Contacto</th>
            <th>Direccion</th>
            <th>Fecha de registro</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $usuario)
        <tr>
            <td>{{$usuario->nombre}} {{$usuario->apellidos}}</td>
            <td>
                <div>{{$usuario->telefono}}</div>
                <div><small>{{$usuario->email}}</small></div>
            </td>
            <td>
                <div>{{$usuario->direccion}}</div>

            </td>
            <td>
                <div>{{$usuario->created_at}}</div>
            </td>
            <td>
                <div class="action-buttons">
                    <a href="/admin-clientes" class="btn-icon btn-view" title="Ver detalles">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="/admin-clientes" class="btn-icon btn-edit" title="Editar">
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
        Mostrando {{ $usuarios->firstItem() ?? 0 }}-{{ $usuarios->lastItem() ?? 0 }} de {{ $usuarios->total() }} clientes
    </div>
    <div class="pagination-buttons">
        <a href="{{ $usuarios->previousPageUrl() }}" class="pagination-button {{ $usuarios->onFirstPage() ? 'disabled' : '' }}">
            <i class="fas fa-chevron-left"></i>
        </a>

        @for ($i = 1; $i <= $usuarios->lastPage(); $i++)
            <a href="{{ $usuarios->url($i) }}" class="pagination-button {{ $usuarios->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
            @endfor

            <a href="{{ $usuarios->nextPageUrl() }}" class="pagination-button {{ !$usuarios->hasMorePages() ? 'disabled' : '' }}">
                <i class="fas fa-chevron-right"></i>
            </a>
    </div>
</div>
@endsection