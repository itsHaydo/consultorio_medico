<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Pago') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-100 border-b border-gray-200">
                    <form action="{{ route('pago.update', $pago->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="estado" class="block text-gray-700 text-sm font-bold mb-2">Estado:</label>
                            <select name="estado" id="estado" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-200">
                                <option value="Pendiente" {{ $pago->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="Pagado" {{ $pago->estado == 'Pagado' ? 'selected' : '' }}>Pagado</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="metodo_pago" class="block text-gray-700 text-sm font-bold mb-2">Método de Pago:</label>
                            <select name="metodo_pago" id="metodo_pago" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-200">
                                <option value="Tarjeta" {{ $pago->metodo_pago == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                                <option value="Efectivo" {{ $pago->metodo_pago == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Actualizar Pago
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
