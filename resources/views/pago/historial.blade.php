<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Historial de Pagos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Paciente</th>
                            <th scope="col" class="px-6 py-3">Fecha y Hora de Consulta</th>
                            <th scope="col" class="px-6 py-3">Tipo de Pago</th>
                            <th scope="col" class="px-6 py-3">Monto</th>
                            <th scope="col" class="px-6 py-3">Fecha de Pago</th>
                            <th scope="col" class="px-6 py-3">Método de Pago</th>
                            <th scope="col" class="px-6 py-3">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagos as $pago)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $pago->cita->paciente->nombre }} {{ $pago->cita->paciente->apellido_p }} {{ $pago->cita->paciente->apellido_m }}</td>
                                <td class="px-6 py-4">{{ $pago->cita->fecha }} | {{ $pago->cita->hora}}</td>
                                <td class="px-6 py-4">{{ $pago->tipo_pago }}</td>
                                <td class="px-6 py-4">{{ $pago->monto }}</td>
                                <td class="px-6 py-4">{{ $pago->fecha_pago }}</td>
                                <td class="px-6 py-4">{{ $pago->metodo_pago }}</td>
                                <td class="px-6 py-4">{{ $pago->estado }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>                
                <br>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</x-app-layout>
