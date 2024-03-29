<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'color'];

    // Relacion N:M con peliculas
    public function films(): BelongsToMany
    {
        return $this->belongsToMany(Film::class);
    }

    // Accesors y muttators
    public function nombre(): Attribute
    {
        return Attribute::make(
            set: fn ($v) => strtolower($v),
            get: fn ($v) => "#$v"
        );
    }
}
