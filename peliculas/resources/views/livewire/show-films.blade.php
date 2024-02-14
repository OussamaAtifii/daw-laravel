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
                            <button wire:click="detalle({{ $film->pid }})">
                                <i class="fa-solid fa-circle-info ml-4"></i>
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

                        <td class="px-6 py-4 cursor-pointer" wire:click="actualizarDisponibilidad({{ $film->pid }})">
                            <div class="flex items-center">
                                <div @class([
                                    'h-2.5 w-2.5 rounded-full me-2',
                                    'bg-green-500' => $film->disponible == 'si',
                                    'bg-red-500' => $film->disponible == 'no',
                                ])></div> {{ $film->disponible }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <button wire:click="edit({{ $film->pid }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button wire:click="pedirConfirmacion({{ $film->pid }})">
                                <i class="fas fa-trash"></i>
                            </button>
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

    {{-- UPDATE MODAL --}}
    @isset($form->film)
        <x-dialog-modal maxWidth="4xl" wire:model="modalUpdate">
            <x-slot name="title">
                Actualizar pelicula
            </x-slot>

            <x-slot name="content">
                <x-label for="titulo">Titulo</x-label>
                <x-input placeholder="Añada su titulo" class="w-full mb-2" id="titulo" name="titulo"
                    wire:model="form.titulo"></x-input>
                <x-input-error for="form.titulo" />

                <x-label for="sinopsis">Sinopsis</x-label>
                <textarea name="sinopsis" id="sinopsis" wire:model="form.sinopsis"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mb-2" rows=5"></textarea>
                <x-input-error for="form.sinopsis" />

                <x-label for="category_id">Categoria</x-label>
                <select name="category_id" id="category_id" class="mb-2 w-full rounded" wire:model="form.category_id">
                    <option value="">Seleccione una categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                    @endforeach
                </select>
                <x-input-error for="form.category_id" />

                <x-label for="disponible">Disponible</x-label>
                <input id="default-checkbox" type="checkbox" value="si" @checked($form->disponible == 'si')
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 mb-2"
                    id="disponible" name="disponible" value="si" wire:model="form.disponible">
                <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900">Si</label>
                <x-input-error for="form.disponible" />


                <x-label for="tags_id">Etiquetas</x-label>
                <div class="flex">
                    @foreach ($tags as $tag)
                        <div class="flex items-center me-4">
                            <input id="{{ $tag->nombre }}" type="checkbox" value="{{ $tag->id }}"
                                wire:model="form.tags_id"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                            <label for="{{ $tag->nombre }}" class="ms-2 text-sm font-medium text-gray-900 p-1 rounded"
                                style="background-color: {{ $tag->color }}">{{ $tag->nombre }}</label>
                        </div>
                    @endforeach
                </div>
                <x-input-error for="form.tags_id" />

                <x-label for="imagenU">Caratula</x-label>
                <div class="h-80 bg-gray-200 relative">
                    @if ($form->imagen)
                        <img src="{{ $form->imagen->temporaryUrl() }}" alt=""
                            class="w-full h-full bg-center bg-cover gb-repeat">
                    @else
                        <img src="{{ Storage::url($form->film->caratula) }}" alt=""
                            class="w-full h-full bg-center bg-cover gb-repeat">
                    @endif
                    <input type="file" accept="image/*" hidden id="imagenU" wire:model="form.imagen">
                    <label for="imagenU"
                        class="absolute bottom-2 right-2 bg-gray-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">
                        Add Image
                        <i class="fa-solid fa-image ml-1"></i> </label>
                </div>
                <x-input-error for="form.imagen" />

            </x-slot>

            <x-slot name="footer">
                <div class="flex flex-row-reverse">
                    <button wire:click="update"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        wire:loading.attr="disabled">
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

    {{-- Detalle films --}}
    @isset($film)
        <x-dialog-modal wire:model="modalDetalle">
            <x-slot name="title" maxWidth="4xl">
                Detalle peliculas
            </x-slot>
            <x-slot name="content">
                <div class="w-full mx-auto bg-white border border-gray-200 rounded-lg shadow">
                    <a href="#">
                        <img class="rounded w-full bg-cover bg-center bg-no-repeat"
                            src="{{ Storage::url($film->caratula) }}" alt="" />
                    </a>
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $film->titulo }}</h5>
                        <p class="mb-3 font-normal text-gray-700">{{ $film->sinopsis }}</p>
                        <p class="mb-3 font-normal text-gray-700">
                            <span class="font-bold">Categoria: </span>
                            {{-- {{ $film->category->nombre }} --}}
                        </p>
                        <p class="mb-3 font-normal text-gray-700">
                            <span class="font-bold">Disponible: </span>
                            <span @class([
                                'text-red-500 line-through' => $film->disponible == 'no',
                                'text-green-500' => $film->disponible == 'si',
                            ])></span>
                        </p>
                        <p class="mb-3 font-normal text-gray-700">
                            <span class="font-bold">Registrada: </span>
                            {{-- {{ $film->created_at->format('d/m/Y h:i:s') }} --}}
                        </p>
                        <div class="flex">
                            @foreach ($film->tags as $tag)
                                <div class="p-1 rounded mr-1 font-bold" style="background-color: {{ $tag->color }}">
                                    {{ $tag->nombre }}
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

            </x-slot>
            <x-slot name="footer">
                <button wire:click="cancelarDetalle"
                    class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-xmark"></i> CANCELAR
                </button>
            </x-slot>
        </x-dialog-modal>
    @endisset
</x-propio.main>
