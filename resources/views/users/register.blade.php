@extends('layouts.indexFront')
@section('layoutbody')
<!DOCTYPE html>
<html>
<head>
    <title>E-commerce</title>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f7f7f7;
            font-family: 'Jost', sans-serif;
        }

        .signup-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .signup-form {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .signup-form h3 {
            margin-bottom: 30px;
            font-weight: 600;
        }

        .signup-form input {
            margin-bottom: 20px;
        }

        .signup-form button {
            width: 100%;
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
        }

        .signup-link a {
            text-decoration: none;
            color: #007bff;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .text-danger {
            color: red;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <form action="{{ route('user.store') }}" method="POST" class="signup-form">
            @csrf
            <h3>Sign Up</h3>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="User name" class="form-control">
                @error('username')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" class="form-control">
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="addres">Address</label>
                <input type="text" name="addres" placeholder="Address" class="form-control">
                @error('addres')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" class="form-control">
                @error('password')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Sign Up</button>

            <div class="signup-link mt-3">
                <p>Already have an account? <a href="{{ route('login') }}">Log In</a></p>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

@endsection

