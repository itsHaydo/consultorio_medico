<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Consultas Pacientes') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Historial de Consultas</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Doctor</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consultas as $consulta)
                    <tr>
                        <td>{{ $consulta->fecha }}</td>
                        <td>{{ $consulta->doctor->name ?? 'N/A' }}</td>
                        <td>{{ $consulta->hora }}</td>
                        <td>
                            <a href="{{ route('consulta.detalles', ['id' => $consulta->id]) }}">Ver Detalles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</x-app-layout>