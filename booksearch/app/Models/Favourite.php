<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
    ];
    
    // Get the user who favourited the book
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    // Get the book favourited by the user
    public function book(): BelongsTo{
        return $this->belongsTo(Book::class);
    }
}