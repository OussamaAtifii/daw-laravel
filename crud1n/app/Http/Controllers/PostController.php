<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(7);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'nombre')->orderBy('nombre')->get();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'min:4', 'unique:posts,titulo'],
            'contenido' => ['required', 'string', 'min:10'],
            'publicado' => ['nullable'],
            'category_id' => ['required', 'exists:categories,id'],
            'imagen' => ['nullable', 'image', 'max:2048']
        ]);

        // Si llegamos aquí, es que las validaciones han sido correctas
        // 1.- Guardar la imagen en la carpeta storage/app/public/posts
        $imgRuta = ($request->imagen) ? $request->imagen->store('posts') : 'posts/noimage.png';

        // 2.- Guardar los datos en la tabla posts
        Post::create([
            'titulo' => ucfirst($request->titulo),
            'contenido' => ucfirst($request->contenido),
            'publicado' => ($request->publicado) ? "SI" : "NO",
            'category_id' => $request->category_id,
            'imagen' => $imgRuta
        ]);

        return redirect()->route('posts.index')->with("info", "Post creado correctamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.detalle', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::getCategorias();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'titulo' => ['required', 'string', 'min:4', 'unique:posts,titulo,' . $post->id],
            'contenido' => ['required', 'string', 'min:10'],
            'publicado' => ['nullable'],
            'category_id' => ['required', 'exists:categories,id'],
            'imagen' => ['nullable', 'image', 'max:2048']
        ]);

        // Si llegamos aquí, es que las validaciones han sido correctas

        $imgRuta = $post->imagen;

        if ($request->imagen) {
            // Si el usuario ha subido una imagen nueva, borramos la antigua si no es la por defecto
            if (basename($post->imagen) != 'noimage.png') {
                Storage::delete($post->imagen);
            }

            $imgRuta = $request->imagen->store('posts');
        }

        $post->update([
            'titulo' => ucfirst($request->titulo),
            'contenido' => ucfirst($request->contenido),
            'publicado' => ($request->publicado) ? "SI" : "NO",
            'category_id' => $request->category_id,
            'imagen' => $imgRuta
        ]);

        return redirect()->route('posts.index')->with("info", "Post actualizado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (basename($post->imagen) != 'noimage.png') {
            Storage::delete($post->imagen);
        }

        $post->delete();
        return redirect()->route('posts.index')->with("info", "Post eliminado correctamente");
    }

    /**
     * Metodos para ver los posts de una categoria especifica que mandaremos por parametro
     */

    public function postsCategoria(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->paginate(5);
        $nombre = $category->nombre;
        return view('posts.postsCategoria', compact('nombre', 'posts'));
    }
}
