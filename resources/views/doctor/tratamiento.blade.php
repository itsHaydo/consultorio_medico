<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Expedientes') }}
        </h2>
    </x-slot>

    <style>
        .details {
            display: none;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                @if (session('success'))
                    <div class="bg-green-600 border border-green-400 text-green-100 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Doctor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Hora
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Motivo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Observaciones
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pagada
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for ($i=0; $i < count(json_decode($consulta, true)); $i++) {
                                $tratamiento = App\Models\Tratamiento::where('cita_id', $consulta[$i]->cita_id)->get();
                                $cita = App\Models\Cita::where('id', $consulta[$i]->cita_id)->get();
                        ?>

                        @foreach ($cita as $itemCita)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $itemCita->doctor->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $itemCita->fecha }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $itemCita->hora }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $itemCita->motivo }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $itemCita->observaciones }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $itemCita->pagada ? 'Si' : 'No' }}
                                </td>
                                <td class="px-6 py-4">
                                    <button onclick="mostrarDetalles('detalles_{{ $itemCita->id }}')"
                                        class="bg-blue-500 text-white px-4 py-2 rounded">
                                        Mostrar Detalles
                                    </button>
                                </td>
                            </tr>
                            <tr id="detalles_{{ $itemCita->id }}"
                                class="details bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colspan="3" class="px-4 py-2 border-b border-gray-300">
                                    @foreach ($tratamiento as $itemTratamiento)
                                        <h1>Fechas de consumo {{ $itemTratamiento->fecha_inicio }} a
                                            {{ $itemTratamiento->fecha_fin }}</h1>
                                        <h1>Instrucciones de consumo: {{ $itemTratamiento->descripcion }}</h1>
                                        <h1>Nombre del medicamento: {{ $itemTratamiento->medicamento->nombre }} </h1>
                                    @endforeach
                                </td>
                                <td colspan="6" class="px-4 py-2 border-b border-gray-300">
                                    <table class="w-full">
                                        <tr>
                                            <td>Talla</td>
                                            <td>Peso</td>
                                            <td>Temperatura</td>
                                            <td>Presion</td>
                                        </tr>
                                        <tr>
                                            <td>{{ $consulta[$i]->talla }} cm</td>
                                            <td>{{ $consulta[$i]->peso }} kg</td>
                                            <td>{{ $consulta[$i]->temperatura }}°</td>
                                            <td>{{ $consulta[$i]->presion }}</td>
                                        </tr>
                                    </table>
                                    <br>
                                    <h1>Notas de consulta: </h1>
                                    <textarea disabled class="w-full">{{ $consulta[$i]->notas }}</textarea>
                                </td>
                            </tr>
                        @endforeach
                        <?php
    }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmar(id) {
            Swal.fire({
                title: 'Confirmacion!',
                text: '¿Estas seguro de eliminar este tratamiento?',
                icon: 'warning',
                confirmButtonText: 'Aceptar',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('eliminar-tratamiento_id').submit()
                    //Swal.fire("Tratamiento eliminado!", "", "success");
                }
            });
        }

        function mostrarDetalles(id) {
            var detalles = document.getElementById(id);
            if (detalles.style.display === "none") {
                detalles.style.display = "table-row";
            } else {
                detalles.style.display = "none";
            }
        }

        document.querySelectorAll('.details').forEach(function(row) {
            row.style.display = 'none';
        });
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</x-app-layout>
