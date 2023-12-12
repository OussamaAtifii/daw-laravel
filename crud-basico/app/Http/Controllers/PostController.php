<?php

namespace App\Http\Controllers;

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
        $posts = Post::orderBy('id', 'DESC')->paginate(5);
        // return view('posts.index', ['posts' => $posts]);
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
        // 1.- Validar el formulario
        $request->validate([
            'titulo' => ['required', 'string', 'min:5', 'unique:posts,titulo'],
            'contenido' => ['required', 'string', 'min:10'],
            'publicado' => ['nullable'],
            'imagen' => ['nullable', 'image', 'max:2024'],
        ]);

        // 2.- Si no hay errores pasar de esta linea, le guardamos los datos
        $publicado = ($request->publicado) ? "SI" : "NO";
        $ruta = ($request->imagen) ? $request->imagen->store('posts') : "posts/default.jpg";

        Post::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'publicado' => $publicado,
            'imagen' => $ruta
        ]);

        // 3.- Volver a la pagina posts y crear session para mostrar mensaje
        return redirect()->route('posts.index')->with('mensaje', 'Post creado correctamente');
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
            'titulo' => ['required', 'string', 'min:5', 'unique:posts,titulo,' . $post->id],
            'contenido' => ['required', 'string', 'min:10'],
            'publicado' => ['nullable'],
            'imagen' => ['nullable', 'image', 'max:2024'],
        ]);

        $publicado = ($request->publicado) ? "SI" : "NO";
        // Si hay imagen nueva la guardamos y borramos la anterior
        $ruta = $post->imagen;
        if ($request->imagen) {
            // Se sube una imagen, borramos la anterior si no es la por defecto
            $ruta = $request->imagen->store('posts');

            if (basename($post->imagen) != "default.jpg") {
                Storage::delete($post->imagen);
            }
        }

        $post->update([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'publicado' => $publicado,
            'imagen' => $ruta
        ]);

        return redirect()->route('posts.index')->with('mensaje', 'Post actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // 1.- Borrar la imagen si no es la por defecto
        if (basename($post->imagen) != "default.jpg") {
            Storage::delete($post->imagen);
        }
        $post->delete();

        return redirect()->route('posts.index')->with('mensaje', 'Post borrado correctamente');
    }
}
