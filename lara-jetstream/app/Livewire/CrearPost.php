<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearPost extends Component
{
    use WithFileUploads;

    public bool $openModal = false;

    // Las validaciones sirven para las dos imagenes
    #[Validate(['nullable', 'image', 'max:1024'])]
    public $imagen;
    // public $imagen1;

    #[Validate(['required', 'string', 'min:3', 'unique:posts,titulo'])]
    public string $titulo = '';

    #[Validate(['required', 'string', 'min:10'])]
    public string $contenido = '';

    #[Validate(['nullable'])]
    public string $estado = '';

    #[Validate(['required', 'exists:categories,id'])]
    public string $category_id = '';

    public function render()
    {
        $categories = Category::select('nombre', 'id')->orderBy('nombre')->get();
        return view('livewire.crear-post', compact('categories'));
    }

    public function store()
    {
        $this->validate();

        Post::create([
            'titulo' => $this->titulo,
            'contenido' => $this->contenido,
            'category_id' => $this->category_id,
            'estado' => $this->estado ? 'borrador' : 'publicado',
            'imagen' => $this->imagen ? $this->imagen->store('posts') : 'posts/default.jpg',
            'user_id' => auth()->user()->id
        ]);

        $this->dispatch('info', 'Post creado correctamente'); // Evento que se escucha en todo el proyecto
        $this->dispatch('postCreado')->to(ShowPosts::class); // Evento que se escucha en un componente en específico

        $this->cancelar();
    }

    public function cancelar()
    {
        $this->reset(['openModal', 'titulo', 'contenido', 'estado', 'category_id', 'imagen']);
        $this->resetErrorBag();
    }
}
