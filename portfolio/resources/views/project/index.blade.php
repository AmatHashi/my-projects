

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
    <title>admin panel</title>
</head>
<body>
    @extends('layouts.sidebar')
    @section('sidebarContent')
    <div class="container mt-5">
    <h2 class="mb-4 text-secondary">Projects List</h2>
    <div class="d-flex justify-content-start mb-3"> 
    <button class="btn btn-primary" id="btn-save-all" data-bs-toggle="modal" data-bs-target="#projectModal">Add</button>
    </div>
    <div class="row">
        @foreach ($project as $row)
            <div class="col-md-4 mb-4">
                <div class="card" style="height: 400px;"> 
                    <img src="{{ asset('storage/' . $row->image) }}" class="card-img-top" alt="{{ $row->title }}" style="height: 200px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $row->name }}</h5>
                        <p class="card-text flex-grow-1">{{ $row->description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="" data-id="{{ $row->id }}" class="btn btn-primary btn-update">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{route('project.delete',$row->id)}}" class="btn btn-danger btn-delete" >
                                <i class="fas fa-trash"></i> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- model create--}}

 <div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center ml-5" id="exampleModalLabel">create project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('project.store')}}" method="POST" enctype="multipart/form-data" id="projectForm">
                    @csrf
        
                    <div class="form-group mb-3">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image"   name="image">
                        
                    </div>
        
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                       
                    </div>
        
                    <div class="form-group mb-3">
                        <label for="discription">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    
                    </div>
                    <button type="submit" class="btn btn-dark pl-7" id="submitButton">store</button>
                </form>  
            </div>
        </div>
    </div>
  </div> 

{{-- model update --}}

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="updId" name="id">

                    <div class="form-group mb-3">
                        <label for="update_image">Image</label>
                        <input type="file" class="form-control" id="update_image" name="image">
                    </div>

                    <div class="form-group">
                        <label for="update_name">Name</label>
                        <input type="text" class="form-control" id="update_name" name="name" >
                    </div>

                    <div class="form-group mb-3">
                        <label for="update_description">Description</label>
                        <textarea class="form-control" id="update_description" name="description" rows="3" ></textarea>
                    </div>

                    <button type="submit" class="btn btn-dark" id="updateButton">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <script>

     jQuery(document).ready(function($) {
        $('#projectForm').on('submit', function(event) {
            event.preventDefault();  
            var formData = new FormData(this);
    
            $.ajax({
                url: $(this).attr('action'), 
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    location.reload();  
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
   

        // Update project
        $('.btn-update').on('click', function(event) {
            event.preventDefault()

         var projectId = $(this).data('id');   
        $.ajax({
         url: 'edit/' + projectId,
         type: 'GET',
         success: function(response) {
            $('#updateModal #updId').val(response.id);  
            $('#updateModal #update_name').val(response.name);
            $('#updateModal #update_description').val(response.description); 
            $('#updateModal').modal('show');
           
          },
            error: function(xhr) {
            console.error('Error:', xhr);
            alert('Failed to fetch product details.');
        }
    });
    });

 // Update form submission
$('#updateForm').on('submit', function(event) {
    event.preventDefault(); 
    var formData = new FormData(this);
    $.ajax({
        url: 'update',  
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            alert(response.message);  
            $('#updateModal').modal('hide');  
            location.reload();  
        },
        error: function(xhr) { 
            console.error('Error:', xhr);
            alert('Failed to update product.');
        }
    });
    });

    
        // Handle delete button click with confirmation
        $('.btn-delete').on('click', function(event) {
            event.preventDefault();  
            let url = $(this).attr('href'); 
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url; 
                }
            });
        });
    });
    </script>
    
@endsection
 {{-- //     if (typeof jQuery === 'undefined') {
        //     console.error('jQuery is not loaded');
        // } else {
        //     console.log('jQuery is loaded');
        // }
        // $(function() {
        //     console.log('jQuery is working:', $.fn.jquery);
        // }); --}}

</body>
</html>