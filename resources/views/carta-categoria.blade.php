@extends('layouts.app')

@section('content')
<!-- 
    Aquí iría el navbar, pero como mencionas que ya lo tienes implementado, 
    no incluyo el código. Se mostraría automáticamente al usar @extends('layouts.app')
-->

<!-- 
    SECCIÓN HERO CON IMAGEN DE LA CATEGORÍA
    
    IMPORTANTE: 
    - La imagen y el título se cargarán dinámicamente según la categoría seleccionada
    - Puedes ajustar la altura y el oscurecimiento de la imagen en los estilos
-->
<div class="hero-category" style="background-image: url('{{ asset('images/' . $categoria . '-hero.jpg') }}');">
    <div class="container">
        <h1 class="category-hero-title">{{ strtoupper($categoria) }}</h1>
    </div>
</div>

<!-- 
    SECCIÓN DE PRODUCTOS DE LA CATEGORÍA
    Esta sección muestra todos los productos de la categoría seleccionada
-->
<div class="container products-container">
    <!-- Título de la sección -->
    <h2 class="section-title">NUESTROS {{ strtoupper($categoria) }}</h2>
    
    <!-- Filtros (opcional) -->
    @if($categoria == 'hamburguesas' || $categoria == 'smash')
    <div class="filters-container mb-4">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-dark active" data-filter="all">Todos</button>
            <button type="button" class="btn btn-outline-dark" data-filter="carne">Carne</button>
            <button type="button" class="btn btn-outline-dark" data-filter="pollo">Pollo</button>
            <button type="button" class="btn btn-outline-dark" data-filter="vegano">Vegano</button>
        </div>
    </div>
    @endif
    
    <!-- Lista de productos -->
    <div class="row">
        @foreach($productos as $producto)
        <div class="col-md-6 col-lg-4 mb-4 product-item" data-category="{{ $producto->subcategoria ?? 'all' }}">
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('images/productos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                    @if($producto->nuevo)
                    <span class="product-badge new-badge">Nuevo</span>
                    @endif
                    @if($producto->popular)
                    <span class="product-badge popular-badge">Popular</span>
                    @endif
                </div>
                <div class="product-info">
                    <h3 class="product-title">{{ $producto->nombre }}</h3>
                    <p class="product-description">{{ $producto->descripcion }}</p>
                    <div class="product-footer">
                        <span class="product-price">{{ number_format($producto->precio, 2) }}€</span>
                        <button class="btn btn-sm btn-primary add-to-cart" data-id="{{ $producto->id }}">Añadir</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Botón para volver a la carta -->
    <div class="text-center mt-5">
        <a href="{{ route('carta') }}" class="btn btn-outline-dark btn-lg">Volver a la carta</a>
    </div>
</div>

<!-- 
    Aquí iría el footer, pero como mencionas que ya lo tienes implementado, 
    no incluyo el código. Se mostraría automáticamente al usar @extends('layouts.app')
-->
@endsection

@section('styles')
<style>
    /* 
        ESTILOS PARA LA SECCIÓN HERO DE CATEGORÍA
        MODIFICAR: Ajusta la altura o efectos según tus necesidades
    */
    .hero-category {
        height: 300px; /* MODIFICAR: Ajusta la altura según tus necesidades */
        background-size: cover;
        background-position: center;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 50px;
    }
    
    /* 
        Capa oscura sobre la imagen
        MODIFICAR: Ajusta la opacidad para hacer la imagen más clara u oscura
    */
    .hero-category::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* MODIFICAR: Cambia la opacidad (0.5) */
    }
    
    /* 
        Estilo del título sobre la imagen
        MODIFICAR: Ajusta el tamaño, color o sombra según necesites
    */
    .category-hero-title {
        color: white; /* MODIFICAR: Cambia el color del texto */
        font-size: 3.5rem; /* MODIFICAR: Cambia el tamaño del texto */
        font-weight: bold;
        position: relative;
        z-index: 1;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* MODIFICAR: Ajusta la sombra del texto */
    }
    
    /* 
        Estilos para el contenedor de productos
        MODIFICAR: Ajusta el espaciado según tus necesidades
    */
    .products-container {
        padding-bottom: 60px; /* MODIFICAR: Ajusta el espaciado inferior */
    }
    
    /* 
        Estilo del título de la sección
        MODIFICAR: Ajusta el tamaño, color o margen según necesites
    */
    .section-title {
        font-size: 2rem; /* MODIFICAR: Cambia el tamaño del texto */
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
        color: #333; /* MODIFICAR: Cambia el color del texto */
    }
    
    /* 
        Estilos para los filtros
        MODIFICAR: Ajusta los colores o espaciados según tus necesidades
    */
    .filters-container {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
    }
    
    /* 
        Estilos para las tarjetas de productos
        MODIFICAR: Ajusta los bordes, sombras o efectos según tus necesidades
    */
    .product-card {
        background-color: white;
        border-radius: 8px; /* MODIFICAR: Ajusta el redondeo de las esquinas */
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* MODIFICAR: Ajusta la sombra */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .product-card:hover {
        transform: translateY(-5px); /* MODIFICAR: Ajusta el movimiento al pasar el ratón */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* MODIFICAR: Ajusta la sombra al pasar el ratón */
    }
    
    /* 
        Estilos para las imágenes de productos
        MODIFICAR: Ajusta la altura o proporciones según tus necesidades
    */
    .product-image {
        position: relative;
        height: 200px; /* MODIFICAR: Ajusta la altura de las imágenes */
        overflow: hidden;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .product-card:hover .product-image img {
        transform: scale(1.05); /* MODIFICAR: Ajusta el zoom al pasar el ratón */
    }
    
    /* 
        Estilos para las etiquetas de productos
        MODIFICAR: Ajusta los colores o posiciones según tus necesidades
    */
    .product-badge {
        position: absolute;
        top: 10px;
        padding: 5px 10px;
        font-size: 0.8rem;
        font-weight: bold;
        border-radius: 4px;
        z-index: 1;
    }
    
    .new-badge {
        left: 10px;
        background-color: #e74c3c; /* MODIFICAR: Cambia el color de fondo */
        color: white;
    }
    
    .popular-badge {
        right: 10px;
        background-color: #f39c12; /* MODIFICAR: Cambia el color de fondo */
        color: white;
    }
    
    /* 
        Estilos para la información de productos
        MODIFICAR: Ajusta los espaciados o colores según tus necesidades
    */
    .product-info {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .product-title {
        font-size: 1.25rem; /* MODIFICAR: Cambia el tamaño del texto */
        font-weight: bold;
        margin-bottom: 10px;
        color: #333; /* MODIFICAR: Cambia el color del texto */
    }
    
    .product-description {
        font-size: 0.9rem;
        color: #666; /* MODIFICAR: Cambia el color del texto */
        margin-bottom: 15px;
        flex-grow: 1;
    }
    
    .product-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }
    
    .product-price {
        font-size: 1.2rem; /* MODIFICAR: Cambia el tamaño del texto */
        font-weight: bold;
        color: #2d3748; /* MODIFICAR: Cambia el color del texto */
    }
    
    /* 
        ESTILOS RESPONSIVOS
        Estos estilos se aplican en pantallas más pequeñas
        MODIFICAR: Ajusta los tamaños o espaciados según necesites
    */
    @media (max-width: 991px) {
        .hero-category {
            height: 250px; /* MODIFICAR: Ajusta la altura en tablets */
        }
        
        .category-hero-title {
            font-size: 3rem; /* MODIFICAR: Ajusta el tamaño del texto en tablets */
        }
    }
    
    @media (max-width: 767px) {
        .hero-category {
            height: 200px; /* MODIFICAR: Ajusta la altura en móviles */
        }
        
        .category-hero-title {
            font-size: 2.5rem; /* MODIFICAR: Ajusta el tamaño del texto en móviles */
        }
        
        .product-image {
            height: 180px; /* MODIFICAR: Ajusta la altura de las imágenes en móviles */
        }
    }
</style>
@endsection

@section('scripts')
<script>
    // Script para filtrar productos por subcategoría (para hamburguesas y smash)
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filters-container .btn');
        const productItems = document.querySelectorAll('.product-item');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Quitar la clase active de todos los botones
                filterButtons.forEach(btn => btn.classList.remove('active'));
                
                // Añadir la clase active al botón clickeado
                this.classList.add('active');
                
                // Obtener el filtro seleccionado
                const filter = this.getAttribute('data-filter');
                
                // Mostrar u ocultar productos según el filtro
                productItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
        
        // Botones para añadir al carrito (funcionalidad a implementar)
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                // Aquí puedes implementar la lógica para añadir al carrito
                alert('Producto añadido al carrito: ' + productId);
            });
        });
    });
</script>
@endsection