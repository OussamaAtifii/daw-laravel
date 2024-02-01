<x-app-layout>
    <x-propios.principal>
        <div class="w-3/4 mx-auto p-6 rounded-xl shadow-xl bg-gray-200">
            <form method="POST" action="{{ route('contacto.send') }}">
                @csrf
                <div class="mb-5">
                    <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                    <input type="text" id="nombre" value="{{ old('nombre') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Añada un nombre" name="nombre">
                    <x-input-error for="nombre" class="italic mt-1" />
                </div>
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">email</label>
                    @auth
                        <input type="text" id="email" value="{{ auth()->user()->email }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Añada un email" name="email" readonly>
                    @else
                        <input type="text" id="email" value="{{ old('email') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Añada un email" name="email">
                    @endauth
                    <x-input-error for="email" class="italic mt-1" />
                </div>
                <div class="mb-5">
                    <label for="contenido" class="block mb-2 text-sm font-medium text-gray-900">contenido</label>
                    <textarea id="contenido" placeholder="Añada una contenido"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
                        name="contenido">{{ old('contenido') }}
                    </textarea>
                    <x-input-error for="contenido" class="italic mt-1" />
                </div>
                <div class="flex flex-row-reverse">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fa-solid fa-paper-plane"></i> Enviar
                    </button>
                    <button type="reset"
                        class="mx-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-paintbrush"></i> LIMPIAR
                    </button>
                    <a href="{{ route('home') }}"
                        class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-xmark"></i> CANCELAR</a>
                </div>
            </form>
        </div>
    </x-propios.principal>
</x-app-layout>
