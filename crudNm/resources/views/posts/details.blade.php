@extends('layouts.principal')

@section('titulo')
    Inicio posts
@endsection

@section('cabecera')
    Gestion de Posts
@endsection

@section('contenido')
    <div class="max-w-sm mx-auto bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <img class="rounded-t-lg" src="{{ Storage::url($post->imagen) }}" alt="{{ $post->titulo }}" />
        <div class="p-5">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->titulo }}</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $post->contenido }}</p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                <span class="font-bold">Estado: </span> <span @class([
                    'text-red-500 line-through' => $post->estado == 'borrador',
                    'text-green-500' => $post->estado == 'publicado',
                ])>
                    {{ ucfirst($post->estado) }}</span>
            </p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                <span class="font-bold">Fecha de creación: </span> {{ $post->created_at->format('d-m-Y') }}
            </p>

            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                <span class="font-bold">Fecha de modificación: </span> {{ $post->updated_at->format('d-m-Y') }}
            </p>

            <div class="flex mb-2">
                @foreach ($post->tags as $tag)
                    <div class="py-1 px-1 rounded-xl mr-1" style="background-color:{{ $tag->color }}">
                        {{ $tag->nombre }}
                    </div>
                @endforeach
            </div>
            <a href="#" onclick="location.href = document.referrer; return false;"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Volver
                <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
@endsection
