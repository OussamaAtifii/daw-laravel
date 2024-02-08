<x-propio.main>
    <div class="flex w-full mb-1">
        <div class="flex-1 relative">
            <x-input type="text" placeholder="Buscar" class="w-3/4" wire:model.live="buscar"></x-input>
        </div>
        <div>
            @livewire('crear-film')
        </div>
    </div>
    @if (count($films))
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Info
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Caratula
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('titulo')">
                        <i class="fas fa-sort mr-1"></i> Titulo
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('nombre')">
                        <i class="fas fa-sort mr-1"></i> Categoria
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('disponible')">
                        <i class="fas fa-sort mr-1"></i> Disponible
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Opciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($films as $film)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <button>
                                <i class="fas fa-info text-xl text-blue-500"></i>
                            </button>
                        </td>
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-20 h-14 rounded" src="{{ Storage::url($film->caratula) }}" alt="Jese image">
                        </th>
                        <td class="px-6 py-4">
                            {{ $film->titulo }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $film->nombre }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div @class([
                                    'h-2.5 w-2.5 rounded-full me-2',
                                    'bg-green-500' => $film->disponible == 'si',
                                    'bg-red-500' => $film->disponible == 'no',
                                ])></div> {{ $film->disponible }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit
                                user</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-2">
            {{ $films->links() }}
        </div>
    @else
        <div class="text-center mt-4">
            <h1 class="text-2xl font-bold text-gray-700">No hay resultados para la busqueda "{{ $buscar }}"</h1>
        </div>
    @endif

</x-propio.main>
