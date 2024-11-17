<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookBarrowController extends Controller
{
    //get all the books from book table
    public function get($id) 
    {

        $book = Book::findOrFail($id);

        return view('borrowbook', compact('book'));
    }

    //barrow book
    public function barrow(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        //find book using book_id
        $book = Book::findOrFail($id);
        //if book copies less than 1 canot barrow
        $bookCopies = $book->copies;

        if ($bookCopies < 1) {
            return redirect()->route('book.get', $id)->with('error', 'Book Cannot Barrow');
        }

        //save the detail of barrow book to book_barrows table
        Book_Borrow::create([
            'user_id' => $request->user_id,
            'book_id' => $id,
            'barrow_date' => DB::raw('CURRENT_DATE'),
            'due_date' => DB::raw('DATE_ADD(CURRENT_DATE, INTERVAL 14 DAY)'),
        ]);
        
        //after barrow a book book copies less than 1 availability change 'empty'
        if($bookCopies < 1) {
            $book->update([
                'availability' => 'empty',
            ]);
        } else {
            //else book count minimize by 1
            $book->update([
                'copies' => $bookCopies - 1,
            ]);
        }

        return redirect()->route('books.index')->with('success', 'Book barrow successfully!');
    }
}
