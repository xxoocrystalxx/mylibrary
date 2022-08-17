<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function rating()
    {
        return round($this->reviews()->avg('rating'), 2);
    }

    public static function orderByRating()
    {
        return (new static)::with('reviews')->selectRaw('books.*,AVG(reviews.rating) as rating_book')
            ->leftJoin('reviews', 'books.id', '=', 'reviews.book_id')
            ->groupBy('book_id', 'books.id')->orderByRaw('rating_book DESC nulls last');
    }
}
