<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyLibrary extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public static function getThisList($user_id, $book_id)
    {
        return (new static)::where('user_id', '=', $user_id)
            ->where('book_id', '=', $book_id)
            ->first();
    }
}
