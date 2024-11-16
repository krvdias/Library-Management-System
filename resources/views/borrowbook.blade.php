<!-- resources/views/dashboard.blade.php -->
@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="custom">
        <div class="details">
            <h1 class="title">Title : {{$book->title ?? 'N/A'}}</h1>
            <h5 class="author">Author : {{$book->author ?? 'N/A'}}</h5>
        </br>   

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="inline-form-group">
                        <label for="ISBN" class="form-label">ISBN: <span>{{ $book->ISBN ?? 'N/A' }}</span></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="inline-form-group">
                        <label for="category" class="form-label">Category: <span>{{ $book->category ?? 'N/A' }}</span></label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="inline-form-group">
                        <label for="copies" class="form-label">Copies: <span>{{ $book->copies ?? 'N/A' }}</span></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="inline-form-group">
                        <label for="availability" class="form-label">Availability: <span>{{ $book->availability ?? 'N/A' }}</span></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form">
            <form method="POST" action="{{route('book.barrow', $book->id)}}" class="form">
                @csrf
                    <div class="form-error text-center text-shadow">
                    @error('user_id')
                        <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="mb-3 inline-form-group">
                        <label for="user_id" class="form-label">User ID :</label>
                        <input type="text" name="user_id" class="form-control" id="user_id" placeholder="Enter User ID" required>
                    </div>

                    <div class="inline-group">
                    <div class="btn">
                        <a href="{{ route('books.index') }}">Back</a>
                    </div>
                        <button type="submit" value="add" class="btn-add">Barrow</button>
                    </div>
            </form>
        </div>
    </div>
@endsection