<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Medicamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-600 border border-green-400 text-green-100 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nombre</th>
                            <th scope="col" class="px-6 py-3">Descripción</th>
                            <th scope="col" class="px-6 py-3">Precio</th>
                            <th scope="col" class="px-6 py-3">Fecha de caducidad</th>
                            <th scope="col" class="px-6 py-3">Cantidad</th>
                            <th scope="col" class="px-6 py-3">Medida</th>
                            <th scope="col" class="px-6 py-3">Estado</th>
                            <th scope="col" class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $item->nombre }}</td>
                                <td class="px-6 py-4">{{ $item->descripcion }}</td>
                                <td class="px-6 py-4">{{ $item->precio }}</td>
                                <td class="px-6 py-4">{{ $item->fecha_caducidad }}</td>
                                <td class="px-6 py-4">{{ $item->cantidad }}</td>
                                <td class="px-6 py-4">{{ $item->medida }}</td>
                                <td class="px-6 py-4">{{ $item->estado }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('editar.medicamento', $item->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400">Editar</a>
                                    <form id="eliminar-producto_{{ $item->id }}" action="{{ route('destroy.medicamento', $item->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="button" onclick="confirmar({{ $item->id }}, '{{ $item->nombre }}')"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <button onclick="window.location.href='{{ route('agregar_medicamento') }}'" type="button"
                    class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Agregar
                    medicamento</button>
            </div>
        </div>
    </div>

    <script>
        function confirmar(id, medica) {
            Swal.fire({
                title: 'Confirmacion!',
                text: '¿Estas seguro de eliminar el medicamento ['+medica+']?',
                icon: 'warning',
                confirmButtonText: 'Aceptar',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('eliminar-producto_'+id).submit()
                    //Swal.fire("Tratamiento eliminado!", "", "success");
                }
            });
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</x-app-layout>
