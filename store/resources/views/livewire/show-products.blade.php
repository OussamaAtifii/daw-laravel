<x-main>
    <div class="flex w-full mb-1 items-center justify-center">
        <div class="w-full">
            <x-input type="search" wire:model.live="busqueda" class="w-3/4"></x-input>
            <i class="fas fa-search"></i>
        </div>
        <div>
            @livewire('create-product')
        </div>
    </div>
    <table class="w-full text-sm 
                text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Info
                </th>
                <th scope="col" class="px-6 py-3">
                    Imagen
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('nombre')">
                    Nombre <i class="fa-solid fa-sort"></i>
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('stock')">
                    Stock <i class="fa-solid fa-sort"></i>
                </th>
                <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('disponible')">
                    Disponible <i class="fa-solid fa-sort"></i>
                </th>
                <th scope="col" class="px-6 py-3">
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="w-4 p-4">
                        <button wire:click="detalle({{ $product }})">
                            <i class="fas fa-info"></i>
                        </button>
                    </td>
                    <th scope="row"
                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="w-14 h-10 rounded bg-center bg-cover" src="{{ Storage::url($product->imagen) }}"
                            alt="Jese image">
                    </th>
                    <td class="px-6 py-4">
                        {{ $product->nombre }}
                    </td>
                    <td>
                        <div class="flex items-center">
                            <button wire:click="disminuir({{ $product->id }})"
                                class="inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200"
                                type="button">
                                <span class="sr-only">Quantity button</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 1h16" />
                                </svg>
                            </button>
                            <div>
                                <p @class([
                                    'bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1',
                                    'text-red-500' => $product->stock <= 10,
                                    'line-through' => $product->stock == 0,
                                    'text-green-500' => $product->stock >= 10,
                                ])">
                                    {{ $product->stock }}
                                </p>
                            </div>
                            <button wire:click="aumentar({{ $product->id }})"
                                class="inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200"
                                type="button">
                                <span class="sr-only">Quantity button</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 1v16M1 9h16" />
                                </svg>
                            </button>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                            {{ $product->disponible }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="edit({{ $product->id }})">
                            <i class="fas fa-edit text-blue-500"></i>
                        </button>
                        <button wire:click="confirmarBorrar({{ $product->id }})">
                            <i class="fas fa-trash text-red-500"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">
        {{ $products->links() }}
    </div>

    {{-- Modal para modificar producto --}}
    @isset($form->product)
        <x-dialog-modal wire:model="openEdit">
            <x-slot name="title">
                Actualizar producto
            </x-slot>

            <x-slot name="content">
                <x-label for="nombre">
                    Nombre
                </x-label>
                <x-input id="nombre" placeholder="Añada un nombre.." class="w-full" wire:model="form.nombre">
                </x-input>
                <x-input-error for="form.nombre"></x-input-error>

                <x-label for="form.descripcion" class="mt-3">
                    Descripcion
                </x-label>
                <textarea id="descripcion" wire:model="form.descripcion" placeholder="Añada una descripcion.." class="w-full">
            </textarea>
                <x-input-error for="form.descripcion"></x-input-error>

                <x-label for="stock" class="mt-3">
                    Stock
                </x-label>
                <x-input id="stock" type="number" wire:model="form.stock" placeholder="Añada un stock.." class="w-full"
                    min="0">
                </x-input>
                <x-input-error for="form.stock"></x-input-error>

                <x-label for="precio" class="mt-3">
                    PVP (€)
                </x-label>
                <x-input id="precio" type="number" wire:model="form.pvp" placeholder="Añada un precio.."
                    step="0.1" class="w-full" min="0">
                </x-input>
                <x-input-error for="form.pvp"></x-input-error>

                <x-label for="tags" class="mt-3">
                    Etiquetas
                </x-label>
                <div class="flex flex-wrap gap-2">
                    @foreach ($tagsShow as $tag)
                        <div class="flex items-center me-4">
                            <input id="inline-checkbox{{ $tag->id }}" type="checkbox" value="{{ $tag->id }}"
                                wire:model="form.tags"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                            <label for="inline-checkbox" class="ms-2 text-sm font-medium text-gray-900 rounded p-1"
                                style="background-color: {{ $tag->color }}">{{ $tag->nombre }}</label>
                        </div>
                    @endforeach
                </div>
                <x-input-error for="form.tags"></x-input-error>

                <x-label for="imagenU" class="mt-3">
                    Imagen
                </x-label>
                <div class="w-full h-72 bg-gray-200 rounded relative">
                    <input type="file" wire:model="form.imagen" accept="image/*" hidden id="imagenU">
                    <label for="imagenU"
                        class="absolute bottom-2 end-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Imagen
                        <i class="fas fa-upload ml-2"></i>
                    </label>
                    @if ($form->imagen)
                        <img src="{{ $form->imagen->temporaryUrl() }}" class="w-full bg-no-repeat bg-center">
                    @else
                        <img src="{{ Storage::url($form->product->imagen) }}" class="w-full bg-no-repeat bg-center">
                    @endif
                    <x-input-error for="form.imagen"></x-input-error>

                </div>

            </x-slot>

            <x-slot name="footer">
                <div class="flex flex-row-reverse">
                    <button wire:click="update" wire:loading.attr="disabled"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-edit"></i> EDITAR
                    </button>

                    <button wire:click="cancelarUpdate"
                        class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-xmark"></i> CANCELAR
                    </button>
                </div>
            </x-slot>
        </x-dialog-modal>
    @endisset

    {{-- Modal para ver producto --}}
    @isset($product->imagen)
        <x-dialog-modal wire:model="openShow">
            <x-slot name="title">
                Detalle
            </x-slot>

            <x-slot name="content">
                <div class="w-full mx-auto bg-white border border-gray-200 rounded-lg shadow ">
                    <img class="rounded-lg bg-cover bg-no-repeat bg-center w-full"
                        src="{{ Storage::url($product->imagen) }}" alt="" />
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $product->nombre }}</h5>
                        <p class="mb-3 font-normal text-gray-700">{{ $product->descripcion }}</p>
                    </div>
                    <div class="flex flex-wrap mt-4 gap-1">
                        @foreach ($product->tags as $tag)
                            <div class="p-1 rounded" style="background-color: {{ $tag->color }}">{{ $tag->nombre }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button wire:click="cerrarDetalle"
                    class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-xmark"></i> CANCELAR
                </button>
            </x-slot>
        </x-dialog-modal>
    @endisset
</x-main>
