@extends('plantillas.principal')

@section('titulo')
    Detalle post
@endsection
@section('cabecera')
    Detalle post
@endsection
@section('contenido')
    <div class="w-1/2 mx-auto">
        <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <img class="rounded-t-lg bg-center bg-cover bg-no-repeat" src="{{ Storage::url($post->imagen) }}" />
            <div class="p-5">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->titulo }}</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $post->contenido }}</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <span class="font-bold">Categoria: </span> {{ $post->category->nombre }}
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <span class="font-bold">Publicado: </span> {{ $post->publicado }}
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <span class="font-bold">Fecha de creación: </span>
                    {{ $post->created_at->format('d/m/Y h:i') }}
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <span class="font-bold">Fecha de modificación: </span> {{ $post->updated_at->format('d/m/Y h:i') }}
                </p>
                <a href="{{ route('posts.index') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Volver<i class="fas fa-home ml-2"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
