<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Google Font Import for Holtwood One SC -->
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">

    <!-- Bootstrap Style Import -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/background.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            flex-direction: column;
        }
        .welcome-container {
            margin-bottom: 20px; 
            text-align: center;
            text-size-adjust: xl;
        }
        .welcome-container h1 {
            font-family: 'Holtwood One SC', serif;
            font-size: 110px;
            font-weight: bold;
            letter-spacing: 2px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
            padding: 60px;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.4);
            padding: 30px;
            margin-bottom: 50px;
            border-radius: 15px;
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        .inline-form-group {
            display: flex;
            align-items: center;
            justify-content: flex-start; 
            gap: 10px; 
            width: 100%; 
        }

        .form-label {
            font-family: 'Arial', sans-serif;
            min-width: 120px; 
            text-align: left; 
            font-size: 20px;
            font-weight: bold;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
            color: white;
            -webkit-text-stroke: 1px black;
        }

        .form-control {
            border-radius: 15px;
            border: 3px solid #E7B342;
            flex: 1; /* Ensures the input field takes up remaining space */
            max-width: 300px; /* Adjust as needed for input width consistency */
        }
        .btn-custom {
            background-color: #d27d2d;
            color: #fff;
            border-radius: 20px;
            border: none;
        }
        .btn-custom:hover {
            background-color: #b25c1c;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>WELCOME</h1>
    </div>
    
    <div class="login-container">
        <form method="POST" action="{{route('user.logIn')}}" class="form">
        @csrf
            <div class="mb-3 inline-form-group">
                <label for="username" class="form-label">User Name :</label>
                <input type="text" name="email" class="form-control" id="username" placeholder="Enter Name">
            </div>
            <div class="mb-3 inline-form-group">
                <label for="password" class="form-label">Password :</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="text-center">
                <button type="submit" value="logIn" class="btn btn-custom px-5">Enter Now</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
