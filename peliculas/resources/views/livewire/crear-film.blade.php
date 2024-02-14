<div>
    <x-button wire:click="$set('modalCrear', true)"><i class="fas fa-add ml-2"></i> Añadir peli</x-button>
    <x-dialog-modal maxWidth="4xl" wire:model="modalCrear">
        <x-slot name="title">
            Crear pelicula
        </x-slot>

        <x-slot name="content">
            <x-label for="titulo">Titulo</x-label>
            <x-input placeholder="Añada su titulo" class="w-full mb-2" id="titulo" name="titulo"
                wire:model="titulo"></x-input>
            <x-input-error for="titulo" />

            <x-label for="sinopsis">Sinopsis</x-label>
            <textarea name="sinopsis" id="sinopsis" wire:model="sinopsis"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mb-2" rows=5"></textarea>
            <x-input-error for="sinopsis" />

            <x-label for="category_id">Categoria</x-label>
            <select name="category_id" id="category_id" class="mb-2 w-full rounded" wire:model="category_id">
                <option value="">Seleccione una categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                @endforeach
            </select>
            <x-input-error for="category_id" />

            <x-label for="disponible">Disponible</x-label>
            <input id="default-checkbox" type="checkbox" value="si"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 mb-2"
                id="disponible" name="disponible" value="si" wire:model="disponible">
            <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900">Si</label>
            <x-input-error for="disponible" />


            <x-label for="tags_id">Etiquetas</x-label>
            <div class="flex">
                @foreach ($tags as $tag)
                    <div class="flex items-center me-4">
                        <input id="{{ $tag->nombre }}" type="checkbox" value="{{ $tag->id }}" wire:model="tags_id"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label for="{{ $tag->nombre }}" class="ms-2 text-sm font-medium text-gray-900 p-1 rounded"
                            style="background-color: {{ $tag->color }}">{{ $tag->nombre }}</label>
                    </div>
                @endforeach
            </div>
            <x-input-error for="tags_id" />

            <x-label for="imagenC">Caratula</x-label>
            <div class="h-80 bg-gray-200 relative">
                @if ($imagen)
                    <img src="{{ $imagen->temporaryUrl() }}" alt=""
                        class="w-full h-full bg-center bg-cover gb-repeat">
                @endif
                <input type="file" accept="image/*" hidden id="imagenC" wire:model="imagen">
                <label for="imagenC"
                    class="absolute bottom-2 right-2 bg-gray-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">
                    Add Image
                    <i class="fa-solid fa-image ml-1"></i> </label>
            </div>
            <x-input-error for="imagen" />

        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button wire:click="store" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    wire:loading.attr="disabled">
                    <i class="fas fa-save"></i> GUARDAR
                </button>

                <button wire:click="cancelarCrear"
                    class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-xmark"></i> CANCELAR
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
