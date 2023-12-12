@extends('layouts.principal')
@section('titulo')
    Crear
@endsection
@section('cabecera')
    Crear posts
@endsection
@section('contenido')
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="w-1/2 mx-auto">
        @csrf {{-- Evitar ataques al formulario, es obligatorio --}}
        <div class="mb-6">
            <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Título</label>
            <input type="text" name="titulo" id="nombre" placeholder="Título..." value="{{ old('titulo') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('titulo')
                <x-msgerror>
                    {{ $message }}
                </x-msgerror>
            @enderror
        </div>
        <div class="mb-6">
            <label for="desc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Contenido</label>
            <textarea name="contenido" rows='5' id="desc"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('contenido') }}</textarea>
            @error('contenido')
                <x-msgerror>
                    {{ $message }}
                </x-msgerror>
            @enderror
        </div>
        <div class="mb-6">
            <label for="publicado" class="block mb-2 text-sm font-medium text-gray-900">
                Publicado</label>
            <input type="checkbox" value="valor" name="publicado" id="publicado" @checked(old('publicado') == 'valor')">
            <span class="font-bold">SI</span>
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
                        <x-msgerror>
                            {{ $message }}
                        </x-msgerror>
                    @enderror
                </div>
                <div class="w-1/2">
                    <img src="{{ Storage::url('posts/default.jpg') }}"
                        class="h-72 rounded w-full object-cover border-4 border-black" id="img">
                </div>
            </div>

        </div>

        <div class="flex flex-row-reverse">
            <button type="submit" name="btn"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="fas fa-save mr-2"></i>GUARDAR
            </button>
            <button type="reset"
                class="mr-2 text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-blue-800">
                <i class="fas fa-paintbrush mr-2"></i>LIMPIAR
            </button>
            <a href="{{ route('posts.index') }}"
                class="mr-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">
                <i class="fas fa-backward mr-2"></i>VOLVER
            </a>
        </div>

    </form>
@endsection
