<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'contenido', 'estado', 'imagen', 'user_id', 'category_id'];

    // Relacion 1:N con users
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relacion 1:N con users
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function titulo(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucfirst($value)
        );
    }

    // Accessors and mutators
    public function contenido(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucfirst($value)
        );
    }
}
