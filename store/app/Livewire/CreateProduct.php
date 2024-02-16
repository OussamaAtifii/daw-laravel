<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Tag;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;

    public bool $modalCrear = false;

    #[Validate(['image', 'nullable', 'max:2048'])]
    public $imagen;

    #[Validate(['required', 'string', 'unique:products,nombre', 'min:3'])]
    public string $nombre = "";

    #[Validate(['required', 'string', 'min:10'])]
    public string $descripcion = "";

    #[Validate(['required', 'integer', 'min:0'])]
    public int $stock;

    #[Validate(['required', 'decimal:0,2', 'min:0', 'max:9999.99'])]
    public float $pvp;

    #[Validate(['required', 'array', 'exists:tags,id'])]
    public array $tags = [];

    public function render()
    {
        $tagsShow = Tag::orderBy('nombre')->get();
        return view('livewire.create-product', compact('tagsShow'));
    }

    public function store()
    {
        $this->validate();

        $product = Product::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'stock' => $this->stock,
            'pvp' => $this->pvp,
            'imagen' =>  $this->imagen ? $this->imagen->store('producto') : 'default.jpg',
            'disponible' => $this->stock ? 'si' : 'no',
            'user_id' => auth()->user()->id
        ]);

        $product->tags()->attach($this->tags);

        $this->dispatch('producto_creado')->to(ShowProducts::class);
        $this->dispatch('mensaje', 'Producto creado correctamente');
        $this->cancelarCrear();
    }

    public function cancelarCrear()
    {
        $this->reset(['modalCrear', 'nombre', 'descripcion', 'imagen', 'stock', 'pvp', 'tags']);
    }
}
