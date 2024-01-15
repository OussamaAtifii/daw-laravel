<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // Campos que se van a poder rellenar, modificar, borrar, etc....
    protected $fillable = ['nombre', 'descripcion'];

    // Añadir la relación 1:N con la tabla posts
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    // Metodo estatico para obtener el nombre e id de todas las categorias
    public static function getCategorias()
    {
        return Category::select('id', 'nombre')->orderBy('nombre')->get();
    }
}
