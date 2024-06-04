<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pagos') }}
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
                            <th scope="col" class="px-6 py-3">Estado</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagos as $pago)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $pago->cita->paciente->nombre }} {{ $pago->cita->paciente->apellido_p }} {{ $pago->cita->paciente->apellido_m }}</td>
                                <td class="px-6 py-4">{{ $pago->cita->fecha }} | {{ $pago->cita->hora}}</td>
                                <td class="px-6 py-4">{{ $pago->tipo_pago }}</td>
                                <td class="px-6 py-4">{{ $pago->monto }}</td>
                                <td class="px-6 py-4">{{ $pago->estado }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('pago.edit', $pago->id) }}" class="text-red-600 hover:text-red-900">Pagar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>                
                <br>
            </div>
            <button type="button" onclick="window.location.href='pagos/historial'" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Historial de Pagos</button>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</x-app-layout>
