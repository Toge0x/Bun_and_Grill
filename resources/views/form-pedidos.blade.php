@extends('layouts.app')

@section('title', 'Realizar Pedido')

@section('content')
<div class="hero-section">
    <div class="container">
        <h1 class="hero-title">REALIZA TU PEDIDO</h1>
    </div>
</div>

<div class="order-container">
    <div class="order-grid">
        <div class="products-section">
            <h2 class="section-title">NUESTRAS HAMBURGUESAS</h2>

            <!-- Pestañas de categorías -->
            <ul class="category-tabs" id="categoryTabs" role="tablist">
                @foreach($categorias as $index => $categoria)
                <li class="tab-item" role="presentation">
                    <button class="tab-link {{ $index === 0 ? 'active' : '' }}"
                        id="tab-{{ $categoria }}"
                        data-bs-toggle="tab"
                        data-bs-target="#content-{{ $categoria }}"
                        type="button"
                        role="tab"
                        aria-controls="content-{{ $categoria }}"
                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                        {{ $categoria }}
                    </button>
                </li>
                @endforeach
            </ul>

            <!-- Contenido de las pestañas -->
            <div class="tab-content" id="categoryTabsContent">
                @foreach($productos as $categoria => $productosCategoria)
                <div class="tab-pane {{ $loop->first ? 'active' : '' }}"
                    id="content-{{ $categoria }}"
                    role="tabpanel"
                    aria-labelledby="tab-{{ $categoria }}">

                    <div class="products-list">
                        @foreach($productosCategoria as $producto)
                        <div class="product-card">
                            <div class="product-details">
                                <h5 class="product-title">{{ $producto->nombre }}</h5>
                                <p class="product-description">{{ is_array($producto->ingredientes) ? implode(', ', $producto->ingredientes) : $producto->ingredientes }}</p>
                                <p class="product-price">€{{ number_format($producto->precio, 2) }}</p>
                                <button class="btn-add add-to-cart"
                                    data-id="{{ $producto->idProducto }}"
                                    data-nombre="{{ $producto->nombre }}"
                                    data-precio="{{ $producto->precio }}">
                                    Añadir al carrito
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="cart-section">
            <div class="cart-container">
                <div class="cart-header">
                    <h5>Tu Pedido</h5>
                    <span id="cart-count" class="cart-count">0</span>
                </div>
                <div class="cart-body">
                    <div id="cart-items">
                        <div class="cart-empty">
                            <i class="cart-icon"></i>
                            <p>Tu carrito está vacío</p>
                            <p>Añade productos para realizar tu pedido</p>
                        </div>
                    </div>

                    <hr>

                    <div class="cart-summary">
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span id="subtotal">€0.00</span>
                        </div>
                        <div class="summary-row">
                            <span>IVA (10%):</span>
                            <span id="iva">€0.00</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span id="total">€0.00</span>
                        </div>
                    </div>

                    <hr>

                @guest
                    <div class="alert-info">
                        Para realizar un pedido necesitas 
                        <a href="{{ route('login') }}">iniciar sesión</a>.
                    </div>
                @endguest

                @auth
                    <form id="checkout-form" class="checkout-form">
                        @csrf

                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="tel" id="telefono" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección de entrega</label>
                            <textarea id="direccion" name="direccion" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn-primary" id="realizar-pedido" disabled>
                            REALIZAR PEDIDO
                        </button>
                    </form>
                @endauth

