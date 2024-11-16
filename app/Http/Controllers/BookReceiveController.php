<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_Receive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookReceiveController extends Controller
{
    public function collect(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'book_id' => 'required|integer',
        ]);

        Book_Receive::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'return_date' => DB::raw('CURRENT_DATE'),
        ]);
        
        $book = Book::findOrFail($request->book_id);
        $bookCopies = $book->copies + 1;
        
        if($bookCopies < 1) {
            $book->update([
                'availability' => 'empty',
            ]);
        } else {
            $book->update([
                'copies' => $bookCopies,
                'availability' => 'available',
            ]);
        }

        return redirect()->route('collectbook')->with('success', 'Book collected successfully!');
    }

    public function index()
    {
        $books = Book::with([
            'book_borrow' => function ($query) {
                $query->latest(); // Fetch latest borrow record
            },
            'book_borrow.user', // Include the user related to the borrow
            'book_receive' => function ($query) {
                $query->latest(); // Fetch latest receive record
            },
        ])->get();

        $booksData = $books->map(function ($book) {
            $latestBorrow = $book->book_borrow->first(); // Latest borrow
            $latestReceive = $book->book_receive->first(); // Latest receive
        
            return [
                'ISBN' => $book->ISBN,
                'Title' => $book->title,
                'Member' => $latestBorrow?->user?->name ?? 'N/A',
                'BorrowDate' => $latestBorrow?->barrow_date ?? 'N/A',
                'DueDate' => $latestBorrow?->due_date ?? 'N/A',
                'ReturnDate' => $latestReceive?->return_date ?? 'N/A',
            ];
        });

        return view('barrowhistory', compact('booksData'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        // Search for books based on ISBN (and optionally Title or Author)
        $booksData = Book::with(['book_borrow.user', 'book_receive.user'])
            ->where('ISBN', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->orWhere('author', 'like', "%{$query}%")
            ->get()
            ->map(function ($book) {
                return [
                    'ISBN' => $book->ISBN,
                    'Title' => $book->title,
                    'Member' => optional($book->book_borrow->first()?->user)->name ?? 'N/A',
                    'BorrowDate' => optional($book->book_borrow->first())->barrow_date ?? 'N/A',
                    'DueDate' => optional($book->book_borrow->first())->due_date ?? 'N/A',
                    'ReturnDate' => optional($book->book_receive->first())->return_date ?? 'N/A',
                ];
            });

        return view('barrowhistory', compact('booksData'));
    }

}
