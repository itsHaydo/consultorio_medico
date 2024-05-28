<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agendar Cita') }}
        </h2>
    </x-slot>
    <div class="py-12 flex justify-center items-center bg-gray-900">
        <div class="max-w-full w-full mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                @if ($errors->any())
                    <div class="bg-red-600 border border-red-400 text-red-100 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    
                @if(session('success'))
                    <div class="bg-green-600 border border-green-400 text-green-100 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
    
                <form action="{{ route('cita.store') }}" method="POST" class="max-w-2xl mx-auto bg-gray-700 rounded-lg px-8 pt-6 pb-8 mb-4">
                    @csrf
    
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="paciente_id" class="block text-gray-300 text-sm font-bold mb-2">Paciente:</label>
                        <select name="paciente_id" id="paciente_id" class="form-select block w-full mt-1 text-black">
                            <option value="" class="text-black">Seleccione un paciente</option>
                            @foreach($pacientes as $paciente)
                                <option class="text-black" value="{{ $paciente->id }}">
                                    {{ $paciente->nombre }} {{ $paciente->apellido_p }} {{ $paciente->apellido_m }} | {{ $paciente->correo }} | {{ $paciente->fecha_nacimiento }}
                                </option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="doctor_id" class="block text-gray-300 text-sm font-bold mb-2">Doctor:</label>
                        <select name="doctor_id" id="doctor_id" class="form-select block w-full mt-1 text-black">
                            <option value="" class="text-black">Seleccione un doctor</option>
                            @foreach($doctores as $doctor)
                                <option class="text-black" value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="fecha" class="block text-gray-300 text-sm font-bold mb-2">Fecha:</label>
                        <input type="date" name="fecha" id="fecha" class="form-input mt-1 bg-gray-800 text-white">
                    </div>
    
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="hora" class="block text-gray-300 text-sm font-bold mb-2">Hora:</label>
                        <input type="time" name="hora" id="hora" class="form-input mt-1 bg-gray-800 text-white" step="1800">
                    </div>
    
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="motivo" class="block text-gray-300 text-sm font-bold mb-2">Motivo (Opcional):</label>
                        <input type="text" name="motivo" id="motivo" class="form-input mt-1 bg-gray-800 text-white">
                    </div>
    
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="observaciones" class="block text-gray-300 text-sm font-bold mb-2">Observaciones (Opcional):</label>
                        <textarea name="observaciones" id="observaciones" class="form-textarea mt-1 bg-gray-800 text-white"></textarea>
                    </div>
    
                    <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">Agendar Cita</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const timeInput = document.getElementById('hora');
    
            timeInput.addEventListener('input', (e) => {
                const time = e.target.value;
                const [hours, minutes] = time.split(':');
    
                // Force minutes to be '00' or '30'
                if (minutes !== '00' && minutes !== '30') {
                    e.target.value = `${hours}:${minutes < 30 ? '00' : '30'}`;
                }
            });
    
            // Set initial value with minutes as '00' or '30'
            if (timeInput.value === '') {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = now.getMinutes() < 30 ? '00' : '30';
                timeInput.value = `${hours}:${minutes}`;
            }
        });
    </script>
    
</x-app-layout>