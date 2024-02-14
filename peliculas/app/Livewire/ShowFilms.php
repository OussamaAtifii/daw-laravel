<?php

namespace App\Livewire;

use App\Livewire\Forms\UpdateForm;
use App\Models\Category;
use App\Models\Film;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowFilms extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $campo = "pid";
    public string $orden = "desc";
    public string $buscar = "";

    public bool $modalUpdate = false;
    public UpdateForm $form;

    // Detalles
    public Film $film;
    public bool $modalDetalle = false;

    #[On('evento_pelicula_creada')]
    public function render()
    {
        $tags = Tag::select('id', 'nombre', 'color')->orderBy('nombre')->get();
        $categories = Category::select('id', 'nombre')->orderBy('nombre')->get();

        $films = Film::join('categories', 'categories.id', '=', 'category_id')
            ->select('films.id as pid', 'caratula', 'titulo', 'disponible', 'nombre')
            ->where('titulo', 'like', "%$this->buscar%")
            ->orwhere('nombre', 'like', "%$this->buscar%")
            ->orwhere('disponible', 'like', "%$this->buscar%")
            ->orderBy($this->campo, $this->orden)->paginate(5);

        return view('livewire.show-films', compact('films', 'tags', 'categories'));
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

    // Borrar peliculas
    public function pedirConfirmacion(string $id)
    {
        $this->dispatch('confirmar', $id);
    }

    #[On('borrarOk')]
    public function borrarPelicula(Film $film)
    {
        // Comprobar la imagen
        if (basename($film->caratula) != 'default.png') {
            Storage::delete($film->caratula);
        }

        $film->delete();
        $this->dispatch('mensaje', 'Pelicula borrada correctamente');
    }

    // Actualizar disponibilidad
    public function actualizarDisponibilidad(Film $film)
    {
        $disponible = $film->disponible == 'si' ? 'no' : 'si';

        $film->update([
            'disponible' => $disponible
        ]);
    }

    // Metodos update
    public function edit(Film $film)
    {
        $this->form->setPelicula($film);
        $this->modalUpdate = true;
    }

    public function update()
    {
        $this->form->actualizar();
        $this->cancelarUpdate();
        $this->dispatch('mensaje', 'Pelicula actualizada correctamente');
    }

    public function cancelarUpdate()
    {
        $this->form->limpiar();
        $this->modalUpdate = false;
    }

    // Detalle pelicula
    public function detalle(Film $film)
    {
        $this->film = $film;
        $this->modalDetalle = true;
    }

    public function cancelarDetalle()
    {
        $this->reset(['modalDetalle', 'film']);
    }
}
