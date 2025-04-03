<div class="order-container">
    <div class="row">
        <div class="col-lg-8">
            <h2 class="section-title">NUESTROS PRODUCTOS</h2>
            
            <!-- Pestañas de categorías -->
            <ul class="nav category-tabs" id="categoryTabs" role="tablist">
                @foreach($categorias as $index => $categoria)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $index === 0 ? 'active' : '' }}" 
                                id="tab-{{ Str::slug($categoria->categoria) }}" 
                                data-bs-toggle="tab" 
                                data-bs-target="#content-{{ Str::slug($categoria->categoria) }}" 
                                type="button" 
                                role="tab" 
                                aria-controls="content-{{ Str::slug($categoria->categoria) }}" 
                                aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                            {{ $categoria->categoria }}
                        </button>
                    </li>
                @endforeach
            </ul>
            
            <!-- Contenido de las pestañas -->
            <div class="tab-content" id="categoryTabsContent">
                @foreach($productos as $categoria => $productosCategoria)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                         id="content-{{ Str::slug($categoria) }}" 
                         role="tabpanel" 
                         aria-labelledby="tab-{{ Str::slug($categoria) }}">
                        
                        <div class="row">
                            @foreach($productosCategoria as $producto)
                                <div class="col-md-6 mb-4">
                                    <div class="card product-card h-100" data-id="{{ $producto->id }}" data-nombre="{{ $producto->nombre }}" data-precio="{{ $producto->precio }}">
                                        <div class="row g-0">
                                            <div class="col-4">
                                                <img src="{{ asset('images/' . $producto->imagen) }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $producto->nombre }}">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                                                    <p class="card-text small">{{ $producto->descripcion }}</p>
                                                    <p class="card-text"><strong>€{{ number_format($producto->precio, 2) }}</strong></p>
                                                    <button class="btn btn-sm btn-outline-dark add-to-cart">Añadir</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Tu Pedido</h5>
                </div>
                <div class="card-body">
                    <div id="cart-items">
                        <div class="cart-empty">
                            <i class="bi bi-cart"></i>
                            <p>Tu carrito está vacío</p>
                            <p>Añade productos para realizar tu pedido</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between">
                        <span>Subtotal:</span>
                        <span id="subtotal">€0.00</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>IVA (10%):</span>
                        <span id="iva">€0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span class="fw-bold">Total:</span>
                        <span class="fw-bold" id="total">€0.00</span>
                    </div>
                    
                    <hr>
                    
                    <form id="checkout-form" class="mt-3">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección de entrega</label>
                            <textarea class="form-control" id="direccion" name="direccion" rows="3" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-pedido w-100" id="realizar-pedido" disabled>
                            REALIZAR PEDIDO
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Pedido Confirmado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                    <p class="mt-3">¡Tu pedido ha sido registrado con éxito!</p>
                    <p>Recibirás una confirmación por email.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<style>
    .order-container {
        background-color: white;
        padding: 40px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: -50px;
        position: relative;
        z-index: 2;
    }
    
    .section-title {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 30px;
    }
    
    .product-card {
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .product-card.selected {
        border-color: #2d3748;
        background-color: #f8f9fa;
    }
    
    .cart-item {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }
    
    .btn-pedido {
        background-color: #2d3748;
        color: white;
        padding: 10px 30px;
        font-weight: bold;
    }
    
    .category-tabs {
        overflow-x: auto;
        white-space: nowrap;
        margin-bottom: 20px;
    }
    
    .category-tabs .nav-link {
        color: #495057;
    }
    
    .category-tabs .nav-link.active {
        color: #2d3748;
        font-weight: bold;
        border-bottom: 2px solid #2d3748;
    }
    
    .quantity-control {
        display: flex;
        align-items: center;
    }
    
    .quantity-control button {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e9ecef;
        border: none;
        border-radius: 4px;
    }
    
    .quantity-control input {
        width: 40px;
        text-align: center;
        border: 1px solid #ced4da;
        border-radius: 4px;
        margin: 0 5px;
    }
    
    .cart-empty {
        text-align: center;
        padding: 30px;
        color: #6c757d;
    }
    
    .cart-empty i {
        font-size: 3rem;
        margin-bottom: 15px;
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartItems = document.getElementById('cart-items');
        const subtotalElement = document.getElementById('subtotal');
        const ivaElement = document.getElementById('iva');
        const totalElement = document.getElementById('total');
        const realizarPedidoBtn = document.getElementById('realizar-pedido');
        const checkoutForm = document.getElementById('checkout-form');
        
        let cart = [];
        
        // Añadir producto al carrito
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const productCard = this.closest('.product-card');
                const productId = productCard.dataset.id;
                const productName = productCard.dataset.nombre;
                const productPrice = parseFloat(productCard.dataset.precio);
                
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
                
                updateCart();
            });
        });
        
        // Actualizar el carrito
        function updateCart() {
            if (cart.length === 0) {
                cartItems.innerHTML = `
                    <div class="cart-empty">
                        <i class="bi bi-cart"></i>
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
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">${item.name}</h6>
                                <button type="button" class="btn-close remove-item" aria-label="Close"></button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="quantity-control">
                                    <button type="button" class="decrease-quantity">-</button>
                                    <input type="number" min="1" value="${item.quantity}" class="item-quantity" readonly>
                                    <button type="button" class="increase-quantity">+</button>
                                </div>
                                <span>€${(item.price * item.quantity).toFixed(2)}</span>
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
                            updateCart();
                        }
                    });
                });
                
                document.querySelectorAll('.increase-quantity').forEach(button => {
                    button.addEventListener('click', function() {
                        const cartItem = this.closest('.cart-item');
                        const productId = cartItem.dataset.id;
                        const item = cart.find(item => item.id === productId);
                        
                        item.quantity += 1;
                        updateCart();
                    });
                });
                
                // Añadir event listeners a los botones de eliminar
                document.querySelectorAll('.remove-item').forEach(button => {
                    button.addEventListener('click', function() {
                        const cartItem = this.closest('.cart-item');
                        const productId = cartItem.dataset.id;
                        
                        cart = cart.filter(item => item.id !== productId);
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
        
        // Enviar pedido
        checkoutForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (cart.length === 0) {
                alert('Añade productos a tu carrito para realizar un pedido');
                return;
            }
            
            const formData = new FormData(this);
            formData.append('productos', JSON.stringify(cart));
            
            // Enviar datos al servidor mediante fetch
            fetch('{{ route("pedidos.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                    confirmationModal.show();
                    
                    // Limpiar carrito y formulario
                    cart = [];
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
        
        // Inicializar carrito
        updateCart();
    });
</script>
@endpush