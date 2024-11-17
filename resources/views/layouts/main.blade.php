<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library Management System')</title>

    <!-- Google Font Import for Holtwood One SC -->
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">

    <!-- Bootstrap Style Import -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- custom Style Import -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Header -->
    <div class="header col-2">
        LIBRARY MANAGEMENT SYSTEM
    </div>

    <!-- Content Wrapper containing Sidebar and Main Content -->
    <div class="content-wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4>Hi! {{ Auth::user()->name }}..</h4>
            <div class="sidebar-buttons">
                <a href="{{ route('addmember') }}" class="btn">Add Member</a>
                <a href="{{ route('members.index') }}" class="btn">View Members</a>
                <a href="{{ route('addbook') }}" class="btn">Add Books</a>
                <a href="{{ route('books.index') }}" class="btn">All Books</a>
                <a href="{{ route('collectbook') }}" class="btn">Collect Books</a>
                <a href="{{ route('history.index') }}" class="btn">Barrow History</a>
            </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="margin-top: auto;">
            @csrf
            <button type="submit" id="logout">Log Out</button>
        </form>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Content section to be filled by child views -->
            @yield('content')

            <!-- Success Notification Modal -->
            @if(session('success'))
            <div class="modal-overlay">
                <div class="modal-content">
                    <img src="{{ asset('images/success.png') }}" alt="Success Tick" class="success-tick">
                    <p>{{ session('success') }}</p>
                </div>
            </div>
            @endif

            <!-- error notification model -->
            @if(session('error'))
            <div class="modal-overlay">
                <div class="modal-content">
                    <img src="{{ asset('images/caution.png') }}" alt="Caution" class="caution">
                    <p1>{{session('error')}}</p1>
                </div>
            </div>
            @endif

            <!-- Logout Confirmation Modal -->
            <div class="modal-overlay" id="logout-confirmation-modal" style="display: none;">
                <div class="modal-content">
                    <p>Are you sure you want to log out?</p>
                    <div class="modal-buttons">
                        <button id="confirm-logout" class="custom-btn">Yes, Log Out</button>
                        <button id="cancel-logout" class="custom-btn btn-cancel">Cancel</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="footer">
        
    </div>

    <script>
        //logout confirmation
        document.getElementById('logout').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent immediate form submission
            document.getElementById('logout-confirmation-modal').style.display = 'flex'; // Show modal
        });

        document.getElementById('confirm-logout').addEventListener('click', function() {
            document.getElementById('logout-form').submit(); // Submit if confirmed
        });

        document.getElementById('cancel-logout').addEventListener('click', function() {
            document.getElementById('logout-confirmation-modal').style.display = 'none'; // Hide modal
        });

        // notification
        function closeModal() {
                document.querySelector('.modal-overlay').style.display = 'none';
            }

            // Automatically close the modal after a few seconds
            setTimeout(closeModal, 2500); // 3000 ms = 3 seconds
        
            function toggleNotifications() {
            const notificationList = document.getElementById('notifications-list');
            notificationList.style.display = notificationList.style.display === 'block' ? 'none' : 'block';
        }

            
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
