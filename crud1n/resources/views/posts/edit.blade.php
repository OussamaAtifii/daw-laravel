@extends('plantillas.principal')

@section('titulo')
    Editar post
@endsection
@section('cabecera')
    Editar post
@endsection
@section('contenido')
    <div class="mx-auto p-6 rounded-xl shadow-1l">
        <form class="max-w-sm mx-auto" method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900">Titulo</label>
                <input type="text" id="titulo" value="{{ old('titulo', $post->titulo) }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Añade un titulo" name="titulo">
                @error('titulo')
                    <p class="text-red-500 italic text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">
                    Contenido
                </label>
                <textarea id="contenido"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="contenido" placeholder="Añade el contenido">{{ old('contenido', $post->contenido) }}</textarea>
                @error('contenido')
                    <p class="text-red-500 italic text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="publicado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publicar</label>
                <div class="flex items-center mb-4">
                    <input id="publicado" type="checkbox" value="SI" name="publicado"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        @checked(old('publicado', $post->publicado) == 'SI')>

                    <label for="publicado" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">SI</label>
                </div>
            </div>
            <div class="mb-5">
                <label for="categoria" class="block mb-2 text-sm font-medium text-gray-900">categoria</label>
                <select type="text" id="categoria"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="category_id">
                    <option value="safart">Seleccione una categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>{{ $category->nombre }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 italic text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <div class="flex w-full">
                    <div class="w-1/2 mr-2">
                        <label for="imagen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            IMAGEN</label>
                        <input type="file" id="imagen" oninput="img.src=window.URL.createObjectURL(this.files[0])"
                            name="imagen" accept="image/*"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        @error('imagen')
                            <p class="text-red-500 italic text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-1/2">
                        <img src="{{ Storage::url($post->imagen) }}"
                            class="h-72 rounded w-full object-cover border-4 border-black" id="img">
                    </div>
                </div>

            </div>
            <div class="flex flex-row-reverse">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-edit mr-2"></i> Editar
                </button>
            </div>
        </form>
    </div>
@endsection
