<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;

class PostUpdateForm extends Form
{
    public $imagen;
    public ?Post $post;
    public string $titulo = '';
    public string $contenido = '';
    public string $category_id = "";
    public string $estado = "";

    public function setPost(Post $post)
    {
        $this->post = $post;
        $this->titulo = $post->titulo;
        $this->contenido = $post->contenido;
        $this->category_id = $post->category_id;
        $this->estado = $post->estado;
    }

    public function rules()
    {
        return [
            'titulo' => ['required', 'string', 'min:3', 'unique:posts,titulo,' . $this->post->id],
            'contenido' => ['required', 'string', 'min:10'],
            'estado' => ['nullable'],
            'category_id' => ['required', 'exists:categories,id'],
            'imagen' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function update()
    {
        $this->validate();

        if ($this->imagen) {
            if (basename($this->post->imagen) != 'default.png') {
                Storage::delete($this->post->imagen);
            }
        }

        $ruta = $this->imagen ? $this->imagen->store('posts') : $this->post->imagen;

        $this->post->update([
            'titulo' => $this->titulo,
            'contenido' => $this->contenido,
            'estado' => $this->estado ? 'publicado' : 'borrador',
            'category_id' => $this->category_id,
            'imagen' => $ruta
        ]);
    }

    public function cancelar()
    {
        $this->reset(['post', 'titulo', 'contenido', 'imagen', 'estado', 'category_id',]);
    }
}
