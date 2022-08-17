<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $casts = [
    //     'book_id'  => 'int',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id')->withDefault();
    }

    public static function getThisReview($user_id, $book_id)
    {
        return (new static)::with('user', 'book')->where('user_id', '=', $user_id)
            ->where('book_id', '=', $book_id)
            ->first();
    }
}
