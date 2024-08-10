<!DOCTYPE html>
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
                        <h1>Create customers</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{route('customers.store')}}" method="POST">
                            @csrf
                           
                            <div class="form-group">
                                <label for="title">fullname</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}" >
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="type">email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" >
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                               @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" >
                                   @error('phone')
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
</html>
