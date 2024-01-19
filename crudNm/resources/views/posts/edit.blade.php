@extends('layouts.principal')
@section('titulo')
    Editar post
@endsection

@section('cabecera')
    Editar post
@endsection

@section('contenido')
    <div class="w-3/4 mx-auto p-6 rounded-xl shadow-xl bg-gray-500 dark:text-gray-200">
        <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-5">
                <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                <input type="text" id="titulo" value="{{ old('titulo', $post->titulo) }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Añada un titulo" name="titulo">
                @error('titulo')
                    <x-inputerror>{{ $message }}</x-inputerror>
                @enderror
            </div>
            <div class="mb-5">
                <label for="contenido"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contenido</label>
                <textarea id="contenido" name="contenido"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Añade un contenido...">{{ old('contenido', $post->contenido) }}</textarea>
                @error('contenido')
                    <x-inputerror>{{ $message }}</x-inputerror>
                @enderror
            </div>
            <div class="mb-5">
                <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publicar</label>
                <div class="flex items-center mb-4">
                    <input id="estado" type="checkbox" value="publicado" name="estado"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        @checked(old('estado', $post->estado) == 'publicado')>
                    <label for="estado" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">SI</label>
                </div>
                @error('estado')
                    <x-inputerror>{{ $message }}</x-inputerror>
                @enderror
            </div>
            <div class="mb-5">
                <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Etiquetas</label>
                <div class="flex">
                    @foreach ($tags as $tag)
                        <div class="flex items-center me-4">
                            <input id="inline-checkbox-{{ $tag->id }}" type="checkbox" value="{{ $tag->id }}"
                                name="tags[]" @checked(in_array($tag->id, old('tags', $tagsPost)))
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-checkbox-{{ $tag->id }}"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $tag->nombre }}</label>
                        </div>
                    @endforeach
                </div>
                @error('tags')
                    <x-inputerror>{{ $message }}</x-inputerror>
                @enderror
            </div>
            <div class="mb-4">
                <div class="flex w-full">
                    <div class="w-1/2 mr-2">
                        <label for="imagen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Imagen
                        </label>
                        <input type="file" id="imagen" oninput="img.src=window.URL.createObjectURL(this.files[0])"
                            name="imagen" accept="image/*"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        @error('imagen')
                            <x-inputerror>{{ $message }}</x-inputerror>
                        @enderror
                    </div>

                    <div class="w-1/2">
                        <img src="{{ Storage::url($post->imagen) }}"
                            class="h-72 rounded w-full bg-cover bg-center bg-no-repeat border-4 border-black"
                            id="img">
                    </div>
                </div>

            </div>
            <div class="flex flex-row-reverse">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-save"></i> EDITAR
                </button>
                <a href="{{ route('posts.index') }}"
                    class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-xmark"></i> CANCELAR</a>
            </div>
        </form>
    </div>
@endsection
