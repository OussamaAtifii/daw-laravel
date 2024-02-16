<?php

namespace App\Livewire;

use App\Livewire\Forms\UpdateProduct;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class ShowProducts extends Component
{

    use WithPagination;
    use WithFileUploads;
    public string $campo = "id";
    public string $orden = "desc";

    public string $busqueda = "";

    public UpdateProduct $form;
    public bool $openEdit = false;

    public Product $product;
    public bool $openShow = false;

    #[On('producto_creado')]
    public function render()
    {
        $tagsShow = Tag::select('id', 'nombre', 'color')->orderBy('color')->get();
        $products = Product::where('user_id', auth()->user()->id)
            ->where(function ($q) {
                $q->where('nombre', 'like', '%' . $this->busqueda . '%')
                    ->orWhere('disponible', 'like', '%' . $this->busqueda . '%');
            })
            ->orderBy($this->campo, $this->orden)
            ->paginate(5);

        return view('livewire.show-products', compact('products', 'tagsShow'));
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

    public function confirmarBorrar(Product $product)
    {
        $this->authorize('update', $product);
        $this->dispatch('confirmarBorrar', $product->id);
    }

    #[On('borrarOk')]
    public function borrar(Product $product)
    {
        $this->authorize('update', $product);

        if (basename($product->imagen) !== 'default.jpg') {
            Storage::delete($product->imagen);
        }

        $product->delete();
        $this->dispatch('mensaje', 'Producto eliminado correctamente');
    }

    // Para actualizar
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $this->form->setProducto($product);
        $this->openEdit = true;
    }

    public function update()
    {
        $this->form->editarProducto();
        $this->cancelarUpdate();
        $this->dispatch('mensaje', 'Producto actualizado correctamente');
    }

    public function cancelarUpdate()
    {
        $this->openEdit = false;
        $this->form->limpiarCampos();
    }

    // Mostrar detalles
    public function detalle(Product $product)
    {
        $this->product = $product;
        $this->openShow = true;
        dd($this->product);
    }

    public function cerrarDetalle()
    {
        $this->reset(['product', 'openShow']);
    }
}
