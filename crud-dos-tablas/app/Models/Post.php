<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'contenido', 'imagen', 'publicado', 'category_id'];


    // Indicar la relacion 1:N con la tabla categories
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
