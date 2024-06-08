<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Expediente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Doctor Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Specialty
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Dr. John Doe
                            </th>
                            <td class="px-6 py-4">
                                Cardiology
                            </td>
                            <td class="px-6 py-4">
                                johndoe@example.com
                            </td>
                            <td class="px-6 py-4">
                                (555) 123-4567
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Dr. Jane Smith
                            </th>
                            <td class="px-6 py-4">
                                Neurology
                            </td>
                            <td class="px-6 py-4">
                                janesmith@example.com
                            </td>
                            <td class="px-6 py-4">
                                (555) 234-5678
                            </td>
                        </tr>
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Dr. Emily Johnson
                            </th>
                            <td class="px-6 py-4">
                                Pediatrics
                            </td>
                            <td class="px-6 py-4">
                                emilyjohnson@example.com
                            </td>
                            <td class="px-6 py-4">
                                (555) 345-6789
                            </td>
                        </tr>
                    </tbody>
                </table><br>
                <button onclick="window.location.href='doctores/registrar_doctores'" type="button" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Registrar pago</button>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</x-app-layout>
