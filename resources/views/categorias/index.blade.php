<x-app-layout>

    @section('title', 'Categorias')

    @push('css')
    @endpush

    <!-- Header Section -->
    <div class="px-6 py-2 border-b border-gray-100 dark:border-gray-700">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    <span class="inline-flex items-center">
                        <i class="fas fa-folder-open mr-3 text-purple-500"></i>
                        Gestión de Categorías
                    </span>
                </h2>
                <p class="mt-1 text-xs md:text-sm text-gray-500 dark:text-gray-400">
                    Administra y organiza tus categorías de productos
                </p>
            </div>

            <!-- Breadcrumb -->
            <nav class="mt-4 md:mt-0" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center text-purple-600 hover:text-purple-700 dark:text-purple-400 dark:hover:text-purple-300 transition-colors">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-gray-500 dark:text-gray-400">Categorías</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="font-medium text-gray-700 dark:text-gray-300">Listado</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Card Container  --}}
    <div class="w-full overflow-hidden rounded-lg shadow-xs mt-3">
        <div class="w-full overflow-x-auto">
            <div class="bg-white rounded-lg shadow-md dark:bg-gray-800">
                {{-- Card Hearder  --}}
                <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">

                    <div class="flex items-center text-gray-700 dark:text-gray-300">
                        <i class="fas fa-table mr-2"></i>
                        <span>Registros</span>
                    </div>
                    {{-- Boton de Agregar Categoría --}}
                    <button
                        class="flex items-center justify-center p-3 bg-purple-600 hover:bg-purple-700 text-white rounded-full 
                        shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                        type="button" data-modal-target="crearCategoriaModal" data-modal-toggle="crearCategoriaModal">
                        <i class="fas fa-plus"></i>
                    </button>

                </div>

                {{-- Tabla de Categorías --}}
                <div class="p-4">
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b
                                         dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">Nombre</th>
                                        <th class="px-4 py-3">Descripción</th>
                                        <th class="py-3">Estado / Dest.</th>
                                        <th class="pl-10 py-3">
                                            <i class="fa-solid fa-wrench"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach ($categorias as $categoria)
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-1">
                                                <strong
                                                    class="text-gray-900 dark:text-gray-200">{{ $categoria->caracteristica->nombre }}</strong>
                                            </td>
                                            <td class="px-4 py-1">
                                                <i class="fa-regular fa-comment-dots mr-2"></i>
                                                {{ $categoria->caracteristica->descripcion }}
                                            </td>
                                            <td class="px-4 py-1">
                                                @if ($categoria->caracteristica->estado == 1)
                                                    <i class="fa-solid fa-circle-check text-green-500"></i>
                                                @else
                                                    <i class="fa-solid fa-circle-xmark text-gray-400"></i>
                                                @endif

                                                @if ($categoria->caracteristica->destacado == 1)
                                                    <i class="fa fa-star text-blue-400 ml-2"></i>
                                                @endif
                                            </td>
                                            <td class="px-4 py-1">
                                                <button
                                                    class="p-2 text-blue-400 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700"
                                                    type="button" data-modal-target="editarCategoriaModal"
                                                    data-modal-toggle="editarCategoriaModal"
                                                    data-id="{{ $categoria->id }}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>

                                                <button
                                                    class="p-2 text-red-500 rounded-lg hover:bg-red-50 dark:hover:bg-gray-700">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Modal para crear categoría -->
    <div id="crearCategoriaModal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 overflow-y-auto overflow-x-hidden">
        <div class="relative p-4 w-full max-w-2xl">
            <!-- Modal content -->
            <div
                class="relative bg-white rounded-lg shadow dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 dark:border-gray-700 rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        <i class="fas fa-folder-plus mr-2 text-purple-500"></i>
                        Crear Nueva Categoría
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto
                         inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white"
                        data-modal-hide="crearCategoriaModal">
                        <i class="fas fa-times"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form action="{{ route('categorias.store') }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Nombre <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500
                                 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                  dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500 transition-all duration-200"
                                placeholder="Ej. Electrónicos">
                            @error('nombre')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="descripcion"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Descripción
                            </label>
                            <textarea name="descripcion" id="descripcion" rows="3"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500
                                 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                  dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500 transition-all duration-200"
                                placeholder="Ej. Productos electrónicos y dispositivos tecnológicos">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex items-center mb-5">
                            <input type="checkbox" name="destacado" id="destacado" value="1"
                                {{ old('destacado') ? 'checked' : '' }}
                                class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 dark:focus:ring-purple-600}
                                 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="destacado" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Marcar como destacado
                                <span class="text-xs text-gray-500 dark:text-gray-400 block">(Aparecerá en secciones
                                    especiales)</span>
                            </label>
                        </div>

                        <div class="flex justify-center pt-4 border-t border-gray-200 dark:border-gray-700">
                            <button type="submit"
                                class="flex items-center px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg text-sm focus:outline-none
                                 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200">
                                <i class="far fa-floppy-disk mr-2"></i>
                                Guardar Categoría
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal para editar categoría -->
    <div id="editarCategoriaModal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 overflow-y-auto overflow-x-hidden">
        <div class="relative p-4 w-full max-w-2xl">
            <!-- Modal content -->
            <div
                class="relative bg-white rounded-lg shadow dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 dark:border-gray-700 rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        <i class="fas fa-folder-plus mr-2 text-blue-500"></i>
                        Editar Categoría
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto
                         inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white"
                        data-modal-hide="editarCategoriaModal">
                        <i class="fas fa-times"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form id="form-editar-categoria">
                        <input type="hidden" id="categoria-id" name="id">

                        <div class="mb-5">
                            <label for="nombre-editar"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Nombre <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nombre" id="nombre-editar" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                                 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 transition-all duration-200"
                                placeholder="Ej. Electrónicos">
                        </div>

                        <div class="mb-5">
                            <label for="descripcion-editar"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Descripción
                            </label>
                            <textarea name="descripcion" id="descripcion-editar" rows="3"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                                 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 transition-all duration-200"
                                placeholder="Ej. Productos electrónicos y dispositivos tecnológicos"></textarea>
                        </div>

                        <div class="flex items-center mb-5">
                            <input type="checkbox" name="destacado_editar" id="destacado_editar" value="1"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500
                                 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="destacado_editar"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Marcar como destacado
                                <span class="text-xs text-gray-500 dark:text-gray-400 block">(Aparecerá en secciones
                                    especiales)</span>
                            </label>
                        </div>

                        <div class="flex justify-center pt-4 border-t border-gray-200 dark:border-gray-700">
                            <button type="submit"
                                class="flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm
                                 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                                  transition-all duration-200">
                                <i class="far fa-floppy-disk mr-2"></i>
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Función para manejar todos los modales
                function setupModal(modalId, toggleSelector = null) {
                    const modal = document.getElementById(modalId);
                    if (!modal) return;

                    // Configurar botones de apertura
                    if (toggleSelector) {
                        document.querySelectorAll(toggleSelector).forEach(button => {
                            button.addEventListener('click', (e) => {
                                e.preventDefault();
                                // Resetear el modal primero
                                modal.style.display = 'none';
                                modal.classList.add('hidden');

                                // Mostrar correctamente
                                modal.style.display = 'flex';
                                modal.classList.remove('hidden');
                                document.body.style.overflow = 'hidden';
                            });
                        });
                    }

                    // Configurar botón de cierre (X)
                    const closeButton = modal.querySelector('[data-modal-hide]');
                    if (closeButton) {
                        closeButton.addEventListener('click', (e) => {
                            e.preventDefault();
                            modal.style.display = 'none';
                            modal.classList.add('hidden');
                            document.body.style.overflow = 'auto';
                        });
                    }

                    // Cerrar al hacer clic fuera del modal
                    modal.addEventListener('click', (e) => {
                        if (e.target === modal) {
                            e.preventDefault();
                            modal.style.display = 'none';
                            modal.classList.add('hidden');
                            document.body.style.overflow = 'auto';
                        }
                    });
                }

                // Inicializar cada modal
                setupModal('crearCategoriaModal', '[data-modal-toggle="crearCategoriaModal"]');
                setupModal('editarCategoriaModal', '[data-modal-toggle="editarCategoriaModal"]');
            });


            // RUTAS CONSTANTES
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // FUNCION CREAR CATEGORIA
            document.querySelector('#crearCategoriaModal form').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const jsonData = Object.fromEntries(formData.entries());
                console.log(jsonData);
                const storeUrl = '{{ route('categorias.store') }}';

                fetch(storeUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify(jsonData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    })
                    .finally(() => {});
            });

            
            document.querySelectorAll('[data-modal-toggle="editarCategoriaModal"]').forEach(button => {
                button.addEventListener('click', async function() {
                    const id = this.getAttribute('data-id');
                    const modal = document.getElementById('editarCategoriaModal');

                    try {
                        const response = await fetch(`/categorias/${id}`);
                        const data = await response.json();

                        if (data.success) {
                            document.getElementById('categoria-id').value = data.data.id;
                            document.getElementById('nombre-editar').value = data.data.caracteristica
                                ?.nombre || '';
                            document.getElementById('descripcion-editar').value = data.data.caracteristica
                                ?.descripcion || '';
                            document.getElementById('destacado_editar').checked = data.data.caracteristica
                                ?.destacado == 1;

                            // Mostrar el modal
                            modal.classList.remove('hidden');
                        } else {
                            alert("Error al cargar los datos de la categoría");
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                });
            });


            // FUNCION EDITAR CATEGORIA
            document.querySelector('#form-editar-categoria').addEventListener('submit', function(e) {
                e.preventDefault();

                const categoriaId = document.getElementById('categoria-id').value;
                const nombre = document.getElementById('nombre-editar').value;
                const descripcion = document.getElementById('descripcion-editar').value;
                const destacado = document.getElementById('destacado_editar').checked ? 1 : 0;

                const DataSend = {
                    nombre,
                    descripcion,
                    destacado
                };
                // console.log(DataSend);

                fetch(`/categorias/${categoriaId}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify(DataSend)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            console.log('error', data.message || 'Error al actualizar');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    })
            });
            
        </script>
    @endpush
</x-app-layout>
