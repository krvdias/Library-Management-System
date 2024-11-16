<!-- resources/views/dashboard.blade.php -->
@extends('layouts.main')

@section('title', 'Collect Book')

@section('content')

    <div class="custom">

        <div class="form">
        <form method="POST" action="{{route('book.collect')}}" class="form">
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

            <div class="form-error text-center ">
                @error('book_id')
                    <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 inline-form-group">
                <label for="book_id" class="form-label">Book ID :</label>
                <input type="book_id" name="book_id" class="form-control" id="book_id" placeholder="Enter Book ID" required>
            </div>

            <div class="inline-group">
                <div class="btn">
                    <a href="{{ route('welcome') }}">Home</a>
                </div>
                <button type="submit" value="collect" class="btn-add">Collect Now</button>
            </div>

        </form>
        </div>

    </div>

@endsection