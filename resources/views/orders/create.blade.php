{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <div class="container mt-5">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>Create Product</h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">category</label>
                                <select id="cat_id" name="cat_id" value="{{ old('cat_id') }}" class="form-control">
                                    <option value="">choose category</option>
                                    @foreach ($categories as $row)
                                        
                                    <option value="{{$row?->id}}">{{$row?->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" >
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="type">Quantity</label>
                                <input type="text" class="form-control" id="quantity" name="quantity" value="{{ old('qauntity') }}" >
                                @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                               @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">price</label>
                                <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" >
                                   @error('price')
                                 <div class="invalid-feedback">{{ $message }}</div>
                                   @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">image</label>
                                <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}" >
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                               @enderror
                            </div>
    
                            
                              <div class="form-group">
                                <label for="discription">discription</label>
                                <input type="text" class="form-control" id="disription" name="disription" value="{{ old('disription') }}">
                                @error('disription')
                                <div class="invalid-feedback">{{ $message }}</div>
                               @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    
</body>
</html> --}}
