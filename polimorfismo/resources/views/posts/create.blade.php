@extends('layouts.main')
@section('titulo')
    Gestion de Posts
@endsection

@section('cabecera')
    Crear Post
@endsection

@section('contenido')
    <form class="max-w-sm mx-auto" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-5">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dar:text-white">Titulo</label>
            <input id="title" name="nombre"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dar:bg-gray-700 dar:border-gray-600 dar:placeholder-gray-400 dar:text-white dar:focus:ring-blue-500 dar:focus:border-blue-500"
                required />
            @error('nombre')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dar:text-white">Descripción del
                post</label>
            <textarea type="text" id="descripcion" name="descripcion"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dar:bg-gray-700 dar:border-gray-600 dar:placeholder-gray-400 dar:text-white dar:focus:ring-blue-500 dar:focus:border-blue-500"
                required></textarea>
            @error('descripcion')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-5">
            <label class="block mb-2 text-sm font-medium text-gray-900 dar:text-white" for="file_input">Imagen</label>
            <input type="file" name="imagen"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dar:bg-gray-700 dar:border-gray-600 dar:placeholder-gray-400 dar:text-white dar:focus:ring-blue-500 dar:focus:border-blue-500"
                id="file_input">
            @error('imagen')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-5">
            <label for="img-desc" class="block mb-2 text-sm font-medium text-gray-900 dar:text-white">Descripción de la
                imagen</label>
            <textarea type="text" id="img-desc" name="img_desc"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dar:bg-gray-700 dar:border-gray-600 dar:placeholder-gray-400 dar:text-white dar:focus:ring-blue-500 dar:focus:border-blue-500"></textarea>
            @error('img_desc')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        {{-- <div class="w-1/2 mr-2">
            <label for="imagen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                IMAGEN</label>
            <input type="file" id="imagen" oninput="img.src=window.URL.createObjectURL(this.files[0])" name="imagen"
                accept="image/*"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        </div>

        <div class="w-1/2">
            <img src="{{ Storage::url('default.jpg') }}" class="h-72 rounded w-full object-cover border-4 border-black"
                id="img">
        </div> --}}
        {{-- </div> --}}
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dar:bg-blue-600 dar:hover:bg-blue-700 dar:focus:ring-blue-800">Submit</button>
    </form>
@endsection
