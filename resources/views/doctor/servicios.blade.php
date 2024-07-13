<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Realizar servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
                <div class="p-6 rounded-lg shadow-lg">

                    @if (session('success'))
                        <div class="bg-green-600 border border-green-400 text-green-100 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('tratamiento', $item->id) }}" method="POST">
                        @csrf

                        <input type="hidden" id="paciente_id" name="paciente_id" value="{{ $item->paciente->id }}">
                        <input type="hidden" id="doctor_id" name="doctor_id" value="{{ $item->doctor->id }}">
                        <input type="hidden" id="cita_id" name="cita_id" value="{{ $item->id }}">

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="fecha-inicio" class="block text-sm font-medium text-white">Fecha de
                                    inicio</label>
                                <input type="date" id="fecha_inicio" name="fecha_inicio"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label for="fecha-fin" class="block text-sm font-medium text-white">Fecha de
                                    final</label>
                                <input type="date" id="fecha_fin" name="fecha_fin"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="relative z-0 w-full mb-5 group">
                                <label for="producto_id"
                                    class="block text-gray-300 text-sm font-bold mb-2">Producto:</label>
                                <select name="producto_id" id="producto_id"
                                    class="form-select block w-full mt-1 text-black">
                                    <option value="" class="text-black">Seleccione un medicamento</option>
                                    @foreach ($medicamentos as $producto)
                                        <option class="text-black" value="{{ $producto->id }}">Stock:
                                            {{ $producto->cantidad }} - {{ $producto->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="fecha-fin" class="block text-sm font-medium text-white">Cantidad: </label>
                                <input type="number" id="cantidad" name="cantidad"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label for="notas" class="block text-sm font-medium text-white">Notas de cita</label>
                            <textarea id="descripcion" name="descripcion" rows="6"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ $item->observaciones ? $item->observaciones : '' }}</textarea>
                        </div>

                        <br>
                        <div>
                            <button type="submit"
                                class="w-full px-1 py-2.5 font-medium text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Agregar servicio
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script>
            const today = new Date().toISOString().split("T")[0];

            const dateinicio = document.getElementById('fecha_inicio');
            const datefin = document.getElementById('fecha_fin');

            dateinicio.min = today;
            datefin.min = today;

            $(document).ready(function() {
                $('#producto_id').select2({
                    placeholder: "Seleccione un medicamento",
                    allowClear: true
                });
            });
        </script>

    </div>
</x-app-layout>
