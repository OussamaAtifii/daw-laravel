<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('nombre')->paginate(5);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:3', 'unique:categories,nombre'],
            'descripcion' => ['required', 'string', 'min:10'],
        ]);

        Category::create([
            'nombre' => ucfirst($request->nombre),
            'descripcion' => ucfirst($request->descripcion)
        ]);

        return redirect()->route('categories.index')->with('info', "Categoria guardada correctamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:3', 'unique:categories,nombre,' . $category->id],
            'descripcion' => ['required', 'string', 'min:10'],
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('info', "Categoria modificada correctamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('info', "Categoria borrada correctamente");
    }
}
