@extends('layouts.app')

@section('title', 'Carta - Bun & Grill')

@section('styles')
<style>
    /* Estilos generales */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background-color: #f5f5f5;
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    /* Encabezado de la carta */
    .menu-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .menu-title {
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #222;
        position: relative;
        display: inline-block;
    }

    .menu-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background-color: #f0b000;
        border-radius: 2px;
    }

    .menu-description {
        font-size: 18px;
        color: #666;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Categorías */
    .category-tabs {
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .category-tab {
        padding: 12px 24px;
        background-color: #fff;
        border: 2px solid #eee;
        border-radius: 30px;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #555;
    }

    .category-tab:hover {
        background-color: #f8f8f8;
        border-color: #ddd;
    }

    .category-tab.active {
        background-color: #f0b000;
        color: #222;
        border-color: #f0b000;
    }

    /* Sección de categoría */
    .category-section {
        margin-bottom: 60px;
    }

    .category-heading {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0b000;
        color: #222;
    }

    /* Grid de productos */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }

    /* Tarjeta de producto */
    .product-card {
        background-color: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .product-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 1px solid #eee;
    }

    .product-content {
        padding: 20px;
    }

    .product-price {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: #f0b000;
        color: #222;
        font-weight: 700;
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 16px;
    }

    .product-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 10px;
        color: #222;
    }

    .product-ingredients {
        margin-bottom: 15px;
        color: #666;
        font-size: 14px;
        line-height: 1.5;
    }

    .allergens {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px dashed #eee;
    }

    .allergens-title {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #666;
    }

    .allergen-tag {
        display: inline-block;
        background-color: #fff0f0;
        color: #e74c3c;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        margin-right: 5px;
        margin-bottom: 5px;
        border: 1px solid #ffcccc;
    }

    .no-allergens {
        color: #666;
        font-size: 13px;
        font-style: italic;
    }

    /* Botón de añadir al carrito */
    .add-to-cart {
        display: block;
        width: 100%;
        padding: 12px;
        background-color: #222;
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 15px;
        text-align: center;
        text-decoration: none;
    }

    .add-to-cart:hover {
        background-color: #333;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 20px 15px;
        }

        .menu-title {
            font-size: 32px;
        }

        .menu-description {
            font-size: 16px;
        }

        .category-heading {
            font-size: 28px;
        }

        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
    }

    @media (max-width: 576px) {
        .menu-title {
            font-size: 28px;
        }

        .category-tab {
            padding: 10px 18px;
            font-size: 14px;
        }

        .products-grid {
            grid-template-columns: 1fr;
        }

        .category-heading {
            font-size: 24px;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="menu-header">
        <h1 class="menu-title">Nuestra Carta</h1>
        <p class="menu-description">Descubre nuestra selección de hamburguesas gourmet, elaboradas con ingredientes frescos y de la mejor calidad. Cada bocado es una experiencia única.</p>
    </div>

    <div class="category-tabs">
        <div class="category-tab active" data-category="all">Todos</div>
        <div class="category-tab" data-category="1">Hamburguesas</div>
        <div class="category-tab" data-category="2">Entrantes</div>
        <div class="category-tab" data-category="3">Bebidas</div>
        <div class="category-tab" data-category="4">Postres</div>
    </div>

    <!-- Sección Hamburguesas -->
    <div class="category-section" data-category="1">
        <h2 class="category-heading">Hamburguesas</h2>
        <div class="products-grid">
            @foreach($productos as $producto)
            @if($producto->idCategoria == 1)
            <div class="product-card">
                <div class="product-price">{{ number_format($producto->precio, 2) }} €</div>
                <div class="product-content">
                    <h3 class="product-title">{{ $producto->nombre }}</h3>
                    <div class="product-ingredients">
                        @if(is_array($producto->ingredientes))
                        {{ implode(', ', $producto->ingredientes) }}
                        @else
                        {{ $producto->ingredientes }}
                        @endif
                    </div>

                    <div class="allergens">
                        <div class="allergens-title">Alérgenos:</div>
                        @if(isset($producto->alergenos) && is_array($producto->alergenos) && count($producto->alergenos) > 0)
                        @foreach($producto->alergenos as $alergeno)
                        <span class="allergen-tag">{{ $alergeno }}</span>
                        @endforeach
                        @else
                        <span class="no-allergens">Sin alérgenos</span>
                        @endif
                    </div>

                    <a href="#" class="add-to-cart">Añadir al pedido</a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

    <!-- Sección Entrantes -->
    <div class="category-section" data-category="2">
        <h2 class="category-heading">Entrantes</h2>
        <div class="products-grid">
            @foreach($productos as $producto)
            @if($producto->idCategoria == 2)
            <div class="product-card">
                <div class="product-price">{{ number_format($producto->precio, 2) }} €</div>
                @if($producto->imagen)
                <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="product-image">
                @else
                <img src="{{ asset('images/default-appetizer.jpg') }}" alt="{{ $producto->nombre }}" class="product-image">
                @endif
                <div class="product-content">
                    <h3 class="product-title">{{ $producto->nombre }}</h3>
                    <div class="product-ingredients">
                        @if(is_array($producto->ingredientes))
                        {{ implode(', ', $producto->ingredientes) }}
                        @else
                        {{ $producto->ingredientes }}
                        @endif
                    </div>

                    <div class="allergens">
                        <div class="allergens-title">Alérgenos:</div>
                        @if(isset($producto->alergenos) && is_array($producto->alergenos) && count($producto->alergenos) > 0)
                        @foreach($producto->alergenos as $alergeno)
                        <span class="allergen-tag">{{ $alergeno }}</span>
                        @endforeach
                        @else
                        <span class="no-allergens">Sin alérgenos</span>
                        @endif
                    </div>

                    <a href="#" class="add-to-cart">Añadir al pedido</a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

    <!-- Sección Bebidas -->
    <div class="category-section" data-category="3">
        <h2 class="category-heading">Bebidas</h2>
        <div class="products-grid">
            @foreach($productos as $producto)
            @if($producto->idCategoria == 3)
            <div class="product-card">
                <div class="product-price">{{ number_format($producto->precio, 2) }} €</div>
                @if($producto->imagen)
                <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="product-image">
                @else
                <img src="{{ asset('images/default-drink.jpg') }}" alt="{{ $producto->nombre }}" class="product-image">
                @endif
                <div class="product-content">
                    <h3 class="product-title">{{ $producto->nombre }}</h3>
                    <div class="product-ingredients">
                        @if(is_array($producto->ingredientes))
                        {{ implode(', ', $producto->ingredientes) }}
                        @else
                        {{ $producto->ingredientes }}
                        @endif
                    </div>

                    <div class="allergens">
                        <div class="allergens-title">Alérgenos:</div>
                        @if(isset($producto->alergenos) && is_array($producto->alergenos) && count($producto->alergenos) > 0)
                        @foreach($producto->alergenos as $alergeno)
                        <span class="allergen-tag">{{ $alergeno }}</span>
                        @endforeach
                        @else
                        <span class="no-allergens">Sin alérgenos</span>
                        @endif
                    </div>

                    <a href="#" class="add-to-cart">Añadir al pedido</a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

    <!-- Sección Postres -->
    <div class="category-section" data-category="4">
        <h2 class="category-heading">Postres</h2>
        <div class="products-grid">
            @foreach($productos as $producto)
            @if($producto->idCategoria == 4)
            <div class="product-card">
                <div class="product-price">{{ number_format($producto->precio, 2) }} €</div>
                @if($producto->imagen)
                <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="product-image">
                @else
                <img src="{{ asset('images/default-dessert.jpg') }}" alt="{{ $producto->nombre }}" class="product-image">
                @endif
                <div class="product-content">
                    <h3 class="product-title">{{ $producto->nombre }}</h3>
                    <div class="product-ingredients">
                        @if(is_array($producto->ingredientes))
                        {{ implode(', ', $producto->ingredientes) }}
                        @else
                        {{ $producto->ingredientes }}
                        @endif
                    </div>

                    <div class="allergens">
                        <div class="allergens-title">Alérgenos:</div>
                        @if(isset($producto->alergenos) && is_array($producto->alergenos) && count($producto->alergenos) > 0)
                        @foreach($producto->alergenos as $alergeno)
                        <span class="allergen-tag">{{ $alergeno }}</span>
                        @endforeach
                        @else
                        <span class="no-allergens">Sin alérgenos</span>
                        @endif
                    </div>

                    <a href="#" class="add-to-cart">Añadir al pedido</a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filtrado por categorías
        const categoryTabs = document.querySelectorAll('.category-tab');
        const categorySections = document.querySelectorAll('.category-section');

        categoryTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Actualizar pestaña activa
                categoryTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                // Filtrar secciones
                const category = this.getAttribute('data-category');

                if (category === 'all') {
                    categorySections.forEach(section => {
                        section.style.display = 'block';
                    });
                } else {
                    categorySections.forEach(section => {
                        if (section.getAttribute('data-category') === category) {
                            section.style.display = 'block';
                        } else {
                            section.style.display = 'none';
                        }
                    });
                }
            });
        });
    });
</script>
@endsection