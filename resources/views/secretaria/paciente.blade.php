<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pacientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nombre Paciente</th>
                            <th scope="col" class="px-6 py-3">Correo</th>
                            <th scope="col" class="px-6 py-3">Teléfono</th>
                            <th scope="col" class="px-6 py-3">Fecha Nacimiento</th>
                            <th scope="col" class="px-6 py-3">Género Biológico</th>
                            <th scope="col" class="px-6 py-3">Edad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pacientes as $paciente)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $paciente->nombre }} {{ $paciente->apellido_p }} {{ $paciente->apellido_m }}
                                </th>
                                <td class="px-6 py-4">{{ $paciente->correo }}</td>
                                <td class="px-6 py-4">{{ $paciente->telefono }}</td>
                                <td class="px-6 py-4">{{ $paciente->fecha_nacimiento }}</td>
                                <td class="px-6 py-4">{{ $paciente->genero_biologico }}</td>
                                <td class="px-6 py-4">{{ $paciente->age }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table><br>
                <button onclick="window.location.href='pacientes/agendar_cita'" type="button" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Agendar Cita</button>
                <button onclick="window.location.href='pacientes/registrar_pacientes'" type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Registrar Nuevo Paciente</button>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</x-app-layout>
