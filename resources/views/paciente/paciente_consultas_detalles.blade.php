<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles de la Consulta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Consulta del {{ $consulta->fecha }}</h3>

                    <!-- Mostrar los detalles de la consulta -->
                    <p class="text-gray-900 dark:text-white"><strong>Doctor:</strong> {{ $consulta->doctor->name ?? 'N/A' }}</p>
                    <p class="text-gray-900 dark:text-white"><strong>Talla:</strong> {{ $consulta->talla }} cm</p>
                    <p class="text-gray-900 dark:text-white"><strong>Peso:</strong> {{ $consulta->peso }} kg</p>
                    <p class="text-gray-900 dark:text-white"><strong>Temperatura:</strong> {{ $consulta->temperatura }} °C</p>
                    <p class="text-gray-900 dark:text-white"><strong>Presión:</strong> {{ $consulta->presion }} mmHg</p>
                    <p class="text-gray-900 dark:text-white"><strong>Notas:</strong> {{ $consulta->notas ?? 'Sin notas adicionales' }}</p>

                    <!-- Verificar si hay tratamientos asociados a la consulta -->
                    @if($tratamientos->isEmpty())
                        <p class="text-gray-900 dark:text-white">No se realizaron tratamientos durante esta consulta.</p>
                    @else
                        <h4 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Tratamientos Realizados:</h4>
                        <ul class="list-disc list-inside text-gray-900 dark:text-white">
                            @foreach($tratamientos as $tratamiento)
                                <li>{{ $tratamiento->descripcion }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- Botón de regresar -->
                    <div class="mt-6">
                        <a href="{{ url()->previous() }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Regresar
                        </a>
                    </div>

                    <!-- Botón para descargar PDF -->
<div class="mt-6">
    <a href="{{ route('paciente_consultas_detalles_pdf', ['id' => $consulta->id]) }}" 
       class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
        Descargar PDF
    </a>
</div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
