@extends('layouts.main')

@section('title', 'View Books')

@section('content')
    <div class="custom">
        <div class="inline-group">
            <div class="btn-filter">
                <a href="{{ route('books.index') }}">All Books</a>
            </div>
            <div class="btn-filter">
                <a href="{{ route('books.available') }}">Available Books</a>
            </div>
            <div class="btn-filter">
                <a href="{{ route('books.empty') }}">Empty Books</a>
            </div>
        </div>

        {{-- Search Bar --}}
        <div class="search-bar align-right mb-4" style="display: flex; justify-content: flex-end;">
            <form method="GET" action="{{ route('book.search') }}" class="flex">
                <input
                    type="text"
                    name="search"
                    value="{{ request()->query('search') }}"
                    placeholder="Search by ISBN, Title and Author"
                />
                <button type="submit" class="search-button">Search</button>
            </form>
        </div>

        {{-- Scrollable Data Table --}}
        <div class="data-table">
            <table class=" divide-y divide-brown-200 bg-white rounded-lg shadow-lg">
                <thead class="table-header">
                    <tr>
                        <th class="table-data-book" >ID</th>
                        <th class="table-data-book" >ISBN</th>
                        <th class="table-data-book" >Category</th>
                        <th class="table-data-book" >TItle</th>
                        <th class="table-data-book" >Author</th>
                        <th class="table-data-book" >Copies</th>
                        <th class="table-data-book" >Availability</th>
                        <th class="table-data-book" >Action</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @forelse($books as $item)
                        <tr data-id="{{ $item->id }}">
                            <td class="table-data-book" >{{ $item->id ?? 'N/A'}}</td>
                            <td class="table-data-book" >{{ ucfirst($item->ISBN) }}</td>
                            <td class="table-data-book" >{{ $item->category ?? 'N/A'}}</td>
                            <td class="table-data-book" >{{ $item->title ?? 'N/A'}}</td>
                            <td class="table-data-book" >{{ $item->author ?? 'N/A' }}</td>
                            <td class="table-data-book" >{{ $item->copies ?? 'N/A' }}</td>
                            <td class="table-data-book" >{{ $item->availability ?? 'N/A' }}</td>
                            <td class="table-data-book whitespace-nowrap">
                                <div class="action-buttons inline-form-group">
                                    <a href="{{ route('book.get', $item->id) }}" class="btn-custom">Barrow</a>
                                    <a href="{{ route('book.view', $item->id) }}" class="btn-custom">View</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="no-data">No Books found!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="inline-group">
            <div class="btn">
                <a href="{{ route('welcome') }}">Home</a>
            </div>
            {{-- Add Book Button --}}
            <div class="add-member-button">
                <a href="{{ route('addbook') }}">Add Book</a>
            </div>
        </div>
    </div>
@endsection
