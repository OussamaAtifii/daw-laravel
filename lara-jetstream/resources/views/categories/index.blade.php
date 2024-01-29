<x-app-layout>
    <x-propios.principal>
        <div class="my-2 flex flex-row-reverse">
            <a href="{{ route('categories.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-add"></i>NUEVO
            </a>
        </div>
        <div class="relative overflow-x-auto rounded-xl">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            NOMBRE
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Descripcion
                        </th>
                        <th scope="col" class="px-6 py-3">
                            ACCIONES
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="bg-white border-b hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $category->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $category->nombre }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $category->descripcion }}
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="_method" value="delete">
                                    <a href="{{ route('categories.edit', $category) }}" class="mr-2">
                                        <i class="fas fa-edit text-green-400 hover:text-2xl"></i>
                                    </a>
                                    <button type="submit">
                                        <i class="fas fa-trash text-red-400 hover:text-2xl"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{ $categories->links() }}
        </div>
    </x-propios.principal>
</x-app-layout>
