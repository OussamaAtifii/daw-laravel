@extends('template.principal')

<div class="h-screen flex justify-center items-center">
    <a href="{{ route('clients.index') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
        <i class="fa-solid fa-user mr-3"></i>Acceder a clientes
    </a>
</div>
