@extends('layouts.main')

@section('title', 'Member Edit')

@section('content')
    <div class="custom">

        <div class="form">
            <form method="POST" action="{{ route('member.update', $member->id) }}" class="form">
                @csrf
                @method('PUT') <!-- Add this for form update -->

                <div class="form-error text-center text-shadow">
                    @error('name')
                        <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 inline-form-group">
                    <label for="name" class="form-label">Name :</label>
                    <input type="text" name="name" class="form-control" id="username" placeholder="Enter Name" value="{{ old('name', $member->name) }}" required>
                </div>

                <div class="form-error text-center">
                    @error('email')
                        <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 inline-form-group">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{ old('email', $member->email) }}" required>
                </div>

                <div class="form-error text-center">
                    @error('mobile')
                        <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 inline-form-group">
                    <label for="mobile" class="form-label">Mobile :</label>
                    <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter Mobile No" value="{{ old('mobile', $member->mobile) }}" required>
                </div>

                <div class="form-error text-center">
                    @error('address')
                        <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 inline-form-group">
                    <label for="address" class="form-label">Address :</label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address" value="{{ old('address', $member->address) }}" required>
                </div>

                <h6>Not Required</h6>
                <div class="not-required">
                        <div class="form-error text-center">
                            @error('password')
                                <div class="text-danger fw-bold" style="font-size: 1.1rem;">{{ $message }}</div>
                            @enderror
                        </div>
                    <div class="inline-form-group">
                        <label for="role" class="requir-label">Role :</label>
                        <select class="form-role" name="role">
                            <option value="">Select Option</option>
                            <option value="admin" {{ old('role', $member->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="member" {{ old('role', $member->role) == 'member' ? 'selected' : '' }}>Member</option>
                        </select>
                        <label for="password" class="requir-label">Password :</label>
                        <input type="password" name="password" class="requir-control" id="password" value="{{ old('password'), '12345678' }}">
                    </div>
                </div>

                <div class="inline-group">
                    <div class="btn">
                        <a href="{{ route('members.index') }}">Back</a>
                    </div>
                    <button type="submit" class="btn-add">Update Now</button>
                </div>

            </form>
        </div>

    </div>
@endsection
