<?php

namespace App\Livewire;

use App\Models\Film;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShowFilms extends Component
{
    use WithPagination;

    public string $campo = "pid";
    public string $orden = "desc";
    public string $buscar = "";

    // #[On('evento_pelicula_creada')]
    public function render()
    {
        $films = Film::join('categories', 'categories.id', '=', 'category_id')
            ->select('films.id as pid', 'caratula', 'titulo', 'disponible', 'nombre')
            ->where('titulo', 'like', "%$this->buscar%")
            ->orwhere('nombre', 'like', "%$this->buscar%")
            ->orwhere('disponible', 'like', "%$this->buscar%")
            ->orderBy($this->campo, $this->orden)->paginate(5);

        return view('livewire.show-films', compact('films'));
    }

    public function ordenar(string $campo)
    {
        $this->orden = $this->orden == 'asc' ? 'desc' : 'asc';
        $this->campo = $campo;
    }

    public function updatingBuscar()
    {
        $this->resetPage();
    }
}
