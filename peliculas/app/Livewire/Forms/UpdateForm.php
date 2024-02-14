<?php

namespace App\Livewire\Forms;

use App\Models\Film;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateForm extends Form
{
    public ?Film $film = null;
    public string $titulo = "";
    public ?string $disponible = null;
    public $imagen;
    public ?string $category_id = null;
    public array $tags_id = [];
    public string $sinopsis = "";

    public function setPelicula(Film $film)
    {
        $this->film = $film;
        $this->titulo = $film->titulo;
        $this->disponible = $film->disponible;
        $this->category_id = $film->category_id;
        $this->sinopsis = $film->sinopsis;
        $this->tags_id = $film->getTagsId($film);
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'min:3', 'unique:films,titulo,' . $this->film->id],
            'sinopsis' => ['required', 'string', 'min:10'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags_id' => ['required', 'array', 'min:1', 'exists:tags,id'],
            'disponible' => ['nullable']
        ];
    }

    public function actualizar()
    {
        $this->validate();

        $ruta = $this->film->caratula;
        if ($this->imagen) {
            if (basename($this->film->caratula) != 'default.png') {
                Storage::delete($this->film->caratula);
            }

            $ruta = $this->imagen->store('caratulas');
        }

        $this->film->update([
            'titulo' => $this->titulo,
            'sinopsis' => $this->sinopsis,
            'category_id' => $this->category_id,
            'disponible' => $this->disponible ? 'si' : 'no',
            'caratula' => $ruta
        ]);

        // Actualizar etiquetas
        $this->film->tags()->sync($this->tags_id);
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->reset(['titulo', 'imagen', 'disponible', 'category_id', 'tags_id', 'film', 'sinopsis']);
    }
}
