<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Sidebar Layout</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">E-commerce</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                
            </div>
        </div>
    </nav>

    <div class="d-flex">
        <div class="bg-info border-right" id="sidebar-wrapper" style="width: 200px; height: 100vh;">
            <div class="list-group list-group-flush mt-3">
                <a href="{{ route('products') }}" class="list-group-item list-group-item-action bg-light fs-5">Products</a>
                <a href="{{ route('categories') }}" class="list-group-item list-group-item-action bg-light fs-5">Category</a>
                <a href="{{ route('orders') }}" class="list-group-item list-group-item-action bg-light fs-5">Orders</a>
                <a href="{{route('customers')}}" class="list-group-item list-group-item-action bg-light fs-5">Customers</a>
            </div>
        </div>

        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>
    @yield('page_js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
