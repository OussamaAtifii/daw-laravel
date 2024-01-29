<div>
    <x-button class="fas fa-add mr-2" wire:click="$set('openModal', true)">Nuevo</x-button>

    <x-dialog-modal wire:model='openModal'>
        <x-slot name="title">
            Crear post
        </x-slot>
        <x-slot name="content">

            <x-label for="titulo">Título</x-label>
            <x-input id="titulo" placeholder="Añada un titulo" class="w-full mb-4" wire:model="titulo" />
            <input-error for="titulo" />

            <x-label for="contenido">Contenido</x-label>
            <textarea id="titulo" placeholder="Añada un contenido" wire:model="contenido"
                class="w-full mb-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            </textarea>
            <input-error for="contenido" />


            <x-label for="categoria">Categoria</x-label>
            <select id="categoria" wire:model="category_id"
                class="w-full mb-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">Selecciona una categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                @endforeach
            </select>
            <input-error for="category_id" />


            <x-label for="estado">Estado</x-label>
            <div class="flex items-center mb-4">
                <input id="default-checkbox" type="checkbox" value="PUBLICADO" wire:model="estado"
                    class="w-4 h-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900">Publicado
                </label>
            </div>
            <input-error for="estado" />

            <x-label for="imagen2">Imagen</x-label>
            <div class="w-full h-72 rounded relative bg-gray-200">
                @if ($imagen)
                    <img src="{{ $imagen->temporaryUrl() }}" alt=""
                        class="bg-cover bg-center bg-no-repeat h-72">
                @endif
                <input type="file" accept="image/*" id="imagen2" hidden wire:model="imagen">
                <label for="imagen2"
                    class="absolute bottom-2 right-2 bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Upload<i class="fa-solid fa-cloud-arrow-up ml-2"></i></label>
            </div>
            <input-error for="imagen" />


        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button wire:click="store" type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-save"></i> GUARDAR
                </button>
                <button wire:click="cancelar"
                    class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-xmark"></i> CANCELAR</button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
