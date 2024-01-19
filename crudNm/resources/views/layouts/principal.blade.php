<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CDN Tailwind Css --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- CDN SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- CDN FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>@yield('titulo')</title>
</head>

<body>

    {{-- Navbar --}}
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="{{ route('home') }}" class="block py-2 px-3 rounded text-blue-500"
                            aria-current="page"><i class="fas fa-home mr-2"></i>Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('posts.index') }}" class="block py-2 px-3 rounded text-black dark:text-white"
                            aria-current="page">
                            <i class="fas fa-gears mr-2"></i> Gestionar Posts
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Contenido --}}
    <h1 class="my-4 text-center text-xl">@yield('cabecera')</h1>
    <div class="mx-auto w-3/4 p-8">
        @yield('contenido')
    </div>

    {{-- Mensajes --}}
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

</body>

</html>
