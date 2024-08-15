<!-- resources/views/citas_paciente.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Citas Pendientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Fecha</th>
                            <th scope="col" class="px-6 py-3">Hora</th>
                            <th scope="col" class="px-6 py-3">Doctor</th>
                            <th scope="col" class="px-6 py-3">Motivo</th>
                            <th scope="col" class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($citas as $cita)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $cita->fecha }}</td>
                                <td class="px-6 py-4">{{ $cita->hora }}</td>
                                <td class="px-6 py-4">{{ $cita->doctor->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $cita->motivo }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('cita_detalles', ['id' => $cita->id]) }}"
                                       class="text-blue-600 hover:text-blue-900 dark:text-blue-400">Ver Detalles</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">No tienes citas pendientes.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
