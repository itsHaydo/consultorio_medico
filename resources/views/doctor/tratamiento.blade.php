<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Expedientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                @if (session('success'))
                    <div class="bg-green-600 border border-green-400 text-green-100 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Doctor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha Inicio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha Fin
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Descripción
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consulta as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->doctor->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->fecha_inicio }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->fecha_fin }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->descripcion }}
                                </td>
                                <td class="px-6 py-4">
                                    <form id="eliminar-tratamiento"
                                        action="{{ route('destroy.tratamiento', $item->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="button" onclick="confirmar()"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmar() {
            Swal.fire({
                title: 'Confirmacion!',
                text: '¿Estas seguro de eliminar este tratamiento?',
                icon: 'warning',
                confirmButtonText: 'Aceptar',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('eliminar-tratamiento').submit()
                    //Swal.fire("Tratamiento eliminado!", "", "success");
                }
            });
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</x-app-layout>
