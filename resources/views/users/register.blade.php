<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h2>Registration Form</h2>
        <form action="{{route('user.store')}}" method="POST" id="signup">
            @csrf
            <div class="form-group">
                <label for="username">fullname</label>
                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter fullname" >
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" >
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" >
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" >
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
    <script>
        $(document).ready(function(){
            $('#signup').on('submit', function(e){
                e.preventDefault();
                let formData = $(this).serialize();
                let url = '{{route("user.store") }}';
                
                $.ajax({
                    url: url, 
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        
                    },
                    error: function(xhr,error) {
                        console.error('Error occurred:', status, error);
                        console.error('Response text:', xhr.responseText);

                    },
                }); 
            });

        })
    </script>


</body>
</html>
