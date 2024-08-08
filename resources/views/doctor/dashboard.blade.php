<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Message -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Bienvenido doctor a nuestro sistema de consultoría médica. ¡Nos alegra verte!') }}
                </div>
            </div>

            <div style="display: none">
                <form id="citaForm" action="{{ route('cita.store') }}" method="POST" style="display: none;">
                    @csrf

                    <div class="relative z-0 w-full mb-5 group">
                        <label for="paciente_id" class="block text-gray-800 text-sm font-bold mb-2">Paciente:</label>
                        <select name="paciente_id" id="paciente_id" class="form-select block w-full mt-1 text-black">
                            <option value="" class="text-black">Seleccione un paciente</option>
                            @foreach ($pacientes as $paciente)
                                <option class="text-black" value="{{ $paciente->id }}">
                                    {{ $paciente->nombre }} {{ $paciente->apellido_p }} {{ $paciente->apellido_m }} |
                                    {{ $paciente->correo }} | {{ $paciente->fecha_nacimiento }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <label for="doctor_id" class="block text-gray-800 text-sm font-bold mb-2">Doctor:</label>
                        <select name="doctor_id" id="doctor_id" class="form-select block w-full mt-1 text-black">
                            <option value="" class="text-black">Seleccione un doctor</option>
                            @foreach ($doctores as $doctor)
                                <option class="text-black" value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <label for="fecha" class="block text-gray-800 text-sm font-bold mb-2">Fecha:</label>
                        <p id="value-fecha"></p>
                        <input type="date" name="fecha" id="fecha"
                            class="form-input mt-1 w-full bg-gray-300 text-black">
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <label for="hora" class="block text-gray-800 text-sm font-bold mb-2">Hora:</label>
                        <input type="time" name="hora" id="hora"
                            class="form-input mt-1 w-full bg-gray-300 text-black" step="1800">
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <label for="motivo"
                            class="block text-gray-800 text-sm font-bold mb-2">Motivo(Opcional):</label>
                        <input type="text" name="motivo" id="motivo"
                            class="form-input mt-1 w-full bg-gray-300 text-black">
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <label for="observaciones" class="block text-gray-800 text-sm font-bold mb-2">Observaciones
                            (Opcional):</label>
                        <textarea name="observaciones" id="observaciones" class="form-textarea mt-1 w-full bg-gray-300 text-black"></textarea>
                    </div>

                    <button type="submit"
                        class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">Agendar
                        Cita</button>
                </form>
            </div>

            

            <div id="calendar" style="color: aliceblue"></div>

        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
        <script src='fullcalendar/core/locales/es.global.js'></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const calendarEl = document.getElementById('calendar');
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'es',
                    initialView: 'dayGridMonth',
                    events: [
                        @foreach ($consultas as $consulta)
                            {
                                title: '{{ $consulta->paciente->nombre }} {{ $consulta->paciente->apellido_p }} {{ $consulta->paciente->apellido_m }}',
                                start: '{{ $consulta->fecha }}T{{ $consulta->hora }}',
                                url: '{{ route('doctor.realizarcita', $consulta->id) }}'
                            },
                        @endforeach
                    ],
                    navLinks: true,
                    navLinkDayClick: function(date, jsEvent) { // Agregar una cita
                        //console.log('day', date.toISOString());
                        //console.log('coords', jsEvent.pageX, jsEvent.pageY);

                        const fechas = document.getElementById('fecha');
                        const dates = date.toISOString().split('T')[0].split('-');
                        fechas.value = `${dates[2]}-${dates[1]}-${dates[0]}`; // Formato DD-MM-YYYY
                        document.getElementById('value-fecha').innerText = `${dates[2]}-${dates[1]}-${dates[0]}`;
                        console.log(`${dates[2]}-${dates[1]}-${dates[0]}`);

                        Swal.fire({
                            title: 'Agendar Cita',
                            html: document.getElementById('citaForm').innerHTML,
                            showCancelButton: true,
                            showConfirmButton: false,
                            cancelButtonText: 'Cancelar',
                            focusConfirm: false,    
                            preConfirm: () => {
                                // Aquí puedes validar el formulario antes de enviarlo
                                const paciente_id = Swal.getPopup().querySelector(
                                    '#paciente_id').value;
                                const doctor_id = Swal.getPopup().querySelector('#doctor_id')
                                    .value;
                                const fecha = fechas.value;
                                const hora = Swal.getPopup().querySelector('#hora').value;

                                // TODO
                                //  Hacer que tome la fecha seleccionada

                                if (!paciente_id || !doctor_id || !fecha || !hora) {
                                    Swal.showValidationMessage(
                                        'Por favor, completa todos los campos obligatorios');
                                    return false;
                                }

                                // Crear un formulario temporal para enviar los datos
                                const form = document.createElement('form');
                                form.action = "{{ route('cita.store') }}";
                                form.method = 'POST';
                                form.innerHTML = `
                                    @csrf
                                    <input type="hidden" name="paciente_id" value="${paciente_id}">
                                    <input type="hidden" name="doctor_id" value="${doctor_id}">
                                    <input type="hidden" name="fecha" value="${fecha}">
                                    <input type="hidden" name="hora" value="${hora}">
                                    <input type="hidden" name="motivo" value="${Swal.getPopup().querySelector('#motivo').value}">
                                    <input type="hidden" name="observaciones" value="${Swal.getPopup().querySelector('#observaciones').value}">
                                `;
                                document.body.appendChild(form);
                                form.submit();
                            }
                        });

                    },
                    /*eventClick: function(info) { // Relizar la cita
                        info.jsEvent.preventDefault();

                        

                    }*/
                });
                calendar.render();
            });
        </script>
    @endpush

</x-app-layout>
