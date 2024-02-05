<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Film extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'sinopsis', 'caratula', 'category_id', 'disponible'];

    // Relacion 1:N con category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Relacion N:M con tag
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    // Accessors y muttators
    public function nombre(): Attribute
    {
        return Attribute::make(
            set: fn ($v) => ucwords($v)
        );
    }

    public function sinopsis(): Attribute
    {
        return Attribute::make(
            set: fn ($v) => ucwords($v)
        );
    }
}
