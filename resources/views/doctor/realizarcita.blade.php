<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Realizar Cita') }}
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
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">
                <div class="p-6 rounded-lg shadow-lg">
                    <form action="{{ route('guardar.consulta', $consulta->id) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-white">Nombre</label>
                                <label type="text"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    {{ $consulta->paciente->nombre }} {{ $consulta->paciente->apellido_p }}
                                    {{ $consulta->paciente->apellido_m }}
                                </label>
                                <input type="hidden" id="paciente_id" name="paciente_id"
                                    value="{{ $consulta->paciente_id }}">
                            </div>
                            <div>
                                <label for="fecha-hora" class="block text-sm font-medium text-white">Fecha y
                                    hora</label>
                                <label type="text" id="fecha-hora"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    {{ $consulta->fecha }} | {{ $consulta->hora }}
                                </label>
                                <input type="hidden" id="fecha" name="fecha" value="{{ $consulta->fecha }}">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="cuenta-pagada" class="block text-sm font-medium text-white">
                                    Cuenta pagada
                                </label>
                                <label type="text" id="cuenta-pagada"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    {{ $consulta->pagada ? 'Si' : 'No' }}
                                </label>
                            </div>
                            <div>
                                <label for="tratamiento"
                                    class="block text-sm font-medium text-white">Tratamiento</label>
                                <a href="{{ route('doctor.servicios', $consulta->id) }}" id="btn-tratamiento"
                                    class="text-center block w-full mt-1 py-2.5 font-medium text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Agregar tratamiento
                                </a>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="motivos" class="block text-sm font-medium text-white">Motivos</label>
                            <input type="text" value="{{ $consulta->motivo }}"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <!-- Consulta -->

                        <div class="mb-4">
                            <label for="talla" class="block text-sm font-medium text-white">Talla:</label>
                            <input type="number" id="talla" name="talla"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div class="mb-4">
                            <label for="peso" class="block text-sm font-medium text-white">Peso:</label>
                            <input type="number" id="peso" name="peso"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div class="mb-4">
                            <label for="temperatura" class="block text-sm font-medium text-white">Temperatura en grados
                                C°:</label>
                            <input type="number" id="temperatura" name="temperatura"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div class="mb-4">
                            <label for="presion" class="block text-sm font-medium text-white">Presion:</label>
                            <input type="number" id="presion" name="presion"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <div>
                            <label for="notas" class="block text-sm font-medium text-white">Notas de cita</label>
                            <textarea id="notas" name="notas" rows="6"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ $consulta->observaciones ? $consulta->observaciones : '' }}</textarea>
                        </div>
                    
                    <br>
                    @if ($consulta->pagada)
                        <div>
                        @else
                            <div class="grid grid-cols-2 gap-4 mb-4">
                    @endif

                    <input
                        type="submit"
                        value="Terminar cita"
                        class="w-full px-1 py-2.5 font-medium text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    </form>    

                    @if (!$consulta->pagada)
                        <button
                            class="w-full px-1 py-2.5 font-medium text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Pagar cita
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
