<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book_Borrow extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'barrow_date',
        'due_date',
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
