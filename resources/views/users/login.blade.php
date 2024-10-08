@extends('layouts.indexFront')
@section('layoutbody')

<!DOCTYPE html>
<html lang="en">
<head>
    <title>E-commerce</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f7f7f7;
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .login-form {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-form h3 {
            margin-bottom: 30px;
            font-weight: 600;
        }

        .login-form input {
            margin-bottom: 20px;
        }

        .social {
            display: flex;
            justify-content: space-between;
        }

        .social div {
            width: 48%;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            background-color: #f1f1f1;
            cursor: pointer;
        }

        .social div:hover {
            background-color: #ddd;
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
    </style>
</head>
<body>
    <div class="login-container">
        <form action="{{ route('user.login') }}" method="POST" id="loginForm" class="login-form">
            @csrf
            <h3>Login Here</h3>
        
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" placeholder="Email or Phone" id="username" name="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" id="password" name="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary btn-block">Log In</button>

            <div class="social mt-4">
                <div class="google"><i class="fab fa-google"></i> Google</div>
                <div class="fb"><i class="fab fa-facebook"></i> Facebook</div>
            </div>

            <div class="signup-link mt-3">
                <p>Don't have an account? <a href="{{route('user.create')}}">Sign Up</a></p>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(event) {
                event.preventDefault(); 
                let form = $(this);
                let formData = new FormData(this);

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response.user);
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            showConfirmButton: true,
                            timer: 2000, 
                            timerProgressBar: true,
                        });
                    },
                    error: function(xhr) {
                        let errorMessage = 'Something went wrong!';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        // Swal.fire({
                        //     icon: 'error',
                        //     title: 'Error!',
                        //     text: errorMessage,
                        //     showConfirmButton: true
                        // });
                    }
                });
            });
        });
    </script>
</body>
</html>

@endsection
