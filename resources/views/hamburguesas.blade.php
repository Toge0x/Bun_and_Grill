@extends('layouts.admin')

@section('title', 'Gestión de Productos')

@section('page-title', 'Gestión de Productos')

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

    /* Estilos para los botones de categoría */
    .category-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .category-btn {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        border: 1px solid #ddd;
        font-size: 14px;
        background-color: white;
    }

    .category-btn:hover {
        background-color: #f8f9fa;
    }

    .category-btn.active {
        background-color: #f0b000;
        color: #2d3748;
        border-color: #f0b000;
    }

    /* Estilos para los encabezados de categoría */
    .category-header {
        margin: 30px 0 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0b000;
        font-size: 24px;
        font-weight: bold;
        color: #2d3748;
    }

    .hamburguesas-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 15px;
    }

    .hamburguesa-card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        position: relative;
        padding: 20px;
    }

    .hamburguesa-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .hamburguesa-price {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: #f0b000;
        color: #2d3748;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 14px;
    }

    .hamburguesa-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
        padding-right: 70px;
        /* Espacio para el precio */
    }

    .hamburguesa-ingredients {
        margin-bottom: 15px;
        min-height: 60px;
        /* Altura mínima para los ingredientes */
    }

    .ingredient-tag {
        display: inline-block;
        background-color: #f8f9fa;
        color: #666;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        margin-right: 5px;
        margin-bottom: 5px;
    }

    /* Estilos para los alérgenos */
    .hamburguesa-allergens {
        margin-bottom: 15px;
        border-top: 1px dashed #eee;
        padding-top: 10px;
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

    .allergens-title {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 8px;
        color: #666;
    }

    .hamburguesa-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 10px;
        border-top: 1px solid #eee;
        padding-top: 10px;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
    }

    /* Modal styles */
    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s, visibility 0.3s;
    }

    .modal-backdrop.show {
        opacity: 1;
        visibility: visible;
    }

    .modal-container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        transform: translateY(-20px);
        transition: transform 0.3s;
    }

    .modal-backdrop.show .modal-container {
        transform: translateY(0);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    .modal-title {
        font-size: 20px;
        font-weight: bold;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #666;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-footer {
        padding: 15px 20px;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .form-input,
    .form-textarea,
    .form-select {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-input:focus,
    .form-textarea:focus,
    .form-select:focus {
        outline: none;
        border-color: #f0b000;
    }

    .form-textarea {
        min-height: 100px;
        resize: vertical;
    }

    .ingredients-container,
    .allergens-container {
        margin-top: 10px;
    }

    .ingredient-item,
    .allergen-item {
        display: flex;
        align-items: center;
        background-color: #f8f9fa;
        padding: 8px 12px;
        border-radius: 4px;
        margin-bottom: 8px;
    }

    .allergen-item {
        background-color: #fff0f0;
        border: 1px solid #ffcccc;
    }

    .ingredient-text,
    .allergen-text {
        flex: 1;
    }

    .ingredient-remove,
    .allergen-remove {
        background: none;
        border: none;
        color: #e74c3c;
        cursor: pointer;
        font-size: 16px;
    }

    .add-ingredient-row,
    .add-allergen-row {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .add-ingredient-input,
    .add-allergen-input {
        flex: 1;
    }

    /* Mensaje cuando no hay productos */
    .no-products {
        text-align: center;
        padding: 40px;
        background-color: #f8f9fa;
        border-radius: 8px;
        color: #666;
        font-size: 16px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hamburguesas-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        }

        .category-filters {
            flex-direction: column;
            align-items: stretch;
        }

        .category-btn {
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .hamburguesas-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="actions-container">
    <div class="search-container">
        <input type="text" class="search-input" id="searchInput" placeholder="Buscar producto...">
        <button class="btn btn-secondary" id="searchButton">
            <i class="fas fa-search"></i> Buscar
        </button>
    </div>

    <button class="btn btn-primary" id="addHamburguesaBtn">
        <i class="fas fa-plus"></i> Nuevo Producto
    </button>
</div>

<!-- Filtros de categoría -->
<div class="category-filters">
    <button class="category-btn active" data-category="all">Todos</button>
    <button class="category-btn" data-category="1">Hamburguesas</button>
    <button class="category-btn" data-category="2">Entrantes</button>
    <button class="category-btn" data-category="3">Bebidas</button>
    <button class="category-btn" data-category="4">Postres</button>
</div>

<!-- Contenedor para productos agrupados por categoría -->
<div id="productsContainer">
    <!-- Sección de hamburguesas -->
    <div class="category-section" data-category="1">
        <h2 class="category-header">Hamburguesas</h2>
        <div class="hamburguesas-grid">
            @foreach($productos as $producto)
            @if($producto->idCategoria == '1')
            <div class="hamburguesa-card" data-category="{{ $producto->idCategoria }}" data-name="{{ strtolower($producto->nombre) }}">
                <div class="hamburguesa-price">{{ $producto->precio }} €</div>
                <h3 class="hamburguesa-title">{{ $producto->nombre }}</h3>
                <div class="hamburguesa-ingredients">
                    @foreach($producto->ingredientes as $ingrediente)
                    <span class="ingredient-tag">{{ $ingrediente }}</span>
                    @endforeach
                </div>

                <!-- Sección de alérgenos -->
                <div class="hamburguesa-allergens">
                    <div class="allergens-title">Alérgenos:</div>
                    @if(isset($producto->alergenos) && count($producto->alergenos) > 0)
                    @foreach($producto->alergenos as $alergeno)
                    <span class="allergen-tag">{{ $alergeno }}</span>
                    @endforeach
                    @else
                    <span class="ingredient-tag">Sin alérgenos</span>
                    @endif
                </div>

                <div class="hamburguesa-actions">
                    <form method="POST" action="{{ route('hamburguesas.destroy', $producto->idProducto) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary btn-sm">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>

                    <button class="btn btn-primary btn-sm" onclick="editHamburguesa({{ $producto->idProducto}}, '{{ $producto->nombre }}', {{ json_encode($producto->ingredientes) }}, {{ $producto->precio }}, {{ isset($producto->alergenos) ? json_encode($producto->alergenos) : '[]' }}, '{{ $producto->categoria }}')">
                        <i class="fas fa-edit"></i> Modificar
                    </button>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

    <!-- Sección de entrantes -->
    <div class="category-section" data-category="2">
        <h2 class="category-header">Entrantes</h2>
        <div class="hamburguesas-grid">
            @foreach($productos as $producto)
            @if($producto->idCategoria == '2')
            <div class="hamburguesa-card" data-category="{{ $producto->idCategoria }}" data-name="{{ strtolower($producto->nombre) }}">
                <div class="hamburguesa-price">{{ $producto->precio }} €</div>
                <h3 class="hamburguesa-title">{{ $producto->nombre }}</h3>
                <div class="hamburguesa-ingredients">
                    @foreach($producto->ingredientes as $ingrediente)
                    <span class="ingredient-tag">{{ $ingrediente }}</span>
                    @endforeach
                </div>

                <!-- Sección de alérgenos -->
                <div class="hamburguesa-allergens">
                    <div class="allergens-title">Alérgenos:</div>
                    @if(isset($producto->alergenos) && count($producto->alergenos) > 0)
                    @foreach($producto->alergenos as $alergeno)
                    <span class="allergen-tag">{{ $alergeno }}</span>
                    @endforeach
                    @else
                    <span class="ingredient-tag">Sin alérgenos</span>
                    @endif
                </div>

                <div class="hamburguesa-actions">
                    <form method="POST" action="{{ route('hamburguesas.destroy', $producto->idProducto) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary btn-sm">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>

                    <button class="btn btn-primary btn-sm" onclick="editHamburguesa({{ $producto->idProducto}}, '{{ $producto->nombre }}', {{ json_encode($producto->ingredientes) }}, {{ $producto->precio }}, {{ isset($producto->alergenos) ? json_encode($producto->alergenos) : '[]' }}, '{{ $producto->categoria }}')">
                        <i class="fas fa-edit"></i> Modificar
                    </button>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

    <!-- Sección de bebidas -->
    <div class="category-section" data-category="3">
        <h2 class="category-header">Bebidas</h2>
        <div class="hamburguesas-grid">
            @foreach($productos as $producto)
            @if($producto->idCategoria == '3')
            <div class="hamburguesa-card" data-category="{{ $producto->idCategoria }}" data-name="{{ strtolower($producto->nombre) }}">
                <div class="hamburguesa-price">{{ $producto->precio }} €</div>
                <h3 class="hamburguesa-title">{{ $producto->nombre }}</h3>
                <div class="hamburguesa-ingredients">
                    @foreach($producto->ingredientes as $ingrediente)
                    <span class="ingredient-tag">{{ $ingrediente }}</span>
                    @endforeach
                </div>

                <!-- Sección de alérgenos -->
                <div class="hamburguesa-allergens">
                    <div class="allergens-title">Alérgenos:</div>
                    @if(isset($producto->alergenos) && count($producto->alergenos) > 0)
                    @foreach($producto->alergenos as $alergeno)
                    <span class="allergen-tag">{{ $alergeno }}</span>
                    @endforeach
                    @else
                    <span class="ingredient-tag">Sin alérgenos</span>
                    @endif
                </div>

                <div class="hamburguesa-actions">
                    <form method="POST" action="{{ route('hamburguesas.destroy', $producto->idProducto) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary btn-sm">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>

                    <button class="btn btn-primary btn-sm" onclick="editHamburguesa({{ $producto->idProducto}}, '{{ $producto->nombre }}', {{ json_encode($producto->ingredientes) }}, {{ $producto->precio }}, {{ isset($producto->alergenos) ? json_encode($producto->alergenos) : '[]' }}, '{{ $producto->categoria }}')">
                        <i class="fas fa-edit"></i> Modificar
                    </button>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

    <!-- Sección de postres -->
    <div class="category-section" data-category="4">
        <h2 class="category-header">Postres</h2>
        <div class="hamburguesas-grid">
            @foreach($productos as $producto)
            @if($producto->idCategoria == '4')
            <div class="hamburguesa-card" data-category="{{ $producto->idCategoria }}" data-name="{{ strtolower($producto->nombre) }}">
                <div class="hamburguesa-price">{{ $producto->precio }} €</div>
                <h3 class="hamburguesa-title">{{ $producto->nombre }}</h3>
                <div class="hamburguesa-ingredients">
                    @foreach($producto->ingredientes as $ingrediente)
                    <span class="ingredient-tag">{{ $ingrediente }}</span>
                    @endforeach
                </div>

                <!-- Sección de alérgenos -->
                <div class="hamburguesa-allergens">
                    <div class="allergens-title">Alérgenos:</div>
                    @if(isset($producto->alergenos) && count($producto->alergenos) > 0)
                    @foreach($producto->alergenos as $alergeno)
                    <span class="allergen-tag">{{ $alergeno }}</span>
                    @endforeach
                    @else
                    <span class="ingredient-tag">Sin alérgenos</span>
                    @endif
                </div>

                <div class="hamburguesa-actions">
                    <form method="POST" action="{{ route('hamburguesas.destroy', $producto->idProducto) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary btn-sm">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>

                    <button class="btn btn-primary btn-sm" onclick="editHamburguesa({{ $producto->idProducto}}, '{{ $producto->nombre }}', {{ json_encode($producto->ingredientes) }}, {{ $producto->precio }}, {{ isset($producto->alergenos) ? json_encode($producto->alergenos) : '[]' }}, '{{ $producto->categoria }}')">
                        <i class="fas fa-edit"></i> Modificar
                    </button>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

    <!-- Mensaje cuando no hay resultados de búsqueda -->
    <div id="noResults" class="no-products" style="display: none;">
        <p>No se encontraron productos que coincidan con tu búsqueda.</p>
    </div>
</div>

<!-- Modal para añadir producto -->
<div class="modal-backdrop" id="addModal">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Nuevo Producto</h3>
            <button class="modal-close" onclick="closeAddModal()">&times;</button>
        </div>
        <div class="modal-body">
            <form id="addHamburguesaForm" action="{{ route('hamburguesas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="add_nombre" class="form-label">Nombre</label>
                    <input type="text" id="add_nombre" name="nombre" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="add_precio" class="form-label">Precio (€)</label>
                    <input type="number" id="add_precio" name="precio" class="form-input" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label for="add_categoria" class="form-label">Categoría</label>
                    <select id="add_categoria" name="categoria" class="form-select" required>
                        <option value="">Selecciona una categoría</option>
                        <option value="1">Hamburguesas</option>
                        <option value="2">Entrantes</option>
                        <option value="3">Bebidas</option>
                        <option value="4">Postres</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Ingredientes</label>
                    <div id="addIngredientsContainer" class="ingredients-container">
                        <!-- Los ingredientes se añadirán dinámicamente aquí -->
                    </div>

                    <div class="add-ingredient-row">
                        <input type="text" id="addNewIngredient" class="form-input add-ingredient-input" placeholder="Nuevo ingrediente">
                        <button type="button" class="btn btn-secondary" id="addAddIngredientBtn">
                            <i class="fas fa-plus"></i> Añadir
                        </button>
                    </div>

                    <!-- Campos ocultos para cada ingrediente -->
                    <div id="addIngredientsFields"></div>
                </div>

                <!-- Sección para alérgenos -->
                <div class="form-group">
                    <label class="form-label">Alérgenos</label>
                    <div id="addAllergensContainer" class="allergens-container">
                        <!-- Los alérgenos se añadirán dinámicamente aquí -->
                    </div>

                    <div class="add-allergen-row">
                        <input type="text" id="addNewAllergen" class="form-input add-allergen-input" placeholder="Nuevo alérgeno">
                        <button type="button" class="btn btn-secondary" id="addAddAllergenBtn">
                            <i class="fas fa-plus"></i> Añadir
                        </button>
                    </div>

                    <!-- Campos ocultos para cada alérgeno -->
                    <div id="addAllergensFields"></div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeAddModal()">Cancelar</button>
            <button class="btn btn-primary" onclick="submitAddForm()">Guardar Producto</button>
        </div>
    </div>
</div>

<!-- Modal para editar producto -->
<div class="modal-backdrop" id="editModal">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Editar Producto</h3>
            <button class="modal-close" onclick="closeEditModal()">&times;</button>
        </div>
        <div class="modal-body">
            <form id="editHamburguesaForm" action="" method="POST">
                @csrf
                <input type="hidden" id="edit_hamburguesa_id" name="hamburguesa_id">

                <div class="form-group">
                    <label for="edit_nombre" class="form-label">Nombre</label>
                    <input type="text" id="edit_nombre" name="nombre" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="edit_precio" class="form-label">Precio (€)</label>
                    <input type="number" id="edit_precio" name="precio" class="form-input" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label for="edit_categoria" class="form-label">Categoría</label>
                    <select id="edit_categoria" name="categoria" class="form-select" required>
                        <option value="hamburguesas">Hamburguesas</option>
                        <option value="entrantes">Entrantes</option>
                        <option value="bebidas">Bebidas</option>
                        <option value="postres">Postres</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Ingredientes</label>
                    <div id="editIngredientsContainer" class="ingredients-container">
                        <!-- Los ingredientes se añadirán dinámicamente aquí -->
                    </div>

                    <div class="add-ingredient-row">
                        <input type="text" id="editNewIngredient" class="form-input add-ingredient-input" placeholder="Nuevo ingrediente">
                        <button type="button" class="btn btn-secondary" id="addEditIngredientBtn">
                            <i class="fas fa-plus"></i> Añadir
                        </button>
                    </div>

                    <!-- Campos ocultos para cada ingrediente -->
                    <div id="editIngredientsFields"></div>
                </div>

                <!-- Sección para alérgenos en el modal de edición -->
                <div class="form-group">
                    <label class="form-label">Alérgenos</label>
                    <div id="editAllergensContainer" class="allergens-container">
                        <!-- Los alérgenos se añadirán dinámicamente aquí -->
                    </div>

                    <div class="add-allergen-row">
                        <input type="text" id="editNewAllergen" class="form-input add-allergen-input" placeholder="Nuevo alérgeno">
                        <button type="button" class="btn btn-secondary" id="addEditAllergenBtn">
                            <i class="fas fa-plus"></i> Añadir
                        </button>
                    </div>

                    <!-- Campos ocultos para cada alérgeno -->
                    <div id="editAllergensFields"></div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeEditModal()">Cancelar</button>
            <button class="btn btn-primary" onclick="submitEditForm()">Guardar Cambios</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Variables globales
    let addIngredients = [];
    let editIngredients = [];
    let addAllergens = [];
    let editAllergens = [];
    let currentCategory = 'all';
    let searchTerm = '';

    // Función para abrir el modal de añadir
    document.getElementById('addHamburguesaBtn').addEventListener('click', function() {
        // Limpiar el formulario
        document.getElementById('addHamburguesaForm').reset();

        // Limpiar ingredientes
        addIngredients = [];
        document.getElementById('addIngredientsContainer').innerHTML = '';
        document.getElementById('addIngredientsFields').innerHTML = '';

        // Limpiar alérgenos
        addAllergens = [];
        document.getElementById('addAllergensContainer').innerHTML = '';
        document.getElementById('addAllergensFields').innerHTML = '';

        // Mostrar el modal
        document.getElementById('addModal').classList.add('show');
    });

    // Función para cerrar el modal de añadir
    function closeAddModal() {
        document.getElementById('addModal').classList.remove('show');
    }

    // Función para abrir el modal de edición
    function editHamburguesa(id, nombre, ingredientes, precio, alergenos, categoria) {
        // Establecer los valores en el formulario

        // Establecer los valores en el formulario
        document.getElementById('edit_hamburguesa_id').value = id;
        document.getElementById('edit_nombre').value = nombre;
        document.getElementById('edit_precio').value = precio;
        document.getElementById('edit_categoria').value = categoria;

        // Actualizar la acción del formulario
        document.getElementById('editHamburguesaForm').action = "{{ route('hamburguesas.update', '') }}/" + id;

        // Limpiar y añadir los ingredientes
        const ingredientsContainer = document.getElementById('editIngredientsContainer');
        ingredientsContainer.innerHTML = '';
        document.getElementById('editIngredientsFields').innerHTML = '';

        editIngredients = [...ingredientes];

        // Añadir cada ingrediente al contenedor
        editIngredients.forEach((ingrediente, index) => {
            addEditIngredientToList(ingrediente, index);
        });

        // Actualizar los campos ocultos de ingredientes
        updateEditIngredientFields();

        // Limpiar y añadir los alérgenos
        const allergensContainer = document.getElementById('editAllergensContainer');
        allergensContainer.innerHTML = '';
        document.getElementById('editAllergensFields').innerHTML = '';

        editAllergens = Array.isArray(alergenos) ? [...alergenos] : [];

        // Añadir cada alérgeno al contenedor
        editAllergens.forEach((alergeno, index) => {
            addEditAllergenToList(alergeno, index);
        });

        // Actualizar los campos ocultos de alérgenos
        updateEditAllergenFields();

        // Mostrar el modal
        document.getElementById('editModal').classList.add('show');
    }

    // Función para cerrar el modal de edición
    function closeEditModal() {
        document.getElementById('editModal').classList.remove('show');
    }

    // Función para añadir un ingrediente a la lista visual (modal añadir)
    function addAddIngredientToList(ingrediente, index) {
        const ingredientsContainer = document.getElementById('addIngredientsContainer');

        const ingredientItem = document.createElement('div');
        ingredientItem.className = 'ingredient-item';
        ingredientItem.innerHTML = `
            <span class="ingredient-text">${ingrediente}</span>
            <button type="button" class="ingredient-remove" data-index="${index}">
                <i class="fas fa-times"></i>
            </button>
        `;

        ingredientsContainer.appendChild(ingredientItem);

        // Añadir event listener para eliminar
        ingredientItem.querySelector('.ingredient-remove').addEventListener('click', function() {
            const index = parseInt(this.getAttribute('data-index'));
            removeAddIngredient(index);
        });
    }

    // Función para añadir un ingrediente a la lista visual (modal editar)
    function addEditIngredientToList(ingrediente, index) {
        const ingredientsContainer = document.getElementById('editIngredientsContainer');

        const ingredientItem = document.createElement('div');
        ingredientItem.className = 'ingredient-item';
        ingredientItem.innerHTML = `
            <span class="ingredient-text">${ingrediente}</span>
            <button type="button" class="ingredient-remove" data-index="${index}">
                <i class="fas fa-times"></i>
            </button>
        `;

        ingredientsContainer.appendChild(ingredientItem);

        // Añadir event listener para eliminar
        ingredientItem.querySelector('.ingredient-remove').addEventListener('click', function() {
            const index = parseInt(this.getAttribute('data-index'));
            removeEditIngredient(index);
        });
    }

    // Función para añadir un alérgeno a la lista visual (modal añadir)
    function addAddAllergenToList(alergeno, index) {
        const allergensContainer = document.getElementById('addAllergensContainer');

        const allergenItem = document.createElement('div');
        allergenItem.className = 'allergen-item';
        allergenItem.innerHTML = `
            <span class="allergen-text">${alergeno}</span>
            <button type="button" class="allergen-remove" data-index="${index}">
                <i class="fas fa-times"></i>
            </button>
        `;

        allergensContainer.appendChild(allergenItem);

        // Añadir event listener para eliminar
        allergenItem.querySelector('.allergen-remove').addEventListener('click', function() {
            const index = parseInt(this.getAttribute('data-index'));
            removeAddAllergen(index);
        });
    }

    // Función para añadir un alérgeno a la lista visual (modal editar)
    function addEditAllergenToList(alergeno, index) {
        const allergensContainer = document.getElementById('editAllergensContainer');

        const allergenItem = document.createElement('div');
        allergenItem.className = 'allergen-item';
        allergenItem.innerHTML = `
            <span class="allergen-text">${alergeno}</span>
            <button type="button" class="allergen-remove" data-index="${index}">
                <i class="fas fa-times"></i>
            </button>
        `;

        allergensContainer.appendChild(allergenItem);

        // Añadir event listener para eliminar
        allergenItem.querySelector('.allergen-remove').addEventListener('click', function() {
            const index = parseInt(this.getAttribute('data-index'));
            removeEditAllergen(index);
        });
    }

    // Función para eliminar un ingrediente (modal añadir)
    function removeAddIngredient(index) {
        addIngredients.splice(index, 1);
        refreshAddIngredientsList();
    }

    // Función para eliminar un ingrediente (modal editar)
    function removeEditIngredient(index) {
        editIngredients.splice(index, 1);
        refreshEditIngredientsList();
    }

    // Función para eliminar un alérgeno (modal añadir)
    function removeAddAllergen(index) {
        addAllergens.splice(index, 1);
        refreshAddAllergensList();
    }

    // Función para eliminar un alérgeno (modal editar)
    function removeEditAllergen(index) {
        editAllergens.splice(index, 1);
        refreshEditAllergensList();
    }

    // Función para refrescar la lista de ingredientes (modal añadir)
    function refreshAddIngredientsList() {
        const ingredientsContainer = document.getElementById('addIngredientsContainer');
        ingredientsContainer.innerHTML = '';

        addIngredients.forEach((ingrediente, index) => {
            addAddIngredientToList(ingrediente, index);
        });

        // Actualizar los campos ocultos
        updateAddIngredientFields();
    }

    // Función para refrescar la lista de ingredientes (modal editar)
    function refreshEditIngredientsList() {
        const ingredientsContainer = document.getElementById('editIngredientsContainer');
        ingredientsContainer.innerHTML = '';

        editIngredients.forEach((ingrediente, index) => {
            addEditIngredientToList(ingrediente, index);
        });

        // Actualizar los campos ocultos
        updateEditIngredientFields();
    }

    // Función para refrescar la lista de alérgenos (modal añadir)
    function refreshAddAllergensList() {
        const allergensContainer = document.getElementById('addAllergensContainer');
        allergensContainer.innerHTML = '';

        addAllergens.forEach((alergeno, index) => {
            addAddAllergenToList(alergeno, index);
        });

        // Actualizar los campos ocultos
        updateAddAllergenFields();
    }

    // Función para refrescar la lista de alérgenos (modal editar)
    function refreshEditAllergensList() {
        const allergensContainer = document.getElementById('editAllergensContainer');
        allergensContainer.innerHTML = '';

        editAllergens.forEach((alergeno, index) => {
            addEditAllergenToList(alergeno, index);
        });

        // Actualizar los campos ocultos
        updateEditAllergenFields();
    }

    // Función para actualizar los campos ocultos de ingredientes (modal añadir)
    function updateAddIngredientFields() {
        const container = document.getElementById('addIngredientsFields');
        container.innerHTML = '';

        addIngredients.forEach((ingrediente, index) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `ingredientes[${index}]`;
            input.value = ingrediente;
            container.appendChild(input);
        });
    }

    // Función para actualizar los campos ocultos de ingredientes (modal editar)
    function updateEditIngredientFields() {
        const container = document.getElementById('editIngredientsFields');
        container.innerHTML = '';

        editIngredients.forEach((ingrediente, index) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `ingredientes[${index}]`;
            input.value = ingrediente;
            container.appendChild(input);
        });
    }

    // Función para actualizar los campos ocultos de alérgenos (modal añadir)
    function updateAddAllergenFields() {
        const container = document.getElementById('addAllergensFields');
        container.innerHTML = '';

        addAllergens.forEach((alergeno, index) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `alergenos[${index}]`;
            input.value = alergeno;
            container.appendChild(input);
        });
    }

    // Función para actualizar los campos ocultos de alérgenos (modal editar)
    function updateEditAllergenFields() {
        const container = document.getElementById('editAllergensFields');
        container.innerHTML = '';

        editAllergens.forEach((alergeno, index) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `alergenos[${index}]`;
            input.value = alergeno;
            container.appendChild(input);
        });
    }

    // Event listener para añadir un nuevo ingrediente (modal añadir)
    document.getElementById('addAddIngredientBtn').addEventListener('click', function() {
        const newIngredientInput = document.getElementById('addNewIngredient');
        const ingrediente = newIngredientInput.value.trim();

        if (ingrediente) {
            addIngredients.push(ingrediente);
            refreshAddIngredientsList();
            newIngredientInput.value = '';
            newIngredientInput.focus();
        }
    });

    // Event listener para añadir un nuevo ingrediente (modal editar)
    document.getElementById('addEditIngredientBtn').addEventListener('click', function() {
        const newIngredientInput = document.getElementById('editNewIngredient');
        const ingrediente = newIngredientInput.value.trim();

        if (ingrediente) {
            editIngredients.push(ingrediente);
            refreshEditIngredientsList();
            newIngredientInput.value = '';
            newIngredientInput.focus();
        }
    });

    // Event listener para añadir un nuevo alérgeno (modal añadir)
    document.getElementById('addAddAllergenBtn').addEventListener('click', function() {
        const newAllergenInput = document.getElementById('addNewAllergen');
        const alergeno = newAllergenInput.value.trim();

        if (alergeno) {
            addAllergens.push(alergeno);
            refreshAddAllergensList();
            newAllergenInput.value = '';
            newAllergenInput.focus();
        }
    });

    // Event listener para añadir un nuevo alérgeno (modal editar)
    document.getElementById('addEditAllergenBtn').addEventListener('click', function() {
        const newAllergenInput = document.getElementById('editNewAllergen');
        const alergeno = newAllergenInput.value.trim();

        if (alergeno) {
            editAllergens.push(alergeno);
            refreshEditAllergensList();
            newAllergenInput.value = '';
            newAllergenInput.focus();
        }
    });

    // También permitir añadir ingrediente con Enter (modal añadir)
    document.getElementById('addNewIngredient').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('addAddIngredientBtn').click();
        }
    });

    // También permitir añadir ingrediente con Enter (modal editar)
    document.getElementById('editNewIngredient').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('addEditIngredientBtn').click();
        }
    });

    // También permitir añadir alérgeno con Enter (modal añadir)
    document.getElementById('addNewAllergen').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('addAddAllergenBtn').click();
        }
    });

    // También permitir añadir alérgeno con Enter (modal editar)
    document.getElementById('editNewAllergen').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('addEditAllergenBtn').click();
        }
    });

    // Función para enviar el formulario de añadir
    function submitAddForm() {
        const nombre = document.getElementById('add_nombre').value;
        const precio = document.getElementById('add_precio').value;
        const categoria = document.getElementById('add_categoria').value;

        if (!nombre || !precio || !categoria) {
            alert('Por favor, completa todos los campos obligatorios.');
            return;
        }

        if (addIngredients.length === 0) {
            alert('Debes añadir al menos un ingrediente.');
            return;
        }

        // Actualizar los campos ocultos antes de enviar
        updateAddIngredientFields();
        updateAddAllergenFields();

        // Enviar el formulario
        document.getElementById('addHamburguesaForm').submit();
    }

    // Función para enviar el formulario de editar
    function submitEditForm() {
        const nombre = document.getElementById('edit_nombre').value;
        const precio = document.getElementById('edit_precio').value;
        const categoria = document.getElementById('edit_categoria').value;

        if (!nombre || !precio || !categoria) {
            alert('Por favor, completa todos los campos obligatorios.');
            return;
        }

        if (editIngredients.length === 0) {
            alert('Debes añadir al menos un ingrediente.');
            return;
        }

        // Actualizar los campos ocultos antes de enviar
        updateEditIngredientFields();
        updateEditAllergenFields();

        // Enviar el formulario
        document.getElementById('editHamburguesaForm').submit();
    }

    // Filtrado por categoría
    document.querySelectorAll('.category-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Actualizar botón activo
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            this.classList.add('active');

            // Obtener categoría seleccionada
            currentCategory = this.getAttribute('data-category');

            // Aplicar filtros
            applyFilters();
        });
    });

    // Búsqueda de productos
    document.getElementById('searchButton').addEventListener('click', function() {
        searchTerm = document.getElementById('searchInput').value.trim().toLowerCase();
        applyFilters();
    });

    // También permitir buscar con Enter
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('searchButton').click();
        }
    });

    // Función para aplicar filtros (categoría y búsqueda)
    function applyFilters() {
        let hasVisibleProducts = false;

        // Si la categoría es "all", mostrar todas las secciones
        if (currentCategory === 'all') {
            document.querySelectorAll('.category-section').forEach(section => {
                section.style.display = 'block';
            });
        } else {
            // Mostrar solo la sección de la categoría seleccionada
            document.querySelectorAll('.category-section').forEach(section => {
                if (section.getAttribute('data-category') === currentCategory) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        }

        // Filtrar productos por término de búsqueda
        document.querySelectorAll('.hamburguesa-card').forEach(card => {
            const cardName = card.getAttribute('data-name');
            const cardCategory = card.getAttribute('data-category');

            // Verificar si el producto coincide con la búsqueda y la categoría
            const matchesSearch = searchTerm === '' || cardName.includes(searchTerm);
            const matchesCategory = currentCategory === 'all' || cardCategory === currentCategory;

            if (matchesSearch && matchesCategory) {
                card.style.display = 'block';
                hasVisibleProducts = true;
            } else {
                card.style.display = 'none';
            }
        });

        // Mostrar mensaje si no hay resultados
        const noResultsElement = document.getElementById('noResults');
        if (!hasVisibleProducts) {
            noResultsElement.style.display = 'block';
        } else {
            noResultsElement.style.display = 'none';
        }
    }
</script>
@endsection