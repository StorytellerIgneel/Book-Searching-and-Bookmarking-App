<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'synopsis',
        'author_id',
        'cover_image_link',
    ];

    // Get the author of the book
    public function author(): BelongsTo{
        return $this->belongsTo(Author::class);
    }

    // Get all ratings associated with the book
    public function ratings(): HasMany{
        return $this->hasMany(Rating::class);
    }

    // Get all favourites record for the book
    public function favourites(): HasMany{
        return $this->hasMany(Favourite::class);
    }
}
