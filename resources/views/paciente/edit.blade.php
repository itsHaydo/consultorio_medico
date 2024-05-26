<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pagos') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Editar Paciente</h2>
    
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{ route('paciente.update', $paciente->id) }}" method="POST">
            @csrf
            @method('PUT')
    
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="{{ $paciente->nombre }}" class="w-full p-2 border border-gray-300 rounded">
            </div>
    
            <div class="mb-4">
                <label for="apellido_p" class="block text-gray-700">Apellido Paterno:</label>
                <input type="text" name="apellido_p" id="apellido_p" value="{{ $paciente->apellido_p }}" class="w-full p-2 border border-gray-300 rounded">
            </div>
    
            <div class="mb-4">
                <label for="apellido_m" class="block text-gray-700">Apellido Materno:</label>
                <input type="text" name="apellido_m" id="apellido_m" value="{{ $paciente->apellido_m }}" class="w-full p-2 border border-gray-300 rounded">
            </div>
    
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700">Edad:</label>
                <input type="text" name="nombre" id="nombre" value="{{ $paciente->age }}" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label for="correo" class="block text-gray-700">Correo:</label>
                <input type="email" name="correo" id="correo" value="{{ $paciente->correo }}" class="w-full p-2 border border-gray-300 rounded">
            </div>
    
            <div class="mb-4">
                <label for="telefono" class="block text-gray-700">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" value="{{ $paciente->telefono }}" class="w-full p-2 border border-gray-300 rounded">
            </div>
    
            <div class="mb-4">
                <label for="fecha_nacimiento" class="block text-gray-700">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ $paciente->fecha_nacimiento }}" class="w-full p-2 border border-gray-300 rounded">
            </div>
    
            <div class="mb-4">
                <label for="genero_biologico" class="block text-gray-700">Género:</label>
                <input type="text" name="genero_biologico" id="genero_biologico" value="{{ $paciente->genero_biologico }}" class="w-full p-2 border border-gray-300 rounded">
            </div>
    
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>

    
</x-app-layout>