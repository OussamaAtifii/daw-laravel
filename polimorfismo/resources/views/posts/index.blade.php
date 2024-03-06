@extends('layouts.main')
@section('titulo')
    Gestion de Posts
@endsection

@section('cabecera')
    Gestion de Posts
@endsection

@section('contenido')
    <div class="flex justify-end">
        <a href="{{ route('posts.create') }}"
            class="font-bold px-4 py-2 my-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
            Crear Post
        </a>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3">
                    Descripcion
                </th>
                <th scope="col" class="px-6 py-3">
                    Tipo
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                        <img class="w-10 h-10 rounded-full" src="{{ Storage::url($post->image->url_imagen) }}"
                            alt="{{ $post->image->desc_imagen }}">
                        <div class="ps-3">
                            <div class="text-base font-semibold">{{ ucfirst($post->nombre) }}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        {{ $post->descripcion }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $post->image->imageable_type }}
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('posts.edit', $post) }}" class="font-medium text-blue-600 mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="font-medium text-blue-600">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">
        {{ $posts->links() }}
    </div>
@endsection
