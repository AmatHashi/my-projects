<!doctype html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('') }}login/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        .password-container {
            position: relative;
        }
        .password-container .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .error{
            color: red
        }
    </style>
</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Login</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-user-o"></span>
                    </div>
                    <h3 class="text-center mb-4">Sign In</h3>
                    <form action="{{ route('user.login') }}" method="POST" class="login-form" id="loginForm">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control rounded-left" placeholder="Email" name="email" value="{{ old('email') }}">
                            @error('email')
                            <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group password-container">
                            <input type="password" id="password" class="form-control rounded-left" placeholder="Password" name="password">
                            <span class="fa fa-eye toggle-password" onclick="togglePasswordVisibility()"></span>
                            @error('password')
                            <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
                        </div>
                    </form>
                    {{-- @if(session('errors'))
                        @if($errors->has('email'))
                            <p class="error">{{ $errors->first('email') }}</p>
                        @endif
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('') }}login/js/jquery.min.js"></script>
<script src="{{ asset('') }}login/js/popper.js"></script>
<script src="{{ asset('') }}login/js/bootstrap.min.js"></script>
<script src="{{ asset('') }}login/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

//   document.getElementById('loginForm').addEventListener('submit', function (e) {
//         e.preventDefault(); 

//         const formData = new FormData(this);

//         fetch(this.action, {
//             method: 'POST',
//             body: formData,
//             headers: {
//                 'X-Requested-With': 'XMLHttpRequest',
//                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
//             }
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 window.location.href = data.url; 
//             }
//             // } if (data.message) {
//             //     Swal.fire({
//             //         icon: 'error',
//             //         title: 'Login Failed',
//             //         text: data.message ,
//             //         timer: 3000,
//             //         timerProgressBar: true,
//             //         showConfirmButton: false,

//             //     });
//             // }
//         })
//         .catch(error => {
//             console.error('Error:', error);
           
//         });
//     });

    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const togglePassword = document.querySelector('.toggle-password');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePassword.classList.remove('fa-eye');
            togglePassword.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            togglePassword.classList.remove('fa-eye-slash');
            togglePassword.classList.add('fa-eye');
        }
    }
</script>
</body>
</html>


{{-- <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        eyeIcon.classList.toggle('fa-eye'); // Show password
        eyeIcon.classList.toggle('fa-eye-slash'); // Hide password
    });
</script> --}}

</body>
</html>
