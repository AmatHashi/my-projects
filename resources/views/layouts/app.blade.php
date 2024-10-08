<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        .navbar {
            position: fixed;
            width: 100%; 
            height: 20px;
            top: 0;
            left: 0;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: burlywood;
            color: #fff;
            /* display: flex;
            justify-content: center; 
            align-items: center; */
            height: 65px; 
        }
        .navbar-brand {
            color: #fff;
            margin: 0;
            font-size: 1.5rem; 
        }
        #sidebar-wrapper {
            position: fixed;
            top: 56px; 
            bottom: 0;
            left: 0;
            width: 200px;
            z-index: 999; 
            box-shadow: 4px 0 6px rgba(0, 0, 0, 0.1);
            background-color: burlywood;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .sidebar-wrapper{
            margin-top: 20px;

        }
        .list-group {
            width: 100%; 
        }
        .sidebar-item {
            transition: background-color 0.3s ease;
            text-align: center;
        }
        .sidebar-item:hover {
            background-color: rgb(224, 209, 191);
        }
        .sidebar-item a {
            text-decoration: none;
            color: #fff;
        }
        .sidebar-item a:hover {
            color: #ffeb3b;
        }
        .flex-grow-1 {
            margin-left: 200px; 
            padding-top: 56px; 
            padding-left: 15px;
            padding-right: 15px;
        }
        .user-info {
            color: #fff;
            margin-left: 20px;
            font-weight: bold;
            font-size: 20px
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1 class="navbar-brand text-white">E-commerce</h1>
            <div class="d-flex align-items-center">
                {{-- <span class="user-info">{{Auth::user()->username}}</span> --}}
            </div>
        </div>
    </nav>

    <div id="sidebar-wrapper">
        <div class="list-group list-group-flush mt-3">
            <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action sidebar-item fs-5">Products</a>
            <a href="{{route('category.index')}}" class="list-group-item list-group-item-action sidebar-item fs-5">Category</a>
            <a href="{{route('orders.all')}}" class="list-group-item list-group-item-action sidebar-item fs-5">Orders</a>
            <a href="{{route('all.contact')}}" class="list-group-item list-group-item-action sidebar-item fs-5">Messages</a>
        </div>
    </div>
    <div class="flex-grow-1 p-4">
        @yield('content')
    </div>

    {{-- @yield('page_js')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>
