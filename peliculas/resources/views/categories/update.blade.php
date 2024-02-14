<x-app-layout>
    <x-propio.main>
        <form class="max-w-sm mx-auto" method="POST" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('put')
            <div class="mb-5">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre de la
                    categoria</label>
                <input type="text" id="nombre" name="nombre"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    placeholder="Terror" required value="{{ old('nombre', $category->nombre) }}">
                <x-input-error for="nombre"></x-input-error>
            </div>

            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Modificar</button>
        </form>

    </x-propio.main>
</x-app-layout>
