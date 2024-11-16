<?php

use App\Http\Controllers\BookBarrowController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookReceiveController;
use App\Http\Controllers\DashboardController;
use App\Models\Book_Borrow;

//first page login
Route::get('/', function () {
    return view('login');
})->name('login');

//post credintials
Route::post('/login/post', [LoginController::class, 'logIn'])->name('user.logIn');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

//direct to home page

Route::middleware(['auth'])->group(function () {
    
    Route::get('/welcome', [DashboardController::class, 'index'])->name('welcome');

    //member crud
    Route::get('/addmember', function () {
        return view('addmember');
    })->name('addmember');

    Route::post('/addmember/post', [MemberController::class, 'add'])->name('member.add');
    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('member.destroy');
    Route::get('/members/search', [MemberController::class, 'search'])->name('member.search');
    Route::put('/members/update/{id}', [MemberController::class, 'update'])->name('member.update');
    Route::get('members/edit/{id}', [MemberController::class, 'edit'])->name('member.edit');

    //books crud
    Route::get('/addbook', function () {
        return view('addbook');
    })->name('addbook');

    Route::post('/addbook/post', [BookController::class, 'add'])->name('book.add');
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('/books/search', [BookController::class, 'search'])->name('book.search');
    Route::put('/books/update/{id}', [BookController::class, 'update'])->name('book.update');
    Route::get('books/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::get('book/view/{id}', [BookController::class, 'view'])->name('book.view');
    Route::get('/books/available', [BookController::class, 'available'])->name('books.available');
    Route::get('/books/empty', [BookController::class, 'empty'])->name('books.empty');

    //barrow crud
    Route::get('book/get/{id}', [BookBarrowController::class, 'get'])->name('book.get');
    Route::post('/book/barrow/{id}', [BookBarrowController::class, 'barrow'])->name('book.barrow');

    //collect crud
    Route::get('/collectbook', function () {
        return view('collectbook');
    })->name('collectbook');

    Route::post('/book/collect',[BookReceiveController::class, 'collect'])->name('book.collect');

    //history crud
    Route::get('/history',[BookReceiveController::class, 'index'])->name('history.index');
    Route::get('/history/search',[BookReceiveController::class, 'search'])->name('history.search');
});
