<!-- resources/views/dashboard.blade.php -->
@extends('layouts.main')

@section('title', 'Add Member')

@section('content')

    <div class="custom">

        <div class="form">
        <form method="POST" action="{{route('member.add')}}" class="form">
        @csrf
            <div class="form-error text-center text-shadow">
                @error('name')
                    <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 inline-form-group">
                <label for="name" class="form-label">Name :</label>
                <input type="text" name="name" class="form-control" id="username" placeholder="Enter Name" required>
            </div>

            <div class="form-error text-center ">
                @error('email')
                    <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 inline-form-group">
                <label for="email" class="form-label">Email :</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
            </div>

            <div class="form-error text-center">
                @error('mobile')
                    <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 inline-form-group">
                <label for="mobile" class="form-label">Mobile :</label>
                <input type="text" name="mobile" class="form-control" id="mobile" placeholder="07XXXXXXXX" required>
            </div>

            <div class="form-error text-center">
                @error('address')
                    <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 inline-form-group">
                <label for="address" class="form-label">Address :</label>
                <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address" required>
            </div>

            <h6>Not Required</h6>
            <div class="not-required">
                <div class="inline-form-group">
                    <label for="name" class="requir-label">Role :</label>
                    <select class="form-role" name="role">
                        <option value="">Select Option</option>
                        <option value="admin" {{ old('role', 'member') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="member" {{ old('role', 'member') == 'member' ? 'selected' : '' }}>Member</option>
                    </select>

                    <label for="password" class="requir-label">Password :</label>
                    <input type="password" name="password" class="requir-control" id="password" value="{{ old('password', '12345678') }}">
                </div>
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