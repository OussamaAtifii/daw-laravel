@extends('plantillas.principal')

@section('titulo')
    Posts categoria
@endsection
@section('cabecera')
    Posts de la categoria {{ $nombre }}
@endsection
@section('contenido')
    <div class="relative overflow-x-auto rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Info
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Titulo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Publicado
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="{{ route('posts.show', $post) }}">
                                <i class="fas fa-info"></i>
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            {{ $post->titulo }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div @class([
                                    'h-2.5 w-2.5 rounded-full bg-green-500 me-2',
                                    'bg-green-500' => $post->publicado == 'SI',
                                    'bg-red-500' => $post->publicado == 'NO',
                                ])></div>{{ $post->publicado }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-2">
        {{ $posts->links() }}
    </div>
@endsection
