@extends('template.principal')

@section('titulo')
    Añadir cliente
@endsection
@section('cabecera')
    Crear cliente
@endsection
@section('contenido')
    <div class="w-1/2 mx-auto p-6 rounded-xl shadow-1l">
        <form class="max-w-sm mx-auto" method="POST" action="{{ route('clients.store') }}">
            <div class="mb-5">
                @csrf
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                <input type="name" id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Ingresa tu nombre de usuario" name="username">
                @error('username')
                    <p class="text-red-500 italic text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                <input type="email" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Ingresa tu email" name="email">
                @error('email')
                    <p class="text-red-500 italic text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900">
                    Descripción
                </label>
                <textarea id="descripcion"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    name="descripcion" placeholder="Añade una descripción"></textarea>
                @error('descripcion')
                    <p class="text-red-500 italic text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-row-reverse">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa-solid fa-square-plus mr-2"></i>Crear
                </button>
                <a href="{{ route('clients.index') }}"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2">
                    <i class="fa-solid fa-xmark mr-2"></i>Cancelar
                </a>
            </div>

        </form>
    </div>
@endsection
