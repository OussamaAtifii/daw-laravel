<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateProduct extends Form
{
    public ?Product $product = null;
    public string $nombre = "";
    public string $descripcion = "";
    public int $stock = 0;
    public float $pvp = 0;
    public array $tags = [];
    public $imagen;

    public function setProducto(Product $product)
    {
        $this->product = $product;
        $this->nombre = $product->nombre;
        $this->descripcion = $product->descripcion;
        $this->stock = $product->stock;
        $this->pvp = $product->pvp;
        $this->tags = $product->getTags();
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'unique:products,nombre,' . $this->product->id, 'min:3'],
            'descripcion' => ['required', 'string', 'min:10'],
            'pvp' => ['required', 'decimal:0,2', 'min:0', 'max:9999.99'],
            'stock' => ['required', 'integer', 'min:0'],
            'tags' => ['required', 'array', 'exists:tags,id'],
            'imagen' => ['image', 'nullable', 'max:2048'],
        ];
    }

    public function editarProducto()
    {
        $ruta = $this->product->imagen;

        if ($this->imagen) {
            if (basename($this->product->imagen) != 'default.jpg') {
                Storage::delete($this->product->imagen);
            }
            $ruta = $this->imagen->store('productos');
        }

        // Actualizar producto
        $this->product->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'stock' => $this->stock,
            'pvp' => $this->pvp,
            'imagen' =>  $ruta,
            'disponible' => $this->stock ? 'si' : 'no',
            'user_id' => auth()->user()->id
        ]);

        // Actualizar etiquetas del producto
        $this->product->tags()->sync($this->tags);
    }

    public function limpiarCampos()
    {
        $this->reset();
        // $this->reset(['producto', 'nombre', 'descripcion', 'stock', 'pvp', 'tags', 'imagen']);
    }
}
