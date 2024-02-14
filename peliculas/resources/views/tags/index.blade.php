<x-app-layout>
    <x-propio.main>

        <div class="flex justify-end">
            <a href="{{ route('tags.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mb-2">Añadir
                etiqueta</a>
        </div>
        <div class="relative overflow-x-auto rounded">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Color
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de creación
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de modificación
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $tag->nombre }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap rounded"
                                style="background-color: {{ $tag->color }}">
                                {{ $tag->color }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $tag->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $tag->updated_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('tags.destroy', $tag) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route('tags.edit', $tag) }}">
                                        <i class="fa-solid fa-pen-clip mr-2"></i>
                                    </a>
                                    <button>
                                        <i class="fa-solid fa-delete-left"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </x-propio.main>
</x-app-layout>
