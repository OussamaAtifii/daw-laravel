<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    // Campos que se van a poder rellenar, modificar, borrar, etc....
    protected $fillable = ['titulo', 'contenido', 'publicado', 'imagen', 'category_id'];

    // Añadir la relación 1:N con la tabla categorias
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
