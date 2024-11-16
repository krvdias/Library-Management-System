@extends('layouts.main')

@section('title', 'Book Details')

@section('content')
    <div class="custom">

            <!-- Delete Confirmation Modal -->
            <div class="modal-overlay" id="delete-confirmation-modal" style="display: none;">
                <div class="modal-content">
                    <p1>Are you sure you want to delete?</p1>
                    <div class="modal-buttons">
                        <button id="confirm-delete" class="custom-btn">Yes, Delete</button>
                        <button id="cancel-delete" class="custom-btn btn-cancel">Cancel</button>
                    </div>
                </div>
            </div>

        <div class="form">
            <form method="POST" action="{{ route('book.update', $book->id) }}" class="form">
                @csrf
                @method('PUT') <!-- Add this for form update -->

                <div class="form-error text-center text-shadow">
                    @error('ISBN')
                        <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 inline-form-group">
                    <label for="ISBN" class="form-label">ISBN :</label>
                    <input type="text" name="ISBN" class="form-control" id="ISBN" placeholder="Enter ISBN" value="{{ old('ISBN', $book->ISBN) }}" required>
                </div>

                <div class="form-error text-center">
                    @error('category')
                        <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 inline-form-group">
                    <label for="category" class="form-label">Category :</label>
                    <input type="category" name="category" class="form-control" id="category" placeholder="Enter Category" value="{{ old('category', $book->category) }}" required>
                </div>

                <div class="form-error text-center">
                    @error('title')
                        <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 inline-form-group">
                    <label for="title" class="form-label">Title :</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" value="{{ old('title', $book->title) }}" required>
                </div>

                <div class="form-error text-center">
                    @error('author')
                        <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 inline-form-group">
                    <label for="author" class="form-label">Author :</label>
                    <input type="text" name="author" class="form-control" id="author" placeholder="Enter Author" value="{{ old('author', $book->author) }}" required>
                </div>

                <div class="form-error text-center">
                    @error('copies')
                        <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 inline-form-group">
                    <label for="copies" class="form-label">New Copies :</label>
                    <input type="text" name="copies" class="form-control" id="copies" placeholder="Add New Copies Amount" value="{{ old('copies', $book->copies) }}" required>
                </div>

                <div class="inline-group">
                    <div class="btn">
                        <a href="{{ route('books.index') }}">Back</a>
                    </div>
                    <button type="submit" class="btn-add">Update Now</button>
                </div>
            </form>
            <div style="display: flex; justify-content: flex-end;">
                <form action="{{ route('book.destroy', $book->id) }}" method="POST" id="delete-form" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button id="delete" type="submit" class="btn-add">Delete</button>
                </form>
            </div>

        </div>

    </div>

    <script>
        // Select all delete buttons and attach event listeners
            document.querySelectorAll('.btn-add#delete').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent immediate form submission
                    document.getElementById('delete-confirmation-modal').style.display = 'flex'; // Show modal
                    
                    // Set the form to submit when confirmed
                    document.getElementById('confirm-delete').onclick = function() {
                        button.closest('form').submit(); // Submit the form related to the clicked button
                    };
                });
            });

            // Hide modal when cancel is clicked
            document.getElementById('cancel-delete').addEventListener('click', function() {
                document.getElementById('delete-confirmation-modal').style.display = 'none'; // Hide modal
            });

    </script>
@endsection
