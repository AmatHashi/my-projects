
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <input type="text" id="search" placeholder="Search products">         
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal" data-bs-whatever="@mdo">Create New Product</button>
    </div>
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

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="product-list">
            @php
            $counter = 1;
           @endphp
            @foreach($products as $product)
                <tr class="product-item">
                    <td> {{ $counter++ }} </td>
                    <td>{{ $product->name }}</td>
                     <td>{{ $product->mycat->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail rounded" style="width: 40px; height: 40px; border-radius: 50%;">
                    </td>
                    <td>
                        {{-- <a href="{{ route('product.show', $product->id) }}" class="btn btn-info btn-sm">View</a> --}}
                        <a href="#" onclick="updatefn({{ $product->id }})" class="btn btn-info btn-sm">Update</a>
                        <a href="{{ route('product.delete', $product->id) }}" class="btn btn-danger btn-sm">Delete</a>  
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Create property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                    @csrf                
                    <div class="form-group">
                        <label for="name">Category</label>
                        <select id="cat_id" name="cat_id" class="form-control">
                            <option value="">Choose category</option>
                            @foreach ($category as $row) 
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity">
                        @error('quantity')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price">
                        @error('price')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="discription">discription</label>
                        <input type="text" class="form-control" id="discription" name="discription">
                        @error('discription')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100" id="submitButton">Create</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_js')
<script>
    const updatefn = (id) => {
        let url = "{{ route('product.edit', ':id') }}";
        url = url.replace(':id', id);
        $.get(url)
            .done((data) => {
                $("#name").val(data.name);
                $("#quantity").val(data.quantity);
                $("#price").val(data.price);

                let updateUrl = "{{ route('products.update', ':id') }}";
                updateUrl = updateUrl.replace(':id', id);
                $("#productForm").attr("action", updateUrl);
                $('#productModal').modal('toggle');
            })
            .fail((error) => {
                console.error('Error fetching data:', error);
            });
    };
    $("#productModal").on("hidden.bs.modal",function(){
        $("#name").val("");
        $("#quantity").val("");
        $("#price").val("");
        $("#productForm").attr("action", "{{ route('products') }}");
    });
</script>
@endsection
