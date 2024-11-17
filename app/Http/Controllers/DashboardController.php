<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\User;


class DashboardController extends Controller
{
    //send the data to home page cards
    public function index()
    {
        // Fetch data for the dashboard summary
        $totalUsers = User::where('role','!=','admin')->count();
        $totalBooks = Book::count();
        $availableBooks = Book::where('availability', 'available')->count();

        //get the book copies count of all the books
        $allBookCopies = Book::pluck('copies');
        $totalCopies = 0;

        foreach ($allBookCopies as $copies) {
            $totalCopies += $copies; // Add each book's copies to the total
        }


        $barrowedBooks = Book::where('availability', 'empty')->count();
        $recentRegistrations = User::latest()->take(5)->get();

        // Pass data to the view
        return view('welcome', compact('totalUsers', 'totalBooks', 'availableBooks','totalCopies', 'recentRegistrations'));
    }
}
