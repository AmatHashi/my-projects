<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@extends('layouts.app')
@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" data-bs-whatever="@mdo">Create New User</button>
    </div>    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
            $counter = 1;
            @endphp
            @foreach ($user as $row)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $row->username }}</td>
                    <td>{{ $row->email }}</td>
                    <td>
                        <a href="#" onclick="updatefn({{$row->id }})" class="btn btn-info btn-sm">View</a>
                        <a href="" class="btn btn-warning btn-sm">Update</a>
                        <form action="" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">add user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data" id="userForm">
                    @csrf                
                    
                    <div class="form-group">
                        <label for="username">username</label>
                        <input type="text" class="form-control" id="username" name="username">
                        @error('username')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                        @error('price')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                   
                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100" id="submitButton">Create</button>
                </form>
            </div>
            
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 const upduser = (id) => {
    let url = "{{ route('user.edit', ':id') }}";
    url = url.replace(':id', id);

    $.get(url)
        .done((data) => {
            $("#fullname").val(data.fullname);
            $("#username").val(data.username);
            $("#email").val(data.email);

            let updateUrl = "{{ route('user.modify', ':id') }}";
            updateUrl = updateUrl.replace(':id', id);
            $("#userForm").attr("action", updateUrl);
            $('#userModal').modal('toggle');
        })
        .fail((error) => {
            console.error('Error fetching data:', error);
        });
    $('#submitButton').text('update');
};
</script>


