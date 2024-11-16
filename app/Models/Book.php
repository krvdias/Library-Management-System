<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'ISBN',
        'category',
        'title',
        'author',
        'copies',
        'availability',
    ];

    public function book_borrow() 
    {
        return $this->hasMany(Book_Borrow::class);
    }

    public function book_receive()
    {
        return $this->hasMany(Book_Receive::class);
    }
}
