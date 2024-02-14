<x-app-layout>
    <x-propio.main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form class="max-w-sm mx-auto" method="POST" action="{{ route('tags.update', $tag) }}">
                    @csrf
                    @method('put')
                    <div class="mb-5">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre de la
                            etiqueta</label>
                        <input type="text" id="nombre" name="nombre"
                            value="{{ old('nombre', substr($tag->nombre, 1)) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Infantil" required>
                        <x-input-error for="nombre"></x-input-error>
                    </div>
                    <div class="mb-5">
                        <label for="color" class="block mb-2 text-sm font-medium text-gray-900">
                            Color de la etiqueta
                        </label>
                        <input type="color" id="color" name="color" value="{{ old('color', $tag->color) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Terror" required>
                        <x-input-error for="color"></x-input-error>
                    </div>
                    <button
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Crear</button>
                </form>
            </div>
        </div>
    </x-propio.main>
</x-app-layout>
