@extends('layouts.principal')

@section('titulo')
    Editar categoria
@endsection

@section('cabecera')
    Editar categoria
@endsection

@section('contenido')
    <div class="w-1/3 mx-auto flex items-center justify-center">
        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('put')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                    Nombre
                </label>
                <input id="nombre" name="nombre" type="text" value="{{ $category->nombre }}" placeholder="Nombre"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('nombre')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="descripcion">
                    Descripción
                </label>
                <textarea id="descripcion" name="descripcion" placeholder="Descripcion"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"> {{ $category->descripcion }}
                </textarea>
                @error('descripcion')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>
            <div class="flex flex-row-reverse">
                <button type="submit" name="btn"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <i class="fas fa-edit mr-2"></i>Editar
                </button>
                <button type="reset"
                    class="mr-2 text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-blue-800">
                    <i class="fas fa-paintbrush mr-2"></i>Limpiar
                </button>
                <a href="{{ route('categories.index') }}"
                    class="mr-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-blue-800">
                    <i class="fas fa-backward mr-2"></i>VOLVER
                </a>
            </div>
        </form>
    </div>
@endsection
