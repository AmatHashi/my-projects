<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @extends('layouts.app')
    @section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center my-4">Product Details</h1>
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $product->name }}</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Price:</strong> ${{ $product->price }}</p>
                        <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
                        <p><strong>Discription:</strong> {{ $product->disription }}</p>
                        {{-- <p><strong>Category:</strong>{{$product->mycat->name}}</p> --}}
                        <p><strong>Image:</strong>      
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail rounded" style="width: 100px; height: 90px; border-radius: 50%;">
                        </p>

                    </div>
                </div>
                <a href="{{ route('products') }}" class="btn btn-secondary mt-3">Back to All Products</a>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>
