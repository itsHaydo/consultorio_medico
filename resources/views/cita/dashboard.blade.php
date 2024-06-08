<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nombre Paciente</th>
                            <th scope="col" class="px-6 py-3">Nombre Doctor</th>
                            <th scope="col" class="px-6 py-3">Fecha</th>
                            <th scope="col" class="px-6 py-3">Hora</th>
                            <th scope="col" class="px-6 py-3">Motivo</th>
                            <th scope="col" class="px-6 py-3">Observaciones</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($citas as $cita)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $cita->paciente->nombre }} {{ $cita->paciente->apellido_p }} {{ $cita->paciente->apellido_m }}</td>
                                <td class="px-6 py-4">{{ $cita->doctor->name }}</td>
                                <td class="px-6 py-4">{{ $cita->fecha }}</td>
                                <td class="px-6 py-4">{{ $cita->hora }}</td>
                                <td class="px-6 py-4">{{ $cita->motivo }}</td>
                                <td class="px-6 py-4">{{ $cita->observaciones }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('cita.edit', $cita->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>                
                <br>
                <button onclick="window.location.href='cita/agendar'" type="button" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Agendar Cita</button>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</x-app-layout>
