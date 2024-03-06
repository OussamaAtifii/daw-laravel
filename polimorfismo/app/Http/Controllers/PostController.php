<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'min:3', 'string', 'max:255', 'unique:posts,nombre'],
            'descripcion' => ['required', 'min:3', 'string', 'max:255',],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'img_desc' => ['nullable', 'min:10', 'string', 'max:255',]
        ]);

        $post = Post::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        $post->image()->create([
            'url_imagen' => $request->imagen ? $request->imagen->store('imagenes') : "default.jpg",
            'desc_imagen' => $request->img_desc ? $request->img_desc : "Imagen por defecto",
        ]);

        return redirect()->route('posts.index')->with('info', 'Post creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'nombre' => ['required', 'min:3', 'string', 'max:255', 'unique:posts,nombre,' . $post->id],
            'descripcion' => ['required', 'min:3', 'string', 'max:255',],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'img_desc' => ['required', 'min:10', 'string', 'max:255',]
        ]);

        $ruta = $post->image->url_imagen;

        if ($request->imagen) {
            if (basename($ruta) != "default.jpg") {
                Storage::delete($ruta);
            }
            $ruta = $request->imagen->store('posts');
        }

        //! Revisar lo de que la desc no puede ser nula tambien en el update
        $post->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        $post->image()->update([
            'url_imagen' => $ruta,
            'desc_imagen' => $request->img_desc,
        ]);

        return redirect()->route('posts.index')->with('info', 'Post actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        if (basename($post->image->url_imagen) != "default.jpg") {
            Storage::delete($post->image->url_imagen);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('info', 'Post eliminado correctamente');
    }
}
