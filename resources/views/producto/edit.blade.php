<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modificar medicamento') }}
        </h2>
    </x-slot>
    <div class="py-12 flex justify-center items-center bg-gray-900">
        <div class="max-w-full w-full mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                
                <form action="{{ route('modificar.medicamento', $producto->id) }}" method="POST" class="max-w-2xl mx-auto bg-gray-700 rounded-lg px-8 pt-6 pb-8 mb-4">
                    @csrf
    
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="nombre" class="block text-gray-300 text-sm font-bold mb-2">Nombre del medicamento:</label>
                        <input type="text" value="{{ $producto->nombre }}" name="nombre" id="nombre" class="form-input mt-1 w-full bg-gray-800 text-white">
                    </div>
    
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="descripcion" class="block text-gray-300 text-sm font-bold mb-2">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" class="form-input mt-1 w-full bg-gray-800 text-white">{{ $producto->descripcion }}
                        </textarea>
                    </div>
    
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="precio" class="block text-gray-300 text-sm font-bold mb-2">Precio:</label>
                        <input type="number" name="precio" value="{{ $producto->precio }}" id="precio" class="form-input mt-1 w-full bg-gray-800 text-white">
                    </div>
    
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="fecha_caducidad" class="block text-gray-300 text-sm font-bold mb-2">Fecha de caducidad:</label>
                        <input type="date" name="fecha_caducidad" value="{{ $producto->fecha_caducidad }}" id="fecha_caducidad" class="form-input mt-1 w-full bg-gray-800 text-white">
                    </div>
    
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="cantidad" class="block text-gray-300 text-sm font-bold mb-2">Cantidad del producto:</label>
                        <input type="number" name="cantidad" value="{{ $producto->cantidad }}" id="cantidad" class="form-input mt-1 w-full bg-gray-800 text-white">
                    </div>
    
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="unidad_medida" class="block text-gray-300 text-sm font-bold mb-2">Unidad de medida:</label>
                        <select name="unidad_medida" id="unidad_medida" class="form-select mt-1 w-full bg-gray-800 text-white">
                            <option value="ml">Mililitros</option>
                            <option value="caja">Caja</option>
                            <option value="l">Litros</option>
                            <option value="pieza">Piezas</option>
                        </select>
                    </div>

                    <input type="hidden" id="estado" name="estado" value="disponible">
    
                    <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">Modificar medicamento</button>
                </form>
            </div>
        </div>
    </div>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    
</x-app-layout>