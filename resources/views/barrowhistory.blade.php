@extends('layouts.main')

@section('title', 'Barrow History')

@section('content')
    <div class="custom">

        {{-- Search Bar --}}
        <div class="search-bar align-right mb-4" style="display: flex; justify-content: flex-end;">
            <form method="GET" action="{{ route('history.search') }}" class="flex">
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
                        <th class="table-data-history px-8 py-2 " >ISBN</th>
                        <th class="table-data-history px-8 py-2" >TItle</th>
                        <th class="table-data-history px-8 py-2" >Member</th>
                        <th class="table-data-history px-8 py-2" >Barrow Date</th>
                        <th class="table-data-history px-8 py-2" >Due Date</th>
                        <th class="table-data-history px-8 py-2" >Return Date</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @forelse($booksData as $book)
                        <tr>
                            <td class="table-data-history px-8 py-2" >{{ $book['ISBN'] }}</td>
                            <td class="table-data-history px-8 py-2" >{{ $book['Title'] }}</td>
                            <td class="table-data-history px-8 py-2" >{{ $book['Member'] }}</td>
                            <td class="table-data-history px-8 py-2" >{{ $book['BorrowDate'] }}</td>
                            <td class="table-data-history px-8 py-2" >{{ $book['DueDate'] }}</td>
                            <td class="table-data-history px-8 py-2" >{{ $book['ReturnDate'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="no-data">No Books found!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="inline-group">
            <div class="btn">
                <a href="{{ route('welcome') }}">Home</a>
            </div>
        </div>
    </div>
@endsection
