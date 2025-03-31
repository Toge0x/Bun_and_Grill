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
        padding-right: 70px; /* Espacio para el precio */
    }

    .hamburguesa-ingredients {
        margin-bottom: 15px;
        min-height: 60px; /* Altura mínima para los ingredientes */
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
        <!-- Hamburguesa 1 -->
        <div class="hamburguesa-card">
            <div class="hamburguesa-price">8,50 €</div>
            <h3 class="hamburguesa-title">Hamburguesa Clásica</h3>
            <div class="hamburguesa-ingredients">
                <span class="ingredient-tag">Carne de ternera</span>
                <span class="ingredient-tag">Queso cheddar</span>
                <span class="ingredient-tag">Lechuga</span>
                <span class="ingredient-tag">Tomate</span>
                <span class="ingredient-tag">Cebolla</span>
                <span class="ingredient-tag">Salsa especial</span>
            </div>
            <div class="hamburguesa-actions">
                <button class="btn btn-secondary btn-sm" onclick="deleteHamburguesa(1)">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
                <button class="btn btn-primary btn-sm" onclick="editHamburguesa(1, 'Hamburguesa Clásica', ['Carne de ternera', 'Queso cheddar', 'Lechuga', 'Tomate', 'Cebolla', 'Salsa especial'], 8.50)">
                    <i class="fas fa-edit"></i> Modificar
                </button>
            </div>
        </div>

        <!-- Hamburguesa 2 -->
        <div class="hamburguesa-card">
            <div class="hamburguesa-price">9,75 €</div>
            <h3 class="hamburguesa-title">Hamburguesa BBQ</h3>
            <div class="hamburguesa-ingredients">
                <span class="ingredient-tag">Carne de ternera</span>
                <span class="ingredient-tag">Queso ahumado</span>
                <span class="ingredient-tag">Bacon</span>
                <span class="ingredient-tag">Cebolla caramelizada</span>
                <span class="ingredient-tag">Salsa BBQ</span>
            </div>
            <div class="hamburguesa-actions">
                <button class="btn btn-secondary btn-sm" onclick="deleteHamburguesa(2)">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
                <button class="btn btn-primary btn-sm" onclick="editHamburguesa(2, 'Hamburguesa BBQ', ['Carne de ternera', 'Queso ahumado', 'Bacon', 'Cebolla caramelizada', 'Salsa BBQ'], 9.75)">
                    <i class="fas fa-edit"></i> Modificar
                </button>
            </div>
        </div>

        <!-- Hamburguesa 3 -->
        <div class="hamburguesa-card">
            <div class="hamburguesa-price">10,50 €</div>
            <h3 class="hamburguesa-title">Hamburguesa Vegana</h3>
            <div class="hamburguesa-ingredients">
                <span class="ingredient-tag">Burger de garbanzos</span>
                <span class="ingredient-tag">Queso vegano</span>
                <span class="ingredient-tag">Aguacate</span>
                <span class="ingredient-tag">Rúcula</span>
                <span class="ingredient-tag">Tomate</span>
                <span class="ingredient-tag">Salsa de yogur</span>
            </div>
            <div class="hamburguesa-actions">
                <button class="btn btn-secondary btn-sm" onclick="deleteHamburguesa(3)">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
                <button class="btn btn-primary btn-sm" onclick="editHamburguesa(3, 'Hamburguesa Vegana', ['Burger de garbanzos', 'Queso vegano', 'Aguacate', 'Rúcula', 'Tomate', 'Salsa de yogur'], 10.50)">
                    <i class="fas fa-edit"></i> Modificar
                </button>
            </div>
        </div>

        <!-- Hamburguesa 4 -->
        <div class="hamburguesa-card">
            <div class="hamburguesa-price">12,95 €</div>
            <h3 class="hamburguesa-title">Hamburguesa Doble</h3>
            <div class="hamburguesa-ingredients">
                <span class="ingredient-tag">Doble carne de ternera</span>
                <span class="ingredient-tag">Doble queso</span>
                <span class="ingredient-tag">Bacon</span>
                <span class="ingredient-tag">Huevo frito</span>
                <span class="ingredient-tag">Lechuga</span>
                <span class="ingredient-tag">Tomate</span>
                <span class="ingredient-tag">Salsa especial</span>
            </div>
            <div class="hamburguesa-actions">
                <button class="btn btn-secondary btn-sm" onclick="deleteHamburguesa(4)">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
                <button class="btn btn-primary btn-sm" onclick="editHamburguesa(4, 'Hamburguesa Doble', ['Doble carne de ternera', 'Doble queso', 'Bacon', 'Huevo frito', 'Lechuga', 'Tomate', 'Salsa especial'], 12.95)">
                    <i class="fas fa-edit"></i> Modificar
                </button>
            </div>
        </div>

        <!-- Hamburguesa 5 -->
        <div class="hamburguesa-card">
            <div class="hamburguesa-price">10,95 €</div>
            <h3 class="hamburguesa-title">Hamburguesa Mexicana</h3>
            <div class="hamburguesa-ingredients">
                <span class="ingredient-tag">Carne de ternera</span>
                <span class="ingredient-tag">Queso cheddar</span>
                <span class="ingredient-tag">Guacamole</span>
                <span class="ingredient-tag">Jalapeños</span>
                <span class="ingredient-tag">Pico de gallo</span>
                <span class="ingredient-tag">Nachos triturados</span>
            </div>
            <div class="hamburguesa-actions">
                <button class="btn btn-secondary btn-sm" onclick="deleteHamburguesa(5)">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
                <button class="btn btn-primary btn-sm" onclick="editHamburguesa(5, 'Hamburguesa Mexicana', ['Carne de ternera', 'Queso cheddar', 'Guacamole', 'Jalapeños', 'Pico de gallo', 'Nachos triturados'], 10.95)">
                    <i class="fas fa-edit"></i> Modificar
                </button>
            </div>
        </div>

        <!-- Hamburguesa 6 -->
        <div class="hamburguesa-card">
            <div class="hamburguesa-price">9,50 €</div>
            <h3 class="hamburguesa-title">Hamburguesa de Pollo</h3>
            <div class="hamburguesa-ingredients">
                <span class="ingredient-tag">Pechuga de pollo crujiente</span>
                <span class="ingredient-tag">Queso gouda</span>
                <span class="ingredient-tag">Lechuga</span>
                <span class="ingredient-tag">Tomate</span>
                <span class="ingredient-tag">Cebolla morada</span>
                <span class="ingredient-tag">Salsa de mostaza y miel</span>
            </div>
            <div class="hamburguesa-actions">
                <button class="btn btn-secondary btn-sm" onclick="deleteHamburguesa(6)">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
                <button class="btn btn-primary btn-sm" onclick="editHamburguesa(6, 'Hamburguesa de Pollo', ['Pechuga de pollo crujiente', 'Queso gouda', 'Lechuga', 'Tomate', 'Cebolla morada', 'Salsa de mostaza y miel'], 9.50)">
                    <i class="fas fa-edit"></i> Modificar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal para editar hamburguesa -->
    <div class="modal-backdrop" id="editModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Editar Hamburguesa</h3>
                <button class="modal-close" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="hamburguesaForm">
                    <input type="hidden" id="hamburguesa_id" name="hamburguesa_id">

                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="precio" class="form-label">Precio (€)</label>
                        <input type="number" id="precio" name="precio" class="form-input" step="0.01" min="0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Ingredientes</label>
                        <div id="ingredientsContainer" class="ingredients-container">
                            <!-- Los ingredientes se añadirán dinámicamente aquí -->
                        </div>

                        <div class="add-ingredient-row">
                            <input type="text" id="newIngredient" class="form-input add-ingredient-input" placeholder="Nuevo ingrediente">
                            <button type="button" class="btn btn-secondary" id="addIngredientBtn">
                                <i class="fas fa-plus"></i> Añadir
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="cancelBtn">Cancelar</button>
                <button class="btn btn-primary" id="saveBtn">Guardar Cambios</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Variables globales
    let currentIngredients = [];

    // Función para abrir el modal de edición
    function editHamburguesa(id, nombre, ingredientes, precio) {
        // Establecer los valores en el formulario
        document.getElementById('hamburguesa_id').value = id;
        document.getElementById('nombre').value = nombre;
        document.getElementById('precio').value = precio;

        // Limpiar y añadir los ingredientes
        const ingredientsContainer = document.getElementById('ingredientsContainer');
        ingredientsContainer.innerHTML = '';
        currentIngredients = [...ingredientes];

        // Añadir cada ingrediente al contenedor
        currentIngredients.forEach((ingrediente, index) => {
            addIngredientToList(ingrediente, index);
        });

        // Mostrar el modal
        document.getElementById('editModal').classList.add('show');
        document.getElementById('modalTitle').textContent = 'Editar Hamburguesa';
    }

    // Función para añadir una nueva hamburguesa
    document.getElementById('addHamburguesaBtn').addEventListener('click', function() {
        // Limpiar el formulario
        document.getElementById('hamburguesaForm').reset();
        document.getElementById('hamburguesa_id').value = '';

        // Limpiar ingredientes
        document.getElementById('ingredientsContainer').innerHTML = '';
        currentIngredients = [];

        // Mostrar el modal
        document.getElementById('editModal').classList.add('show');
        document.getElementById('modalTitle').textContent = 'Nueva Hamburguesa';
    });

    // Función para cerrar el modal
    function closeModal() {
        document.getElementById('editModal').classList.remove('show');
    }

    // Event listeners para cerrar el modal
    document.getElementById('closeModal').addEventListener('click', closeModal);
    document.getElementById('cancelBtn').addEventListener('click', closeModal);

    // Función para añadir un ingrediente a la lista visual
    function addIngredientToList(ingrediente, index) {
        const ingredientsContainer = document.getElementById('ingredientsContainer');

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
            removeIngredient(index);
        });
    }

    // Función para eliminar un ingrediente
    function removeIngredient(index) {
        currentIngredients.splice(index, 1);
        refreshIngredientsList();
    }

    // Función para refrescar la lista de ingredientes
    function refreshIngredientsList() {
        const ingredientsContainer = document.getElementById('ingredientsContainer');
        ingredientsContainer.innerHTML = '';

        currentIngredients.forEach((ingrediente, index) => {
            addIngredientToList(ingrediente, index);
        });
    }

    // Event listener para añadir un nuevo ingrediente
    document.getElementById('addIngredientBtn').addEventListener('click', function() {
        const newIngredientInput = document.getElementById('newIngredient');
        const ingrediente = newIngredientInput.value.trim();

        if (ingrediente) {
            currentIngredients.push(ingrediente);
            refreshIngredientsList();
            newIngredientInput.value = '';
            newIngredientInput.focus();
        }
    });

    // También permitir añadir ingrediente con Enter
    document.getElementById('newIngredient').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('addIngredientBtn').click();
        }
    });

    // Guardar los cambios
    document.getElementById('saveBtn').addEventListener('click', function() {
        const id = document.getElementById('hamburguesa_id').value;
        const nombre = document.getElementById('nombre').value;
        const precio = document.getElementById('precio').value;

        if (!nombre || !precio) {
            alert('Por favor, completa todos los campos obligatorios.');
            return;
        }

        if (currentIngredients.length === 0) {
            alert('Debes añadir al menos un ingrediente.');
            return;
        }

        // Aquí normalmente enviarías los datos al servidor
        // Por ahora, solo mostraremos un mensaje y cerraremos el modal
        console.log('Guardando hamburguesa:', {
            id: id || 'nueva',
            nombre,
            precio,
            ingredientes: currentIngredients
        });

        alert('Hamburguesa guardada correctamente.');
        closeModal();

        // En una aplicación real, aquí harías una petición AJAX
        // y luego actualizarías la UI o recargarías la página
    });

    // Función para eliminar una hamburguesa
    function deleteHamburguesa(id) {
        if (confirm('¿Estás seguro de que deseas eliminar esta hamburguesa?')) {
            // Aquí normalmente enviarías una petición al servidor
            console.log('Eliminando hamburguesa con ID:', id);
            alert('Hamburguesa eliminada correctamente.');

            // En una aplicación real, aquí harías una petición AJAX
            // y luego actualizarías la UI o recargarías la página
        }
    }
</script>
@endsection