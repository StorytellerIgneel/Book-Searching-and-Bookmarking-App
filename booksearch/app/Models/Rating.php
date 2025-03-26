<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    /** @use HasFactory<\Database\Factories\RatingFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'book_id', 
        'score',
    ];

    // Get the user who give the rating
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    // Get the book that was rated
    public function book(): BelongsTo{
        return $this->belongsTo(Book::class);
    }

}
