<x-propios.principal>
    <div class="flex w-full mt-1 mb-2 items-center">
        <div class="flex-1">
            <x-input class="w-3/4" placeholder="Buscar" type="search" wire:model.live="search">
                <i class="fas fa-search"></i>
            </x-input>
        </div>
        <div>
            @livewire('crear-post')
        </div>
    </div>
    @if (count($posts))
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Info
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Imagen
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('titulo')">
                        Titulo <i class="ml-1 fas fa-sort"></i>
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" wire:click="ordenar('estado')">
                        Estado <i class="ml-1 fas fa-sort"></i>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <button wire:click="showPost({{ $post->id }})">
                                <i class="fa-solid fa-circle-info"></i>
                            </button>
                        </td>
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="{{ Storage::url($post->imagen) }}"
                                alt="Jese image">
                        </th>
                        <td class="px-6 py-4 font-bold">
                            {{ $post->titulo }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div @class([
                                    'h-2.5 w-2.5 rounded-full bg-green-500 me-2',
                                    'bg-green-500' => $post->estado == 'publicado',
                                    'bg-red-500' => $post->estado == 'borrador',
                                ])></div> {{ $post->estado }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <button wire:click="edit({{ $post->id }})" class="mr-1">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button wire:click="confirmacion('{{ $post->id }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                        <td>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="p-2 rounded-xl text-black">
            No se encontro ningun registro con el termino {{ $search }}
        </p>
    @endif
    <div class="mt-1">
        {{ $posts->links() }}
    </div>

    {{-- Modal para actualizar post --}}
    @isset($form->post)
        <x-dialog-modal wire:model='openUpdateModal'>
            <x-slot name="title">
                Editar post
            </x-slot>
            <x-slot name="content">

                <x-label for="titulo">Título</x-label>
                <x-input id="titulo" placeholder="Añada un titulo" class="w-full mb-4" wire:model="form.titulo" />
                <input-error for="form.titulo" />

                <x-label for="contenido">Contenido</x-label>
                <textarea id="titulo" placeholder="Añada un contenido" wire:model="form.contenido"
                    class="w-full mb-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            </textarea>
                <input-error for="form.contenido" />

                <x-label for="categoria">Categoria</x-label>
                <select id="categoria" wire:model="form.category_id"
                    class="w-full mb-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">Selecciona una categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                    @endforeach
                </select>
                <input-error for="form.category_id" />


                <x-label for="estado">Estado</x-label>
                <div class="flex items-center mb-4">
                    <input id="default-checkbox" type="checkbox" value="publicado" wire:model="form.estado"
                        @checked($form->estado == 'publicado')
                        class="w-4 h-4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900">Publicado
                    </label>
                </div>
                <input-error for="form.estado" />

                <x-label for="imagen1">Imagen</x-label>
                <div class="w-full h-72 rounded relative bg-gray-200">
                    @if ($form->imagen)
                        <img src="{{ $form->imagen->temporaryUrl() }}" class="bg-cover bg-center bg-no-repeat h-72">
                    @else
                        <img src="{{ Storage::url($form->post->imagen) }}" class="bg-cover bg-center bg-no-repeat h-72">
                    @endif
                    <input type="file" accept="image/*" id="imagen1" hidden wire:model="imagen1">
                    <label for="imagen1"
                        class="absolute bottom-2 right-2 bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Upload<i class="fa-solid fa-cloud-arrow-up ml-2"></i></label>
                </div>
                <input-error for="form.imagen" />

            </x-slot>
            <x-slot name="footer">
                <div class="flex flex-row-reverse">
                    <button wire:click="update" type="submit" wire:loading.attr='disabled'
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-update"></i> Editar
                    </button>
                    <button wire:click="cancelar"
                        class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-xmark"></i> CANCELAR</button>
                </div>
            </x-slot>
        </x-dialog-modal>
    @endisset

    {{-- Modal detalles --}}
    <x-dialog-modal wire:model='openShowModal'>
        <x-slot name="title">
            Detalles del post
        </x-slot>
        <x-slot name="content">
            <div class="max-w-sm mx-auto bg-white border border-gray-200 rounded-lg shadow ">
                <img class="rounded-t-lg bg-cover bg-center" src="{{ Storage::url($post->imagen) }}"
                    alt="" />
                <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $post->titulo }}</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $post->contenido }}</p>
                    <div class="mb-3">
                        <span class="font-bold">Categoría: </span> {{ $post->category->nombre }}
                    </div>
                    <div class="mb-3">
                        <span class="font-bold">Email: </span> {{ $post->user->email }}
                    </div>
                    <div class="mb-3">
                        <span class="font-bold" @class([
                            'text-green-600' => $post->estado == 'publicado',
                            'text-red-600 line-throught' => $post->estado == 'borrador',
                        ])>Estado: </span>
                        {{ $post->estado ? 'publicado' : 'borrador' }}
                    </div>
                    <div class="mb-3">
                        <span class="font-bold">Creado: </span> {{ $post->created_at->format('d/m/Y H:i:s') }}
                    </div>
                    <div class="mb-3">
                        <span class="font-bold">Modificado: </span> {{ $post->updated_at->format('d/m/Y H:i:s') }}
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button wire:click="cancelarShow" type="submit" wire:loading.attr='disabled'
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-update"></i> Editar
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>

</x-propios.principal>
