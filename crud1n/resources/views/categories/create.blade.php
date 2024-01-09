@extends('plantillas.principal')

@section('titulo')
    Añadir categoria
@endsection
@section('cabecera')
    Crear categoria
@endsection
@section('contenido')
    <div class="w-1/2 mx-auto p-6 rounded-xl shadow-1l">

        <form class="max-w-sm mx-auto" method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Your name</label>
                <input type="name" id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Deporte..." name="nombre">
                @error('nombre')
                    <p class="text-red-500 italic text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">
                    Your description
                </label>
                <textarea type="descripcion" id="descripcion"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="descripcion" placeholder="Descripcion..."></textarea>
                @error('descripcion')
                    <p class="text-red-500 italic text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-row-reverse">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Sumbit</button>
            </div>

        </form>
    </div>
@endsection
