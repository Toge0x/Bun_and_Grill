@extends('layouts.app')

@section('content')
<!-- 
    Aquí iría el navbar, pero como mencionas que ya lo tienes implementado, 
    no incluyo el código. Se mostraría automáticamente al usar @extends('layouts.app')
-->

<!-- 
    SECCIÓN HERO CON IMAGEN DE HAMBURGUESAS Y TÍTULO "CARTA"
    
    IMPORTANTE: 
    - Modifica la URL de la imagen en los estilos para cambiar la imagen de fondo
    - Puedes ajustar la altura y el oscurecimiento de la imagen en los estilos
-->
<div class="hero-menu">
    <div class="container">
        <h1 class="menu-title">CARTA</h1>
    </div>
</div>

<!-- 
    SECCIÓN DE CATEGORÍAS DE ALIMENTOS
    Esta sección contiene la cuadrícula con las diferentes categorías de alimentos
-->
<div class="container categories-container">
    <div class="row">
        <!-- 
            CATEGORÍA: ENTRANTES
            MODIFICAR: Cambia la imagen y la URL según tus necesidades
        -->
        <div class="col-md-6 mb-4">
            <a href="{{ route('carta.categoria', 'entrantes') }}" class="category-card">
                <div class="category-image">
                    <img src="{{ asset('images/entrantes.jpg') }}" alt="Entrantes">
                    <div class="category-overlay"></div>
                    <h2 class="category-title">ENTRANTES</h2>
                </div>
            </a>
        </div>
        
        <!-- 
            CATEGORÍA: HAMBURGUESAS
            MODIFICAR: Cambia la imagen y la URL según tus necesidades
        -->
        <div class="col-md-6 mb-4">
            <a href="{{ route('carta.categoria', 'hamburguesas') }}" class="category-card">
                <div class="category-image">
                    <img src="{{ asset('images/hamburguesas.jpg') }}" alt="Hamburguesas">
                    <div class="category-overlay"></div>
                    <h2 class="category-title">HAMBURGUESAS</h2>
                </div>
            </a>
        </div>
        
        <!-- 
            CATEGORÍA: SMASH
            MODIFICAR: Cambia la imagen y la URL según tus necesidades
        -->
        <div class="col-md-6 mb-4">
            <a href="{{ route('carta.categoria', 'smash') }}" class="category-card">
                <div class="category-image">
                    <img src="{{ asset('images/smash.jpg') }}" alt="Smash">
                    <div class="category-overlay"></div>
                    <h2 class="category-title">SMASH</h2>
                </div>
            </a>
        </div>
        
        <!-- 
            CATEGORÍA: ENSALADAS
            MODIFICAR: Cambia la imagen y la URL según tus necesidades
        -->
        <div class="col-md-6 mb-4">
            <a href="{{ route('carta.categoria', 'ensaladas') }}" class="category-card">
                <div class="category-image">
                    <img src="{{ asset('images/ensaladas.jpg') }}" alt="Ensaladas">
                    <div class="category-overlay"></div>
                    <h2 class="category-title">ENSALADAS</h2>
                </div>
            </a>
        </div>
        
        <!-- 
            CATEGORÍA: POSTRES
            MODIFICAR: Cambia la imagen y la URL según tus necesidades
        -->
        <div class="col-md-6 mb-4">
            <a href="{{ route('carta.categoria', 'postres') }}" class="category-card">
                <div class="category-image">
                    <img src="{{ asset('images/postres.jpg') }}" alt="Postres">
                    <div class="category-overlay"></div>
                    <h2 class="category-title">POSTRES</h2>
                </div>
            </a>
        </div>
        
        <!-- 
            CATEGORÍA: BEBIDAS
            MODIFICAR: Cambia la imagen y la URL según tus necesidades
        -->
        <div class="col-md-6 mb-4">
            <a href="{{ route('carta.categoria', 'bebidas') }}" class="category-card">
                <div class="category-image">
                    <img src="{{ asset('images/bebidas.jpg') }}" alt="Bebidas">
                    <div class="category-overlay"></div>
                    <h2 class="category-title">BEBIDAS</h2>
                </div>
            </a>
        </div>
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
        ESTILOS PARA LA SECCIÓN HERO
        MODIFICAR: Cambia la URL de la imagen para mostrar tus hamburguesas
        IMPORTANTE: Asegúrate de que la imagen exista en la carpeta public/images/
    */
    .hero-menu {
        height: 400px; /* MODIFICAR: Ajusta la altura según tus necesidades */
        background-image: url('{{ asset('images/carta-hero.jpg') }}'); /* MODIFICAR: Cambia la imagen */
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
        MODIFICAR: Ajusta la opacidad (último valor de rgba) para hacer la imagen más clara u oscura
    */
    .hero-menu::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4); /* MODIFICAR: Cambia la opacidad (0.4) */
    }
    
    /* 
        Estilo del título sobre la imagen
        MODIFICAR: Ajusta el tamaño, color o sombra según necesites
    */
    .menu-title {
        color: white; /* MODIFICAR: Cambia el color del texto */
        font-size: 4rem; /* MODIFICAR: Cambia el tamaño del texto */
        font-weight: bold;
        position: relative;
        z-index: 1;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* MODIFICAR: Ajusta la sombra del texto */
    }
    
    /* 
        Estilos para el contenedor de categorías
        MODIFICAR: Ajusta el espaciado según tus necesidades
    */
    .categories-container {
        padding-bottom: 60px; /* MODIFICAR: Ajusta el espaciado inferior */
    }
    
    /* 
        Estilos para las tarjetas de categorías
        MODIFICAR: Ajusta los bordes, sombras o efectos según tus necesidades
    */
    .category-card {
        display: block;
        text-decoration: none;
        color: inherit;
        border-radius: 8px; /* MODIFICAR: Ajusta el redondeo de las esquinas */
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* MODIFICAR: Ajusta la sombra */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .category-card:hover {
        transform: translateY(-5px); /* MODIFICAR: Ajusta el movimiento al pasar el ratón */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* MODIFICAR: Ajusta la sombra al pasar el ratón */
    }
    
    /* 
        Estilos para las imágenes de categorías
        MODIFICAR: Ajusta la altura o proporciones según tus necesidades
    */
    .category-image {
        position: relative;
        height: 250px; /* MODIFICAR: Ajusta la altura de las imágenes */
        overflow: hidden;
    }
    
    .category-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .category-card:hover .category-image img {
        transform: scale(1.05); /* MODIFICAR: Ajusta el zoom al pasar el ratón */
    }
    
    /* 
        Capa oscura sobre las imágenes de categorías
        MODIFICAR: Ajusta la opacidad para hacer las imágenes más claras u oscuras
    */
    .category-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* MODIFICAR: Cambia la opacidad (0.5) */
    }
    
    /* 
        Estilo de los títulos de categorías
        MODIFICAR: Ajusta el tamaño, color o posición según tus necesidades
    */
    .category-title {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white; /* MODIFICAR: Cambia el color del texto */
        font-size: 1.8rem; /* MODIFICAR: Cambia el tamaño del texto */
        font-weight: bold;
        text-align: center;
        width: 100%;
        padding: 0 15px;
        margin: 0;
        z-index: 1;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8); /* MODIFICAR: Ajusta la sombra del texto */
    }
    
    /* 
        ESTILOS RESPONSIVOS
        Estos estilos se aplican en pantallas más pequeñas
        MODIFICAR: Ajusta los tamaños o espaciados según necesites
    */
    @media (max-width: 991px) {
        .hero-menu {
            height: 350px; /* MODIFICAR: Ajusta la altura en tablets */
        }
        
        .menu-title {
            font-size: 3.5rem; /* MODIFICAR: Ajusta el tamaño del texto en tablets */
        }
    }
    
    @media (max-width: 767px) {
        .hero-menu {
            height: 250px; /* MODIFICAR: Ajusta la altura en móviles */
        }
        
        .menu-title {
            font-size: 2.5rem; /* MODIFICAR: Ajusta el tamaño del texto en móviles */
        }
        
        .category-image {
            height: 200px; /* MODIFICAR: Ajusta la altura de las imágenes en móviles */
        }
        
        .category-title {
            font-size: 1.5rem; /* MODIFICAR: Ajusta el tamaño del texto en móviles */
        }
    }
</style>
@endsection