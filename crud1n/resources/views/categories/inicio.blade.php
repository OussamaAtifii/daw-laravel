@extends('plantillas.principal')

@section('titulo')
    Inicio categorias
@endsection
@section('cabecera')
    Mis categorias
@endsection
@section('contenido')
    <div class="my-2 flex flex-row-reverse">
        <a href="{{ route('categories.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-add mr-1"></i> Añadir
        </a>
    </div>

    <div class="relative overflow-x-auto">
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
                        Descripcion
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th class="px-6 py-4">
                            {{ $categoria->id }}
                        </th>
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $categoria->nombre }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $categoria->descripcion }}
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('categories.destroy', $categoria) }}" method="POST">
                                @csrf
                                @method('delete')
                                <a href="{{ route('categories.edit', $categoria) }}">
                                    <i class="fas fa-edit mr-2"></i>
                                </a>
                                <button>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-2">
            {{ $categorias->links() }}
        </div>
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
