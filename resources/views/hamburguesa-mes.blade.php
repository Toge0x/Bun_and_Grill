@extends('layouts.app')

@section('content')
<!-- 
    SECCIÓN HERO CON IMAGEN DE LA HAMBURGUESA
    
    IMPORTANTE: 
    - Modifica la clase 'hero-burger' en los estilos para cambiar la imagen de fondo
    - Puedes ajustar la altura y el oscurecimiento de la imagen en los estilos
-->
<div class="hero-burger">
    <div class="container">
        <!-- MODIFICAR: Cambia el nombre de la hamburguesa aquí -->
        <h1 class="burger-title">"NOMBRE DE LA HAMBURGUESA"</h1>
    </div>
</div>

<!-- 
    SECCIÓN DE INFORMACIÓN DE LA HAMBURGUESA
    Esta sección contiene toda la información detallada sobre la hamburguesa
-->
<div class="container burger-info-container">
    <div class="row">
        <!-- Columna principal con la información de la hamburguesa -->
        <div class="col-lg-8">
            <!-- MODIFICAR: Cambia el título de la hamburguesa aquí también -->
            <h2 class="section-title">HAMBURGUESA DEL MES: "NOMBRE"</h2>
            
            <div class="burger-info">
                <!-- 
                    BLOQUE DE DESCRIPCIÓN
                    MODIFICAR: Cambia la descripción de la hamburguesa según tus necesidades 
                -->
                <div class="info-item">
                    <h3>Descripción de la Hamburguesa del Mes</h3>
                    <p>Deliciosa hamburguesa artesanal con 200g de carne de ternera, queso cheddar madurado, bacon crujiente, cebolla caramelizada, lechuga fresca, tomate, pepinillos y nuestra salsa especial, todo ello en un pan brioche recién horneado.</p>
                </div>
                
                <!-- 
                    BLOQUE DE ALÉRGENOS
                    MODIFICAR: Actualiza los alérgenos según los ingredientes de tu hamburguesa
                    IMPORTANTE: Los iconos utilizan Font Awesome, asegúrate de incluirlo en tu layout
                -->
                <div class="info-item">
                    <h3>Alérgenos</h3>
                    <p>Contiene: gluten (pan), lácteos (queso), huevo (en la salsa), mostaza (en la salsa).</p>
                    <div class="alergenos-icons">
                        <!-- Puedes añadir o quitar iconos según los alérgenos de tu hamburguesa -->
                        <span class="alergeno-icon" title="Gluten">
                            <i class="fas fa-bread-slice"></i>
                        </span>
                        <span class="alergeno-icon" title="Lácteos">
                            <i class="fas fa-cheese"></i>
                        </span>
                        <span class="alergeno-icon" title="Huevo">
                            <i class="fas fa-egg"></i>
                        </span>
                        <span class="alergeno-icon" title="Mostaza">
                            <i class="fas fa-pepper-hot"></i>
                        </span>
                    </div>
                </div>
                
                <!-- 
                    BLOQUE DE PRECIO
                    MODIFICAR: Actualiza el precio y la información adicional 
                -->
                <div class="info-item">
                    <h3>Precio</h3>
                    <p class="price">12,95€</p>
                    <p class="price-info">* Incluye patatas fritas caseras y bebida</p>
                </div>
                
                <!-- 
                    BLOQUE DE VALORACIÓN
                    MODIFICAR: Ajusta el número de estrellas llenas (filled) para cambiar la valoración
                    - Actualmente muestra 3 de 5 estrellas
                    - Para cambiar a 4 estrellas, añade la clase "filled" a la cuarta estrella
                -->
                <div class="info-item">
                    <h3>Valoración</h3>
                    <div class="rating">
                        <span class="star filled">★</span>
                        <span class="star filled">★</span>
                        <span class="star filled">★</span>
                        <span class="star">★</span>
                        <span class="star">★</span>
                    </div>
                    <!-- MODIFICAR: Actualiza el número de valoraciones -->
                    <p class="rating-count">(42 valoraciones)</p>
                </div>
                
                <!-- 
                    BLOQUE DE INGREDIENTES
                    MODIFICAR: Actualiza la lista de ingredientes según tu hamburguesa 
                -->
                <div class="info-item">
                    <h3>Ingredientes</h3>
                    <ul class="ingredients-list">
                        <li>Pan brioche artesanal</li>
                        <li>200g de carne de ternera</li>
                        <li>Queso cheddar madurado</li>
                        <li>Bacon crujiente</li>
                        <li>Cebolla caramelizada</li>
                        <li>Lechuga fresca</li>
                        <li>Tomate</li>
                        <li>Pepinillos</li>
                        <li>Salsa especial de la casa</li>
                    </ul>
                </div>
                
                <!-- 
                    BOTONES DE LLAMADA A LA ACCIÓN
                    IMPORTANTE: Asegúrate de que las rutas 'pedidos.index' y 'reservas.index' existan
                    MODIFICAR: Puedes cambiar los textos o añadir/quitar botones según necesites
                -->
                <div class="cta-container">
                    <a href="{{ route('pedidos.index') }}" class="btn btn-primary btn-lg">Pedir ahora</a>
                    <a href="{{ route('reservas.index') }}" class="btn btn-outline-dark btn-lg ms-3">Reservar mesa</a>
                </div>
            </div>
        </div>
        
        <!-- 
            BARRA LATERAL
            Esta sección contiene información adicional como promociones y hamburguesas anteriores
            OPCIONAL: Puedes eliminar toda esta columna si no la necesitas
        -->
        <div class="col-lg-4">
            <div class="burger-sidebar">
                <!-- 
                    BLOQUE DE PROMOCIÓN
                    MODIFICAR: Actualiza la promoción según tus ofertas actuales 
                -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Promoción especial</h4>
                    </div>
                    <div class="card-body">
                        <p>Llévate 2 hamburguesas del mes por solo 19,95€</p>
                        <p class="text-muted small">Válido de lunes a jueves. No acumulable a otras ofertas.</p>
                    </div>
                </div>
                
                <!-- 
                    BLOQUE DE HAMBURGUESAS ANTERIORES
                    MODIFICAR: Actualiza las hamburguesas anteriores con sus nombres e imágenes
                    IMPORTANTE: Asegúrate de tener las imágenes en la carpeta public/images/
                -->
                <div class="card">
                    <div class="card-header">
                        <h4>Hamburguesas anteriores</h4>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <!-- Hamburguesa anterior 1 -->
                            <li class="list-group-item d-flex align-items-center">
                                <img src="{{ asset('images/burger-mini-1.jpg') }}" alt="Hamburguesa" class="mini-burger-img">
                                <div class="ms-3">
                                    <h5 class="mb-0">La Mexicana</h5>
                                    <small class="text-muted">Abril 2023</small>
                                </div>
                            </li>
                            <!-- Hamburguesa anterior 2 -->
                            <li class="list-group-item d-flex align-items-center">
                                <img src="{{ asset('images/burger-mini-2.jpg') }}" alt="Hamburguesa" class="mini-burger-img">
                                <div class="ms-3">
                                    <h5 class="mb-0">La Italiana</h5>
                                    <small class="text-muted">Marzo 2023</small>
                                </div>
                            </li>
                            <!-- Hamburguesa anterior 3 -->
                            <li class="list-group-item d-flex align-items-center">
                                <img src="{{ asset('images/burger-mini-3.jpg') }}" alt="Hamburguesa" class="mini-burger-img">
                                <div class="ms-3">
                                    <h5 class="mb-0">La Americana</h5>
                                    <small class="text-muted">Febrero 2023</small>
                                </div>
                            </li>
                            <!-- Puedes añadir más hamburguesas anteriores siguiendo el mismo formato -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* 
        ESTILOS PARA LA SECCIÓN HERO
        MODIFICAR: Cambia la URL de la imagen para mostrar tu hamburguesa del mes
        IMPORTANTE: Asegúrate de que la imagen exista en la carpeta public/images/
    */
    .hero-burger {
        height: 600px; /* MODIFICAR: Ajusta la altura según tus necesidades */
        background-image: url('{{ asset('images/burger-of-month.jpg') }}'); /* MODIFICAR: Cambia la imagen */
        background-size: cover;
        background-position: center;
        position: relative;
        display: flex;
        align-items: center;
        margin-bottom: 40px;
    }
    
    /* 
        Capa oscura sobre la imagen
        MODIFICAR: Ajusta la opacidad (último valor de rgba) para hacer la imagen más clara u oscura
    */
    .hero-burger::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3); /* MODIFICAR: Cambia la opacidad (0.3) */
    }
    
    /* 
        Estilo del título sobre la imagen
        MODIFICAR: Ajusta el tamaño, color o sombra según necesites
    */
    .burger-title {
        color: white; /* MODIFICAR: Cambia el color del texto */
        font-size: 3rem; /* MODIFICAR: Cambia el tamaño del texto */
        font-weight: bold;
        position: relative;
        z-index: 1;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* MODIFICAR: Ajusta la sombra del texto */
    }
    
    /* Estilos para la sección de información */
    .burger-info-container {
        padding: 40px 0 60px; /* MODIFICAR: Ajusta el espaciado */
    }
    
    /* 
        Estilo del título principal
        MODIFICAR: Ajusta el tamaño, color o margen según necesites
    */
    .section-title {
        font-size: 2rem; /* MODIFICAR: Cambia el tamaño del texto */
        font-weight: bold;
        margin-bottom: 30px;
        color: #333; /* MODIFICAR: Cambia el color del texto */
    }
    
    /* 
        Estilo del contenedor de información
        MODIFICAR: Ajusta el color de fondo, sombra o bordes según necesites
    */
    .burger-info {
        background-color: #fff; /* MODIFICAR: Cambia el color de fondo */
        border-radius: 8px; /* MODIFICAR: Ajusta el redondeo de las esquinas */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* MODIFICAR: Ajusta la sombra */
        padding: 30px; /* MODIFICAR: Ajusta el espaciado interno */
    }
    
    /* 
        Estilo de cada bloque de información
        MODIFICAR: Ajusta el espaciado o el borde según necesites
    */
    .info-item {
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid #eee; /* MODIFICAR: Cambia el estilo del separador */
    }
    
    .info-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
    
    /* 
        Estilo de los subtítulos
        MODIFICAR: Ajusta el tamaño, color o margen según necesites
    */
    .info-item h3 {
        font-size: 1.25rem; /* MODIFICAR: Cambia el tamaño del texto */
        font-weight: 600;
        margin-bottom: 15px;
        color: #444; /* MODIFICAR: Cambia el color del texto */
    }
    
    /* 
        Estilo del precio
        MODIFICAR: Ajusta el tamaño, color o margen según necesites
    */
    .price {
        font-size: 2rem; /* MODIFICAR: Cambia el tamaño del texto */
        font-weight: bold;
        color: #2d3748; /* MODIFICAR: Cambia el color del texto */
        margin-bottom: 5px;
    }
    
    .price-info {
        font-size: 0.9rem;
        color: #666; /* MODIFICAR: Cambia el color del texto */
    }
    
    /* 
        Estilo de las estrellas de valoración
        MODIFICAR: Ajusta el tamaño o margen según necesites
    */
    .rating {
        font-size: 1.5rem; /* MODIFICAR: Cambia el tamaño de las estrellas */
        margin-bottom: 5px;
    }
    
    .star {
        color: #ddd; /* MODIFICAR: Cambia el color de las estrellas vacías */
    }
    
    .star.filled {
        color: #f8b400; /* MODIFICAR: Cambia el color de las estrellas llenas */
    }
    
    .rating-count {
        font-size: 0.9rem;
        color: #666; /* MODIFICAR: Cambia el color del texto */
    }
    
    /* 
        Estilo de la lista de ingredientes
        MODIFICAR: Ajusta el espaciado o estilo de los elementos según necesites
    */
    .ingredients-list {
        padding-left: 20px;
    }
    
    .ingredients-list li {
        margin-bottom: 8px; /* MODIFICAR: Ajusta el espaciado entre elementos */
    }
    
    /* 
        Estilo de los iconos de alérgenos
        MODIFICAR: Ajusta el tamaño, color o espaciado según necesites
    */
    .alergenos-icons {
        display: flex;
        gap: 15px; /* MODIFICAR: Ajusta el espaciado entre iconos */
        margin-top: 10px;
    }
    
    .alergeno-icon {
        width: 40px; /* MODIFICAR: Cambia el tamaño de los iconos */
        height: 40px;
        background-color: #f5f5f5; /* MODIFICAR: Cambia el color de fondo */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: #555; /* MODIFICAR: Cambia el color de los iconos */
    }
    
    /* 
        Estilo de los botones de llamada a la acción
        MODIFICAR: Ajusta el espaciado según necesites
    */
    .cta-container {
        margin-top: 30px; /* MODIFICAR: Ajusta el espaciado superior */
    }
    
    /* 
        Estilo de la barra lateral
        MODIFICAR: Ajusta la posición o espaciado según necesites
    */
    .burger-sidebar {
        position: sticky;
        top: 20px; /* MODIFICAR: Ajusta la posición superior */
    }
    
    /* 
        Estilo de las imágenes pequeñas de hamburguesas anteriores
        MODIFICAR: Ajusta el tamaño o bordes según necesites
    */
    .mini-burger-img {
        width: 60px; /* MODIFICAR: Cambia el tamaño de las imágenes */
        height: 60px;
        object-fit: cover;
        border-radius: 4px; /* MODIFICAR: Ajusta el redondeo de las esquinas */
    }
    
    /* 
        ESTILOS RESPONSIVOS
        Estos estilos se aplican en pantallas más pequeñas
        MODIFICAR: Ajusta los tamaños o espaciados según necesites
    */
    @media (max-width: 991px) {
        .hero-burger {
            height: 400px; /* MODIFICAR: Ajusta la altura en tablets */
        }
        
        .burger-title {
            font-size: 2.5rem; /* MODIFICAR: Ajusta el tamaño del texto en tablets */
        }
        
        .burger-sidebar {
            margin-top: 40px;
        }
    }
    
    @media (max-width: 767px) {
        .hero-burger {
            height: 300px; /* MODIFICAR: Ajusta la altura en móviles */
        }
        
        .burger-title {
            font-size: 2rem; /* MODIFICAR: Ajusta el tamaño del texto en móviles */
        }
    }
</style>
@endsection