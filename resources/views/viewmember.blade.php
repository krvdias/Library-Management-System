@extends('layouts.main')

@section('title', 'View Members')

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

        {{-- Search Bar --}}
        <div class="search-bar align-right mb-4" style="display: flex; justify-content: flex-end;">
            <form method="GET" action="{{ route('member.search') }}" class="flex">
                <input
                    type="text"
                    name="search"
                    value="{{ request()->query('search') }}"
                    placeholder="Search by name, email, or phone"
                />
                <button type="submit" class="search-button">Search</button>
            </form>
        </div>

        {{-- Scrollable Data Table --}}
        <div class="data-table">
            <table class=" divide-y divide-brown-200 bg-white rounded-lg shadow-lg">
                <thead class="table-header">
                    <tr>
                        <th id="member" class="table-data-member">ID</th>
                        <th id="member" class="table-data-member">Name</th>
                        <th id="member" class="table-data-member">Email</th>
                        <th id="member" class="table-data-member">Phone</th>
                        <th id="member" class="table-data-member">Address</th>
                        <th id="member" class="table-data-member">Role</th>
                        <th id="member" class="table-data-member">Register Date</th>
                        <th class="table-data-member" >Action</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @forelse($members as $person)
                        <tr data-id="{{ $person->id }}">
                            <td class="table-data-member" >{{ $person->id ?? 'N/A'}}</td>
                            <td class="table-data-member" >{{ ucfirst($person->name) }}</td>
                            <td class="table-data-member" >{{ $person->email ?? 'N/A'}}</td>
                            <td class="table-data-member" >{{ $person->mobile ?? 'N/A'}}</td>
                            <td class="table-data-member" >{{ $person->address ?? 'N/A' }}</td>
                            <td class="table-data-member" >{{ $person->role ?? 'N/A' }}</td>
                            <td class="table-data-member" >{{ $person->membership_date ?? 'N/A' }}</td>
                            <td class="table-data-member whitespace-nowrap">
                                <div class="action-buttons inline-form-group">
                                    <a href="{{ route('member.edit', $person->id) }}" class="btn-custom">Edit</a>
                                    <form action="{{ route('member.destroy', $person->id) }}" method="POST" id="delete-form" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-custom" id="delete">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="no-data">No members found!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="inline-group">
            <div class="btn">
                <a href="{{ route('welcome') }}">Home</a>
            </div>
            {{-- Add Member Button --}}
            <div class="add-member-button">
                <a href="{{ route('addmember') }}">Add Member</a>
            </div>
        </div>
    </div>

    <script>
        // Select all delete buttons and attach event listeners
            document.querySelectorAll('.btn-custom#delete').forEach(button => {
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
