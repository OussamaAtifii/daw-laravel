@extends('layouts.principal')

@section('titulo')
    Categorias
@endsection

@section('cabecera')
    Mis categorias
@endsection

@section('contenido')
    <div class="relative overflow-x-auto">
        <div class="my-2 flex justify-end">
            <a href="{{ route('categories.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-add mr-2"></i> Añadir categoria
            </a>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Código
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descripción
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $category->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $category->nombre }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $category->descripcion }}
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('categories.destroy', $category) }}">
                                @csrf
                                @method('delete')
                                <a href="{{ route('categories.edit', $category) }}"><i class="fas fa-edit mx-2"></i></a>
                                <button type="submit"><i class="fas fa-trash text-red-500"></i></button>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-2">
            {{ $categories->links() }}
        </div>
    </div>
    @if (session('info'))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "{{ session('info') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endsection
