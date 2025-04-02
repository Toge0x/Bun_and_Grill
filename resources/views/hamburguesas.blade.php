@extends('layouts.admin')

@section('title', 'Gestión de Hamburguesas')

@section('page-title', 'Gestión de Hamburguesas')

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
    .form-textarea {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #f0b000;
    }

    .form-textarea {
        min-height: 100px;
        resize: vertical;
    }

    .ingredients-container {
        margin-top: 10px;
    }

    .ingredient-item {
        display: flex;
        align-items: center;
        background-color: #f8f9fa;
        padding: 8px 12px;
        border-radius: 4px;
        margin-bottom: 8px;
    }

    .ingredient-text {
        flex: 1;
    }

    .ingredient-remove {
        background: none;
        border: none;
        color: #e74c3c;
        cursor: pointer;
        font-size: 16px;
    }

    .add-ingredient-row {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .add-ingredient-input {
        flex: 1;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hamburguesas-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
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
        <input type="text" class="search-input" placeholder="Buscar hamburguesa...">
        <button class="btn btn-secondary">
            <i class="fas fa-search"></i> Buscar
        </button>
    </div>

    <button class="btn btn-primary" id="addHamburguesaBtn">
        <i class="fas fa-plus"></i> Nueva Hamburguesa
    </button>
</div>

<div class="hamburguesas-grid">
    @foreach($productos as $hamburguesa)
    <div class="hamburguesa-card">
        <div class="hamburguesa-price">{{ $hamburguesa->precio }} €</div>
        <h3 class="hamburguesa-title">{{ $hamburguesa->nombre }}</h3>
        <div class="hamburguesa-ingredients">
            @foreach($hamburguesa->ingredientes as $ingrediente)
            <span class="ingredient-tag">{{ $ingrediente }}</span>
            @endforeach
        </div>
        <div class="hamburguesa-actions">
            <form method="POST" action="{{ route('hamburguesas.destroy', $hamburguesa->idProducto) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-secondary btn-sm">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
            </form>

            <button class="btn btn-primary btn-sm" onclick="editHamburguesa({{ $hamburguesa->idProducto}}, '{{ $hamburguesa->nombre }}', {{ json_encode($hamburguesa->ingredientes) }}, {{ $hamburguesa->precio }})">
                <i class="fas fa-edit"></i> Modificar
            </button>
        </div>
    </div>
    @endforeach
</div>

<!-- Modal para añadir hamburguesa -->
<div class="modal-backdrop" id="addModal">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Nueva Hamburguesa</h3>
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
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeAddModal()">Cancelar</button>
            <button class="btn btn-primary" onclick="submitAddForm()">Guardar Hamburguesa</button>
        </div>
    </div>
</div>

<!-- Modal para editar hamburguesa -->
<div class="modal-backdrop" id="editModal">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Editar Hamburguesa</h3>
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

    // Función para abrir el modal de añadir
    document.getElementById('addHamburguesaBtn').addEventListener('click', function() {
        // Limpiar el formulario
        document.getElementById('addHamburguesaForm').reset();

        // Limpiar ingredientes
        addIngredients = [];
        document.getElementById('addIngredientsContainer').innerHTML = '';
        document.getElementById('addIngredientsFields').innerHTML = '';

        // Mostrar el modal
        document.getElementById('addModal').classList.add('show');
    });

    // Función para cerrar el modal de añadir
    function closeAddModal() {
        document.getElementById('addModal').classList.remove('show');
    }

    // Función para abrir el modal de edición
    function editHamburguesa(id, nombre, ingredientes, precio) {
        // Establecer los valores en el formulario
        document.getElementById('edit_hamburguesa_id').value = id;
        document.getElementById('edit_nombre').value = nombre;
        document.getElementById('edit_precio').value = precio;

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

        // Actualizar los campos ocultos
        updateEditIngredientFields();

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

    // Función para enviar el formulario de añadir
    function submitAddForm() {
        const nombre = document.getElementById('add_nombre').value;
        const precio = document.getElementById('add_precio').value;

        if (!nombre || !precio) {
            alert('Por favor, completa todos los campos obligatorios.');
            return;
        }

        if (addIngredients.length === 0) {
            alert('Debes añadir al menos un ingrediente.');
            return;
        }

        // Actualizar los campos ocultos antes de enviar
        updateAddIngredientFields();

        // Enviar el formulario
        document.getElementById('addHamburguesaForm').submit();
    }

    // Función para enviar el formulario de editar
    function submitEditForm() {
        const nombre = document.getElementById('edit_nombre').value;
        const precio = document.getElementById('edit_precio').value;

        if (!nombre || !precio) {
            alert('Por favor, completa todos los campos obligatorios.');
            return;
        }

        if (editIngredients.length === 0) {
            alert('Debes añadir al menos un ingrediente.');
            return;
        }

        // Actualizar los campos ocultos antes de enviar
        updateEditIngredientFields();

        // Enviar el formulario
        document.getElementById('editHamburguesaForm').submit();
    }
</script>
@endsection