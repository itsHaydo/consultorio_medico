<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Consultas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Paciente
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha - Hora
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Motivos
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consultas as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->paciente->nombre }} {{ $item->paciente->apellido_p }}
                                    {{ $item->paciente->apellido_m }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->fecha }} - {{ $item->hora }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->motivo }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('doctor.realizarcita', $item->id) }}"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400">Realizar cita</a> |
                                    <button onclick="editDate('{{ $item->id }}');"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400">Editar
                                        cita</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table><br>
                <button onclick="window.location.href='cita/agendar'" type="button"
                    class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    Agendar cita
                </button>
            </div>
        </div>
    </div>

    <script>

        function editDate(id) {
            var link = "/consulta/"+id+"/edit";
            
            Swal.fire({
            title: 'Enter Date and Time',
            html: `
                <form id="modalForm" action='`+ link +`' method='POST' >
                    @csrf
                    <label for="dateInput">Date:</label>
                    <input type="date" id="fecha" name="fecha"><br><br>

                    <label for="timeInput">Time:</label>
                    <input type="time" id="hora" name="hora">
                    <input type="submit" value="Actualizar">
                </form>
            `,
            showCancelButton: true,
            preConfirm: () => {
                const date = Swal.getPopup().querySelector('#fecha').value;
                const time = Swal.getPopup().querySelector('#hora').value;
                if (!date || !time) {
                    Swal.showValidationMessage(`Please enter both date and time`);
                }
                return { date: date, time: time }
            }
        });

        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</x-app-layout>
