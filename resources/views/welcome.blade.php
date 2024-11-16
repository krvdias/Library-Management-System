@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4" style="color: white; font-weight: 700; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);" >Dashboard Summary</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title" style="color: white;">Total Members</h5>
                    <h2 class="card-text" style="color: white;">{{ $totalUsers }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title" style="color: white;">Total Books</h5>
                    <h2 class="card-text" style="color: white;">{{ $totalBooks }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title" style="color: white;">Available Books</h5>
                    <h2 class="card-text" style="color: white;">{{ $availableBooks }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title" style="color: white;">All Book Copies</h5>
                    <h2 class="card-text" style="color: white;">{{ $totalCopies }}</h2>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mt-5" style="color: white; font-weight: 700; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Recent Registrations</h3>
    <ul class="list-group mt-3">
        @foreach ($recentRegistrations as $user)
            <li class="list-group-item">
                {{ $user->name }} - {{ $user->email }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
