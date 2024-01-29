<?php

namespace App\Livewire;

use App\Livewire\Forms\PostUpdateForm;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    use WithFileUploads;

    public string $campo = "id";
    public string $orden = "desc";
    public string $search = "";

    // Atributos para el modal de modificación
    public bool $openUpdateModal = false;
    public PostUpdateForm $form;

    #[On('postCreado')]
    public function render()
    {
        $posts = Post::where('user_id', auth()->user()->id)
            ->where('titulo', 'like', '%' . $this->search . '%')
            ->orderBy($this->campo, $this->orden)
            ->paginate(5);

        $categories = Category::select('id', 'nombre')->orderBy('nombre')->get();

        return view('livewire.show-posts', compact('posts', 'categories'));
    }

    public function ordenar(string $campo)
    {
        $this->orden = $this->orden == 'asc' ? 'desc' : 'asc';
        $this->campo = $campo;
    }

    // Para que se reinicie la paginación cuando se realiza una búsqueda
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmacion(Post $post)
    {
        // Solo el usuario que creó el post puede borrarlo consultando las políticas
        $this->authorize('delete', $post);

        // Se emite un evento para que se muestre el modal de confirmación
        $this->dispatch('confirmarBorrado', $post->id);
    }

    // Se ejecuta cuando se emite el evento 'borradoConfirmado' de la modal de la vista
    #[On('borradoConfirmado')]
    public function delete(Post $post)
    {
        $this->authorize('delete', $post);

        if (basename($post->imagen) != 'default.jpg') {
            Storage::delete($post->imagen);
        }

        $post->delete();
        $this->dispatch('info', 'Post eliminado correctamente');
    }

    // Actualiza registro
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $this->form->setPost($post);
        $this->openUpdateModal = true;
    }

    public function update()
    {
        $this->authorize('update', $this->form->post);
        $this->form->update();
        $this->cancelar();
        $this->dispatch('info', 'Post editado correctamente');
    }

    public function cancelar()
    {
        $this->form->cancelar();
        $this->openUpdateModal = false;
    }
}
