<!-- Include necessary styles and scripts -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>All Category</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#catModal" data-bs-whatever="@mdo">Create New category</button>
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
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $count=1
            @endphp
            @foreach($category as $category)
                <tr>
                    <td>{{$count++}}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm update-btn" data-id="{{$category->id}}" >
                            <i class="fas fa-pencil-alt"></i>
                        </button>                          
                        <a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger btn-sm ml-2 delete-link" title="Delete">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Create Category Modal -->
<div class="modal fade" id="catModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Create category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.store') }}" method="POST" id="catForm">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="catName" name="name">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Update Category Modal -->
<div class="modal fade" id="updModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Update Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="categoryId" name="id">
                    <div class="form-group">
                        <label for="updName">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <button type="button" class="btn btn-primary w-100" id="updateSubmit">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function(){
    $('.update-btn').on('click', function(){
        var id = $(this).data('id');
        $.ajax({
            url: 'category/edit/' + id,
            type: 'GET',
            success: function(response) {
               console.log(response)
                $('#categoryId').val(response.id);
                $('#name').val(response.name);
                $('#updModal').modal('show');
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                alert('Failed to fetch category details.');
            }
        });
    });
    $('#updateSubmit').on('click', function(){
        var id = $('#categoryId').val();
        var name = $('#name').val();
        
        $.ajax({
            url: '{{ route('category.update') }}',  
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                id: id,
                name: name
            },
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    $('#updModal').modal('hide');
                    location.reload();  
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                alert('Failed to update category.');
            }
        });
    });
    

    $('.delete-link').on('click', function(event) {
        event.preventDefault(); 

        let url = $(this).attr('href'); 

        Swal.fire({
            title: 'Are you sure to delete this?',
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
});
</script>
