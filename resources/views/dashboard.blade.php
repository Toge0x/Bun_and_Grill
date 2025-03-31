@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('styles')
<style>
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        display: flex;
        align-items: center;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 24px;
    }

    .stat-icon.reservas {
        background-color: rgba(52, 152, 219, 0.2);
        color: #3498db;
    }

    .stat-icon.clientes {
        background-color: rgba(46, 204, 113, 0.2);
        color: #2ecc71;
    }

    .stat-icon.pedidos {
        background-color: rgba(155, 89, 182, 0.2);
        color: #9b59b6;
    }

    .stat-icon.ingresos {
        background-color: rgba(240, 176, 0, 0.2);
        color: #f0b000;
    }

    .stat-info {
        flex: 1;
    }

    .stat-value {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .stat-label {
        color: #666;
        font-size: 14px;
    }

    .dashboard-sections {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .dashboard-card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .dashboard-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .dashboard-card-title {
        font-size: 18px;
        font-weight: bold;
    }

    .dashboard-card-link {
        color: #f0b000;
        font-size: 14px;
    }

    .dashboard-card-link:hover {
        text-decoration: underline;
    }

    .recent-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #eee;
    }

    .recent-item:last-child {
        border-bottom: none;
    }

    .recent-item-info {
        flex: 1;
    }

    .recent-item-title {
        font-weight: bold;
        margin-bottom: 3px;
    }

    .recent-item-subtitle {
        color: #666;
        font-size: 13px;
    }

    .recent-item-status {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: bold;
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

    .chart-container {
        height: 300px;
        margin-top: 15px;
    }
</style>
@endsection

@section('content')
    <!-- Estadísticas generales -->
    <div class="dashboard-stats">
        <div class="stat-card">
            <div class="stat-icon reservas">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">24</div>
                <div class="stat-label">Reservas hoy</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon clientes">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">156</div>
                <div class="stat-label">Clientes totales</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon pedidos">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">38</div>
                <div class="stat-label">Pedidos pendientes</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon ingresos">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">$2,450</div>
                <div class="stat-label">Ingresos hoy</div>
            </div>
        </div>
    </div>

    <!-- Secciones del dashboard -->
    <div class="dashboard-sections">
        <!-- Reservas recientes -->
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h2 class="dashboard-card-title">Reservas recientes</h2>
                <a href="/admin-reservas" class="dashboard-card-link">Ver todas</a>
            </div>

            <div class="dashboard-card-content">
                <div class="recent-item">
                    <div class="recent-item-info">
                        <div class="recent-item-title">Mesa 5 - 4 personas</div>
                        <div class="recent-item-subtitle">Juan Pérez - Hoy 20:00</div>
                    </div>
                    <span class="recent-item-status status-pendiente">Pendiente</span>
                </div>

                <div class="recent-item">
                    <div class="recent-item-info">
                        <div class="recent-item-title">Mesa 8 - 2 personas</div>
                        <div class="recent-item-subtitle">María García - Hoy 21:30</div>
                    </div>
                    <span class="recent-item-status status-confirmada">Confirmada</span>
                </div>

                <div class="recent-item">
                    <div class="recent-item-info">
                        <div class="recent-item-title">Mesa 3 - 6 personas</div>
                        <div class="recent-item-subtitle">Carlos Rodríguez - Mañana 19:00</div>
                    </div>
                    <span class="recent-item-status status-confirmada">Confirmada</span>
                </div>

                <div class="recent-item">
                    <div class="recent-item-info">
                        <div class="recent-item-title">Mesa 10 - 3 personas</div>
                        <div class="recent-item-subtitle">Ana Martínez - Ayer 20:30</div>
                    </div>
                    <span class="recent-item-status status-cancelada">Cancelada</span>
                </div>
            </div>
        </div>

        <!-- Pedidos recientes -->
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h2 class="dashboard-card-title">Pedidos recientes</h2>
                <a href="/admin-pedidos" class="dashboard-card-link">Ver todos</a>
            </div>

            <div class="dashboard-card-content">
                <div class="recent-item">
                    <div class="recent-item-info">
                        <div class="recent-item-title">Pedido #1089</div>
                        <div class="recent-item-subtitle">2 Hamburguesas, 1 Refresco - $35.50</div>
                    </div>
                    <span class="recent-item-status status-pendiente">En preparación</span>
                </div>

                <div class="recent-item">
                    <div class="recent-item-info">
                        <div class="recent-item-title">Pedido #1088</div>
                        <div class="recent-item-subtitle">1 Hamburguesa del mes, 2 Papas - $28.75</div>
                    </div>
                    <span class="recent-item-status status-completada">Entregado</span>
                </div>

                <div class="recent-item">
                    <div class="recent-item-info">
                        <div class="recent-item-title">Pedido #1087</div>
                        <div class="recent-item-subtitle">3 Hamburguesas, 3 Refrescos - $52.25</div>
                    </div>
                    <span class="recent-item-status status-completada">Entregado</span>
                </div>

                <div class="recent-item">
                    <div class="recent-item-info">
                        <div class="recent-item-title">Pedido #1086</div>
                        <div class="recent-item-subtitle">2 Hamburguesas, 1 Ensalada - $42.00</div>
                    </div>
                    <span class="recent-item-status status-cancelada">Cancelado</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos y estadísticas -->
    <div class="dashboard-sections">
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h2 class="dashboard-card-title">Ventas de la semana</h2>
            </div>
            <div class="chart-container">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h2 class="dashboard-card-title">Productos más vendidos</h2>
            </div>
            <div class="chart-container">
                <canvas id="productsChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de ventas
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
            datasets: [{
                label: 'Ventas ($)',
                data: [1200, 1900, 1500, 2000, 2400, 3100, 2800],
                backgroundColor: 'rgba(240, 176, 0, 0.2)',
                borderColor: '#f0b000',
                borderWidth: 2,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Gráfico de productos
    const productsCtx = document.getElementById('productsChart').getContext('2d');
    const productsChart = new Chart(productsCtx, {
        type: 'bar',
        data: {
            labels: ['Hamburguesa Clásica', 'Hamburguesa del Mes', 'Hamburguesa Vegana', 'Papas Fritas', 'Refresco'],
            datasets: [{
                label: 'Unidades vendidas',
                data: [120, 80, 45, 180, 210],
                backgroundColor: [
                    'rgba(52, 152, 219, 0.7)',
                    'rgba(46, 204, 113, 0.7)',
                    'rgba(155, 89, 182, 0.7)',
                    'rgba(241, 196, 15, 0.7)',
                    'rgba(230, 126, 34, 0.7)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection