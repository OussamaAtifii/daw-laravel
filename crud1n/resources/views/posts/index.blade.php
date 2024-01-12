@extends('plantillas.principal')

@section('titulo')
    Inicio posts
@endsection
@section('cabecera')
    Mis posts
@endsection
@section('contenido')
    <div class="my-2 flex flex-row-reverse">
        <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-add mr-1"></i> Añadir
        </a>
    </div>
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
                        Categoria
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Publicado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
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
                            {{ $post->category->nombre }}
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
                        <td class="px-6
                                    py-4">

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
@section('mensajes')
    @if (session('info'))
        <script>
            Swal.fire({
                icon: "success",
                title: "{{ session('info') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endsection
