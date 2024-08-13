<!DOCTYPE html>
<html>
<head>
    <title>E-commerce</title>
    <link rel="stylesheet" href="{{asset('assets/css/mystyle.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	

			<div class="signup">
				<form action="{{route('user.store')}}" method="POST">
                    @csrf
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="fullname" placeholder="User fullname" required="">
					<input type="text" name="username" placeholder="User name" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button>Sign up</button>
				</form>
			</div>

			
	</div>
</body>
</html>