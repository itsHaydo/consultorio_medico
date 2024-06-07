<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bienvenido, ' . Auth::user()->name . '!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Message -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Bienvenido a nuestro sistema de consultoría médica. ¡Nos alegra verte!") }}
                </div>
            </div>

            <!-- Quick Access Buttons -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Accesos Rápidos</h3>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('cita') }}" class="block p-4 bg-indigo-500 text-white rounded-lg text-center shadow-md hover:bg-indigo-600">
                        Programar Nueva Cita
                    </a>
                    <a href="{{ route('paciente') }}" class="block p-4 bg-green-500 text-white rounded-lg text-center shadow-md hover:bg-green-600">
                        Ver Historial Médico
                    </a>
                    <a href="{{ route('pago') }}" class="block p-4 bg-red-500 text-white rounded-lg text-center shadow-md hover:bg-red-600">
                        Consultar Pagos Pendientes
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
