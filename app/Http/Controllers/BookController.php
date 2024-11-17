<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Events\NewNotification;

class BookController extends Controller
{
    // adding new book
    public function add(Request $request) {

        $request->validate([
            'ISBN' => 'required|string|max:255',
            'category' => 'required|string',
            'title' => 'required|string|max:15',
            'author' => 'required|string|max:255',
            'copies' => 'nullable|integer', 
        ]);

        //if book count is less than 1 availability 'empty'
        $copies = $request->copies;
        if ($copies < 1) {
            $status = 'empty';
        } else {
            $status = 'available';
        }
        
        Book::create([
            'ISBN' => $request->ISBN,
            'category' => $request->category,
            'title' => $request->title,
            'author' => $request->author,
            'copies' => $request->copies,
            'availability' => $status,
        ]);

        return redirect()->route('addbook')->with('success', 'Book added successfully!');
    }

    //get all the books in books table
    public function index()
    {
        $books = Book::all(); // Fetch all books
        return view('viewbook', compact('books'));
    }

    //get all books availability == 'available'
    public function available()
    {
        $books = Book::where('availability','available')->get(); 
        return view('viewbook', compact('books'));
    }

    //get all books availability == 'empty'
    public function empty()
    {
        $books = Book::where('availability','empty')->get();
        return view('viewbook', compact('books'));
    }

    //get book details according to book_id
    public function view($id)
    {
        $book = Book::where('id',$id)->first();

        return view('showbook', compact('book'));
    }

    //updating book details
    public function update(Request $request, $id)
    {
        $request->validate([
            'ISBN' => 'required|string|max:255',
            'category' => 'required|string',
            'title' => 'required|string|max:15',
            'author' => 'required|string|max:255',
            'copies' => 'nullable|integer', 
        ]);

        $book = Book::findOrFail($id);
        $bookCopies = $book->copies;
        $totalCopies = $bookCopies + $request->copies;

        if (!$totalCopies > 0) {
            $status = 'empty';
        } else {
            $status = 'available';
        }
        
        $book->update([
            'ISBN' => $request->ISBN,
            'category' => $request->category,
            'title' => $request->title,
            'author' => $request->author,
            'copies' => $request->copies,
            'availability' => $status,
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    // Delete a book
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }

    //search book according to ISBN, title and author
    public function search(Request $request)
    {
        $query = $request->input('search');

        $books = Book::where('ISBN', 'LIKE', '%' . $query . '%')
                    ->orWhere('title', 'LIKE', '%' . $query . '%')
                    ->orWhere('author', 'LIKE', '%' . $query . '%')
                    ->get();

        // Return the view with the search results
        return response()->view('viewbook',compact('books'));
    }
}
