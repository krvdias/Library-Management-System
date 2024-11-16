<!-- resources/views/dashboard.blade.php -->
@extends('layouts.main')

@section('title', 'Add Book')

@section('content')

    <div class="custom">

        <div class="form">
        <form method="POST" action="{{route('book.add')}}" class="form">
        @csrf
            <div class="form-error text-center text-shadow">
                @error('ISBN')
                    <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 inline-form-group">
                <label for="ISBN" class="form-label">ISBN :</label>
                <input type="text" name="ISBN" class="form-control" id="ISBN" placeholder="Enter ISBN" required>
            </div>

            <div class="form-error text-center ">
                @error('category')
                    <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 inline-form-group">
                <label for="category" class="form-label">Category :</label>
                <input type="category" name="category" class="form-control" id="category" placeholder="Enter Category" required>
            </div>

            <div class="form-error text-center">
                @error('title')
                    <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 inline-form-group">
                <label for="title" class="form-label">Title :</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title " required>
            </div>

            <div class="form-error text-center">
                @error('author')
                    <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 inline-form-group">
                <label for="author" class="form-label">Author :</label>
                <input type="text" name="author" class="form-control" id="author" placeholder="Enter Author" required>
            </div>

            <div class="form-error text-center">
                @error('copies')
                    <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 inline-form-group">
                <label for="copies" class="form-label">Copies :</label>
                <input type="text" name="copies" class="form-control" id="copies" placeholder="Copies Amount" required>
            </div>

            <div class="inline-group">
                <div class="btn">
                    <a href="{{ route('welcome') }}">Home</a>
                </div>
                <button type="submit" value="add" class="btn-add">Add Now</button>
            </div>

        </form>
        </div>

    </div>

@endsection