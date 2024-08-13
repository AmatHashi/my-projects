<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
@extends('layouts.app')
@section('content')
<body>
    <div class="container mt-4">
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal" id="createButton">
            Create
          </button>
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customer as $row)
                    <tr>
                        <td>{{ $row->fullname }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>{{ $row->email }}</td>
                        <td>
                            <button class="btn btn-secondary">Update</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="customerForm" action="{{route('customers.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}">
                            @error('fullname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" id='btn' class="btn btn-primary" id="saveButton">Save Data</button>
                        </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>

<script>
  const updfn=(id){
    $('#btn').text('update Customer');
    let url = `{{ route('edit', ['id' => '']) }}` + id;
        // url = url.replace(':id', id);
        $.get(url)
            .done((data) => {
                $("#fullname").val(data.name);
                $("#phone").val(data.phone);
                $("#email").val(data.email);

                let updateUrl = "{{route('customer.update', ':id') }}";
                updateUrl = updateUrl.replace(':id', id);
                $("#customerForm").attr("action", updateUrl);
                $('#exampleModal').modal('toggle');
            })

  }



  $(document).ready(function() {
    $('#customerForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var formAction = $(this).attr('action');
        $.ajax({
            url: formAction
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#exampleModal').modal('hide'); 
                $('#customerForm')[0].reset();
            },
            error: function(xhr) {
                alert('An error occurred: ' + xhr.responseText);
            }
        });
    });
</script>

</body>
@endsection
</html>
