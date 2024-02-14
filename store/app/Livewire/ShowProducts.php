<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducts extends Component
{

    use WithPagination;
    public string $campo = "id";
    public string $orden = "desc";

    public string $busqueda = "";

    public function render()
    {
        $products = Product::where('user_id', auth()->user()->id)
            ->where('nombre', 'like', '%' . $this->busqueda . '%')
            ->orderBy($this->campo, $this->orden)
            ->paginate(5);


        return view('livewire.show-products', compact('products'));
    }

    public function ordenar(string $campo)
    {
        $this->campo = $campo;
        $this->orden = $this->orden == 'desc' ? 'asc' : 'desc';
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    public function aumentar(Product $product)
    {
        $stock = $product->stock + 1;

        $product->update([
            'stock' => $stock,
            'disponible' => $stock > 0 ? 'si' : 'no'
        ]);
    }

    public function disminuir(Product $product)
    {
        if ($product->stock == 0) return;
        $stock = $product->stock - 1;

        $product->update([
            'stock' => $stock,
            'disponible' => $stock == 0 ? 'no' : 'si'
        ]);
    }
}
