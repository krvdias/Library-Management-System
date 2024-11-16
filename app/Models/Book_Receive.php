<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book_Receive extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'return_date',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
