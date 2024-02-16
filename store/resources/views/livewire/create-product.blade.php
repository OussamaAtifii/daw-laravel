<div>
    <x-button wire:click="$set('modalCrear', true)">
        <i class="fas fa-add mr-1"></i> Añadir
    </x-button>

    {{-- Modal para crear producto --}}
    <x-dialog-modal wire:model="modalCrear">
        <x-slot name="title">
        </x-slot>

        <x-slot name="content">
            <x-label for="nombre">
                Nombre
            </x-label>
            <x-input id="nombre" placeholder="Añada un nombre.." class="w-full" wire:model="nombre">
            </x-input>
            <x-input-error for="nombre"></x-input-error>

            <x-label for="descripcion" class="mt-3">
                Descripcion
            </x-label>
            <textarea id="descripcion" wire:model="descripcion" placeholder="Añada una descripcion.." class="w-full">
            </textarea>
            <x-input-error for="descripcion"></x-input-error>

            <x-label for="stock" class="mt-3">
                Stock
            </x-label>
            <x-input id="stock" type="number" wire:model="stock" placeholder="Añada un stock.." class="w-full"
                min="0">
            </x-input>
            <x-input-error for="stock"></x-input-error>

            <x-label for="precio" class="mt-3">
                PVP (€)
            </x-label>
            <x-input id="precio" type="number" wire:model="pvp" placeholder="Añada un precio.." step="0.1"
                class="w-full" min="0">
            </x-input>
            <x-input-error for="pvp"></x-input-error>

            <x-label for="tags" class="mt-3">
                Etiquetas
            </x-label>
            <div class="flex flex-wrap gap-2">
                @foreach ($tagsShow as $tag)
                    <div class="flex items-center me-4">
                        <input id="inline-checkbox{{ $tag->id }}" type="checkbox" value="{{ $tag->id }}"
                            wire:model="tags"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label for="inline-checkbox" class="ms-2 text-sm font-medium text-gray-900 rounded p-1"
                            style="background-color: {{ $tag->color }}">{{ $tag->nombre }}</label>
                    </div>
                @endforeach
            </div>
            <x-input-error for="tags"></x-input-error>

            <x-label for="imagenC" class="mt-3">
                Imagen
            </x-label>
            <div class="w-full h-72 bg-gray-200 rounded relative">
                <input type="file" wire:model="imagen" accept="image/*" hidden id="imagenC">
                <label for="imagenC"
                    class="absolute bottom-2 end-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Imagen
                    <i class="fas fa-upload ml-2"></i>
                </label>
                @if ($imagen)
                    <img src="{{ $imagen->temporaryUrl() }}" class="w-full bg-no-repeat bg-center">
                @endif
                <x-input-error for="imagen"></x-input-error>

            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button wire:click="store" wire:loading.attr="disabled"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
