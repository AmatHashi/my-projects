
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                @foreach($category as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="#" onclick="updatefn({{$category['id']}})" class="btn btn-primary btn-sm">Update</a>
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


    <div class="modal fade" id="catModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Create category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.store')}}" method="POST" id="catForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" class="form-control" id="name" name="name" >
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
    @endsection


    @section('page_js')
<script>
    const updatefn = (id) => {
        let url = "{{ route('category.edit', ':id') }}";
        url = url.replace(':id', id);

        $.get(url)
            .done((data) => {
                $("#name").val(data.name);

                let updateUrl = "{{ route('category.update', ':id') }}";
                updateUrl = updateUrl.replace(':id', id);
                $("#catForm").attr("action", updateUrl);

                $('#catModal').modal('toggle');
            })
            .fail((error) => {
                console.error('Error fetching data:', error);
            });
    };

    $("#catModal").on("hidden.bs.modal", function() {
        $("#name").val("");
        $("#catForm").attr("action", "{{ route('categories') }}");
    });
</script>
@endsection



