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
    <h1 class="my-4 text-center text-xl">@yield('cabecera')</h1>
    <div class="mx-auto w-3/4 p-8">
        @yield('contenido')
    </div>

    @yield('mensajes')
</body>

</html>