<!-- Modal de confirmación -->
<div class="modal" id="confirmationModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pedido Confirmado</h5>
                <button type="button" class="close-btn" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="confirmation-message">
                    <i class="success-icon"></i>
                    <p>¡Tu pedido ha sido registrado con éxito!</p>
                    <p>Recibirás una confirmación por email.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
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
        background-image: url('/images/background-burger.jpg');
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

    /* Order container */
    .order-container {
        background-color: white;
        padding: 40px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: -50px;
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    .order-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }

    @media (max-width: 768px) {
        .order-grid {
            grid-template-columns: 1fr;
        }
    }

    .section-title {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 30px;
    }

    /* Tabs */
    .category-tabs {
        display: flex;
        list-style: none;
        overflow-x: auto;
        white-space: nowrap;
        margin-bottom: 20px;
        border-bottom: 1px solid #ddd;
    }

    .tab-item {
        display: inline-block;
    }

    .tab-link {
        display: inline-block;
        padding: 10px 15px;
        color: #495057;
        text-decoration: none;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    .tab-link.active {
        color: #2d3748;
        font-weight: bold;
        border-bottom: 2px solid #2d3748;
    }

    .tab-content {
        margin-top: 20px;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
    }

    /* Products */
    .products-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .product-card {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #f9f9f9;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .product-title {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .product-description {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
    }

    .product-price {
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 15px;
    }

    .btn-add {
        background-color: #2d3748;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 3px;
        cursor: pointer;
        font-size: 14px;
        width: 100%;
    }

    .btn-add:hover {
        background-color: #1a202c;
    }

    /* Cart */
    .cart-container {
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
        position: sticky;
        top: 20px;
    }

    .cart-header {
        background-color: #2d3748;
        color: white;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cart-header h5 {
        margin: 0;
        font-size: 18px;
    }

    .cart-count {
        background-color: #e53e3e;
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: bold;
        transition: transform 0.3s ease;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.3);
        }

        100% {
            transform: scale(1);
        }
    }

    .pulse {
        animation: pulse 0.5s ease;
    }

    .cart-body {
        padding: 20px;
    }

    .cart-empty {
        text-align: center;
        padding: 30px;
        color: #6c757d;
    }

    .cart-icon::before {
        content: '🛒';
        font-size: 2rem;
        display: block;
        margin-bottom: 10px;
    }

    .cart-item {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
        animation: fadeIn 0.3s ease;
        border-left: 4px solid #28a745;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .cart-item-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .cart-item-title {
        font-weight: bold;
        margin: 0;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #666;
    }

    .cart-item-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .quantity-control {
        display: flex;
        align-items: center;
    }

    .quantity-btn {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e9ecef;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .quantity-input {
        width: 40px;
        text-align: center;
        border: 1px solid #ced4da;
        border-radius: 4px;
        margin: 0 5px;
        padding: 5px;
    }

    .cart-summary {
        margin: 20px 0;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .summary-row.total {
        font-weight: bold;
        margin-top: 10px;
    }

    hr {
        border: 0;
        border-top: 1px solid #ddd;
        margin: 15px 0;
    }

    /* Form */
    .checkout-form {
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    .btn-primary {
        background-color: #2d3748;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        width: 100%;
        font-size: 16px;
    }

    .btn-primary:hover {
        background-color: #1a202c;
    }

    .btn-primary:disabled {
        background-color: #a0aec0;
        cursor: not-allowed;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal.show {
        display: flex;
    }

    .modal-dialog {
        width: 100%;
        max-width: 500px;
        margin: 30px auto;
    }

    .modal-content {
        background-color: white;
        border-radius: 5px;
        overflow: hidden;
    }

    .modal-header {
        padding: 15px;
        border-bottom: 1px solid #ddd;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title {
        margin: 0;
        font-size: 20px;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-footer {
        padding: 15px;
        border-top: 1px solid #ddd;
        text-align: right;
    }

    .confirmation-message {
        text-align: center;
    }

    .success-icon::before {
        content: '✓';
        display: block;
        font-size: 3rem;
        color: #28a745;
        margin-bottom: 15px;
    }

    /* Añadir estilos para resaltar el producto cuando se añade al carrito */
    .product-card.highlight {
        border-color: #28a745;
        box-shadow: 0 0 15px rgba(40, 167, 69, 0.5);
    }

    /* Añadir estilos para mejorar la visualización de los precios en el carrito */
    .item-price {
        font-weight: bold;
        color: #2d3748;
    }

    /* Mejorar los estilos de los botones de cantidad */
    .quantity-btn {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e9ecef;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.2s;
    }

    .quantity-btn:hover {
        background-color: #dee2e6;
    }

    .decrease-quantity {
        color: #e53e3e;
    }

    .increase-quantity {
        color: #28a745;
    }

    /* Mejorar el estilo del botón de eliminar */
    .close-btn {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #e53e3e;
        transition: transform 0.2s;
    }

    .close-btn:hover {
        transform: scale(1.2);
    }
</style>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM cargado correctamente');

        // Tabs functionality
        const tabLinks = document.querySelectorAll('.tab-link');
        const tabPanes = document.querySelectorAll('.tab-pane');

        tabLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Remove active class from all tabs
                tabLinks.forEach(tab => tab.classList.remove('active'));
                tabPanes.forEach(pane => pane.classList.remove('active'));

                // Add active class to current tab
                this.classList.add('active');
                const target = this.getAttribute('data-bs-target').replace('#', '');
                document.getElementById(target).classList.add('active');
            });
        });

        // Cart functionality
        const cartItems = document.getElementById('cart-items');
        const cartCountElement = document.getElementById('cart-count');
        const subtotalElement = document.getElementById('subtotal');
        const ivaElement = document.getElementById('iva');
        const totalElement = document.getElementById('total');
        const realizarPedidoBtn = document.getElementById('realizar-pedido');
        const checkoutForm = document.getElementById('checkout-form');

        // Inicializar carrito desde localStorage o crear uno nuevo
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Actualizar carrito al cargar la página
        updateCart();

        // Añadir producto al carrito
        document.querySelectorAll('.add-to-cart').forEach(button => {
            console.log('Botón encontrado:', button);
            button.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Botón clickeado');

                // Obtén los datos del producto desde los atributos del botón
                const productId = this.dataset.id;
                const productName = this.dataset.nombre;
                const productPrice = parseFloat(this.dataset.precio);

                console.log('Producto:', productId, productName, productPrice);

                // Efecto visual en el botón
                this.textContent = '✓ Añadido';
                this.style.backgroundColor = '#28a745';

                // Restaurar el botón después de 1 segundo
                setTimeout(() => {
                    this.textContent = 'Añadir al carrito';
                    this.style.backgroundColor = '#2d3748';
                }, 1000);

                // Comprobar si el producto ya está en el carrito
                const existingItem = cart.find(item => item.id === productId);

                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    cart.push({
                        id: productId,
                        name: productName,
                        price: productPrice,
                        quantity: 1
                    });
                }

                // Guardar carrito en localStorage
                localStorage.setItem('cart', JSON.stringify(cart));

                // Mostrar notificación
                showNotification(`${productName} añadido al carrito`);

                // Actualizar carrito
                updateCart();

                // Efecto visual en el icono del carrito
                const cartCount = document.getElementById('cart-count');
                cartCount.classList.add('pulse');
                setTimeout(() => {
                    cartCount.classList.remove('pulse');
                }, 500);

                // Resaltar el producto
                const productCard = this.closest('.product-card');
                productCard.classList.add('highlight');
                setTimeout(() => {
                    productCard.classList.remove('highlight');
                }, 2000);
            });
        });

        // Actualizar el carrito
        function updateCart() {
            // Actualizar contador de productos
            const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
            cartCountElement.textContent = totalItems;

            if (cart.length === 0) {
                cartItems.innerHTML = `
                    <div class="cart-empty">
                        <i class="cart-icon"></i>
                        <p>Tu carrito está vacío</p>
                        <p>Añade productos para realizar tu pedido</p>
                    </div>
                `;
                realizarPedidoBtn.disabled = true;
            } else {
                let cartHTML = '';

                cart.forEach(item => {
                    cartHTML += `
                        <div class="cart-item" data-id="${item.id}">
                            <div class="cart-item-header">
                                <h6 class="cart-item-title">${item.name}</h6>
                                <button type="button" class="close-btn remove-item">&times;</button>
                            </div>
                            <div class="cart-item-footer">
                                <div class="quantity-control">
                                    <button type="button" class="quantity-btn decrease-quantity">-</button>
                                    <input type="number" min="1" value="${item.quantity}" class="quantity-input" readonly>
                                    <button type="button" class="quantity-btn increase-quantity">+</button>
                                </div>
                                <span class="item-price">€${(item.price * item.quantity).toFixed(2)}</span>
                            </div>
                        </div>
                    `;
                });

                cartItems.innerHTML = cartHTML;
                realizarPedidoBtn.disabled = false;

                // Añadir event listeners a los botones de cantidad
                document.querySelectorAll('.decrease-quantity').forEach(button => {
                    button.addEventListener('click', function() {
                        const cartItem = this.closest('.cart-item');
                        const productId = cartItem.dataset.id;
                        const item = cart.find(item => item.id === productId);

                        if (item.quantity > 1) {
                            item.quantity -= 1;
                            showNotification(`Cantidad de ${item.name} actualizada`);
                        } else {
                            cart = cart.filter(item => item.id !== productId);
                            showNotification(`${item.name} eliminado del carrito`);
                        }

                        // Guardar carrito en localStorage
                        localStorage.setItem('cart', JSON.stringify(cart));

                        // Actualizar carrito
                        updateCart();
                    });
                });

                document.querySelectorAll('.increase-quantity').forEach(button => {
                    button.addEventListener('click', function() {
                        const cartItem = this.closest('.cart-item');
                        const productId = cartItem.dataset.id;
                        const item = cart.find(item => item.id === productId);

                        item.quantity += 1;
                        showNotification(`Cantidad de ${item.name} actualizada`);

                        // Guardar carrito en localStorage
                        localStorage.setItem('cart', JSON.stringify(cart));

                        // Actualizar carrito
                        updateCart();
                    });
                });

                // Añadir event listeners a los botones de eliminar
                document.querySelectorAll('.remove-item').forEach(button => {
                    button.addEventListener('click', function() {
                        const cartItem = this.closest('.cart-item');
                        const productId = cartItem.dataset.id;
                        const item = cart.find(item => item.id === productId);

                        cart = cart.filter(item => item.id !== productId);
                        showNotification(`${item.name} eliminado del carrito`);

                        // Guardar carrito en localStorage
                        localStorage.setItem('cart', JSON.stringify(cart));

                        // Actualizar carrito
                        updateCart();
                    });
                });
            }

            // Actualizar totales
            const subtotal = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
            const iva = subtotal * 0.10;
            const total = subtotal + iva;

            subtotalElement.textContent = `€${subtotal.toFixed(2)}`;
            ivaElement.textContent = `€${iva.toFixed(2)}`;
            totalElement.textContent = `€${total.toFixed(2)}`;
        }

        // Modificar la función showNotification para hacerla más visible y mejorar la animación
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.textContent = message;

            document.body.appendChild(notification);

            // Estilos para la notificación
            notification.style.position = 'fixed';
            notification.style.bottom = '20px';
            notification.style.right = '20px';
            notification.style.backgroundColor = '#28a745';
            notification.style.color = 'white';
            notification.style.padding = '15px 25px';
            notification.style.borderRadius = '4px';
            notification.style.boxShadow = '0 4px 15px rgba(0,0,0,0.3)';
            notification.style.zIndex = '9999';
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(20px)';
            notification.style.transition = 'opacity 0.3s, transform 0.3s';
            notification.style.fontSize = '16px';
            notification.style.fontWeight = 'bold';

            // Mostrar notificación
            setTimeout(() => {
                notification.style.opacity = '1';
                notification.style.transform = 'translateY(0)';
            }, 10);

            // Ocultar notificación después de 3 segundos
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(20px)';

                // Eliminar notificación del DOM
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Modal functionality
        const modal = document.getElementById('confirmationModal');
        const closeButtons = modal.querySelectorAll('[data-dismiss="modal"]');

        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                modal.classList.remove('show');
            });
        });

        // Enviar pedido
        checkoutForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (cart.length === 0) {
                alert('Añade productos a tu carrito para realizar un pedido');
                return;
            }

            const formData = new FormData(this);

            // Añadir datos del cliente y del pedido
            const email = formData.get('email');
            const fecha = new Date().toISOString().split('T')[0];
            const total = parseFloat(totalElement.textContent.replace('€', ''));

            // Crear objeto de pedido
            const pedidoData = {
                cliente_email: email,
                fecha: fecha,
                estado: 'pendiente',
                total: total
            };

            // Enviar datos al servidor mediante fetch
            fetch('{{ route("pedidos.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        pedido: pedidoData,
                        cliente: {
                            email: email,
                            nombre: formData.get('nombre'),
                            telefono: formData.get('telefono'),
                            direccion: formData.get('direccion')
                        },
                        lineas: cart.map(item => ({
                            producto_id: item.id,
                            cantidad: item.quantity,
                            subtotal: item.price * item.quantity
                        }))
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Mostrar modal de confirmación
                        modal.classList.add('show');

                        // Limpiar carrito y formulario
                        cart = [];
                        localStorage.removeItem('cart');
                        checkoutForm.reset();
                        updateCart();
                    } else {
                        alert('Ha ocurrido un error al procesar tu pedido. Por favor, inténtalo de nuevo.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ha ocurrido un error al procesar tu pedido. Por favor, inténtalo de nuevo.');
                });
        });
    });
</script>
@endsection
@endsection