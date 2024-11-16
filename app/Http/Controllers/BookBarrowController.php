<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookBarrowController extends Controller
{
    public function get($id) 
    {

        $book = Book::findOrFail($id);

        return view('borrowbook', compact('book'));
    }

    public function barrow(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        $book = Book::findOrFail($id);
        $bookCopies = $book->copies;

        if ($bookCopies < 1) {
            return redirect()->route('book.get', $id)->with('error', 'Book Cannot Barrow');
        }

        Book_Borrow::create([
            'user_id' => $request->user_id,
            'book_id' => $id,
            'barrow_date' => DB::raw('CURRENT_DATE'),
            'due_date' => DB::raw('DATE_ADD(CURRENT_DATE, INTERVAL 14 DAY)'),
        ]);
        
        if($bookCopies < 1) {
            $book->update([
                'availability' => 'empty',
            ]);
        } else {
            $book->update([
                'copies' => $bookCopies - 1,
            ]);
        }

        return redirect()->route('books.index')->with('success', 'Book barrow successfully!');
    }
}
