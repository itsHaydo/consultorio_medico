<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Expediente') }} de John Doe
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Doctor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha Inicio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha Fin
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Descripción
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                John Doe
                            </th>
                            <td class="px-6 py-4">
                                15/06/2024
                            </td>
                            <td class="px-6 py-4">
                                19/06/2024
                            </td>
                            <td class="px-6 py-4">
                                Perdida de memoria
                            </td>
                            <td class="px-6 py-4">
                                <a href="#"
                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400">Eliminar</a>
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                John Doe
                            </th>
                            <td class="px-6 py-4">
                                25/06/2024
                            </td>
                            <td class="px-6 py-4">
                                28/06/2024
                            </td>
                            <td class="px-6 py-4">
                                
                            </td>
                            <td class="px-6 py-4">
                                <a href="#"
                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400">Eliminar</a>
                            </td>
                        </tr>
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                John Doe
                            </th>
                            <td class="px-6 py-4">
                                15/07/2024
                            </td>
                            <td class="px-6 py-4">
                                19/07/2024
                            </td>
                            <td class="px-6 py-4">
                                Dolores
                            </td>
                            <td class="px-6 py-4">
                                <a href="#"
                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400">Eliminar</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</x-app-layout>
