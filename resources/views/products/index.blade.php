<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>    

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table th, table td {
            border-bottom: 1px solid #dee2e6;
            padding: 12px;
        }

        table thead th {
            border-bottom: 2px solid #007bff;
            background-color: #f8f9fa;
            color: #007bff;
        }

        .img-thumbnail {
            border-radius: 50%;
        }

        .btn-custom {
            border-radius: 60px;
            padding: 8px 16px;
        }

        .btn-custom:hover {
            opacity: 0.8;
        }

        .product-item td {
            vertical-align: middle;
        }

        .alert {
            margin-bottom: 20px;
        }
       

    </style>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4 ">
            <h3 class="mb-0">All Product List</h3>
            <button type="button" class="btn btn-primary btn-custom" data-bs-toggle="modal" data-bs-target="#productModal">
                <i class="fas fa-plus"></i> Create
            </button>
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
        <table class="table " id="tbl">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="product-list">
                @php
                $counter = 1;
                @endphp
                @foreach($products as $product)
                    <tr class="product-item">
                        <td>
                              @php
                                $images = json_decode($product->image, true); 
                                $firstImage = !empty($images) && isset($images[0]) ? $images[0] : 'default_image.jpg';
                               @endphp
                            <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ optional($product->mycat)->name ?? 'N/A' }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <a  class="btn btn-primary btn-custom updbtn"  data-id="{{$product->id}}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="{{route('products.delete', $product->id) }}" class="btn btn-danger btn-custom ml-2 delete-link" title="Delete">
                                <i class="fas fa-trash"></i>
                            </a>
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
                <h5 class="modal-title text-center ml-5" id="exampleModalLabel">add property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" id="productForm">
                    @csrf
        
                    <div class="form-group mb-3">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image"   name="images[]" accept="image/*" onchange="previewImage()"  multiple>
                        <div id="imagePreview" class="mt-2"></div>
                        @error('image')
                        <div class="invalid-feedback d-block">{{$message}}</div>
                        @enderror
                    </div>
        
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
        
                    <div class="form-group mb-3">
                        <label for="discription">Description</label>
                        <textarea class="form-control" id="discription" name="discription" rows="3"></textarea>
                        @error('discription')
                        <div class="invalid-feedback d-block">{{$message}}</div>
                        @enderror
                    </div>
        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="cat_id">Category</label>
                                <select id="cat_id" name="cat_id" class="form-control">
                                    <option value="">Choose category</option>
                                    @foreach ($category as $row) 
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price">
                                @error('price')
                                <div class="invalid-feedback d-block">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Sizes</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="sizes[]" value="S" id="sizeS">
                                    <label class="form-check-label" for="sizeS">S</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="sizes[]" value="M" id="sizeM">
                                    <label class="form-check-label" for="sizeM">M</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="sizes[]" value="L" id="sizeL">
                                    <label class="form-check-label" for="sizeL">L</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="sizes[]" value="XL" id="sizeXL">
                                    <label class="form-check-label" for="sizeXL">XL</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group mb-3">
                                <label>Colors</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="colors[]" value="Blue" id="colorBlue">
                                    <label class="form-check-label" for="colorBlue">Blue</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="colors[]" value="Red" id="colorRed">
                                    <label class="form-check-label" for="colorRed">Red</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="colors[]" value="Green" id="colorGreen">
                                    <label class="form-check-label" for="colorYellow">Green</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="colors[]" value="Black" id="colorBlack">
                                    <label class="form-check-label" for="colorYellow">Black</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="colors[]" value="White" id="colorWhite">
                                    <label class="form-check-label" for="colorYellow">White</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark pl-7" id="submitButton">Send</button>
                </form>  
            </div>
        </div>
    </div>
  </div>


{{-- product update form --}}
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center ml-5" id="exampleModalLabel">update property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  method="POST" enctype="multipart/form-data" id="updateForm">
                    @csrf   
                    <div class="form-group mb-3">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image" >
                        <div id="imagePreview" class="mt-2"></div>
                        @error('image')
                        <div class="invalid-feedback d-block">{{$message}}</div>
                        @enderror
                    </div>            
                  
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                     </div>
                    <div class="form-group mb-3">
                        <label for="discription">Description</label>
                        <textarea class="form-control" id="discription" name="discription" rows="3"></textarea>
                        @error('discription')
                        <div class="invalid-feedback d-block">{{$message}}</div>
                        @enderror
                    </div>
                            <div class="form-group mb-3">
                                <label for="cat_id">Category</label>
                                <select id="cat_id" name="cat_id" class="form-control">
                                    <option value="">Choose category</option>
                                    @foreach ($category as $row) 
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price">
                                @error('price')
                                <div class="invalid-feedback d-block">{{$message}}</div>
                                @enderror
                            </div>
                    <button type="submit" class="btn btn-dark  pl-7" id="submitButton">update</button>
                </form>
            </div>
           
        </div>
    </div>
  </div>


@endsection

<script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        let table = new DataTable('#tbl');
    
        $('.updbtn').on('click', function() {
            var productId = $(this).data('id');
            $.ajax({
                url: 'products/edit/' + productId,
                type: 'GET',
                success: function(response) {
                    $('#prodId').val(response.id);
                    $('#name').val(response.name);
                    $('#discription').val(response.discription); 
                    $('#price').val(response.price);
                    $('#updateModal').modal('show'); 
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                    alert('Failed to fetch product details.');
                }
            });
        });
    
        // Handle form submission for updating product
        $('#updateForm').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: 'products/update',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        alert(response.success);
                        $('#updateModal').modal('hide');
                        location.reload(); 
                    } else if (response.error) {
                        alert(response.error);
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                    alert('Failed to update product.');
                }
            });
        });
    
        $('#productForm').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        console.log('Form data:', formData); 

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    title: 'Success!',
                    text: response.message, 
                    icon: 'success',
                    timer: 2000, 
                    timerProgressBar: true,
                    willClose: () => {
                        $('#productModal').modal('hide');
                        // location.reload(); 
                    }
                });
            },
            error: function(xhr) {
            console.log('XHR Error:', xhr);
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                var errors = xhr.responseJSON.errors;
                console.log('Errors:', errors);
            } else {  
                console.error('An unexpected error occurred:', xhr);
            }
        }
        });
    });
    
        // Handle delete button click with confirmation
        $('.delete-link').on('click', function(event) {
            event.preventDefault();
            let url = $(this).attr('href'); 
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url; 
                }
            });
        });
    
        function previewImage() {
    const files = document.getElementById('image').files;
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = ''; 
    if (files.length) {
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML += `
                    <img src="${e.target.result}" alt="Image preview" class="img-fluid" 
                    style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;">
                `;
            };
            reader.readAsDataURL(file);
        });
    }
}

$('#image').on('change', previewImage);

    
        $('#image').on('change', previewImage);
    });
    </script>
    

</body>
</html>



