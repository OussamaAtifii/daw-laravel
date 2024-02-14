<x-app-layout>
    <x-main>
        {{-- Mostrar los productos disponibles de la tienda --}}
        <div class="w-full p-2 border-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach ($products as $product)
                <article @class([
                    'h-72 bg-cover bg-center bg-no-repeat',
                    'md:col-span-2' => $loop->first,
                ])
                    style="background-image: url({{ Storage::url($product->imagen) }})">
                    <div class="w-full h-full flex flex-col justify-around items-center p-2 opacity-100">
                        <div class="text-xl font-bold">{{ $product->nombre }}</div>
                        <div class="italix">
                            {{ $product->user->email }}
                        </div>
                        <div class="flex flex-wrap gap-1 justify-center">
                            @foreach ($product->tags as $tag)
                                <div class="p-1 rounded mr-1" style="background-color: {{ $tag->color }}">
                                    {{ $tag->nombre }}</div>
                            @endforeach
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="mt-2">
            {{ $products->links() }}
        </div>
    </x-main>
</x-app-layout>
