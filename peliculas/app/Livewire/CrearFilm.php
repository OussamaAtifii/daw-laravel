<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Film;
use App\Models\Tag;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearFilm extends Component
{
    use WithFileUploads;

    public bool $modalCrear = false;

    #[Validate(['nullable', 'image', 'max:2048'])]
    public $imagen;

    #[Validate(['required', 'string', 'min:3', 'unique:films,titulo'])]
    public string $titulo;

    #[Validate(['required', 'string', 'min:10'])]
    public string $sinopsis;

    #[Validate(['nullable'])]
    public string $disponible = "";

    #[Validate(['required', 'exists:categories,id'])]
    public string $category_id;

    #[Validate(['required', 'array', 'min:1', 'exists:tags,id'])]
    public array $tags_id = [];


    public function render()
    {
        $tags = Tag::select('id', 'nombre', 'color')->orderBy('nombre')->get();
        $categories = Category::select('id', 'nombre')->orderBy('nombre')->get();

        return view('livewire.crear-film', compact('tags', 'categories'));
    }

    public function store()
    {
        $this->validate();

        $film = Film::create([
            'titulo' => $this->titulo,
            'sinopsis' => $this->sinopsis,
            'category_id' => $this->category_id,
            'disponible' => $this->disponible ? 'si' : 'no',
            'caratula' => $this->imagen ? $this->imagen->store('caratulas') : 'default.png'
        ]);

        $film->tags()->attach($this->tags_id);

        // Avisar a componente showfilms para que se actualice y muestre la nueva pelicula
        $this->dispatch('evento_pelicula_creada')->to(ShowFilms::class);

        // Evento para lanzar a todo el proyecto
        $this->dispatch('mensaje', 'Pelicula creada correctamente');
    }

    public function cancelarCrear()
    {
        $this->reset(['openModalCrear', 'titulo', 'imagen', 'disponible', 'category_id', 'tags_id', 'sinopsis']);
    }
}
