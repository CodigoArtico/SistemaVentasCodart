<x-app-layout>

    @section('title', 'Presentaciones')

    @push('css')
    @endpush

    <!-- Header Section -->
    <div class="px-6 py-2 border-b border-gray-100 dark:border-gray-700">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    <span class="inline-flex items-center">
                        <i class="fas fa-folder-open mr-3 text-purple-500"></i>
                        Gestión de Presentaciones
                    </span>
                </h2>
                <p class="mt-1 text-xs md:text-sm text-gray-500 dark:text-gray-400">
                    Administra y organiza tus presentaciones de productos
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
                        <span class="text-gray-500 dark:text-gray-400">Presentaciones</span>
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
                    {{-- Boton de Agregar Presentaciones --}}
                    <button
                        class="flex items-center justify-center p-3 bg-purple-600 hover:bg-purple-700 text-white rounded-full 
                        shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                        type="button" data-modal-target="crearPresentacionesModal"
                        data-modal-toggle="crearPresentacionesModal">
                        <i class="fas fa-plus"></i>
                    </button>

                </div>

                {{-- Tabla de Presentaciones --}}
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
                                    @foreach ($presentaciones as $presentacione)
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-1">
                                                <strong
                                                    class="text-gray-900 dark:text-gray-200">{{ $presentacione->caracteristica->nombre }}</strong>
                                            </td>
                                            <td class="px-4 py-1">
                                                <i class="fa-regular fa-comment-dots mr-2"></i>
                                                {{ $presentacione->caracteristica->descripcion }}
                                            </td>
                                            <td class="px-4 py-1">
                                                @if ($presentacione->caracteristica->estado == 1)
                                                    <i class="fa-solid fa-circle-check text-green-500"></i>
                                                @else
                                                    <i class="fa-solid fa-circle-xmark text-gray-400"></i>
                                                @endif

                                                @if ($presentacione->caracteristica->destacado == 1)
                                                    <i class="fa fa-star text-blue-400 ml-2"></i>
                                                @endif
                                            </td>
                                            <td class="px-4 py-1">
                                                <button
                                                    class="p-2 text-blue-400 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700"
                                                    type="button" data-modal-target="editarPresentacionModal"
                                                    data-modal-toggle="editarPresentacionModal"
                                                    data-id="{{ $presentacione->id }}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>

                                                @if ($presentacione->caracteristica->estado == 1)
                                                    <button
                                                        class="p-2 text-red-500 rounded-lg hover:bg-red-50 dark:hover:bg-gray-700"
                                                        onclick="abrirModalConfirmacion({{ $presentacione->id }}, 1)">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                @else
                                                    <button
                                                        class="p-2 text-yellow-500 rounded-lg hover:bg-yellow-50 dark:hover:bg-gray-700"
                                                        onclick="abrirModalConfirmacion({{ $presentacione->id }}, 0)">
                                                        <i class="fa-solid fa-arrow-rotate-right"></i>
                                                    </button>
                                                @endif
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

    <!-- Modal para crear presentacion -->
    <div id="crearPresentacionesModal" tabindex="-1" aria-hidden="true"
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
                        Crear Nueva Presentaciones
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto
                         inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white"
                        data-modal-hide="crearPresentacionesModal">
                        <i class="fas fa-times"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form action="{{ route('presentaciones.store') }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Nombre <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500
                                 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                  dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500 transition-all duration-200"
                                placeholder="Ej. UND">
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
                                placeholder="Ej. Productos descripcion de presentaciones">{{ old('descripcion') }}</textarea>
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
                                Guardar Presentacion
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar presentaciones -->
    <div id="editarPresentacionModal" tabindex="-1" aria-hidden="true"
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
                        Editar Presentaciones
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto
                         inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white"
                        data-modal-hide="editarPresentacionModal">
                        <i class="fas fa-times"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form id="form-editar-presentaciones">
                        <input type="hidden" id="presentacion-id" name="id">

                        <div class="mb-5">
                            <label for="nombre-editar"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Nombre <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nombre" id="nombre-editar" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                                 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                  dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 transition-all duration-200"
                                placeholder="Ej. Nike">
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
                                placeholder="Ej. Productos descripcion de presentacion"></textarea>
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

    <!-- Modal de confirmación -->
    <div id="confirmModal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 overflow-y-auto overflow-x-hidden">
        <div class="relative p-4 w-full max-w-md">
            <!-- Modal content -->
            <div
                class="relative bg-white rounded-lg shadow dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b dark:border-gray-700 rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        <i class="fas fa-exclamation-circle mr-2 text-yellow-500"></i>
                        Confirmación
                    </h3>
                    <button type="button" onclick="cerrarModal('confirmModal')"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto
                         inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white">
                        <i class="fas fa-times"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-gray-700 dark:text-gray-300" id="confirmModalBody">
                        <!-- Mensaje dinámico -->
                    </p>
                </div>

                <!-- Modal footer -->
                <div
                    class="flex items-center justify-end p-4 md:p-5 border-t dark:border-gray-700 rounded-b space-x-3">
                    <button type="button" onclick="cerrarModal('confirmModal')"
                        class="py-2 px-4 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-600
                         dark:text-gray-300 dark:hover:bg-gray-700 transition-all duration-200">
                        Cancelar
                    </button>
                    <button type="button" id="confirmarEliminacion" data-id="" data-estado=""
                        class="py-2 px-4 text-sm font-medium text-white rounded-lg transition-all duration-200">
                        <!-- Texto dinámico -->
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            //FUNCIOMES DE LOS MODALES - APERTURA Y CIERRE
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
                setupModal('crearPresentacionesModal', '[data-modal-toggle="crearPresentacionesModal"]');
                setupModal('editarPresentacionModal', '[data-modal-toggle="editarPresentacionModal"]');
            });

            // FUNCION CERRAR MODAL - TODOS
            function cerrarModal(modalId) {
                // Simular el click en el botón de cerrar
                const closeButton = document.querySelector(`#${modalId} [data-modal-hide]`);
                if (closeButton) {
                    closeButton.click();
                } else {
                    // Fallback si no encuentra el botón
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.classList.add('hidden');
                        modal.style.display = 'none';
                        document.body.style.overflow = 'auto';

                        // Disparar evento personalizado si es necesario
                        const event = new Event('modal-closed');
                        modal.dispatchEvent(event);
                    }
                }
            }

            // RUTAS CONSTANTES - CSRF TOKEN
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // FUNCION CREAR PRESENTACIONES
            document.querySelector('#crearPresentacionesModal form').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const jsonData = Object.fromEntries(formData.entries());
                console.log(jsonData);
                const storeUrl = '{{ route('presentaciones.store') }}';

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
                            cerrarModal('crearPresentacionesModal');
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

             // FUNCION LLENAR MODAL PRESENTACIONES
            document.querySelectorAll('[data-modal-toggle="editarPresentacionModal"]').forEach(button => {
                button.addEventListener('click', async function() {
                    const id = this.getAttribute('data-id');
                    const modal = document.getElementById('editarPresentacionModal');

                    try {
                        const response = await fetch(`/presentaciones/${id}`);
                        const data = await response.json();

                        if (data.success) {
                            document.getElementById('presentacion-id').value = data.data.id;
                            document.getElementById('nombre-editar').value = data.data.caracteristica
                                ?.nombre || '';
                            document.getElementById('descripcion-editar').value = data.data.caracteristica
                                ?.descripcion || '';
                            document.getElementById('destacado_editar').checked = data.data.caracteristica
                                ?.destacado == 1;

                            // Mostrar el modal
                            modal.classList.remove('hidden');
                        } else {
                            alert("Error al cargar los datos de la presentacion");
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                });
            });

             // FUNCION EDITAR PRESENTACIONES
            document.querySelector('#form-editar-presentaciones').addEventListener('submit', function(e) {
                e.preventDefault();

                const presentacionId = document.getElementById('presentacion-id').value;
                const nombre = document.getElementById('nombre-editar').value;
                const descripcion = document.getElementById('descripcion-editar').value;
                const destacado = document.getElementById('destacado_editar').checked ? 1 : 0;

                const DataSend = {
                    nombre,
                    descripcion,
                    destacado
                };
                // console.log(DataSend);

                fetch(`/presentaciones/${presentacionId}`, {
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
                            cerrarModal('editarPresentacionModal');
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

             // FUNCION MODAL DE CONFIRMACIÓN - ELIMINAR/RESTABLECER PRESENTACIONES
            async function abrirModalConfirmacion(presentacionId, estado) {
                const modal = document.getElementById('confirmModal');
                const confirmBtn = document.getElementById('confirmarEliminacion');

                // Resetear el modal primero
                modal.classList.add('hidden');
                modal.style.display = 'none';

                try {
                    const response = await fetch(`/presentaciones/${presentacionId}`);
                    const presentacion = await response.json();

                    const config = {
                        1: {
                            mensaje: `¿Seguro que quieres eliminar la presentacion <span class="font-bold">"${presentacion.data.caracteristica.nombre}"</span>?`,
                            textoBoton: 'Eliminar',
                            colorBoton: 'bg-red-600 hover:bg-red-700'
                        },
                        0: {
                            mensaje: `¿Seguro que quieres restaurar la presentacion <span class="font-bold">"${presentacion.data.caracteristica.nombre}"</span>?`,
                            textoBoton: 'Restaurar',
                            colorBoton: 'bg-yellow-500 hover:bg-yellow-600'
                        }
                    };

                    document.getElementById('confirmModalBody').innerHTML = config[estado].mensaje;
                    confirmBtn.textContent = config[estado].textoBoton;
                    confirmBtn.className =
                        `py-2 px-4 text-sm font-medium text-white rounded-lg transition-all duration-200 ${config[estado].colorBoton}`;
                    confirmBtn.setAttribute('data-id', presentacionId);
                    confirmBtn.setAttribute('data-estado', estado);

                    // Mostrar el modal correctamente
                    modal.style.display = 'flex';
                    modal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';

                } catch (error) {
                    console.error('Error al obtener marca:', error);
                }
            }

            // MANEJO DE ELIMINACIÓN/RESTAURACIÓN
            document.getElementById('confirmarEliminacion').addEventListener('click', async function() {
                const presentacionId = this.getAttribute('data-id');
                const url = `/presentaciones/${presentacionId}`;

                try {
                    const response = await fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });

                    const data = await response.json();

                    if (!response.ok) throw new Error(data.message || 'Error en la operación');

                    // Cerrar modal y mostrar feedback
                    cerrarModal('confirmModal');
                    alert(data.message || 'Operación exitosa');
                    setTimeout(() => location.reload(), 1500);
                } catch (error) {
                    console.error('Error:', error);
                } finally {}
            });
        </script>
    @endpush
</x-app-layout>
