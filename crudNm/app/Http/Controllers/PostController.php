<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(8);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::select('id', 'nombre')->orderBy('nombre')->get();
        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'min:3', 'unique:posts,titulo'],
            'contenido' => ['required', 'string', 'min:10'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'estado' => ['nullable'],
            'tags' => ['required', 'array', 'min:1', 'exists:tags,id']
        ]);

        // Guardar el post
        $post = Post::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'imagen' => $request->imagen ? $request->imagen->store('posts') : "posts/default.jpg",
            'estado' => $request->estado ? 'publicado' : 'borrador',
        ]);

        // Asignar al posts que acabamos de guardar los tags que recibimos del formulario
        $post->tags()->attach($request->tags);

        return redirect()->route('posts.index')->with('info', 'Post creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.details', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $tagsPost = $post->getTagsId();
        $tags = Tag::select('id', 'nombre')->orderBy('nombre')->get();

        return view('posts.edit', compact('post', 'tags', 'tagsPost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Borrar la imagen asociada al post si no es la por defecto
        if (basename($post->imagen) != "default.jpg") {
            Storage::delete($post->imagen);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('info', 'Post borrado correctamente');
    }
}
